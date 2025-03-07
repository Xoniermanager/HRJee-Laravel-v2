<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurriculamAssignmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('curriculam_assignments')->delete();
        
        \DB::table('curriculam_assignments')->insert(array (
            0 => 
            array (
                'id' => 3,
                'curriculam_id' => 3,
                'question' => 'asdsads',
                'option1' => 'dasasd',
                'option2' => 'dsadsa',
                'option3' => 'asdasd',
                'option4' => 'sadsadsad',
                'file' => NULL,
                'created_at' => '2025-03-06 10:57:56',
                'updated_at' => '2025-03-06 10:57:56',
            ),
            1 => 
            array (
                'id' => 10,
                'curriculam_id' => 11,
                'question' => 'What is your School Name',
                'option1' => 'A',
                'option2' => 'B',
                'option3' => 'C',
                'option4' => 'D',
                'file' => '/curriculam_assignment_pdf/testing_demo-11-1741256895.pdf',
                'created_at' => '2025-03-06 15:58:15',
                'updated_at' => '2025-03-06 15:58:15',
            ),
            2 => 
            array (
                'id' => 11,
                'curriculam_id' => 11,
                'question' => 'What is  Name',
                'option1' => 'A',
                'option2' => 'B',
                'option3' => 'C',
                'option4' => 'D',
                'file' => '/curriculam_assignment_pdf/testing_demo-11-1741256895.pdf',
                'created_at' => '2025-03-06 15:58:15',
                'updated_at' => '2025-03-06 15:58:15',
            ),
        ));
        
        
    }
}