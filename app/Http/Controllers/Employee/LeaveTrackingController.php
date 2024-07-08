<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\LeaveService;
use App\Http\Services\LeaveStatusLogService;
use Illuminate\Http\Request;

class LeaveTrackingController extends Controller
{
    public $leaveService;

    public $leaveStatusLogService;

    public function __construct(LeaveService $leaveService,LeaveStatusLogService $leaveStatusLogService)
    {
        $this->leaveService = $leaveService;
        $this->leaveStatusLogService = $leaveStatusLogService;
    }
    public function index($id)
    {
        $leaveDetails = $this->leaveService->getDetailsById($id);
        $leaveLogStatusDetails = $this->leaveStatusLogService->getDetailsByLeaveId($id);
        return view('employee.leave_tracking.index', compact('leaveDetails','leaveLogStatusDetails'));
    }
}
