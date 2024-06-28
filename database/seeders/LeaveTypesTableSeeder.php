<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LeaveTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('leave_types')->delete();
        
        \DB::table('leave_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Sick',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-28 12:33:08',
                'updated_at' => '2024-06-28 12:33:08',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Casual',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-28 12:33:14',
                'updated_at' => '2024-06-28 12:33:14',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Paid Leave',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-28 12:33:27',
                'updated_at' => '2024-06-28 12:33:27',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Unpaid Leave',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-28 12:33:40',
                'updated_at' => '2024-06-28 12:33:40',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Earned',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-28 12:34:16',
                'updated_at' => '2024-06-28 12:34:16',
            ),
        ));
        
        
    }
}