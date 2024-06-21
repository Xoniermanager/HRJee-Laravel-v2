<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserRelativeDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_relative_details')->delete();
        
        \DB::table('user_relative_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'relation_name' => 'Obie Little',
                'name' => 'Christ Nicolas',
                'dob' => '2025-01-08',
                'phone' => '759-764-5206',
                'nominee' => 0,
                'created_at' => '2024-06-21 15:03:24',
                'updated_at' => '2024-06-21 15:03:24',
            ),
        ));
        
        
    }
}