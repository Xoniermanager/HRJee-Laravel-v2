<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AssetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('assets')->delete();
        
        \DB::table('assets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Donnie Hegmann',
                'asset_category_id' => 4,
                'asset_manufacturer_id' => 4,
                'asset_status_id' => 1,
                'model' => '123432',
                'ownership' => 'owned',
                'purchase_value' => 212.0,
                'depreciation_per_year' => 141.0,
                'invoice_no' => '580',
                'invoice_date' => '2023-06-26',
                'validation_upto' => '2025-01-09',
                'serial_no' => '630',
                'invoice_file' => NULL,
                'allocation_status' => 'available',
                'company_id' => 1,
                'created_at' => '2024-06-24 11:20:55',
                'updated_at' => '2024-06-24 11:20:55',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Dimitri Adams',
                'asset_category_id' => 3,
                'asset_manufacturer_id' => 5,
                'asset_status_id' => 1,
                'model' => '213112',
                'ownership' => 'owned',
                'purchase_value' => 2121.0,
                'depreciation_per_year' => 567.0,
                'invoice_no' => '653',
                'invoice_date' => '2024-06-19',
                'validation_upto' => '2025-06-04',
                'serial_no' => '520',
                'invoice_file' => NULL,
                'allocation_status' => 'available',
                'company_id' => 1,
                'created_at' => '2024-06-24 11:21:16',
                'updated_at' => '2024-06-24 11:21:16',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Harrison Hoppe',
                'asset_category_id' => 1,
                'asset_manufacturer_id' => 2,
                'asset_status_id' => 1,
                'model' => '654343244',
                'ownership' => 'owned',
                'purchase_value' => 2321.0,
                'depreciation_per_year' => 93.0,
                'invoice_no' => '632',
                'invoice_date' => '2024-07-13',
                'validation_upto' => '2024-06-28',
                'serial_no' => '53',
                'invoice_file' => NULL,
                'allocation_status' => 'available',
                'company_id' => 1,
                'created_at' => '2024-06-24 11:21:44',
                'updated_at' => '2024-06-24 11:21:44',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Harrison Hoppe',
                'asset_category_id' => 1,
                'asset_manufacturer_id' => 2,
                'asset_status_id' => 1,
                'model' => '654343244',
                'ownership' => 'owned',
                'purchase_value' => 2321.0,
                'depreciation_per_year' => 93.0,
                'invoice_no' => '632',
                'invoice_date' => '2024-07-13',
                'validation_upto' => '2024-06-28',
                'serial_no' => '53',
                'invoice_file' => NULL,
                'allocation_status' => 'available',
                'company_id' => 1,
                'created_at' => '2024-06-24 11:21:45',
                'updated_at' => '2024-06-24 11:21:45',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Fidel Feil',
                'asset_category_id' => 4,
                'asset_manufacturer_id' => 1,
                'asset_status_id' => 1,
                'model' => '3231',
                'ownership' => 'owned',
                'purchase_value' => 23421.0,
                'depreciation_per_year' => 109.0,
                'invoice_no' => '250',
                'invoice_date' => '2024-07-13',
                'validation_upto' => '2024-12-27',
                'serial_no' => '162',
                'invoice_file' => NULL,
                'allocation_status' => 'available',
                'company_id' => 1,
                'created_at' => '2024-06-24 11:22:06',
                'updated_at' => '2024-06-24 11:22:06',
            ),
        ));
        
        
    }
}