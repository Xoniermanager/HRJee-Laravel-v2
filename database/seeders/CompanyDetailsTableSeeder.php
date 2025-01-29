<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanyDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('company_details')->delete();
        
        \DB::table('company_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'username' => 'xonier12345',
                'contact_no' => '1234567890',
                'joining_date' => '2025-01-29',
                'logo' => NULL,
                'company_size' => '100',
                'company_url' => 'http://www.example.com',
                'company_address' => 'Noida Sec 63',
                'company_type_id' => 1,
                'status' => '1',
                'subscription_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-01-29 10:41:20',
                'updated_at' => '2025-01-29 10:41:20',
            ),
        ));
        
        
    }
}