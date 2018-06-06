<?php

use Illuminate\Database\Seeder;
use App\Address;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::truncate();
        
        
        $addresses = [
          ["550 E Brokaw Rd", "San Jose", "CA", 95112],
          ["1077 E Arques Ave", "Sunnyvale", "CA", 94085],
          [ "43800 Osgood Rd", "Fremont", "CA", 94539],
          ["600 E Hamilton Ave", "Campbell", "CA", 95008],
          ["340 Portage Ave", "Palo Alto", "CA", 94306],
        ];
        foreach ($addresses as $addr) {
          list ($street, $city, $state, $zip) = $addr;
          Address::create([
            'street' => $street,
            'city'   => $city,
            'state'  => $state,
            'zip'    => $zip,
          ]);          
        }
    }
}
