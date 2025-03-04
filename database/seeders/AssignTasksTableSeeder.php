<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AssignTasksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('assign_tasks')->delete();

        \DB::table('assign_tasks')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => 2,
                'user_end_status' => 'pending',
                'final_status' => 'pending',
                'response_data' => '{"name":"arjun","email":"test@gmail.com","phone":"1234567890","city":"Noida","gender":"Male"}',
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-02-28 14:25:00',
                'updated_at' => '2025-02-28 14:25:00',
            ),
        ));


    }
}
