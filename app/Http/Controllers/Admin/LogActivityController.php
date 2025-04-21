<?php

namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LogActivityController extends Controller
{
    public function index()
    {
        $allLogActivityDetails = LogActivity::paginate(10);
        return view('admin.log_activity.index', compact('allLogActivityDetails'));
    }

    public function companyList()
    {
        $allLogActivityDetails = LogActivity::where('company_id', Auth()->user()->company_id)->paginate(10);
        return view('company.log_activity.index', compact('allLogActivityDetails'));
    }

    public function createActivityLog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required',
            'method' => 'required',
            'request_body' => 'required',
            'response_code' => 'required',
            'response_body' => 'required',
        ], );
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 400);
        }
        try {
            $data = $request->all();
            $data['ip'] = $request->ip();
            if (LogActivity::create($data)) {
                return response()->json([
                    'status' => true,
                    'message' => "Log Acitvity Added Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Unable to Add Log Acitivity Please try Again"
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => ""
            ], 500);
        }
    }
}
