<?php

namespace Database\seeders;  // Namespace declaration must be the first line

use Illuminate\Database\Seeder;
use App\Models\WeekDay; // Import the WeekDay model

class WeekDaySeeder extends Seeder
{
    public function run()
    {
        WeekDay::truncate();
        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        foreach ($weekdays as $day) {
            WeekDay::create([
                'name' => $day,
            ]);
        }
    }
}
