<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\LeaveService;
use Illuminate\Http\Request;

class LeaveTrackingController extends Controller
{
    public $leaveService;

    public $leaveLogService;

    public function __construct(LeaveService $leaveService)
    {
        $this->leaveService = $leaveService;
    }
    public function index($id)
    {
        $leaveDetails = $this->leaveService->getDetailsById($id);
        return view('employee.leave_tracking.index', compact('leaveDetails'));
    }
}
