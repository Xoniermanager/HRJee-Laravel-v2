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

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function index($id)
    {
        $leaveDetails = $this->leaveService->getDetailsById($id);
        $leaveLogStatusDetails = $this->leaveStatusLogService->getDetailsByLeaveId($id);
        $leaveManagerDetails = $this->leaveStatusLogService->getManagerDetailsByLeaveId($id);
        
        return view('employee.leave.partials.leave_tracking_modal', compact('leaveDetails','leaveLogStatusDetails', 'leaveManagerDetails'));
    }
    
}
