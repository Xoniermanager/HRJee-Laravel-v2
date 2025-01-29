<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DesignationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('designations')->delete();

        \DB::table('designations')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'company_id' => 1,
                    'created_by' => 1,
                    'name' => 'Manager',
                    'department_id' => 1,
                    'status' => 1,
                    'created_at' => '2024-06-21 14:49:43',
                    'updated_at' => '2024-06-21 14:49:43',
                ),
            1 =>
                array(
                    'id' => 2,
                    'company_id' => 1,
                    'created_by' => 1,
                    'name' => 'Senior Manager',
                    'department_id' => 1,
                    'status' => 1,
                    'created_at' => '2024-06-21 14:49:54',
                    'updated_at' => '2024-06-21 14:49:54',
                ),
            2 =>
                array(
                    'id' => 3,
                    'company_id' => 1,
                    'created_by' => 1,
                    'name' => 'Laravel developer',
                    'department_id' => 3,
                    'status' => 1,
                    'created_at' => '2024-06-21 14:50:04',
                    'updated_at' => '2024-06-21 14:50:04',
                ),
            3 =>
                array(
                    'id' => 4,
                    'company_id' => 1,
                    'created_by' => 1,
                    'name' => 'Php Developer',
                    'department_id' => 3,
                    'status' => 1,
                    'created_at' => '2024-06-21 14:50:14',
                    'updated_at' => '2024-06-21 14:50:14',
                ),
            4 =>
                array(
                    'id' => 5,
                    'company_id' => 1,
                    'created_by' => 1,
                    'name' => 'Email Marketing',
                    'department_id' => 4,
                    'status' => 1,
                    'created_at' => '2024-06-21 14:50:25',
                    'updated_at' => '2024-06-21 14:50:25',
                ),
            5 =>
                array(
                    'id' => 6,
                    'company_id' => 1,
                    'created_by' => 1,
                    'name' => 'BDE',
                    'department_id' => 5,
                    'status' => 1,
                    'created_at' => '2024-06-21 14:50:33',
                    'updated_at' => '2024-06-21 14:50:33',
                ),
        ));


    }
}