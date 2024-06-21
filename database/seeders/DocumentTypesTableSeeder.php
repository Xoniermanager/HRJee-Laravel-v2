<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('document_types')->delete();
        
        \DB::table('document_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Addharcard',
                'description' => NULL,
                'is_mandatory' => 1,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 15:04:22',
                'updated_at' => '2024-06-21 15:04:22',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '10th marksheet',
                'description' => NULL,
                'is_mandatory' => 0,
                'status' => 1,
                'company_id' => NULL,
                'created_at' => '2024-06-21 15:04:33',
                'updated_at' => '2024-06-21 15:04:33',
            ),
        ));
        
        
    }
}