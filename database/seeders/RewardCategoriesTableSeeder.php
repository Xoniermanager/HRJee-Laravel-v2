<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RewardCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('reward_categories')->delete();
        
        \DB::table('reward_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Monetary Rewards',
                'description' => 'Cash bonuses, salary increments, stock options.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:37:42',
                'updated_at' => '2025-04-01 11:55:57',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Performance-Based Rewards',
                'description' => 'Incentives for exceeding targets.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:37:56',
                'updated_at' => '2025-04-01 11:46:51',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Tenure-Based Rewards',
                'description' => 'Loyalty bonuses, service awards.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:38:08',
                'updated_at' => '2025-04-01 11:46:19',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Peer Recognition Rewards',
                'description' => 'Colleague-nominated awards.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:38:21',
                'updated_at' => '2025-04-01 11:46:05',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Loyalty Rewards',
                'description' => 'Points-based systems for repeat customers.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:38:40',
                'updated_at' => '2025-04-01 11:45:44',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Experience-Based Rewards',
                'description' => 'Travel, exclusive events, VIP access.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:38:54',
                'updated_at' => '2025-04-01 11:45:29',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Learning & Development Rewards',
                'description' => 'Sponsored courses, certifications.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:39:11',
                'updated_at' => '2025-04-01 11:45:15',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Wellness Rewards',
                'description' => 'Gym memberships, health benefits.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:39:24',
                'updated_at' => '2025-04-01 11:44:57',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Gamification Rewards',
                'description' => 'Badges, leaderboards, progression levels.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:39:37',
                'updated_at' => '2025-04-01 11:44:43',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Referral Rewards',
                'description' => 'Incentives for bringing in customers/employees.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:39:51',
                'updated_at' => '2025-04-01 11:44:12',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Achievement Awards',
                'description' => 'Trophies, plaques for outstanding performance.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:40:04',
                'updated_at' => '2025-04-01 11:43:37',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Flexible Benefits',
                'description' => 'Extra PTO, remote work options.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:40:21',
                'updated_at' => '2025-04-01 11:43:17',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Discount-Based Rewards',
                'description' => 'Employee or customer discounts.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:40:39',
                'updated_at' => '2025-04-01 11:43:03',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Tangible Gifts',
                'description' => 'Gadgets, merchandise, gift cards.',
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => '2025-04-01 11:40:52',
                'updated_at' => '2025-04-01 11:53:16',
            ),
        ));
        
        
    }
}