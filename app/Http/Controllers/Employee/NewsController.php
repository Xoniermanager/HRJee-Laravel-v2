<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('employee.news.index');
    }

    public function viewDetails()
    {
        return view('employee.news.details');
    }
    
}
