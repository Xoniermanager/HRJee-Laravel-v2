<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SalaryComponentAssignmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('salary_component_assignments')->delete();
        
        \DB::table('salary_component_assignments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'salary_id' => 1,
                'salary_component_id' => 1,
                'value' => 50.0,
                'is_taxable' => 1,
                'value_type' => 'percentage',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-02-03 17:55:30',
                'updated_at' => '2025-02-03 17:55:30',
            ),
            1 => 
            array (
                'id' => 2,
                'salary_id' => 1,
                'salary_component_id' => 2,
                'value' => 0.0,
                'is_taxable' => 1,
                'value_type' => 'fixed',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-02-03 17:55:30',
                'updated_at' => '2025-02-03 17:55:30',
            ),
            2 => 
            array (
                'id' => 3,
                'salary_id' => 2,
                'salary_component_id' => 1,
                'value' => 50.0,
                'is_taxable' => 1,
                'value_type' => 'percentage',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-02-03 17:55:44',
                'updated_at' => '2025-02-03 17:55:44',
            ),
            3 => 
            array (
                'id' => 4,
                'salary_id' => 2,
                'salary_component_id' => 2,
                'value' => 0.0,
                'is_taxable' => 1,
                'value_type' => 'fixed',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-02-03 17:55:44',
                'updated_at' => '2025-02-03 17:55:44',
            ),
            4 => 
            array (
                'id' => 5,
                'salary_id' => 3,
                'salary_component_id' => 1,
                'value' => 50.0,
                'is_taxable' => 1,
                'value_type' => 'percentage',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-02-03 17:55:48',
                'updated_at' => '2025-02-03 17:55:48',
            ),
            5 => 
            array (
                'id' => 6,
                'salary_id' => 3,
                'salary_component_id' => 2,
                'value' => 0.0,
                'is_taxable' => 1,
                'value_type' => 'fixed',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-02-03 17:55:48',
                'updated_at' => '2025-02-03 17:55:48',
            ),
            6 => 
            array (
                'id' => 7,
                'salary_id' => 4,
                'salary_component_id' => 1,
                'value' => 50.0,
                'is_taxable' => 1,
                'value_type' => 'percentage',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-02-03 17:55:53',
                'updated_at' => '2025-02-03 17:55:53',
            ),
            7 => 
            array (
                'id' => 8,
                'salary_id' => 4,
                'salary_component_id' => 2,
                'value' => 0.0,
                'is_taxable' => 1,
                'value_type' => 'fixed',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-02-03 17:55:53',
                'updated_at' => '2025-02-03 17:55:53',
            ),
            8 => 
            array (
                'id' => 9,
                'salary_id' => 5,
                'salary_component_id' => 1,
                'value' => 50.0,
                'is_taxable' => 1,
                'value_type' => 'percentage',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-02-03 17:55:57',
                'updated_at' => '2025-02-03 17:55:57',
            ),
            9 => 
            array (
                'id' => 10,
                'salary_id' => 5,
                'salary_component_id' => 2,
                'value' => 0.0,
                'is_taxable' => 1,
                'value_type' => 'fixed',
                'parent_component' => NULL,
                'earning_or_deduction' => 'earning',
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-02-03 17:55:57',
                'updated_at' => '2025-02-03 17:55:57',
            ),
        ));
        
        
    }
}