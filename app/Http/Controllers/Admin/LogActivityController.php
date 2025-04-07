<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function index()
    {
        $allLogActivityDetails = LogActivity::paginate(10);
        return view('admin.log_activity.index', compact('allLogActivityDetails'));
    }
}
