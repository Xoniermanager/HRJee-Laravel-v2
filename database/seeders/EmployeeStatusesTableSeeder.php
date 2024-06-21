<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmployeeStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('employee_statuses')->delete();
        
        \DB::table('employee_statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Current',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:44:24',
                'updated_at' => '2024-06-21 14:44:24',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Resigned',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:44:35',
                'updated_at' => '2024-06-21 14:44:35',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Terminated',
                'description' => NULL,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 14:44:47',
                'updated_at' => '2024-06-21 14:44:47',
            ),
        ));
        
        
    }
}