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
                'id' => 7,
                'emp_id' => '123456',
                'user_id' => 9,
                'official_email_id' => 'arjun@gmail.com',
                'father_name' => NULL,
                'mother_name' => NULL,
                'blood_group' => 'A-',
                'gender' => 'M',
                'marital_status' => 'M',
                'employee_status_id' => 1,
                'date_of_birth' => '2025-01-29',
                'joining_date' => '2025-01-29',
                'phone' => '1234567890',
                'profile_image' => NULL,
                'last_login_ip' => '127.0.0.1',
                'employee_type_id' => 1,
                'department_id' => 1,
                'designation_id' => 1,
                'company_branch_id' => 1,
                'qualification_id' => 4,
                'shift_id' => 1,
                'offer_letter_id' => '#1234576',
                'work_from_office' => 0,
                'exit_date' => NULL,
                'official_mobile_no' => '1234567653',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-01-29 18:00:18',
                'updated_at' => '2025-01-29 18:00:18',
            ),
        ));
        
        
    }
}