<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResignationStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('resignation_status')->delete();
        
        DB::table('resignation_status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'approved',
                'status' => 1,
                'created_at' => '2024-07-17 10:23:25',
                'updated_at' => '2024-07-17 10:23:28',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'rejected',
                'status' => 1,
                'created_at' => '2024-07-17 10:23:25',
                'updated_at' => '2024-07-17 10:23:28',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'pending',
                'status' => 1,
                'created_at' => '2024-07-17 10:23:25',
                'updated_at' => '2024-07-17 10:23:28',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'withdrawn',
                'status' => 1,
                'created_at' => '2024-07-17 10:23:25',
                'updated_at' => '2024-07-17 10:23:28',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'hold',
                'status' => 1,
                'created_at' => '2024-07-17 10:23:25',
                'updated_at' => '2024-07-17 10:23:28',
            ),
        ));
        
        
    }
}