<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetManufacturersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('asset_manufacturers')->delete();

        \DB::table('asset_manufacturers')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'HP',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2024-06-24 11:09:49',
                'updated_at' => '2024-06-24 11:09:49',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Sumsung',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2024-06-24 11:10:01',
                'updated_at' => '2024-06-24 11:10:01',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Dell',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2024-06-24 11:10:07',
                'updated_at' => '2024-06-24 11:10:07',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Assus',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2024-06-24 11:10:18',
                'updated_at' => '2024-06-24 11:10:18',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Lenovo',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2024-06-24 11:10:27',
                'updated_at' => '2024-06-24 11:10:27',
            ),
        ));


    }
}
