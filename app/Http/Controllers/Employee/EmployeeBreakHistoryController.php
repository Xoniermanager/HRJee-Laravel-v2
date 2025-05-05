<?php

namespace App\Http\Controllers\Employee;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\BreakTypeService;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\EmployeeBreakHistoryService;

class EmployeeBreakHistoryController extends Controller
{
    public $employeeBreakHistory;
    public $breakTypeService;
    public $employeeBreakHistoryService;

    public function __construct(EmployeeBreakHistoryService $employeeBreakHistory, BreakTypeService $breakTypeService, EmployeeBreakHistoryService $employeeBreakHistoryService)
    {
        $this->employeeBreakHistory = $employeeBreakHistory;
        $this->breakTypeService = $breakTypeService;
        $this->employeeBreakHistoryService = $employeeBreakHistoryService;
    }
    public function breakIn(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'break_type_id' => ['required', 'exists:break_types,id'],
                'comment' => ['nullable'],
            ]);
            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            $data = $request->except('_token');
            $checkBreakHistoryDetails = $this->employeeBreakHistory->getAllBreakHistory($data['employee_attendance_id']);
            if ($checkBreakHistoryDetails->count() < 3) {
                $createdDetails = $this->employeeBreakHistory->breakIn($data);
                return response()->json([
                    'status' => true,
                    'data' => $createdDetails,
                    'message' => 'Break Started!'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'You cannot take the break because you exceeded the limit!'
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function breakOut($breakId)
    {
        try {
            if ($this->employeeBreakHistory->breakOut($breakId)) {
                return back()->with(['success' => "You Are Break Out"]);
            }
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function getBreakTypeList()
    {
        try {
            $allBreakTypeDetails = $this->breakTypeService->getAllBreakTypeByCompanyId(Auth()->guard('employee_api')->user()->company_id);
            if ($allBreakTypeDetails) {
                return response()->json([
                    'status' => true,
                    'data' => $allBreakTypeDetails,
                    'message' => 'Break Type List!'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Please try Again!'
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getBreakDetailsByAttendanceId($attendanceId)
    {
        try {
            $takenBreakDetails = $this->employeeBreakHistoryService->getBreakHistoryByAttendanceId($attendanceId);
            if ($takenBreakDetails) {
                return response()->json([
                    'status' => true,
                    'data' => $takenBreakDetails,
                    'message' => 'Break Taken Details List!'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No break Details!'
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function breakOutbyApi($breakId)
    {
        try {
            if ($this->employeeBreakHistory->breakOut($breakId)) {
                return response()->json([
                    'status' => true,
                    'message' => 'You Are Break Out!'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Please try Again!'
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
