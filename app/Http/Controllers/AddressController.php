<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;

class AddressController extends Controller
{
    public function index () {
      return Address::all();
    }
    
    public function show(Address $address) {
      return $address;
    }
    
    public function store (Request $request) {
      $address = Address::create($request->all());
      return response()->json($address, 201);
    }
    
    public function update(Request $request, Address $address) {
      $address->update($request->all());
      $address->lat = null;
      $address->lng = null;
      
      return response()->json($address, 200);
    }
    
    public function delete(Address $address) {
      $address->delete();
      return response()->json(null, 204);
    }

    public function geocode (Address $address) {
      $lat = $address->lat;
      $lng = $address->lng;
      if (defined ($lat) && defined ($lng)) {
        return response()->json($address, 200);
      }

      $address = geocode_address ($address); # adds lat, lng fields
      if (!$address) {
        return response()->json(null, 400);   # BAD REQUEST
      }
      $address->save();  # save lat, lng fields


      return response()->json($address, 200);
    }
}


function get_gmap_api_site_key () {
  $val = env('GMAP_API_SITE_KEY', false);
  if (!$val) {
    dd (".env file is missing GMAP_API_SITE_KEY");
  }
  return $val;
}

function geocode_address ($address) {
  $street = $address->street;
  $city   = $address->city;
  $state  = $address->state;
  $zip    = $address->zip;
  $address_string = "$street, $city, $state, $zip";
  $address_string = urlencode($address_string);

  // create curl resource
  $ch = curl_init();

  $gmap_api_key = get_gmap_api_site_key();
  $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address_string&key=$gmap_api_key";
  curl_setopt($ch, CURLOPT_URL, $url);

  //return the transfer as a string
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  // $output contains the output string
  $output = curl_exec($ch);

  // close curl resource to free up system resources
  curl_close($ch);

  $geo_loc = json_decode($output);
  $status = $geo_loc->status;
  if ($status != "OK") {
    return null;
  }
  $location = $geo_loc->results[0]->geometry->location;
  $lat = $location->lat;
  $lng = $location->lng;

  $address['lat'] = $lat;
  $address['lng'] = $lng;
  return $address;
}
