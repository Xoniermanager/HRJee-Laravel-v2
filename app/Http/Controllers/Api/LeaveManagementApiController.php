<?php

namespace App\Http\Controllers\Api;

use Exception;
use Throwable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\DB;
use App\Http\Services\LeaveService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Services\LeaveTypeService;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\EmployeeLeaveAvailableService;

class LeaveManagementApiController extends Controller
{
    private $leaveTypeService;
    private $leaveService;
    private $employeeLeaveAvailableService;

    public function __construct(EmployeeLeaveAvailableService $employeeLeaveAvailableService, LeaveTypeService $leaveTypeService, LeaveService $leaveService)
    {
        $this->leaveTypeService = $leaveTypeService;
        $this->leaveService = $leaveService;
        $this->employeeLeaveAvailableService = $employeeLeaveAvailableService;
    }

    public function leaveType()
    {
        try {
            $leaveTypeDetails = $this->leaveTypeService->getAllActiveLeaveType();
            return response()->json([
                'status' => true,
                'message' => 'Retried List Successfully',
                'data' => $leaveTypeDetails,
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function allLeaves()
    {
        $allLeaves = $this->leaveService->leavesByUserId(Auth()->guard('employee_api')->user()->id);

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $allLeaves,
        ], 200);
    }

    public function applyLeave(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'leave_type_id'   => ['required', 'exists:leave_types,id'],
                'from'            => ['required', 'date'],
                'to'              => ['required', 'date'],
                'is_half_day'     => ['nullable', 'boolean'],
                'from_half_day'   => ['required_if:is_half_day,1', 'in:first_half,second_half'],
                'to_half_day'     => ['required_if:is_half_day,1', 'in:first_half,second_half'],
                'reason'          => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'error'   => 'validation_error',
                    'message' => $validator->errors(),
                ], 422);
            }

            $data   = $request->all();
            $userID = auth()->guard('employee_api')->user()->id;

            // Step 1: Check available leave balance
            $availableLeave = $this->employeeLeaveAvailableService->getAvailableLeaveByUserIdTypeId($userID, $data['leave_type_id']);
            if (!$availableLeave || $availableLeave->available <= 0) {
                return response()->json([
                    'status'  => false,
                    'message' => "Leaves not available"
                ], 400);
            }

            // Step 2: Calculate applied days
            $from = Carbon::parse($data['from']);
            $to   = Carbon::parse($data['to']);

            $daysApplied = $from->diffInDays($to) + 1;

            if (!empty($data['is_half_day']) && boolval($data['is_half_day'])) {
                $daysApplied = 0.5;
            }

            // Step 3: Validate against leave balance
            if ($daysApplied > $availableLeave->available) {
                return response()->json([
                    'status'  => false,
                    'message' => "You are applying for {$daysApplied} day(s), but only {$availableLeave->available} are available."
                ], 400);
            }

            // Step 4: Check for existing leave applications in the date range
            $alreadyApplied = $this->leaveService->getUserAppliedLeaveByDate($userID, $data['from'], $data['to']);
            if ($alreadyApplied) {
                return response()->json([
                    'status'  => false,
                    'message' => "You have already applied leave for these date(s)"
                ], 400);
            }

            // Step 5: Check if attendance already exists in the selected dates
            $attendanceExists = EmployeeAttendance::where('user_id', $userID)
                ->whereBetween(DB::raw('DATE(punch_in)'), [$data['from'], $data['to']])
                ->exists();

            if ($attendanceExists) {
                return response()->json([
                    'status'  => false,
                    'message' => "Leave cannot be applied: attendance already exists on selected dates."
                ], 400);
            }

            // Step 6: Create leave record
            $created = $this->leaveService->create($data);
            if ($created) {
                return response()->json([
                    'status'  => true,
                    'message' => "Applied Successfully"
                ], 200);
            }

            return response()->json([
                'status'  => false,
                'message' => "Unable to apply leave"
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'error'   => $e->getMessage(),
                'message' => "Unable to Apply the Leave"
            ], 500);
        }

    }

    public function appliedLeaveHistory(Request $request)
    {
        try {

            $appliedLeaves = $this->leaveService->getAllAppliedLeave();
            $appliedLeaves->makeHidden(['created_at', 'updated_at', 'leave_type_id', 'leave_applied_by', 'leave_status_id']);
            // $appliedLeaves->leave_action->makeHidden('leave_id');
            return apiResponse('success', $appliedLeaves);
        } catch (Throwable $th) {
            return errorMessage('null', $th->getMessage());
        }
    }
}
