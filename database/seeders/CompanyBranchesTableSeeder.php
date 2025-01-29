<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanyBranchesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('company_branches')->delete();

        \DB::table('company_branches')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Noida',
                'type' => 'primary',
                'contact_no' => '1234567890',
                'email' => 'noida@gmail.com',
                'hr_email' => 'hr@gmail.com',
                'address' => 'Noida H-161 BSI Park',
                'city' => 'Noida',
                'pincode' => '201901',
                'country_id' => 103,
                'state_id' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-06-21 14:52:45',
                'updated_at' => '2024-06-21 14:52:45',
            ),
        ));


    }
}
