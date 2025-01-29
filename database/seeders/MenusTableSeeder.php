<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('menus')->delete();

        \DB::table('menus')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'title' => 'Country',
                    'slug' => '/country',
                    'icon' => '<i class="fa fa-globe"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 1,
                    'created_at' => '2025-01-15 11:47:40',
                    'updated_at' => '2025-01-15 11:47:40',
                ),
            1 =>
                array(
                    'id' => 2,
                    'title' => 'State',
                    'slug' => '/state',
                    'icon' => '<i class="fa fa-city"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 2,
                    'created_at' => '2025-01-15 11:48:30',
                    'updated_at' => '2025-01-15 11:48:30',
                ),
            2 =>
                array(
                    'id' => 3,
                    'title' => 'Previous Company',
                    'slug' => '/previous-company',
                    'icon' => '<i class="fa fa-history"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 3,
                    'created_at' => '2025-01-15 12:51:05',
                    'updated_at' => '2025-01-15 12:51:05',
                ),
            3 =>
                array(
                    'id' => 4,
                    'title' => 'Company Branch',
                    'slug' => '/branch',
                    'icon' => '<i class="fa fa-sitemap"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 4,
                    'created_at' => '2025-01-15 12:56:24',
                    'updated_at' => '2025-01-15 12:56:24',
                ),
            4 =>
                array(
                    'id' => 5,
                    'title' => 'Employee',
                    'slug' => '/employee',
                    'icon' => '<i class="fa fa-users"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 5,
                    'created_at' => '2025-01-15 12:59:31',
                    'updated_at' => '2025-01-15 12:59:31',
                ),
            5 =>
                array(
                    'id' => 6,
                    'title' => 'Holiday',
                    'slug' => '/holiday',
                    'icon' => '<i class="fa fa-plane"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 6,
                    'created_at' => '2025-01-15 13:04:36',
                    'updated_at' => '2025-01-15 13:04:36',
                ),
            6 =>
                array(
                    'id' => 7,
                    'title' => 'Weekend',
                    'slug' => '/weekend',
                    'icon' => '<i class="fa fa-calendar-day"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 7,
                    'created_at' => '2025-01-15 13:04:59',
                    'updated_at' => '2025-01-15 13:04:59',
                ),
            7 =>
                array(
                    'id' => 8,
                    'title' => 'Announcement',
                    'slug' => '/announcement',
                    'icon' => '<i class="fa fa-bullhorn"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 8,
                    'created_at' => '2025-01-15 13:07:21',
                    'updated_at' => '2025-01-15 13:07:21',
                ),
            8 =>
                array(
                    'id' => 9,
                    'title' => 'Break Type',
                    'slug' => '/break-type',
                    'icon' => '<i class="fa fa-pause"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 8,
                    'created_at' => '2025-01-15 13:11:57',
                    'updated_at' => '2025-01-15 13:11:57',
                ),
            9 =>
                array(
                    'id' => 10,
                    'title' => 'Resignation Status',
                    'slug' => '/resignation/status',
                    'icon' => '<i class="fa fa-sign-out-alt"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 10,
                    'created_at' => '2025-01-15 13:13:57',
                    'updated_at' => '2025-01-15 13:13:57',
                ),
            10 =>
                array(
                    'id' => 11,
                    'title' => 'Office Timing Config',
                    'slug' => '/shifts',
                    'icon' => '<i class="fa fa-clock"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 11,
                    'created_at' => '2025-01-15 15:02:12',
                    'updated_at' => '2025-01-15 15:02:12',
                ),
            11 =>
                array(
                    'id' => 12,
                    'title' => 'Office Shifts',
                    'slug' => '/shifts/office-shifts',
                    'icon' => 'NA',
                    'parent_id' => 11,
                    'status' => 1,
                    'order_no' => 12,
                    'created_at' => '2025-01-15 15:04:16',
                    'updated_at' => '2025-01-15 15:04:16',
                ),
            12 =>
                array(
                    'id' => 13,
                    'title' => 'Timing Config',
                    'slug' => '/shifts/office-time',
                    'icon' => 'NA',
                    'parent_id' => 11,
                    'status' => 1,
                    'order_no' => 13,
                    'created_at' => '2025-01-15 15:05:07',
                    'updated_at' => '2025-01-15 15:05:07',
                ),
            13 =>
                array(
                    'id' => 14,
                    'title' => 'Role Management',
                    'slug' => '/roles',
                    'icon' => '<i class="fa fa-user-shield"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 14,
                    'created_at' => '2025-01-15 16:02:20',
                    'updated_at' => '2025-01-15 16:02:20',
                ),
            14 =>
                array(
                    'id' => 15,
                    'title' => 'Role',
                    'slug' => '/roles',
                    'icon' => 'NA',
                    'parent_id' => 14,
                    'status' => 1,
                    'order_no' => 15,
                    'created_at' => '2025-01-15 16:03:30',
                    'updated_at' => '2025-01-15 16:03:30',
                ),
            15 =>
                array(
                    'id' => 16,
                    'title' => 'Assign Permission',
                    'slug' => '/roles/assign_permissions',
                    'icon' => 'NA',
                    'parent_id' => 14,
                    'status' => 1,
                    'order_no' => 14,
                    'created_at' => '2025-01-15 16:04:41',
                    'updated_at' => '2025-01-15 16:04:41',
                ),
            16 =>
                array(
                    'id' => 17,
                    'title' => 'News Management',
                    'slug' => '/news',
                    'icon' => '<i class="fa fa-newspaper"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 14,
                    'created_at' => '2025-01-15 16:09:51',
                    'updated_at' => '2025-01-15 16:09:51',
                ),
            17 =>
                array(
                    'id' => 18,
                    'title' => 'News',
                    'slug' => '/news',
                    'icon' => 'NA',
                    'parent_id' => 17,
                    'status' => 1,
                    'order_no' => 16,
                    'created_at' => '2025-01-15 16:11:25',
                    'updated_at' => '2025-01-15 16:11:25',
                ),
            18 =>
                array(
                    'id' => 19,
                    'title' => 'News Category',
                    'slug' => '/news/news-category',
                    'icon' => 'NA',
                    'parent_id' => 17,
                    'status' => 1,
                    'order_no' => 17,
                    'created_at' => '2025-01-15 16:12:12',
                    'updated_at' => '2025-01-15 16:12:12',
                ),
            19 =>
                array(
                    'id' => 20,
                    'title' => 'Policy Management',
                    'slug' => '/policy',
                    'icon' => '<i class="fa fa-gavel"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 18,
                    'created_at' => '2025-01-15 16:13:10',
                    'updated_at' => '2025-01-15 16:13:10',
                ),
            20 =>
                array(
                    'id' => 21,
                    'title' => 'Policy',
                    'slug' => '/policy',
                    'icon' => 'NA',
                    'parent_id' => 20,
                    'status' => 1,
                    'order_no' => 18,
                    'created_at' => '2025-01-15 16:13:32',
                    'updated_at' => '2025-01-15 16:13:32',
                ),
            21 =>
                array(
                    'id' => 22,
                    'title' => 'Policy Category',
                    'slug' => '/policy/policy-category',
                    'icon' => 'NA',
                    'parent_id' => 20,
                    'status' => 1,
                    'order_no' => 19,
                    'created_at' => '2025-01-15 16:14:05',
                    'updated_at' => '2025-01-15 16:14:05',
                ),
            22 =>
                array(
                    'id' => 23,
                    'title' => 'Asset Management',
                    'slug' => '/asset',
                    'icon' => '<i class="fa fa-cogs"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 20,
                    'created_at' => '2025-01-15 16:18:29',
                    'updated_at' => '2025-01-15 16:18:29',
                ),
            23 =>
                array(
                    'id' => 24,
                    'title' => 'Asset Manufacturer',
                    'slug' => '/asset/asset-manufacturer',
                    'icon' => 'NA',
                    'parent_id' => 23,
                    'status' => 1,
                    'order_no' => 21,
                    'created_at' => '2025-01-15 16:19:56',
                    'updated_at' => '2025-01-15 16:19:56',
                ),
            24 =>
                array(
                    'id' => 25,
                    'title' => 'Asset Status',
                    'slug' => '/asset/asset-status',
                    'icon' => 'NA',
                    'parent_id' => 23,
                    'status' => 1,
                    'order_no' => 22,
                    'created_at' => '2025-01-15 16:20:25',
                    'updated_at' => '2025-01-15 16:20:25',
                ),
            25 =>
                array(
                    'id' => 26,
                    'title' => 'Asset Category',
                    'slug' => '/asset/asset-category',
                    'icon' => 'NA',
                    'parent_id' => 23,
                    'status' => 1,
                    'order_no' => 23,
                    'created_at' => '2025-01-15 16:21:25',
                    'updated_at' => '2025-01-15 16:21:25',
                ),
            26 =>
                array(
                    'id' => 27,
                    'title' => 'Asset Dashboard',
                    'slug' => '/asset/dashboard',
                    'icon' => 'NA',
                    'parent_id' => 23,
                    'status' => 1,
                    'order_no' => 25,
                    'created_at' => '2025-01-15 16:21:59',
                    'updated_at' => '2025-01-15 16:21:59',
                ),
            27 =>
                array(
                    'id' => 28,
                    'title' => 'Asset',
                    'slug' => '/asset',
                    'icon' => '<i class="fa fa-cogs"></i>',
                    'parent_id' => 23,
                    'status' => 1,
                    'order_no' => 20,
                    'created_at' => '2025-01-15 16:18:29',
                    'updated_at' => '2025-01-15 16:18:29',
                ),
            28 =>
                array(
                    'id' => 29,
                    'title' => 'Attendance Management',
                    'slug' => '/attendance',
                    'icon' => '<i class="fa fa-file-alt"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 26,
                    'created_at' => '2025-01-15 17:43:32',
                    'updated_at' => '2025-01-15 17:43:32',
                ),
            29 =>
                array(
                    'id' => 30,
                    'title' => 'Attendance',
                    'slug' => '/attendance',
                    'icon' => 'NA',
                    'parent_id' => 29,
                    'status' => 1,
                    'order_no' => 27,
                    'created_at' => '2025-01-15 17:43:54',
                    'updated_at' => '2025-01-15 17:43:54',
                ),
            30 =>
                array(
                    'id' => 31,
                    'title' => 'Attendance Status',
                    'slug' => '/attendance/attendance-status',
                    'icon' => 'NA',
                    'parent_id' => 29,
                    'status' => 1,
                    'order_no' => 27,
                    'created_at' => '2025-01-15 17:44:23',
                    'updated_at' => '2025-01-15 17:44:23',
                ),
            31 =>
                array(
                    'id' => 32,
                    'title' => 'Complain',
                    'slug' => '/complain',
                    'icon' => '<i class="fa fa-comment-dots"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 28,
                    'created_at' => '2025-01-15 17:49:56',
                    'updated_at' => '2025-01-15 17:49:56',
                ),
            32 =>
                array(
                    'id' => 33,
                    'title' => 'Complain Status',
                    'slug' => '/complain-status',
                    'icon' => 'NA',
                    'parent_id' => 32,
                    'status' => 1,
                    'order_no' => 28,
                    'created_at' => '2025-01-15 17:51:15',
                    'updated_at' => '2025-01-15 17:51:15',
                ),
            33 =>
                array(
                    'id' => 34,
                    'title' => 'Complain Category',
                    'slug' => '/complain-category',
                    'icon' => 'NA',
                    'parent_id' => 32,
                    'status' => 1,
                    'order_no' => 28,
                    'created_at' => '2025-01-15 17:51:49',
                    'updated_at' => '2025-01-15 17:51:49',
                ),
            34 =>
                array(
                    'id' => 35,
                    'title' => 'Leave Management',
                    'slug' => '/leave',
                    'icon' => '<i class="fa fa-calendar-check"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 29,
                    'created_at' => '2025-01-15 17:54:14',
                    'updated_at' => '2025-01-15 17:54:14',
                ),
            35 =>
                array(
                    'id' => 36,
                    'title' => 'Leave Type',
                    'slug' => '/leave-type',
                    'icon' => 'NA',
                    'parent_id' => 35,
                    'status' => 1,
                    'order_no' => 29,
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-15 17:54:47',
                ),
            36 =>
                array(
                    'id' => 37,
                    'title' => 'Leave Status',
                    'slug' => '/leave-status',
                    'icon' => 'NA',
                    'parent_id' => 35,
                    'status' => 1,
                    'order_no' => 29,
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-15 17:54:47',
                ),
            37 =>
                array(
                    'id' => 38,
                    'title' => 'Employee Leave',
                    'slug' => '/leave',
                    'icon' => 'NA',
                    'parent_id' => 35,
                    'status' => 1,
                    'order_no' => 29,
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:28:11',
                ),
            38 =>
                array(
                    'id' => 39,
                    'title' => 'Employee Leave Credit',
                    'slug' => '/leave-credit-management',
                    'icon' => 'NA',
                    'parent_id' => 35,
                    'status' => 1,
                    'order_no' => 29,
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-15 17:54:47',
                ),
            39 =>
                array(
                    'id' => 40,
                    'title' => 'Leave Status Update',
                    'slug' => '/leave-status-log',
                    'icon' => 'NA',
                    'parent_id' => 35,
                    'status' => 1,
                    'order_no' => 29,
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-15 17:54:47',
                ),
            40 =>
                array(
                    'id' => 41,
                    'title' => 'Employee Leave Available',
                    'slug' => '/get/allemployee/leave/available',
                    'icon' => 'NA',
                    'parent_id' => 35,
                    'status' => 1,
                    'order_no' => 29,
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-15 17:54:47',
                ),
            41 =>
                array(
                    'id' => 42,
                    'title' => 'Exit Employee ',
                    'slug' => '/employee/exit/list',
                    'icon' => '<i class="fa fa-user-times" aria-hidden="true"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 30,
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
        ));
    }
}
