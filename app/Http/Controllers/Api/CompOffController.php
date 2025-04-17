<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\CompOffService;

class CompOffController extends Controller
{
    protected $compOffService;
    public function __construct(CompOffService $compOffService)
    {
        $this->compOffService = $compOffService;
    }

    public function index()
    {
        $allCompOffs = $this->compOffService->getCompOffByUserId(Auth()->user()->id)->where('is_used', 1)->get();
        $balanceCompOff = $this->compOffService->getCompOffByUserId(Auth()->user()->id)->where('is_used', 0)->count();

        $response = [
            'appliedCompOff' => $allCompOffs,
            'balanced' => $balanceCompOff
        ];

        return response()->json([
            'status' => true,
            'data' => $response,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'user_remark' => 'required|string',

        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 400);
        }
        try {
            $data = $request->all();
            $data['user_id'] = Auth()->user()->id;

            $date1 = Carbon::parse($data['start_date']);
            $date2 = Carbon::parse($data['end_date']);
            $daysDifference = $date1->diffInDays($date2);
            $getBalanceCompOff = $this->compOffService->getCompOffByUserId($data['user_id'])->where('is_used', 0)->count();
            
            if(($daysDifference + 1) > $getBalanceCompOff) {
                return response()->json([
                    'status' => false,
                    'message' => 'Your balance comp off is '. $getBalanceCompOff
                ], 200);

            }

            $data['days_difference'] = $daysDifference + 1;
            $data['end_date'] = $data['end_date'] ? $data['end_date'] : $data['start_date'];
            
            if ($this->compOffService->useCompOff($data)) {
                return response()->json([
                    'status' => true,
                    'message' => "Comp off applied successfully"
                ], 200);
                
            } else {

                return response()->json([
                    'status' => false,
                    'message' => "Unable to apply. Please try Again"
                ], 500);
            }
            
        } catch (Exception $e) {

            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => "Unable to apply comp off"
            ], 500);
        }
    }

    public function delete($compOffId)
    {
        try {
            if ($this->compOffService->deleteCompOff($compOffId)) {
                return response()->json([
                    'status' => true,
                    'message' => "Comp Off Deleted Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Unable to Deleted Comp Off Please try Again"
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => "Unable to Deleted the Comp Off"
            ], 500);
        }
    }
}
