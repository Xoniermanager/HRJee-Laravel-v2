<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 // List of major cities in Uttar Pradesh
    $cities = [
        'Lucknow',
        'Kanpur',
        'Agra',
        'Varanasi',
        'Allahabad',
        'Meerut',
        'Ghaziabad',
        'Bareilly',
        'Aligarh',
        'Moradabad',
        'Saharanpur',
        'Gorakhpur',
        'Faizabad',
        'Jhansi',
        'Muzaffarnagar',
        'Mathura',
        'Noida',
        'Rampur',
        'Shahjahanpur',
        'Firozabad',
        // Add more cities as needed
    ];

    // Insert cities into the database
    foreach ($cities as $city) {
        DB::table('states')->insert([
            'name' => $city,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
    }
}
