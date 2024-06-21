<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Company;
use App\Models\CompanyUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::create([
            'name' => 'Demo',
            'username' => 'Demo',
            'contact_no' => '1234567890',
            'email' => 'company@demo.com',
            'role_id' => null, // You might want to adjust this if you have a specific role ID
            'joining_date' => Carbon::now(),
            'logo' => 'https://ibb.co/YPHW7WK',
            'company_size' => '100', // or any other size
            'company_url' => 'https://yourcompany.com',
            'subscription_id' => 1, // You might want to adjust this
            'company_address' => 'XYZ',
            'industry_type' => '5',
            'status' => '1', // or any other status
        ]);
        CompanyUser::insert([
            'company_id' => '1',
            'email' => 'company@demo.com',
            'name' => 'Demo',
            'password' => Hash::make('password') // <---- check this
        ]);
    }
}
