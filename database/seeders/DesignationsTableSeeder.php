<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DesignationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('designations')->delete();
        
        \DB::table('designations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Manager',
                'company_id' => NULL,
                'department_id' => 1,
                'status' => 1,
                'created_at' => '2024-06-21 14:49:43',
                'updated_at' => '2024-06-21 14:49:43',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Senior Manager',
                'company_id' => NULL,
                'department_id' => 1,
                'status' => 1,
                'created_at' => '2024-06-21 14:49:54',
                'updated_at' => '2024-06-21 14:49:54',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Laravel developer',
                'company_id' => NULL,
                'department_id' => 3,
                'status' => 1,
                'created_at' => '2024-06-21 14:50:04',
                'updated_at' => '2024-06-21 14:50:04',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Php Developer',
                'company_id' => NULL,
                'department_id' => 3,
                'status' => 1,
                'created_at' => '2024-06-21 14:50:14',
                'updated_at' => '2024-06-21 14:50:14',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Email Marketing',
                'company_id' => NULL,
                'department_id' => 4,
                'status' => 1,
                'created_at' => '2024-06-21 14:50:25',
                'updated_at' => '2024-06-21 14:50:25',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'BDE',
                'company_id' => NULL,
                'department_id' => 5,
                'status' => 1,
                'created_at' => '2024-06-21 14:50:33',
                'updated_at' => '2024-06-21 14:50:33',
            ),
        ));
        
        
    }
}