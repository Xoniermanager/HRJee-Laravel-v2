<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WeekendsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('weekends')->delete();
        
        \DB::table('weekends')->insert(array (
            0 => 
            array (
                'id' => 3,
                'company_id' => 1,
                'company_branch_id' => 1,
                'department_id' => 1,
                'description' => NULL,
                'status' => 1,
                'created_at' => '2025-01-09 14:59:12',
                'updated_at' => '2025-01-09 14:59:12',
            ),
            1 => 
            array (
                'id' => 4,
                'company_id' => 1,
                'company_branch_id' => 1,
                'department_id' => 3,
                'description' => NULL,
                'status' => 1,
                'created_at' => '2025-01-09 15:01:03',
                'updated_at' => '2025-01-09 15:01:03',
            ),
        ));
        
        
    }
}