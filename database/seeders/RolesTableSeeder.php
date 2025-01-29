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
                'name' => 'Xonier Admin',
                'description' => 'Administrator with full access',
                'user_id' => 1,
                'category' => 'default',
                'status' => 1,
                'created_at' => '2025-01-29 10:41:20',
                'updated_at' => '2025-01-29 10:41:20',
            ),
        ));
        
        
    }
}