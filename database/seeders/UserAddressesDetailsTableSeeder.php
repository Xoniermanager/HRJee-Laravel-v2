<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserAddressesDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_addresses_details')->delete();
        
        \DB::table('user_addresses_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'address_type' => 'both_same',
                'country_id' => 100,
                'state_id' => 1,
                'address' => 'Noida',
                'city' => 'Noida sec 62',
                'pin_code' => '201901',
                'created_at' => '2024-06-21 14:58:59',
                'updated_at' => '2025-01-30 13:12:26',
            ),
        ));
        
        
    }
}