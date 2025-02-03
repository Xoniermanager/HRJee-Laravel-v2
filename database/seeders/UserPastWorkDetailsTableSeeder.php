<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserPastWorkDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_past_work_details')->delete();
        
        \DB::table('user_past_work_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'previous_company_id' => 1,
                'designation' => 'Cartwright - Bernhard',
                'from' => '2024-10-21',
                'to' => '2025-04-29',
                'duration' => '2013',
                'current_company' => 0,
                'created_at' => '2024-06-21 14:59:53',
                'updated_at' => '2024-06-21 14:59:53',
            )
        ));
        
        
    }
}