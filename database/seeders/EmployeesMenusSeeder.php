<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class EmployeesMenusSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $payload  = [
            [
                'title' => 'Attendance Detail',
                'slug' => '/employee/attendance/service',
                'icon' => '<i class="fa fa-calendar-days"></i>',
                'parent_id' => NULL,
                'order_no' => 1,
                'role' => 'employee'
            ],
            [
                'title' => 'Request Attendance',
                'slug' => '/employee/attendance/request',
                'icon' => '<i class="fa fa-calendar-days"></i>',
                'parent_id' => NULL,
                'order_no' => 2,
                'role' => 'employee'
            ],
            [
                'title' => 'Request Address',
                'slug' => '/employee/address/request',
                'icon' => '<i class="fa fa-location"></i>',
                'parent_id' => NULL,
                'order_no' => 2,
                'role' => 'employee'
            ],
            [
                'title' => 'Announcements',
                'slug' => '/employee/announcement',
                'icon' => '<i class="fa fa-newspaper"></i>',
                'parent_id' => NULL,
                'order_no' => 2,
                'role' => 'employee'
            ],
            [
                'title' => 'Employee News',
                'slug' => '/employee/news',
                'icon' => '<i class="fa fa-newspaper"></i>',
                'parent_id' => 16,
                'order_no' => 3,
                'role' => 'employee'
            ],
            [
                'title' => 'Policies',
                'slug' => '/employee/policy',
                'icon' => '<i class="fa fa-file-contract"></i>',
                'parent_id' => 19,
                'order_no' => 4,
                'role' => 'employee'
            ],
            [
                'title' => 'HR Complains',
                'slug' => '/employee/hr-complain/index',
                'icon' => '<i class="fa fa-headphones"></i>',
                'parent_id' => 31,
                'order_no' => 5,
                'role' => 'employee'
            ],
            [
                'title' => 'Apply Leave',
                'slug' => '/employee/leave',
                'icon' => '<i class="fa fa-headphones"></i>',
                'parent_id' => 34,
                'order_no' => 6,
                'role' => 'employee'
            ],
            [
                'title' => 'Leave Available',
                'slug' => '/employee/get/leave/available',
                'icon' => '<i class="fa fa-headphones"></i>',
                'parent_id' => 34,
                'order_no' => 7,
                'role' => 'employee'
            ],
            [
                'title' => 'Notification',
                'slug' => '/employee/notification',
                'icon' => '<i class="fa fa-bell"></i>',
                'order_no' => 8,
                'role' => 'employee'
            ],
            [
                'title' => 'Holidays',
                'slug' => '/employee/holidays',
                'icon' => '<i class="fa fa-bell"></i>',
                'order_no' => 9,
                'role' => 'employee'
            ],
            [
                'title' => 'Resignation',
                'slug' => '/employee/resignation',
                'icon' => '<i class="fa fa-headphones"></i>',
                'order_no' => 10,
                'role' => 'employee'
            ],
            [
                'title' => 'PRM',
                'slug' => '/employee/prm',
                'icon' => '<i class="fas fa-money-bill-wave"></i>',
                'order_no' => 11,
                'role' => 'employee'
            ],
            [
                'title' => 'Payslip',
                'slug' => '/employee/show/payslip',
                'icon' => '<i class="fa fa-credit-card"></i>',
                'order_no' => 12,
                'role' => 'employee'
            ],
            [
                'title' => 'Courses',
                'slug' => '/employee/course',
                'icon' => '<i class="fa fa-credit-card"></i>',
                'order_no' => 13,
                'role' => 'employee'
            ],
            [
                'title' => 'Contact Us',
                'slug' => '/employee/contact-us',
                'icon' => '<i class="fas fa-book"></i>',
                'order_no' => 14,
                'role' => 'employee'
            ],
            [
                'title' => 'Comp Offs',
                'slug' => '/employee/comp-offs',
                'icon' => '<i class="fas fa-book"></i>',
                'order_no' => 14,
                'role' => 'employee'
            ]  ,
            [
                'title' => 'My Rewards',
                'slug' => '/employee/reward/user',
                'icon' => '<i class="fa fa-award"></i>',
                'parent_id' => NULL,
                'order_no' => 2,
                'role' => 'employee'
            ],
            [
                'title' => 'Performance Review',
                'slug' => '/employee/performance-reviews',
                'icon' => '<i class="fa fa-award"></i>',
                'parent_id' => NULL,
                'order_no' => 2,
                'role' => 'employee'
            ]
        ];
        Menu::where('role', 'employee')->delete();

        foreach($payload as $menuData) {
            Menu::create($menuData);
        }
        return true;
    }
}
