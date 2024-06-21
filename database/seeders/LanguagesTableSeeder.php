<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Hindi',
                'status' => 1,
                'created_at' => '2024-06-21 15:02:10',
                'updated_at' => '2024-06-21 15:02:10',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'English',
                'status' => 1,
                'created_at' => '2024-06-21 15:02:14',
                'updated_at' => '2024-06-21 15:02:14',
            ),
        ));
        
        
    }
}