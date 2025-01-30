<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('asset_categories')->delete();

        \DB::table('asset_categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Laptop',
                'status' => 1,
                  'company_id' => 1,
                'created_by' => 1,
                'parent_id' => NULL,
                'created_at' => '2024-06-24 11:19:35',
                'updated_at' => '2024-06-24 11:19:35',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Headphone',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'parent_id' => NULL,
                'created_at' => '2024-06-24 11:19:46',
                'updated_at' => '2024-06-24 11:19:46',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Mobile',
                'status' => 1,
                  'company_id' => 1,
                'created_by' => 1,
                'parent_id' => NULL,
                'created_at' => '2024-06-24 11:19:52',
                'updated_at' => '2024-06-24 11:19:52',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Tabs',
                'status' => 1,
                  'company_id' => 1,
                'created_by' => 1,
                'parent_id' => NULL,
                'created_at' => '2024-06-24 11:19:59',
                'updated_at' => '2024-06-24 11:19:59',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'desktop',
                'status' => 1,
                  'company_id' => 1,
                'created_by' => 1,
                'parent_id' => NULL,
                'created_at' => '2024-06-24 11:20:24',
                'updated_at' => '2024-06-24 11:20:24',
            ),
        ));


    }
}
