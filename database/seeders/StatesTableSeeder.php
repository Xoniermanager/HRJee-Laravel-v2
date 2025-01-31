<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('states')->delete();

        \DB::table('states')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Uttar Pardesh',
                'country_id' => 100,
                'status' => 1,
                'created_at' => '2024-06-21 13:12:49',
                'updated_at' => '2024-06-21 13:12:49',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Delhi',
                'country_id' => 100,
                'status' => 1,
                'created_at' => '2024-06-21 13:12:59',
                'updated_at' => '2024-06-21 13:12:59',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'MP',
                'country_id' => 100,
                'status' => 1,
                'created_at' => '2024-06-21 13:13:20',
                'updated_at' => '2024-06-21 13:13:20',
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'Bihar',
                'country_id' => 100,
                'status' => 1,
                'created_at' => '2024-06-21 13:14:25',
                'updated_at' => '2024-06-21 13:14:25',
            ),
            4 =>
            array(
                'id' => 5,
                'name' => 'Jharkhand',
                'country_id' => 100,
                'status' => 1,
                'created_at' => '2024-06-21 13:15:17',
                'updated_at' => '2024-06-21 13:15:17',
            ),
            5 =>
            array(
                'id' => 6,
                'name' => 'Mumbai',
                'country_id' => 100,
                'status' => 1,
                'created_at' => '2024-06-21 13:15:36',
                'updated_at' => '2024-06-21 13:15:36',
            ),
            6 =>
            array(
                'id' => 7,
                'name' => 'Chennai',
                'country_id' => 100,
                'status' => 1,
                'created_at' => '2024-06-21 13:15:49',
                'updated_at' => '2024-06-21 13:15:49',
            ),
            7 =>
            array(
                'id' => 8,
                'name' => 'Oddisa',
                'country_id' => 100,
                'status' => 1,
                'created_at' => '2024-06-21 13:15:59',
                'updated_at' => '2024-06-21 13:15:59',
            ),
            8 =>
            array(
                'id' => 9,
                'name' => 'West Bengal',
                'country_id' => 100,
                'status' => 1,
                'created_at' => '2024-06-21 13:16:22',
                'updated_at' => '2024-06-21 13:16:22',
            ),
            9 =>
            array(
                'id' => 10,
                'name' => 'Punjab',
                'country_id' => 100,
                'status' => 1,
                'created_at' => '2024-06-21 13:16:36',
                'updated_at' => '2024-06-21 13:16:36',
            ),
        ));
    }
}
