<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserActiveLocationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_active_locations')->delete();
        
        \DB::table('user_active_locations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'address' => 'Noida H-161 BSI Park',
                'latitude' => '28.5355161',
                'longitude' => '77.3910265',
                'created_at' => '2025-03-26 11:23:22',
                'updated_at' => '2025-03-26 11:23:22',
            ),
        ));
        
        
    }
}