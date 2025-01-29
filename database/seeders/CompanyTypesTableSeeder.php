<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanyTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('company_types')->delete();

        \DB::table('company_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'IT',
                'status' => 1,
                'created_at' => '2025-01-21 15:12:27',
                'updated_at' => '2025-01-21 15:12:27',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Medical',
                'status' => 1,
                'created_at' => '2025-01-21 15:12:35',
                'updated_at' => '2025-01-21 15:12:35',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Other',
                'status' => 1,
                'created_at' => '2025-01-21 15:12:41',
                'updated_at' => '2025-01-21 15:12:41',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Industry',
                'status' => 1,
                'created_at' => '2025-01-21 15:12:55',
                'updated_at' => '2025-01-21 15:18:43',
            ),
        ));
    }
}
