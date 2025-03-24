<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserCtcHistoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_ctc_histories')->delete();
        
        \DB::table('user_ctc_histories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'salary_id' => 1,
                'ctc_value' => '500000',
                'effective_date' => '2025-01-01',
                'created_at' => '2025-02-12 17:59:30',
                'updated_at' => '2025-02-12 17:59:30',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'salary_id' => 1,
                'ctc_value' => '900000',
                'effective_date' => '2025-02-12',
                'created_at' => '2025-02-12 18:02:13',
                'updated_at' => '2025-02-12 18:02:13',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 2,
                'salary_id' => 1,
                'ctc_value' => '1000000',
                'effective_date' => '2025-02-12',
                'created_at' => '2025-02-12 18:09:11',
                'updated_at' => '2025-02-12 18:09:11',
            ),
        ));
        
        
    }
}