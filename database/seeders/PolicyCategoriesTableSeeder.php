<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PolicyCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('policy_categories')->delete();
        
        \DB::table('policy_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'General',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-07-04 11:44:29',
                'updated_at' => '2024-07-04 11:44:29',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Hard',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-07-04 11:44:36',
                'updated_at' => '2024-07-04 11:44:36',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Leave Policy',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-07-04 11:44:51',
                'updated_at' => '2024-07-04 11:44:51',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'HR Policy',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-07-04 11:45:04',
                'updated_at' => '2024-07-04 11:59:38',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Asset Policy',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-07-04 11:45:12',
                'updated_at' => '2024-07-04 11:45:12',
            ),
        ));
        
        
    }
}