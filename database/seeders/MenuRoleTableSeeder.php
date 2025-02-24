<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('menu_role')->delete();

        \DB::table('menu_role')->insert(array (
            0 =>
            array (
                'id' => 42,
                'menu_id' => 1,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            1 =>
            array (
                'id' => 43,
                'menu_id' => 2,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            2 =>
            array (
                'id' => 44,
                'menu_id' => 3,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            3 =>
            array (
                'id' => 45,
                'menu_id' => 4,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            4 =>
            array (
                'id' => 46,
                'menu_id' => 5,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            5 =>
            array (
                'id' => 47,
                'menu_id' => 6,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            6 =>
            array (
                'id' => 48,
                'menu_id' => 7,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            7 =>
            array (
                'id' => 49,
                'menu_id' => 8,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            8 =>
            array (
                'id' => 50,
                'menu_id' => 9,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            9 =>
            array (
                'id' => 51,
                'menu_id' => 10,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            10 =>
            array (
                'id' => 52,
                'menu_id' => 11,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            11 =>
            array (
                'id' => 53,
                'menu_id' => 12,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            12 =>
            array (
                'id' => 54,
                'menu_id' => 13,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            13 =>
            array (
                'id' => 55,
                'menu_id' => 14,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            14 =>
            array (
                'id' => 56,
                'menu_id' => 15,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            15 =>
            array (
                'id' => 57,
                'menu_id' => 16,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            16 =>
            array (
                'id' => 58,
                'menu_id' => 17,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            17 =>
            array (
                'id' => 59,
                'menu_id' => 18,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            18 =>
            array (
                'id' => 60,
                'menu_id' => 19,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            19 =>
            array (
                'id' => 61,
                'menu_id' => 20,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            20 =>
            array (
                'id' => 62,
                'menu_id' => 21,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            21 =>
            array (
                'id' => 63,
                'menu_id' => 22,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            22 =>
            array (
                'id' => 64,
                'menu_id' => 23,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            23 =>
            array (
                'id' => 65,
                'menu_id' => 24,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            24 =>
            array (
                'id' => 66,
                'menu_id' => 25,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            25 =>
            array (
                'id' => 67,
                'menu_id' => 26,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            26 =>
            array (
                'id' => 68,
                'menu_id' => 27,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            27 =>
            array (
                'id' => 69,
                'menu_id' => 28,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            30 =>
            array (
                'id' => 72,
                'menu_id' => 31,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            31 =>
            array (
                'id' => 73,
                'menu_id' => 32,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            32 =>
            array (
                'id' => 74,
                'menu_id' => 33,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            33 =>
            array (
                'id' => 75,
                'menu_id' => 34,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            34 =>
            array (
                'id' => 76,
                'menu_id' => 35,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            35 =>
            array (
                'id' => 77,
                'menu_id' => 36,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            36 =>
            array (
                'id' => 78,
                'menu_id' => 37,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            37 =>
            array (
                'id' => 79,
                'menu_id' => 38,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            38 =>
            array (
                'id' => 80,
                'menu_id' => 39,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            39 =>
            array (
                'id' => 81,
                'menu_id' => 40,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            40 =>
            array (
                'id' => 82,
                'menu_id' => 41,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            41 =>
            array (
                'id' => 83,
                'menu_id' => 42,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            42 =>
            array (
                'id' => 84,
                'menu_id' => 43,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            43 =>
            array (
                'id' => 85,
                'menu_id' => 44,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            44 =>
            array (
                'id' => 86,
                'menu_id' => 45,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
            45 =>
            array (
                'id' => 87,
                'menu_id' => 46,
                'role_id' => 1,
                'can_create' => 1,
                'can_read' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => '2025-02-03 15:07:08',
                'updated_at' => '2025-02-03 15:07:08',
            ),
        ));


    }
}
