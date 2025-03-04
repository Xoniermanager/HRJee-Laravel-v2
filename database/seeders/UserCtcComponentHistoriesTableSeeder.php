<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserCtcComponentHistoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_ctc_component_histories')->delete();
        
        \DB::table('user_ctc_component_histories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_ctc_history_id' => 1,
                'salary_component_id' => 1,
                'value' => 50.0,
                'is_taxable' => 1,
                'value_type' => 'percentage',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'created_at' => '2025-02-12 17:59:30',
                'updated_at' => '2025-02-12 17:59:30',
            ),
            1 => 
            array (
                'id' => 2,
                'user_ctc_history_id' => 1,
                'salary_component_id' => 2,
                'value' => 0.0,
                'is_taxable' => 1,
                'value_type' => 'fixed',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'created_at' => '2025-02-12 17:59:30',
                'updated_at' => '2025-02-12 17:59:30',
            ),
            2 => 
            array (
                'id' => 3,
                'user_ctc_history_id' => 2,
                'salary_component_id' => 1,
                'value' => 50.0,
                'is_taxable' => 1,
                'value_type' => 'percentage',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'created_at' => '2025-02-12 18:02:13',
                'updated_at' => '2025-02-12 18:02:13',
            ),
            3 => 
            array (
                'id' => 4,
                'user_ctc_history_id' => 2,
                'salary_component_id' => 2,
                'value' => 10000.0,
                'is_taxable' => 1,
                'value_type' => 'fixed',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'created_at' => '2025-02-12 18:02:13',
                'updated_at' => '2025-02-12 18:02:13',
            ),
            4 => 
            array (
                'id' => 5,
                'user_ctc_history_id' => 3,
                'salary_component_id' => 1,
                'value' => 50.0,
                'is_taxable' => 1,
                'value_type' => 'percentage',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'created_at' => '2025-02-12 18:09:11',
                'updated_at' => '2025-02-12 18:09:11',
            ),
            5 => 
            array (
                'id' => 6,
                'user_ctc_history_id' => 3,
                'salary_component_id' => 2,
                'value' => 5000.0,
                'is_taxable' => 1,
                'value_type' => 'fixed',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'created_at' => '2025-02-12 18:09:11',
                'updated_at' => '2025-02-12 18:09:11',
            ),
        ));
        
        
    }
}