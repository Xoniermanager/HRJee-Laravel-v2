<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserAssetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_assets')->delete();
        
        \DB::table('user_assets')->insert(array (
            0 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'asset_id' => 3,
                'assigned_date' => '2024-06-24',
                'returned_date' => '2024-06-24',
                'comment' => NULL,
                'created_at' => '2024-06-24 16:52:09',
                'updated_at' => '2024-06-24 18:16:07',
            ),
            1 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'asset_id' => 4,
                'assigned_date' => '2024-06-24',
                'returned_date' => NULL,
                'comment' => NULL,
                'created_at' => '2024-06-24 17:37:46',
                'updated_at' => '2024-06-24 18:09:41',
            ),
            2 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'asset_id' => 1,
                'assigned_date' => '2024-06-25',
                'returned_date' => NULL,
                'comment' => NULL,
                'created_at' => '2024-06-24 17:40:29',
                'updated_at' => '2024-06-24 18:04:35',
            ),
            3 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'asset_id' => 2,
                'assigned_date' => '2024-06-24',
                'returned_date' => NULL,
                'comment' => NULL,
                'created_at' => '2024-06-24 17:41:49',
                'updated_at' => '2024-06-24 18:11:39',
            ),
            4 => 
            array (
                'id' => 6,
                'user_id' => 1,
                'asset_id' => 5,
                'assigned_date' => '2024-06-24',
                'returned_date' => NULL,
                'comment' => NULL,
                'created_at' => '2024-06-24 17:43:19',
                'updated_at' => '2024-06-24 18:15:07',
            ),
        ));
        
        
    }
}