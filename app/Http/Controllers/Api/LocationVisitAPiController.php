<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\AssignTaskService;
use App\Http\Services\DispositionCodeService;

class LocationVisitAPiController extends Controller
{
    protected $assignedTaskService;
    protected $dispositionCodeService;

    public function __construct(AssignTaskService $assignedTaskService,DispositionCodeService $dispositionCodeService)
    {
        $this->assignedTaskService = $assignedTaskService;
        $this->dispositionCodeService = $dispositionCodeService;
    }
    public function assignedTask()
    {
        $userId = Auth()->guard('employee_api')->user()->id;
        try {
            $allAssignedTask = $this->assignedTaskService->getAssignedTaskByEmployeeId($userId)->paginate(10);
            return response()->json([
                'status' => true,
                'message' => 'All Assigned Task List',
                'data' => $allAssignedTask,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getDispositionCode()
    {
        $companyId = Auth()->guard('employee_api')->user()->company_id;
        try {
            $allDispositionCode = $this->dispositionCodeService->getDispositionCodeByCompanyId($companyId);
            return response()->json([
                'status' => true,
                'message' => 'All Disposition Code',
                'data' => $allDispositionCode,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
