<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserAdvanceDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('user_advance_details')->delete();

        \DB::table('user_advance_details')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => 2,
                'aadhar_no' => '123456',
                'pan_no' => '12345',
                'uan_no' => NULL,
                'esic_no' => NULL,
                'pf_no' => NULL,
                'insurance_no' => NULL,
                'driving_licence_no' => NULL,
                'probation_period' => NULL,
                'ctc_monthly_in_probation' => NULL,
                'ctc_monthly_after_probation' => NULL,
                'created_at' => '2024-06-21 14:57:49',
                'updated_at' => '2024-06-21 14:57:49',
            ),
        ));


    }
}
