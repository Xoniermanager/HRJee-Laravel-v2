<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('announcements')->delete();   
        DB::table('announcements')->insert([
            'id' => 1,
            'title' => 'title til dfkdfg dfg',
            'image' => '179071659132626951719819766.jfif',
            'description' => 'sdfsdfs sdjf sdkfhksjdhf',
            'start_date_time' => '2024-07-27 00:42:00',
            'expires_at' => '2024-08-01 00:42:00',
            'status' => 'active',
            'company_branch_id' => 1,
            'created_at' => '2024-07-01 13:12:46',
            'updated_at' => '2024-07-01 13:12:46',
        ]);  
    }
}