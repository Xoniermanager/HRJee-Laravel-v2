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
                'employee_type_id' => 4,
                'department_id' => 3,
                'designation_id' => 4,
                'role_id' => 3,
                'company_branch_id' => 1,
                'qualification_id' => 4,
                'shift_id' => 1,
                'offer_letter_id' => 'Dignissimos perspiciatis id rerum.',
                'work_from_office' => 1,
                'exit_date' => NULL,
                'official_mobile_no' => '523',
                'created_at' => '2024-06-21 14:57:34',
                'updated_at' => '2024-06-21 14:57:34',
            ),
            1 =>
            array (
                'id' => 2,
                'emp_id' => '321',
                'name' => 'Arjun Mishra',
                'email' => 'arjun@xoniertechnologies.com',
                'official_email_id' => 'arjun@xoniertechnologies.com',
                'password' => '$2y$12$tBzCqbdhhz9RJ0zMfqn9N.g5IOprYHCy9QDxtF41YqtABoFy.VTfK',
                'father_name' => NULL,
                'mother_name' => NULL,
                'blood_group' => 'A-',
                'gender' => 'F',
                'marital_status' => 'S',
                'employee_status_id' => 1,
                'date_of_birth' => '2024-12-27',
                'joining_date' => '2024-12-27',
                'phone' => '12345654345',
                'profile_image' => '/user_profile/arjun_mishra-1735291998.jpeg',
                'company_id' => 1,
                'last_login_ip' => '127.0.0.1',
                'employee_type_id' => 1,
                'department_id' => 1,
                'designation_id' => 1,
                'role_id' => 4,
                'company_branch_id' => 1,
                'qualification_id' => 4,
                'shift_id' => 1,
                'offer_letter_id' => '12321',
                'work_from_office' => 1,
                'exit_date' => NULL,
                'official_mobile_no' => '12343234',
                'created_at' => '2024-12-27 15:03:18',
                'updated_at' => '2024-12-27 15:03:18',
            ),
            2 =>
            array (
                'id' => 3,
                'emp_id' => '23232',
                'name' => 'Arjun Kumar Mishra',
                'email' => 'arjunMishra@xoniertechnologies.com',
                'official_email_id' => 'arjunMishra@xoniertechnologies.com',
                'password' => '$2y$12$vBZCwb5DnGnFrGVkiTMQ5eHpovIqKfLtng33fhV/8no4EQa8.uz5q',
                'father_name' => NULL,
                'mother_name' => NULL,
                'blood_group' => 'A-',
                'gender' => 'F',
                'marital_status' => 'S',
                'employee_status_id' => 1,
                'date_of_birth' => '2024-12-27',
                'joining_date' => '2024-12-27',
                'phone' => '1233320987',
                'profile_image' => '/user_profile/arjun_kumar_mishra-1735292528.jpeg',
                'company_id' => 1,
                'last_login_ip' => '127.0.0.1',
                'employee_type_id' => 1,
                'department_id' => 5,
                'designation_id' => 6,
                'role_id' => 4,
                'company_branch_id' => 1,
                'qualification_id' => 4,
                'shift_id' => 1,
                'offer_letter_id' => '3242423',
                'work_from_office' => 1,
                'exit_date' => NULL,
                'official_mobile_no' => '34532312342532',
                'created_at' => '2024-12-27 15:12:08',
                'updated_at' => '2024-12-27 15:12:08',
            ),
        ));


    }
}
