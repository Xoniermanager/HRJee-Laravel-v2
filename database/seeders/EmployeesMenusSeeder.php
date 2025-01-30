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
                'parent_id' => 28,
                'order_no' => 1,
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
                'icon' => '<i class="fa fa-file-contractr"></i>',
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
            ]
        ];

        Menu::where('role', 'employee')->delete();

        foreach($payload as $menuData) {
            Menu::create($menuData);
        }
        
        return true;
    }
}