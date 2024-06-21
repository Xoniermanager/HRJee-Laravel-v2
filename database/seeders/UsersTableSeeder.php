<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'emp_id' => '12345',
                'name' => 'Ashraf Ali',
                'email' => 'ashraf@gmail.com',
                'official_email_id' => 'your.email+fakedata65049@gmail.com',
                'password' => '$2y$12$IK.GHJdemvg8GFBpMnk1UupRPgU2k3BBKy0F8qeHs89smlkiYAQkS',
                'father_name' => 'Dejuan_Herman17',
                'mother_name' => 'Vito33',
                'blood_group' => 'O-',
                'gender' => 'M',
                'marital_status' => 'M',
                'employee_status_id' => 1,
                'date_of_birth' => '2023-11-11',
                'joining_date' => '2023-12-06',
                'phone' => '1234567890',
                'profile_image' => NULL,
                'company_id' => 1,
                'last_login_ip' => '192.168.65.1',
                'created_at' => '2024-06-21 14:57:34',
                'updated_at' => '2024-06-21 14:57:34',
            ),
        ));
        
        
    }
}