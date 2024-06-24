<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Services\LeaveService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Services\LeaveTypeService;
use Illuminate\Support\Facades\Validator;

class LeaveManagementController extends Controller
{
    private $leaveTypeService;
    private $leaveService;
    public function __construct(LeaveTypeService $leaveTypeService, LeaveService $leaveService)
    {
        $this->leaveTypeService = $leaveTypeService;
        $this->leaveService = $leaveService;
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

    public function storeApplyLeave(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'leave_type_id'      => ['required', 'exists:leave_types,id'],
                'from'               => ['required', 'date'],
                'to'                 => ['required', 'date'],
                'is_half_day'        => ['boolean'],
                'from_half_day'      => ['required_if:is_half_day,==,1', 'in:first_half,second_half'],
                'to_half_day'        => ['required_if:from,>,to', 'in:first_half,second_half'],
                'reason'             => ['required'],
            ]);
            if($validator->fails()){
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            }
            $data = $request->all();
            if ($this->leaveService->create($data)) {
                return response()->json([
                    'status' => true,
                    'message' => "Applied Successfully"
                ],200);
            }
        }
        catch(Exception $e){
            return response()->json([
                "status" => false,
                "error" =>  $e->getMessage(),
                "message" => "Unable to Apply the Leave"
            ], 500);
        }
    }
}
