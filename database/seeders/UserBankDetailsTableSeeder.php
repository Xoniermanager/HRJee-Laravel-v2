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
                'user_id' => 1,
                'account_name' => 'Adela Brown',
                'account_number' => '484',
                'bank_name' => 'Deborah Moen',
                'ifsc_code' => '70249',
                'created_at' => '2024-06-21 14:59:07',
                'updated_at' => '2024-06-21 14:59:07',
            ),
        ));
        
        
    }
}