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
    public function store(Request $request)
    {
        try {
            $validateData  = Validator::make($request->all(), [
                'break_type_id'   => ['required', 'exists:break_types,id'],
                'comment'   => ['nullable'],
            ]);
            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            $data = $request->all();
            if ($this->employeeBreakHistory->create($data)) {
                return response()->json([
                    'message' => 'Break Store Successfully!'
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
