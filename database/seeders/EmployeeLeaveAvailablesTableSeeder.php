<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmployeeLeaveAvailablesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('employee_leave_availables')->delete();
        
        \DB::table('employee_leave_availables')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'leave_type_id' => 1,
                'available' => 2,
                'created_at' => '2025-03-10 15:53:39',
                'updated_at' => '2025-03-10 15:53:39',
            ),
        ));
        
        
    }
}