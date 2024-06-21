<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PreviousCompaniesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('previous_companies')->delete();
        
        \DB::table('previous_companies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'tcs',
                'status' => 1,
                'company_id' => 1,
                'created_at' => '2024-06-21 14:59:40',
                'updated_at' => '2024-06-21 14:59:40',
            ),
        ));
        
        
    }
}