<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceServiceController extends Controller
{
    public function index()
    {
        return view('employee.hrService.attendance_service');
    }
}
