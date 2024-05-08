<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            ['id' => 1, 'name' => 'India'],
            ['id' => 2, 'name' => 'Bangladesh'],
            ['id' => 3, 'name' => 'Bhutan'],
        ]);
    }
}
