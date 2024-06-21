<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('skills')->delete();
        
        \DB::table('skills')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'php',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 15:00:13',
                'updated_at' => '2024-06-21 15:00:13',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'larvavel',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 15:00:21',
                'updated_at' => '2024-06-21 15:00:21',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'ajax',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 15:00:29',
                'updated_at' => '2024-06-21 15:00:29',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'js',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 15:02:00',
                'updated_at' => '2024-06-21 15:02:00',
            ),
        ));
        
        
    }
}