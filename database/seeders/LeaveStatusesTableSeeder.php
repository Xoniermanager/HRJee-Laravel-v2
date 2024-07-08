<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LeaveStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('leave_statuses')->delete();
        
        \DB::table('leave_statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'PENDING',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-24 10:04:53',
                'updated_at' => '2024-06-24 10:04:53',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'APPROVED',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-24 10:05:02',
                'updated_at' => '2024-06-24 10:05:02',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'CANCELLED',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-24 10:05:21',
                'updated_at' => '2024-06-24 10:05:21',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'REJECTED',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-24 10:05:21',
                'updated_at' => '2024-06-24 10:05:21',
            ),
        ));
    }
}