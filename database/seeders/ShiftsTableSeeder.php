<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShiftsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shifts')->delete();
        
        \DB::table('shifts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Stephanie Brakus',
                'start_time' => '14:47:00',
                'end_time' => '17:31:00',
                'half_day_login' => '01:50:00',
                'check_in_buffer' => '418',
                'check_out_buffer' => '401',
                'min_late_count' => '340',
                'login_before_shift_time' => '15',
                'early_checkout_count' => 112,
                'status' => 1,
                'is_default' => 1,
                'office_timing_config_id' => 1,
                'apply_late_count' => 0,
                'apply_early_checkout_count' => 0,
                'lock_attendance' => 0,
                'created_at' => '2024-06-21 15:01:18',
                'updated_at' => '2024-06-21 15:01:22',
            ),
        ));
        
        
    }
}