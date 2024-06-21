<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserDocumentDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_document_details')->delete();
        
        \DB::table('user_document_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'document_type_id' => 1,
                'document' => '/user_documents/addharcard_1-1718962485.pdf',
                'created_at' => '2024-06-21 15:04:45',
                'updated_at' => '2024-06-21 15:04:45',
            ),
        ));
        
        
    }
}