<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ComplainCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('complain_categories')->delete();

        \DB::table('complain_categories')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'HR',
                    'description' => NULL,
                    'status' => 1,
                    'company_id' => 1,
                    'created_by' => 1,
                    'created_at' => '2024-07-15 13:03:51',
                    'updated_at' => '2024-07-15 13:03:51',
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'IT',
                    'description' => 'IT related',
                    'status' => 1,
                    'company_id' => 1,
                    'created_by' => 1,
                    'created_at' => '2024-07-15 13:04:04',
                    'updated_at' => '2024-07-15 13:04:04',
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'Attendance',
                    'description' => NULL,
                    'status' => 1,
                    'company_id' => 1,
                    'created_by' => 1,
                    'created_at' => '2024-07-15 13:04:24',
                    'updated_at' => '2024-07-15 13:04:24',
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'Productive complaining',
                    'description' => NULL,
                    'status' => 1,
                    'company_id' => 1,
                    'created_by' => 1,
                    'created_at' => '2024-07-15 13:05:19',
                    'updated_at' => '2024-07-15 13:05:19',
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'Venting',
                    'description' => NULL,
                    'status' => 1,
                    'company_id' => 1,
                    'created_by' => 1,
                    'created_at' => '2024-07-15 13:05:30',
                    'updated_at' => '2024-07-15 13:05:30',
                ),
        ));


    }
}