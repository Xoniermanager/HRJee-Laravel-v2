<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\EmployeeComplainLogService;
use App\Http\Services\EmployeeComplainService;

class EmployeeComplainController extends Controller
{
    public $employeeComplainLogService;

    public $employeeComplainService;

    public function __construct(EmployeeComplainLogService $employeeComplainLogService, EmployeeComplainService $employeeComplainService)
    {
        $this->employeeComplainLogService =  $employeeComplainLogService;
        $this->employeeComplainService =  $employeeComplainService;
    }
    public function sendMessage($complainId, Request $request)
    {
        try {
            $validateDetails  = Validator::make($request->all(), [
                'message' => ['required', 'string'],
            ]);
            if ($validateDetails->fails()) {
                return response()->json(['error' => $validateDetails->messages()], 400);
            }
            $data = $request->all();
            $data['employee_complain_id'] =  $complainId;
            $toId = $request->to_id;
            $fromId = $request->from_id;
            if ($this->employeeComplainLogService->sendMessage($data))
            {
                $complainDetails = $this->employeeComplainLogService->findDetailsByComplainId($complainId);
                return response()->json([
                    'message' => 'Message Send successful!',
                    'data'   =>  view('employee_complain.chat_list', compact('complainDetails', 'toId', 'fromId'))->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
