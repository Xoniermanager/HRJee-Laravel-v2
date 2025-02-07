<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeLeaveAvailableService;

class LeaveAvailableApiController extends Controller
{

    public $employeeAvailableLeaveService;
    public function __construct(EmployeeLeaveAvailableService $employeeAvailableLeaveService)
    {
        $this->employeeAvailableLeaveService = $employeeAvailableLeaveService;
    }
    public function getAllLeaveAvailableByUserId()
    {
        try {
            $data = [];
            $getAllLeaveAvailableDetails = $this->employeeAvailableLeaveService->getAllLeaveAvailableByUserId(auth()->guard('employee_api')->user()->id);
            foreach ($getAllLeaveAvailableDetails as $getLeaveDetails) {
                foreach ($getLeaveDetails as $leaveDetails) {
                    $data[] =
                        [
                            'leave_name'  => $leaveDetails->leaveType->name,
                            'avaialble'   => $leaveDetails->available
                        ];
                }
            }
            return response()->json([
                'status' => true,
                'message' => '',
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
