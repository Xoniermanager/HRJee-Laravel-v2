<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('subscription_plans')->delete();
        \DB::table('subscription_plans')->insert([
            [
                'title' => 'Yearly',
                'days' => 365,
                'per_person_amount' => 50,
                'created_at' => '2024-06-21 13:12:49',
                'updated_at' => '2024-06-21 13:12:49',
            ],
            [
                'title' => 'Monthly',
                'days' => 28,
                'per_person_amount' => 20,
                'created_at' => '2024-06-21 13:12:59',
                'updated_at' => '2024-06-21 13:12:59',
            ],
            [
                'title' => 'Trial',
                'days' => 7,
                'per_person_amount' => 10,
                'created_at' => '2024-06-21 13:13:20',
                'updated_at' => '2024-06-21 13:13:20',
            ],
        ]);
    }
}
