<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NewsCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('news_categories')->delete();
        
        \DB::table('news_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'General',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-25 15:40:07',
                'updated_at' => '2024-06-25 15:40:07',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Normal',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-25 15:40:16',
                'updated_at' => '2024-06-25 15:40:16',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Hard News',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-25 15:41:20',
                'updated_at' => '2024-06-25 15:41:20',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Soft News',
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-25 15:41:29',
                'updated_at' => '2024-06-25 15:41:29',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Good News',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-25 15:41:38',
                'updated_at' => '2024-06-25 15:41:38',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'IT News',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-25 15:51:15',
                'updated_at' => '2024-07-02 11:17:36',
            ),
        ));
        
        
    }
}