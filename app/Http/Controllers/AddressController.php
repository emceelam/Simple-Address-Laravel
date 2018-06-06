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
      
      return response()->json($address, 200);
    }
    
    public function delete(Address $address) {
      $address->delete();
      return response()->json(null, 204);
    }
}
