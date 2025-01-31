<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BreakTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('break_types')->delete();

        \DB::table('break_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Lunch Break',
                'description' => 'abc',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2024-07-11 15:19:59',
                'updated_at' => '2024-07-11 15:21:12',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Tea Break',
                'description' => 'asdsa',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2024-07-11 15:20:08',
                'updated_at' => '2024-07-11 15:20:08',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Testered',
                'description' => 'Demo testing',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2024-07-11 15:38:26',
                'updated_at' => '2024-07-11 15:38:26',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'lunch time',
                'description' => 'lunch for employee',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2024-07-11 15:49:19',
                'updated_at' => '2024-07-11 15:49:19',
            ),
        ));


    }
}
