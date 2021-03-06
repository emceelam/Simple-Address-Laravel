<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Address;
use App\Http\Controllers\AddressController;

class AddressTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testsAdddressesAreCreatedCorrectly() {
      $payload = [
        'street' => '2200 Mission College Blvd.',
        'city' => 'Santa Clara',
        'state' => 'CA',
        'zip' => 95054,
      ];

      $this->json('POST', '/api/addresses', $payload)
        #->assertStatus(200)
        ->assertJson([
          'id' => 1, 
          'street' => '2200 Mission College Blvd.',
          'city' => 'Santa Clara',
          'state' => 'CA',
          'zip' => 95054,
        ]);
    }

    public function testsAddressesAreUpdatedCorrectly() {
      $address = factory(Address::class)->create([
        'street' => '2200 Mission College Blvd.',
        'city' => 'Santa Clara',
        'state' => 'CA',
        'zip' => 95054,
      ]);
      $id = $address->id;

      $payload = [
        'street' => '2485 Augustine Dr',
        'city' => 'Santa Clara',
        'state' => 'CA',
        'zip' => 95054,
      ];
      $this->json('PUT', "/api/addresses/$id", $payload)
        ->assertStatus(200)
        ->assertJson([
          'id' => 1,
          'street' => '2485 Augustine Dr',
          'city' => 'Santa Clara',
          'state' => 'CA',
          'zip' => 95054,
        ]);
    }

    public function testsAreDeletedCorrectly() {
      $address = factory(Address::class)->create([
        'street' => '2200 Mission College Blvd.',
        'city' => 'Santa Clara',
        'state' => 'CA',
        'zip' => 95054,
      ]);
      $id = $address->id;

      $this->json('DELETE', "/api/addresses/$id")
        ->assertStatus(204);
    }

    public function testArticlesAreListedCorrectly() {
      $address = factory(Address::class)->create([
        'street' => '2200 Mission College Blvd.',
        'city' => 'Santa Clara',
        'state' => 'CA',
        'zip' => 95054,
      ]);
      $address = factory(Address::class)->create([
        'street' => '2485 Augustine Dr',
        'city' => 'Santa Clara',
        'state' => 'CA',
        'zip' => 95054,
      ]);

      $this->json('GET', "/api/addresses")
        ->assertStatus(200)
        ->assertJsonStructure([
          '*' => ['id','street','city', 'state', 'zip', 'created_at', 'updated_at'],
        ]);
    }


    public function testGeocode() {
      $address = factory(Address::class)->create([
        'street' => '2200 Mission College Blvd.',
        'city'   => 'Santa Clara',
        'state'  => 'CA',
        'zip'    => 95054,
      ]);
      $id = $address->id;

      $this->json('GET', "/api/addresses/$id/geocode")
        ->assertStatus(200)
        ->assertJson([
          'street' => '2200 Mission College Blvd.',
          'city'   => 'Santa Clara',
          'state'  => 'CA',
          'zip'    => 95054,
          'lat'    => 37.3875909,
          'lng'    => -121.9637869,
        ]);
    }

    public function testGmapApiKey() {
      $api_key = AddressController::get_gmap_api_site_key();
      $this->assertTrue( strlen($api_key) > 0 );
    }
}
