<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DefaultLenderTable extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('default_lenders')->delete();
        
        \DB::table('default_lenders')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'HDFC Bank',
                'description' => NULL,
                'status' => 1,
                'created_by' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-21 14:47:17',
                'updated_at' => '2024-06-21 14:47:17',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Central Bank Of India',
                'description' => NULL,
                'status' => 1,
                'created_by' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-21 14:47:17',
                'updated_at' => '2024-06-21 14:47:17',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'AU Bank',
                'description' => NULL,
                'status' => 1,
                'created_by' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-21 14:47:17',
                'updated_at' => '2024-06-21 14:47:17',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Punjab National Bank Of India',
                'description' => NULL,
                'status' => 1,
                'created_by' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-21 14:47:17',
                'updated_at' => '2024-06-21 14:47:17',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Punjab National Bank Of India',
                'description' => NULL,
                'status' => 1,
                'created_by' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-21 14:47:17',
                'updated_at' => '2024-06-21 14:47:17',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Hero Fincorp',
                'description' => NULL,
                'status' => 1,
                'created_by' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-21 14:47:17',
                'updated_at' => '2024-06-21 14:47:17',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Bajaj Finance',
                'description' => NULL,
                'status' => 1,
                'created_by' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-21 14:47:17',
                'updated_at' => '2024-06-21 14:47:17',
            ),
        ));
    }
}