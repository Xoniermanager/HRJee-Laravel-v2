<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResignationController extends Controller
{
    public function index()
    {
        return view('employee.resignation.index');
    }
    public function applyResignation()
    {
        return view('employee.resignation.apply_resignation');
    }
}
