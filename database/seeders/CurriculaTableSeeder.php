<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurriculaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('curricula')->delete();
        
        \DB::table('curricula')->insert(array (
            0 => 
            array (
                'id' => 3,
                'course_id' => 2,
                'title' => 'TEsteered',
                'instructor' => 'Accusamus eaque dolores impedit.',
                'short_description' => 'Sequi earum laudantium laborum quia.',
                'content_type' => 'youtube',
                'video_url' => 'https://xoniertechnologies.com:2096/',
                'pdf_file' => NULL,
                'has_assignment' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-03-06 10:57:56',
                'updated_at' => '2025-03-06 10:57:56',
            ),
            1 => 
            array (
                'id' => 11,
                'course_id' => 1,
                'title' => 'Testing Demo',
                'instructor' => 'Demo Testing',
                'short_description' => 'testing code',
                'content_type' => 'youtube',
                'video_url' => 'https://chatgpt.com/',
                'pdf_file' => NULL,
                'has_assignment' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-03-06 15:58:15',
                'updated_at' => '2025-03-06 15:58:15',
            ),
        ));
        
        
    }
}