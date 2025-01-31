<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ComplainStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('complain_statuses')->delete();

        \DB::table('complain_statuses')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Approved',
                    'status' => 1,
                    'company_id' => 1,
                    'created_by' => 1,
                    'created_at' => '2024-07-15 11:59:38',
                    'updated_at' => '2024-07-15 12:00:34',
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'Pending',
                    'status' => 1,
                    'company_id' => 1,
                    'created_by' => 1,
                    'created_at' => '2024-07-15 11:59:50',
                    'updated_at' => '2024-07-15 11:59:50',
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'Rejected',
                    'status' => 1,
                    'company_id' => 1,
                    'created_by' => 1,
                    'created_at' => '2024-07-15 11:59:57',
                    'updated_at' => '2024-07-15 12:00:14',
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'Processing',
                    'status' => 1,
                    'company_id' => 1,
                    'created_by' => 1,
                    'created_at' => '2024-07-15 12:03:22',
                    'updated_at' => '2024-07-15 12:03:22',
                ),
        ));


    }
}