<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HolidaysTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('holidays')->delete();
        
        \DB::table('holidays')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Holi',
                'date' => '2024-03-08',
                'year' => '2024',
                'company_id' => 1,
                'status' => 1,
                'created_at' => '2024-06-25 10:59:47',
                'updated_at' => '2024-06-25 10:59:47',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Diwali',
                'date' => '2024-11-01',
                'year' => '2024',
                'company_id' => 1,
                'status' => 1,
                'created_at' => '2024-06-25 11:00:07',
                'updated_at' => '2024-06-25 11:00:07',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Diwali',
                'date' => '2024-11-13',
                'year' => '2025',
                'company_id' => 1,
                'status' => 1,
                'created_at' => '2024-06-25 11:01:08',
                'updated_at' => '2024-06-25 11:01:08',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Dussreha',
                'date' => '2024-09-11',
                'year' => '2024',
                'company_id' => 1,
                'status' => 1,
                'created_at' => '2024-06-25 11:01:50',
                'updated_at' => '2024-06-25 11:01:50',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Christmas',
                'date' => '2024-12-25',
                'year' => '2024',
                'company_id' => 1,
                'status' => 1,
                'created_at' => '2024-06-25 11:02:16',
                'updated_at' => '2024-06-25 11:02:16',
            ),
        ));
        
        
    }
}