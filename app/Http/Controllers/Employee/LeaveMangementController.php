<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveMangementController extends Controller
{
    public function index()
    {
        return view('employee.leave.index');
    }
    public function apply_leave()
    {
        return view('employee.leave.apply_leave');
    }
}
