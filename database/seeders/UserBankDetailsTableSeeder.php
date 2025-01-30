<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserBankDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_bank_details')->delete();
        
        \DB::table('user_bank_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'account_name' => 'Adela Brown Rang',
                'account_number' => '48412345676543',
                'bank_name' => 'Deborah MoenBsa',
                'ifsc_code' => '7024943',
                'created_at' => '2024-06-21 14:59:07',
                'updated_at' => '2025-01-30 12:52:12',
            ),
        ));
        
        
    }
}