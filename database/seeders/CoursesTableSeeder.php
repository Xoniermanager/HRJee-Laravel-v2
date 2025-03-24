<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('courses')->delete();
        
        \DB::table('courses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_id' => 1,
                'department_id' => 1,
                'designation_id' => 1,
                'created_by' => 1,
                'title' => 'ABC',
                'description' => '<p>testered</p>',
                'video_type' => 'youtube',
                'video_url' => 'https://xoniertechnologies.com:2096/',
                'pdf_file' => NULL,
                'created_at' => '2025-03-06 10:49:03',
                'updated_at' => '2025-03-06 10:49:03',
            ),
        ));
        
        
    }
}