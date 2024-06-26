<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AssetStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('asset_statuses')->delete();
        
        \DB::table('asset_statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'CREATED',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-24 11:18:35',
                'updated_at' => '2024-06-24 11:18:35',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'UPDATED',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-24 11:18:42',
                'updated_at' => '2024-06-24 11:18:42',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'DRAFTED',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-24 11:18:49',
                'updated_at' => '2024-06-24 11:18:49',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'PENDING',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-24 11:19:02',
                'updated_at' => '2024-06-24 11:19:02',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'APPROVED',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-24 11:19:09',
                'updated_at' => '2024-06-24 11:19:09',
            ),
        ));
        
        
    }
}