<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QualificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('qualifications')->delete();
        
        \DB::table('qualifications')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Btech',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:47:17',
                'updated_at' => '2024-06-21 14:47:17',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '10th',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:47:25',
                'updated_at' => '2024-06-21 14:47:25',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '12th',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:47:32',
                'updated_at' => '2024-06-21 14:47:32',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'BCA',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:47:38',
                'updated_at' => '2024-06-21 14:47:38',
            ),
        ));
        
        
    }
}