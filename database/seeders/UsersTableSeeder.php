<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Xonier',
                'email' => 'xonier@gmail.com',
                'password' => '$2y$12$IR42QDoUUVhWecO3UOEN6ecuY6yCH75BDBCCjFV.rgHueR3rTCS8S',
                'email_verified_at' => NULL,
                'role_id' => 1,
                'company_id' => NULL,
                'manager_id' => NULL,
                'type' => 'company',
                'status' => 1,
                'remember_token' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-01-29 10:41:20',
                'updated_at' => '2025-01-29 10:41:20',
            ),
        ));
        
        
    }
}