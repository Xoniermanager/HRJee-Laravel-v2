<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('roles')->insert([
            ['name' => 'Admin', 'description' => 'Administrator with full permissions', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'User', 'description' => 'Regular user with basic permissions', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
