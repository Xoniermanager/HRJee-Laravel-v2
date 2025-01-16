<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanyMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('company_menu')->delete();
        
        \DB::table('company_menu')->insert(array (
            0 => 
            array (
                'menu_id' => 2,
                'company_id' => 1,
            ),
            1 => 
            array (
                'menu_id' => 3,
                'company_id' => 1,
            ),
            2 => 
            array (
                'menu_id' => 4,
                'company_id' => 1,
            ),
            3 => 
            array (
                'menu_id' => 5,
                'company_id' => 1,
            ),
            4 => 
            array (
                'menu_id' => 6,
                'company_id' => 1,
            ),
            5 => 
            array (
                'menu_id' => 7,
                'company_id' => 1,
            ),
            6 => 
            array (
                'menu_id' => 8,
                'company_id' => 1,
            ),
            7 => 
            array (
                'menu_id' => 9,
                'company_id' => 1,
            ),
            8 => 
            array (
                'menu_id' => 10,
                'company_id' => 1,
            ),
            9 => 
            array (
                'menu_id' => 11,
                'company_id' => 1,
            ),
            10 => 
            array (
                'menu_id' => 1,
                'company_id' => 1,
            ),
            11 => 
            array (
                'menu_id' => 14,
                'company_id' => 1,
            ),
            12 => 
            array (
                'menu_id' => 17,
                'company_id' => 1,
            ),
            13 => 
            array (
                'menu_id' => 20,
                'company_id' => 1,
            ),
            14 => 
            array (
                'menu_id' => 23,
                'company_id' => 1,
            ),
            15 => 
            array (
                'menu_id' => 29,
                'company_id' => 1,
            ),
            16 => 
            array (
                'menu_id' => 32,
                'company_id' => 1,
            ),
            17 => 
            array (
                'menu_id' => 35,
                'company_id' => 1,
            ),
        ));
        
        
    }
}