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
            2 =>
            array (
                'user_id' => 2,
                'language_id' => 2,
                'read' => 'i',
                'write' => 'b',
                'speak' => 'b',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'user_id' => 2,
                'language_id' => 1,
                'read' => 'b',
                'write' => 'i',
                'speak' => 'b',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'user_id' => 3,
                'language_id' => 2,
                'read' => 'i',
                'write' => 'b',
                'speak' => 'b',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'user_id' => 3,
                'language_id' => 1,
                'read' => 'b',
                'write' => 'i',
                'speak' => 'b',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
