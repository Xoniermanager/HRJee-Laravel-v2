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
                'aadhar_no' => '12345612345678',
                'pan_no' => '12345234567',
                'uan_no' => '1234567',
                'esic_no' => '123456',
                'pf_no' => '12345678',
                'insurance_no' => '234567',
                'driving_licence_no' => '234567',
                'probation_period' => 23456,
                'ctc_monthly_in_probation' => '234567',
                'ctc_monthly_after_probation' => '23456',
                'created_at' => '2024-06-21 14:57:49',
                'updated_at' => '2025-01-30 12:51:22',
            ),
        ));
        
        
    }
}