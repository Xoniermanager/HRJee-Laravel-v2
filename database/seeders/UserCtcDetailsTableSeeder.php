<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserCtcDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_ctc_details')->delete();
        
        \DB::table('user_ctc_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'ctc_value' => '1000000',
                'salary_id' => 1,
                'created_at' => NULL,
                'updated_at' => '2025-02-12 18:09:11',
            ),
        ));
        
        
    }
}