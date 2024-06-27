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
                'id' => 1,
                'user_id' => 1,
                'qualification_id' => 4,
                'institute' => 'Louisiana',
                'university' => 'Rohnert Park',
                'course' => 'Slovakia',
                'year' => '2012',
                'percentage' => '21',
                'created_at' => '2024-06-21 14:59:27',
                'updated_at' => '2024-06-21 14:59:27',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'qualification_id' => 1,
                'institute' => 'Washington',
                'university' => 'Vineland',
                'course' => 'Marshall Islands',
                'year' => '2121',
                'percentage' => '43',
                'created_at' => '2024-06-21 14:59:27',
                'updated_at' => '2024-06-21 14:59:27',
            ),
        ));
        
        
    }
}