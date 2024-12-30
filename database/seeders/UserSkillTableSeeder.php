<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSkillTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('user_skill')->delete();

        \DB::table('user_skill')->insert(array (
            0 =>
            array (
                'user_id' => 1,
                'skill_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'user_id' => 1,
                'skill_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'user_id' => 1,
                'skill_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'user_id' => 1,
                'skill_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'user_id' => 2,
                'skill_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'user_id' => 2,
                'skill_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'user_id' => 2,
                'skill_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 =>
            array (
                'user_id' => 2,
                'skill_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 =>
            array (
                'user_id' => 3,
                'skill_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 =>
            array (
                'user_id' => 3,
                'skill_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 =>
            array (
                'user_id' => 3,
                'skill_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
