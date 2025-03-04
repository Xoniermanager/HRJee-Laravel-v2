<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FormFieldsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('form_fields')->delete();
        
        \DB::table('form_fields')->insert(array (
            0 => 
            array (
                'id' => 1,
                'form_id' => 11,
                'label' => 'Name',
                'type' => 'text',
                'options' => NULL,
                'created_at' => '2025-02-28 12:25:07',
                'updated_at' => '2025-02-28 12:25:07',
            ),
            1 => 
            array (
                'id' => 2,
                'form_id' => 11,
                'label' => 'Email',
                'type' => 'email',
                'options' => NULL,
                'created_at' => '2025-02-28 12:25:07',
                'updated_at' => '2025-02-28 12:25:07',
            ),
            2 => 
            array (
                'id' => 3,
                'form_id' => 11,
                'label' => 'Phone',
                'type' => 'number',
                'options' => NULL,
                'created_at' => '2025-02-28 12:25:07',
                'updated_at' => '2025-02-28 12:25:07',
            ),
            3 => 
            array (
                'id' => 4,
                'form_id' => 11,
                'label' => 'City',
                'type' => 'textarea',
                'options' => NULL,
                'created_at' => '2025-02-28 12:25:07',
                'updated_at' => '2025-02-28 12:25:07',
            ),
            4 => 
            array (
                'id' => 5,
                'form_id' => 11,
                'label' => 'Gender',
                'type' => 'radio',
                'options' => '{
"Male": "Male",
"Female": "Female",
"Other": "Other"
}',
                'created_at' => '2025-02-28 12:25:07',
                'updated_at' => '2025-02-28 12:25:07',
            ),
        ));
        
        
    }
}