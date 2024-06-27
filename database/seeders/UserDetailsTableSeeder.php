<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_details')->delete();
        
        \DB::table('user_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'employee_type_id' => 4,
                'department_id' => 3,
                'designation_id' => 4,
                'company_branch_id' => 1,
                'role_id' => 3,
                'qualification_id' => 4,
                'shift_id' => 1,
                'offer_letter_id' => 'Dignissimos perspiciatis id rerum.',
                'work_from_office' => 1,
                'exit_date' => NULL,
                'official_mobile_no' => '523',
                'created_at' => '2024-06-21 15:03:16',
                'updated_at' => '2024-06-21 15:03:16',
            ),
        ));
        
        
    }
}