<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FormsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('forms')->delete();
        
        \DB::table('forms')->insert(array (
            0 => 
            array (
                'id' => 11,
                'company_id' => 1,
                'created_by' => 1,
                'title' => 'Location Visit Form',
                'created_at' => '2025-02-28 12:25:07',
                'updated_at' => '2025-02-28 12:25:07',
            ),
        ));
        
        
    }
}