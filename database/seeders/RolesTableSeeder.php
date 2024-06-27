<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Company',
                'guard_name' => 'web',
                'created_at' => '2024-06-21 14:53:48',
                'updated_at' => '2024-06-21 14:53:48',
                'status' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Employee',
                'guard_name' => 'web',
                'created_at' => '2024-06-21 14:53:58',
                'updated_at' => '2024-06-21 14:53:58',
                'status' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'User',
                'guard_name' => 'web',
                'created_at' => '2024-06-21 14:54:03',
                'updated_at' => '2024-06-21 14:54:03',
                'status' => 1,
            ),
        ));
        
        
    }
}