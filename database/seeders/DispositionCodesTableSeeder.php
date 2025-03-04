<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DispositionCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('disposition_codes')->delete();
        
        \DB::table('disposition_codes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Deaths',
                'description' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-03-04 13:10:18',
                'updated_at' => '2025-03-04 13:10:28',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Swifts',
                'description' => NULL,
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-03-04 13:10:39',
                'updated_at' => '2025-03-04 13:10:58',
            ),
        ));
        
        
    }
}