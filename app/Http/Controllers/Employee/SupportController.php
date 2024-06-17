<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        return view('employee.support.index');
    }

    public function talk_to_us()
    {
        return view('employee.support.talk_to_us');
    }
}
