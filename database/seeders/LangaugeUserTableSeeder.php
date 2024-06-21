<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LangaugeUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('langauge_user')->delete();
        
        \DB::table('langauge_user')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'language_id' => 2,
                'read' => 'e',
                'write' => 'e',
                'speak' => 'e',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'user_id' => 1,
                'language_id' => 1,
                'read' => 'i',
                'write' => 'e',
                'speak' => 'i',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}