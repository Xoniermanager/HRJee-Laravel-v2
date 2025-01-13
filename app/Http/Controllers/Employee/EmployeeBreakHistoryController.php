<?php

namespace App\Http\Controllers\Employee;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\EmployeeBreakHistoryService;

class EmployeeBreakHistoryController extends Controller
{
    public $employeeBreakHistory;

    public function __construct(EmployeeBreakHistoryService $employeeBreakHistory)
    {
        $this->employeeBreakHistory = $employeeBreakHistory;
    }
    public function breakIn(Request $request)
    {
        try {
            $validateData  = Validator::make($request->all(), [
                'break_type_id'   => ['required', 'exists:break_types,id'],
                'comment'   => ['nullable'],
            ]);
            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            $data = $request->except('_token');
            $checkBreakHistoryDetails = $this->employeeBreakHistory->getAllBreakHistory($data['employee_attendance_id']);
            if ($checkBreakHistoryDetails->count() < 3) {
                $this->employeeBreakHistory->breakIn($data);
                return response()->json([
                    'status' => true,
                    'message' => 'Break Started!'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'You cannot take the break because you exceeded the limit!'
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }

    public function breakOut($breakId)
    {
        try {
            if ($this->employeeBreakHistory->breakOut($breakId)) {
                return back()->with(['success' => "You Are Break Out"]);
            }
        } catch (Exception $e) {
            return back()->with(['error' =>  $e->getMessage()]);
        }
    }
}
