<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('departments')->delete();
        
        \DB::table('departments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'HR',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:48:04',
                'updated_at' => '2024-06-21 14:48:04',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Production',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:48:11',
                'updated_at' => '2024-06-21 14:48:11',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Developer',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:48:20',
                'updated_at' => '2024-06-21 14:48:20',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Sales',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:48:29',
                'updated_at' => '2024-06-21 14:48:29',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Marketing',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:48:37',
                'updated_at' => '2024-06-21 14:48:37',
            ),
        ));
        
        
    }
}