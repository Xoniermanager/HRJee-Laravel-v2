<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeLeaveAvailableService;
use App\Http\Services\LeaveService;

class LeaveAvailableApiController extends Controller
{

    public $employeeAvailableLeaveService;
    public $leaveService;

    public function __construct(LeaveService $leaveService, EmployeeLeaveAvailableService $employeeAvailableLeaveService)
    {
        $this->employeeAvailableLeaveService = $employeeAvailableLeaveService;
        $this->leaveService = $leaveService;
    }

    public function getAllLeaveAvailableByUserId()
    {
        try {
            $data = [];
            $userID = auth()->guard('employee_api')->user()->id;
            $getAllLeaveAvailableDetails = $this->employeeAvailableLeaveService->getAllLeaveAvailableByUserId($userID);
            foreach ($getAllLeaveAvailableDetails as $getLeaveDetails) {
                foreach ($getLeaveDetails as $leaveDetails) {
                    $usedLeaves = $this->leaveService->getTotalLeaveByUserIdByMonth($userID, date('m'), date('Y'));
                    $data[] =
                        [
                            'leave_name'  => $leaveDetails->leaveType->name,
                            'avaialble'   => $leaveDetails->available,
                            'used' => $usedLeaves,
                            'totalLeaves' => (int)$usedLeaves + (int)$leaveDetails->available
                        ];
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'All Leave Available',
                'data' => $data,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
