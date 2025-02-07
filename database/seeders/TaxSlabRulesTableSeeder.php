<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class TaxSlabRulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('tax_slab_rules')->delete();
        // Inserting tax slabs into tax_slabs table
        DB::table('tax_slab_rules')->insert([
            [
                'income_range_start' => 0,
                'income_range_end' => 2.5e5, // 2.5 Lakhs
                'tax_rate' => 0, // No tax
                'company_id' => 1,
                'created_by' => 1,
            ],
            [
                'income_range_start' => 2.5e5, // 2.5 Lakhs
                'income_range_end' => 5e5,   // 5 Lakhs
                'tax_rate' => 5, // 5%
                'company_id' => 1,
                'created_by' => 1,
            ],
            [
                'income_range_start' => 5e5,  // 5 Lakhs
                'income_range_end' => 1e6,  // 10 Lakhs
                'tax_rate' => 20, // 20%
                'company_id' => 1,
                'created_by' => 1,
            ],
            [
                'income_range_start' => 1e6,  // 10 Lakhs
                'income_range_end' => 5e6,  // 50 Lakhs
                'tax_rate' => 30, // 30%
                'company_id' => 1,
                'created_by' => 1,
            ],
            [
                'income_range_start' => 5e6,  // 50 Lakhs
                'income_range_end' => 1e9,  // 1 Crore
                'tax_rate' => 30, // 30%
                'company_id' => 1,
                'created_by' => 1,
            ],
            // Add more slabs if necessary
        ]);
    }
}
