<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanyTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'Xonier',
            'username' => 'Xonier',
            'contact_no' => '1234567890',
            'email' => 'xonier@gmail.com',
            'joining_date' => Carbon::now(),
            'logo' => 'https://ibb.co/YPHW7WK',
            'company_size' => '100', // or any other size
            'company_url' => 'https://yourcompany.com',
            'subscription_id' => 1, // You might want to adjust this
            'company_address' => 'XYZ',
            'company_type_id' => '1',
        ]);
    }
}
