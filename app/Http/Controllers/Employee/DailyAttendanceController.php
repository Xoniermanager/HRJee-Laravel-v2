<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DailyAttendanceController extends Controller
{
    public function index()
    {
        return view('employee.dailyAttendance.index');
    }
}
