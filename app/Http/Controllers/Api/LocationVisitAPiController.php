<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\AssignTaskService;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\DispositionCodeService;

class LocationVisitAPiController extends Controller
{
    protected $assignedTaskService;
    protected $dispositionCodeService;

    public function __construct(AssignTaskService $assignedTaskService, DispositionCodeService $dispositionCodeService)
    {
        $this->assignedTaskService = $assignedTaskService;
        $this->dispositionCodeService = $dispositionCodeService;
    }
    public function assignedTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search_term' => 'sometimes|string',
            'final_status' => 'sometimes|string|in:pending,processing,completed,rejected',
            'user_end_status' => 'sometimes|string|in:pending,processing,completed,rejected',
            'visit_address' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }

        $userId = Auth()->guard('employee_api')->user()->id;
        try {
            $allAssignedTask = $this->assignedTaskService->getAssignedTaskByEmployeeId($userId, $request->all())->paginate(10);
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

    public function updateTaskStatusDetails(Request $request, $taskId)
    {
        $validator = Validator::make($request->all(), [
            'disposition_code_id' => 'required|exists:disposition_codes,id',
            'document' => 'sometimes|file|mimes:pdf,xlsx,xls|max:2048', // Validate PDF or Excel file, with a max size of 2MB
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048', // Assuming 'image' should be a file, validate image type
            'user_end_status' => 'required|in:processing,completed,rejected',
            'remark' => 'required|max:255|string', // Validate the remark as a string, required and max length 255 character
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($this->assignedTaskService->taskStatusUpdateByApi($data, $taskId)) {
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Task Details Updated Successfully',
                ], 200); // 200 OK status for success
            } else {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Please try again.',
                ], 500); // 500 Internal Server Error for failure
            }

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.',
                'error' => $e->getMessage(), // Include the error message for debugging
            ], 500);
        }
    }

    public function changeStatus(Request $request, $taskId)
    {
        $validator = Validator::make($request->all(), [
            'user_end_status' => 'required|in:processing',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($this->assignedTaskService->taskStatusUpdateByApi($data, $taskId)) {
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Task Status Changed Successfully',
                ], 200); // 200 OK status for success
            } else {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Please try again.',
                ], 500); // 500 Internal Server Error for failure
            }

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.',
                'error' => $e->getMessage(), // Include the error message for debugging
            ], 500);
        }
    }

    public function taskReport(Request $request)
    {
        $userId = auth()->guard('employee_api')->id();
        $month = $request->month ?? null;

        try {
            $counts = $this->assignedTaskService->getTaskStatusCountsByEmployeeId($userId, $month);

            return response()->json([
                'status' => true,
                'message' => 'Report generated',
                'data' => [
                    'total_assigned_tasks' => array_sum($counts),
                    'total_completed_tasks' => $counts['completed'] ?? 0,
                    'total_pending_tasks' => $counts['pending'] ?? 0,
                    'total_in_progress_tasks' => $counts['processing'] ?? 0,
                    'total_rejected_tasks' => $counts['rejected'] ?? 0,
                ],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function fetchVisitLocations(Request $request)
    {
        $userId = auth()->guard('employee_api')->id();
        $month = $request->date ?? null;

        try {
            $data = $this->assignedTaskService->fetchVisitLocations($userId, $month);

            return response()->json([
                'status' => true,
                'message' => 'Location fetched.',
                'data' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
