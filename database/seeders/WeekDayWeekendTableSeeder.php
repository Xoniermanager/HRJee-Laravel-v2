<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WeekDayWeekendTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('week_day_weekend')->delete();
        
        \DB::table('week_day_weekend')->insert(array (
            0 => 
            array (
                'week_day_id' => 7,
                'weekend_id' => 3,
            ),
            1 => 
            array (
                'week_day_id' => 6,
                'weekend_id' => 4,
            ),
            2 => 
            array (
                'week_day_id' => 7,
                'weekend_id' => 4,
            ),
        ));
        
        
    }
}