<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SalaryComponentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('salary_components')->delete();
        
        \DB::table('salary_components')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Basic pay',
                'default_value' => 50.0,
                'is_taxable' => 1,
                'value_type' => 'percentage',
                'parent_component' => NULL,
                'is_default' => 1,
                'earning_or_deduction' => 'earning',
                'company_id' => 1,
                'created_by' => 1,
                'status' => 1,
                'created_at' => '2025-02-03 17:55:30',
                'updated_at' => '2025-02-03 17:55:30',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Special allowance',
                'default_value' => 0.0,
                'is_taxable' => 1,
                'value_type' => 'fixed',
                'parent_component' => NULL,
                'is_default' => 1,
                'earning_or_deduction' => 'earning',
                'company_id' => 1,
                'created_by' => 1,
                'status' => 1,
                'created_at' => '2025-02-03 17:55:30',
                'updated_at' => '2025-02-03 17:55:30',
            ),
        ));
        
        
    }
}