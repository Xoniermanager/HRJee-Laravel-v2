<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserQualificationDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_qualification_details')->delete();
        
        \DB::table('user_qualification_details')->insert(array (
            0 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'qualification_id' => 1,
                'institute' => 'Washington',
                'university' => 'Vineland',
                'course' => 'Marshall Islands',
                'year' => '2121',
                'percentage' => '43',
                'created_at' => '2024-06-21 14:59:27',
                'updated_at' => '2024-06-21 14:59:27',
            ),
            1 => 
            array (
                'id' => 3,
                'user_id' => 2,
                'qualification_id' => 2,
                'institute' => 'South Dakota',
                'university' => 'Denton',
                'course' => 'Montenegro',
                'year' => '2015',
                'percentage' => '90',
                'created_at' => '2025-01-30 12:53:01',
                'updated_at' => '2025-01-30 12:53:01',
            ),
        ));
        
        
    }
}