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
                    'title' => 'Department',
                    'slug' => '/department',
                    'icon' => '<i class="fa fa-globe"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 1,
                    'role' => 'company',
                    'created_at' => '2025-01-15 11:47:40',
                    'updated_at' => '2025-01-15 11:47:40',
                ),
            1 =>
                array(
                    'id' => 2,
                    'title' => 'Designation',
                    'slug' => '/designation',
                    'icon' => '<i class="fa fa-city"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 2,
                    'role' => 'company',
                    'created_at' => '2025-01-15 11:48:30',
                    'updated_at' => '2025-01-15 11:48:30',
                ),
            2 =>
                array(
                    'id' => 3,
                    'title' => 'Company Branch',
                    'slug' => '/branch',
                    'icon' => '<i class="fa fa-sitemap"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 4,
                    'role' => 'company',
                    'created_at' => '2025-01-15 12:56:24',
                    'updated_at' => '2025-01-15 12:56:24',
                ),
            3 =>
                array(
                    'id' => 4,
                    'title' => 'Employee',
                    'slug' => '/employee',
                    'icon' => '<i class="fa fa-users"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 5,
                    'role' => 'company',
                    'created_at' => '2025-01-15 12:59:31',
                    'updated_at' => '2025-01-15 12:59:31',
                ),
            4 =>
                array(
                    'id' => 5,
                    'title' => 'Holiday',
                    'slug' => '/holiday',
                    'icon' => '<i class="fa fa-plane"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 6,
                    'role' => 'company',
                    'created_at' => '2025-01-15 13:04:36',
                    'updated_at' => '2025-01-15 13:04:36',
                ),
            5 =>
                array(
                    'id' => 6,
                    'title' => 'Weekend',
                    'slug' => '/weekend',
                    'icon' => '<i class="fa fa-calendar-day"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 7,
                    'role' => 'company',
                    'created_at' => '2025-01-15 13:04:59',
                    'updated_at' => '2025-01-15 13:04:59',
                ),
            6 =>
                array(
                    'id' => 7,
                    'title' => 'Announcement',
                    'slug' => '/announcement',
                    'icon' => '<i class="fa fa-bullhorn"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 8,
                    'role' => 'company',
                    'created_at' => '2025-01-15 13:07:21',
                    'updated_at' => '2025-01-15 13:07:21',
                ),
            7 =>
                array(
                    'id' => 8,
                    'title' => 'Break Type',
                    'slug' => '/break-type',
                    'icon' => '<i class="fa fa-pause"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 8,
                    'role' => 'company',
                    'created_at' => '2025-01-15 13:11:57',
                    'updated_at' => '2025-01-15 13:11:57',
                ),
            8 =>
                array(
                    'id' => 9,
                    'title' => 'Resignations',
                    'slug' => '/resignation',
                    'icon' => '<i class="fa fa-sign-out-alt"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 10,
                    'role' => 'company',
                    'created_at' => '2025-01-15 13:13:57',
                    'updated_at' => '2025-01-15 13:13:57',
                ),
            9 =>
                array(
                    'id' => 10,
                    'title' => 'Office Timing Config',
                    'slug' => '/shifts',
                    'icon' => '<i class="fa fa-clock"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 11,
                    'role' => 'company',
                    'created_at' => '2025-01-15 15:02:12',
                    'updated_at' => '2025-01-15 15:02:12',
                ),
            10 =>
                array(
                    'id' => 11,
                    'title' => 'Office Shifts',
                    'slug' => '/shifts/office-shifts',
                    'icon' => 'NA',
                    'parent_id' => 10,
                    'status' => 1,
                    'order_no' => 12,
                    'role' => 'company',
                    'created_at' => '2025-01-15 15:04:16',
                    'updated_at' => '2025-01-15 15:04:16',
                ),
            11 =>
                array(
                    'id' => 12,
                    'title' => 'Timing Config',
                    'slug' => '/shifts/office-time',
                    'icon' => 'NA',
                    'parent_id' => 10,
                    'status' => 1,
                    'order_no' => 13,
                    'role' => 'company',
                    'created_at' => '2025-01-15 15:05:07',
                    'updated_at' => '2025-01-15 15:05:07',
                ),
            12 =>
                array(
                    'id' => 13,
                    'title' => 'Role Management',
                    'slug' => '/roles',
                    'icon' => '<i class="fa fa-user-shield"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 14,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:02:20',
                    'updated_at' => '2025-01-15 16:02:20',
                ),
            13 =>
                array(
                    'id' => 14,
                    'title' => 'Role',
                    'slug' => '/roles',
                    'icon' => 'NA',
                    'parent_id' => 13,
                    'status' => 1,
                    'order_no' => 15,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:03:30',
                    'updated_at' => '2025-01-15 16:03:30',
                ),
            14 =>
                array(
                    'id' => 15,
                    'title' => 'Assign Permission',
                    'slug' => '/roles/assign_permissions',
                    'icon' => 'NA',
                    'parent_id' => 13,
                    'status' => 1,
                    'order_no' => 14,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:04:41',
                    'updated_at' => '2025-01-15 16:04:41',
                ),
            15 =>
                array(
                    'id' => 16,
                    'title' => 'News Management',
                    'slug' => '/news',
                    'icon' => '<i class="fa fa-newspaper"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 14,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:09:51',
                    'updated_at' => '2025-01-15 16:09:51',
                ),
            16 =>
                array(
                    'id' => 17,
                    'title' => 'News',
                    'slug' => '/news',
                    'icon' => 'NA',
                    'parent_id' => 16,
                    'status' => 1,
                    'order_no' => 16,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:11:25',
                    'updated_at' => '2025-01-15 16:11:25',
                ),
            17 =>
                array(
                    'id' => 18,
                    'title' => 'News Category',
                    'slug' => '/news/news-category',
                    'icon' => 'NA',
                    'parent_id' => 16,
                    'status' => 1,
                    'order_no' => 17,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:12:12',
                    'updated_at' => '2025-01-15 16:12:12',
                ),
            18 =>
                array(
                    'id' => 19,
                    'title' => 'Policy Management',
                    'slug' => '/policy',
                    'icon' => '<i class="fa fa-gavel"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 18,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:13:10',
                    'updated_at' => '2025-01-15 16:13:10',
                ),
            19 =>
                array(
                    'id' => 20,
                    'title' => 'Policy',
                    'slug' => '/policy',
                    'icon' => 'NA',
                    'parent_id' => 19,
                    'status' => 1,
                    'order_no' => 18,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:13:32',
                    'updated_at' => '2025-01-15 16:13:32',
                ),
            20 =>
                array(
                    'id' => 21,
                    'title' => 'Policy Category',
                    'slug' => '/policy/policy-category',
                    'icon' => 'NA',
                    'parent_id' => 19,
                    'status' => 1,
                    'order_no' => 19,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:14:05',
                    'updated_at' => '2025-01-15 16:14:05',
                ),
            21 =>
                array(
                    'id' => 22,
                    'title' => 'Asset Management',
                    'slug' => '/asset',
                    'icon' => '<i class="fa fa-cogs"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 20,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:18:29',
                    'updated_at' => '2025-01-15 16:18:29',
                ),
            22 =>
                array(
                    'id' => 23,
                    'title' => 'Asset Manufacturer',
                    'slug' => '/asset/asset-manufacturer',
                    'icon' => 'NA',
                    'parent_id' => 22,
                    'status' => 1,
                    'order_no' => 21,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:19:56',
                    'updated_at' => '2025-01-15 16:19:56',
                ),
            23 =>
                array(
                    'id' => 24,
                    'title' => 'Asset Status',
                    'slug' => '/asset/asset-status',
                    'icon' => 'NA',
                    'parent_id' => 22,
                    'status' => 1,
                    'order_no' => 22,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:20:25',
                    'updated_at' => '2025-01-15 16:20:25',
                ),
            24 =>
                array(
                    'id' => 25,
                    'title' => 'Asset Category',
                    'slug' => '/asset/asset-category',
                    'icon' => 'NA',
                    'parent_id' => 22,
                    'status' => 1,
                    'order_no' => 23,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:21:25',
                    'updated_at' => '2025-01-15 16:21:25',
                ),
            25 =>
                array(
                    'id' => 26,
                    'title' => 'Asset Dashboard',
                    'slug' => '/asset/dashboard',
                    'icon' => 'NA',
                    'parent_id' => 22,
                    'status' => 1,
                    'order_no' => 25,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:21:59',
                    'updated_at' => '2025-01-15 16:21:59',
                ),
            26 =>
                array(
                    'id' => 27,
                    'title' => 'Asset',
                    'slug' => '/asset',
                    'icon' => '<i class="fa fa-cogs"></i>',
                    'parent_id' => 22,
                    'status' => 1,
                    'order_no' => 20,
                    'role' => 'company',
                    'created_at' => '2025-01-15 16:18:29',
                    'updated_at' => '2025-01-15 16:18:29',
                ),
            27 =>
                array(
                    'id' => 28,
                    'title' => 'Attendance Management',
                    'slug' => '#',
                    'icon' => '<i class="fa fa-file-alt"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 26,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:43:32',
                    'updated_at' => '2025-01-15 17:43:32',
                ),
                28 =>
                array(
                    'id' => 29,
                    'title' => 'Attendance',
                    'slug' => '/attendance',
                    'icon' => '<i class="fa fa-file-alt"></i>',
                    'parent_id' => 28,
                    'status' => 1,
                    'order_no' => 26,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:43:32',
                    'updated_at' => '2025-01-15 17:43:32',
                ),
                29 =>
                array(
                    'id' => 30,
                    'title' => 'Attendance Request',
                    'slug' => '/attendance-request',
                    'icon' => '<i class="fa fa-file-alt"></i>',
                    'parent_id' => 28,
                    'status' => 1,
                    'order_no' => 26,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:43:32',
                    'updated_at' => '2025-01-15 17:43:32',
                ),
            30 =>
                array(
                    'id' => 31,
                    'title' => 'Complain',
                    'slug' => '/complain',
                    'icon' => '<i class="fa fa-comment-dots"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 28,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:49:56',
                    'updated_at' => '2025-01-15 17:49:56',
                ),
            31 =>
                array(
                    'id' => 32,
                    'title' => 'Complain Status',
                    'slug' => '/complain-status',
                    'icon' => 'NA',
                    'parent_id' => 31,
                    'status' => 1,
                    'order_no' => 28,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:51:15',
                    'updated_at' => '2025-01-15 17:51:15',
                ),
            32 =>
                array(
                    'id' => 33,
                    'title' => 'Complain Category',
                    'slug' => '/complain-category',
                    'icon' => 'NA',
                    'parent_id' => 31,
                    'status' => 1,
                    'order_no' => 28,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:51:49',
                    'updated_at' => '2025-01-15 17:51:49',
                ),
            33 =>
                array(
                    'id' => 34,
                    'title' => 'Leave Management',
                    'slug' => '/leave',
                    'icon' => '<i class="fa fa-calendar-check"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 29,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:14',
                    'updated_at' => '2025-01-15 17:54:14',
                ),
            34 =>
                array(
                    'id' => 35,
                    'title' => 'Leave Type',
                    'slug' => '/leave-type',
                    'icon' => 'NA',
                    'parent_id' => 34,
                    'status' => 1,
                    'order_no' => 29,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-15 17:54:47',
                ),
            35 =>
                array(
                    'id' => 36,
                    'title' => 'Leave Status',
                    'slug' => '/leave-status',
                    'icon' => 'NA',
                    'parent_id' => 34,
                    'status' => 1,
                    'order_no' => 29,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-15 17:54:47',
                ),
            36 =>
                array(
                    'id' => 37,
                    'title' => 'Employee Leave',
                    'slug' => '/leave',
                    'icon' => 'NA',
                    'parent_id' => 34,
                    'status' => 1,
                    'order_no' => 29,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:28:11',
                ),
            37 =>
                array(
                    'id' => 38,
                    'title' => 'Employee Leave Credit',
                    'slug' => '/leave-credit-management',
                    'icon' => 'NA',
                    'parent_id' => 34,
                    'status' => 1,
                    'order_no' => 29,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-15 17:54:47',
                ),
            38 =>
                array(
                    'id' => 39,
                    'title' => 'Leave Status Update',
                    'slug' => '/leave-status-log',
                    'icon' => 'NA',
                    'parent_id' => 34,
                    'status' => 1,
                    'order_no' => 29,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-15 17:54:47',
                ),
            39 =>
                array(
                    'id' => 40,
                    'title' => 'Employee Leave Available',
                    'slug' => '/get/allemployee/leave/available',
                    'icon' => 'NA',
                    'parent_id' => 34,
                    'status' => 1,
                    'order_no' => 29,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-15 17:54:47',
                ),
            40 =>
                array(
                    'id' => 41,
                    'title' => 'Exit Employee ',
                    'slug' => '/employee/exit/list',
                    'icon' => '<i class="fa fa-user-times" aria-hidden="true"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 30,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            41 =>
                array(
                    'id' => 42,
                    'title' => 'Salary Management',
                    'slug' => '#',
                    'icon' => '<i class="fas fa-money-bill-wave"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 31,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            42 =>
                array(
                    'id' => 43,
                    'title' => 'Salary Component',
                    'slug' => '/salary-component',
                    'icon' => '<i class="fas fa-money-bill-wave"></i>',
                    'parent_id' => 42,
                    'status' => 1,
                    'order_no' => 31,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            44 =>
                array(
                    'id' => 44,
                    'title' => 'Salary Structured',
                    'slug' => '/salary',
                    'icon' => '<i class="fas fa-money-bill-wave"></i>',
                    'parent_id' => 42,
                    'status' => 1,
                    'order_no' => 31,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            45 =>
                array(
                    'id' => 45,
                    'title' => 'Tax Slab Rule',
                    'slug' => '/tax-slab',
                    'icon' => '<i class="fas fa-money-bill-wave"></i>',
                    'parent_id' => 42,
                    'status' => 1,
                    'order_no' => 31,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            46 =>
                array(
                    'id' => 46,
                    'title' => 'Employee Salary',
                    'slug' => '/employee-salary',
                    'icon' => '<i class="fas fa-money-bill-wave"></i>',
                    'parent_id' => 42,
                    'status' => 1,
                    'order_no' => 31,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            47 =>
                array(
                    'id' => 47,
                    'title' => 'Location Visit Management',
                    'slug' => '#',
                    'icon' => '<i class="fa fa-map-marker" aria-hidden="true"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 32,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            48 =>
                array(
                    'id' => 48,
                    'title' => 'Location Visit',
                    'slug' => '/location-visit',
                    'icon' => '<i class="fa fa-map-marker" aria-hidden="true"></i>',
                    'parent_id' => 47,
                    'status' => 1,
                    'order_no' => 32,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            49 =>
                array(
                    'id' => 49,
                    'title' => 'Disposition Code',
                    'slug' => '/disposition-code',
                    'icon' => '<i class="fa fa-map-marker" aria-hidden="true"></i>',
                    'parent_id' => 47,
                    'status' => 1,
                    'order_no' => 32,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            50 =>
                array(
                    'id' => 50,
                    'title' => 'Assign Task',
                    'slug' => '/location-visit/assign_task',
                    'icon' => '<i class="fa fa-map-marker" aria-hidden="true"></i>',
                    'parent_id' => 47,
                    'status' => 1,
                    'order_no' => 32,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            51 =>
                array(
                    'id' => 51,
                    'title' => 'PRM Management',
                    'slug' => '#',
                    'icon' => '<i class="fas fa-money-bill-wave"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 31,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            52 =>
                array(
                    'id' => 52,
                    'title' => 'PRM Category',
                    'slug' => '/prm/category',
                    'icon' => 'NA',
                    'parent_id' => 51,
                    'status' => 1,
                    'order_no' => 31,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            53 =>
                array(
                    'id' => 53,
                    'title' => 'PRM Request',
                    'slug' => '/prm/request',
                    'icon' => 'NA',
                    'parent_id' => 51,
                    'status' => 1,
                    'order_no' => 31,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            54=>
                array(
                    'id' => 54,
                    'title' => 'Course Management',
                    'slug' => '/courses',
                    'icon' => '<i class="fas fa-book"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 32,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            55=>
                array(
                    'id' => 55,
                    'title' => 'Comp Off',
                    'slug' => '/comp-offs',
                    'icon' => '<i class="fas fa-book"></i>',
                    'parent_id' => 34,
                    'status' => 1,
                    'order_no' => 32,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
            56=>
                array(
                    'id' => 56,
                    'title' => 'Face Recognition',
                    'slug' => '/face-recognitions',
                    'icon' => '<i class="fas fa-book"></i>',
                    'parent_id' => 28,
                    'status' => 1,
                    'order_no' => 32,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
                57 =>
                array(
                    'id' => 57,
                    'title' => 'Address Request',
                    'slug' => '/address-request',
                    'icon' => '<i class="fas fa-location"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 32,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
                58 =>
                array(
                    'id' => 58,
                    'title' => 'Rewards Management',
                    'slug' => '#',
                    'icon' => '<i class="fa fa-award"></i>',
                    'parent_id' => NULL,
                    'status' => 1,
                    'order_no' => 32,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
                59 =>
                array(
                    'id' => 59,
                    'title' => 'Rewards Category',
                    'slug' => '/reward-category',
                    'icon' => '#',
                    'parent_id' => 58,
                    'status' => 1,
                    'order_no' => 32,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
                60 =>
                array(
                    'id' => 60,
                    'title' => 'Rewards',
                    'slug' => '/reward',
                    'icon' => '#',
                    'parent_id' => 58,
                    'status' => 1,
                    'order_no' => 32,
                    'role' => 'company',
                    'created_at' => '2025-01-15 17:54:47',
                    'updated_at' => '2025-01-23 12:27:40',
                ),
        ));
    }
}
