<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmployeeTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('employee_types')->delete();
        
        \DB::table('employee_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Contract',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:45:08',
                'updated_at' => '2024-06-21 14:45:08',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'New Joinee',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:45:24',
                'updated_at' => '2024-06-21 14:45:24',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Trainee',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:45:36',
                'updated_at' => '2024-06-21 14:45:36',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Permanent',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:45:50',
                'updated_at' => '2024-06-21 14:45:50',
            ),
        ));
        
        
    }
}