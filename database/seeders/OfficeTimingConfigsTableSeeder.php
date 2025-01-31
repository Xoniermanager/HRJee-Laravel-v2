<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OfficeTimingConfigsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('office_timing_configs')->delete();

        \DB::table('office_timing_configs')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Moises Abernathy',
                'shift_hours' => '181',
                'half_day_hours' => '546',
                'min_shift_Hours' => '533',
                'min_half_day_hours' => '252',
                'company_branch_id' => 1,
                'created_at' => '2024-06-21 15:01:00',
                'updated_at' => '2024-06-21 15:01:00',
                'company_id' => 1,
                'created_by' => 1
            ),
        ));


    }
}
