<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SalariesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('salaries')->delete();
        
        \DB::table('salaries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Developer Salary',
                'description' => 'This Developer Salary assigned to Developer only.',
                'company_id' => 1,
                'created_by' => 1,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-02-03 15:37:28',
                'updated_at' => '2025-02-03 17:55:30',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Marketing Salary',
                'description' => 'This Marketing Salary Assigned only Marketing Team.',
                'company_id' => 1,
                'created_by' => 1,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-02-03 15:37:56',
                'updated_at' => '2025-02-03 17:55:44',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Sales Team Salary',
                'description' => 'This Salary Strucrture assigned to sales team only.',
                'company_id' => 1,
                'created_by' => 1,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-02-03 15:38:42',
                'updated_at' => '2025-02-03 17:55:48',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Lead Generation Salary',
                'description' => 'this salary structure assigned only lead gerneration only.',
                'company_id' => 1,
                'created_by' => 1,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-02-03 15:39:35',
                'updated_at' => '2025-02-03 17:55:53',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'HR Salary',
                'description' => 'This Salary Structured assigned only hr.',
                'company_id' => 1,
                'created_by' => 1,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-02-03 15:40:10',
                'updated_at' => '2025-02-03 17:55:57',
            ),
        ));
        
        
    }
}