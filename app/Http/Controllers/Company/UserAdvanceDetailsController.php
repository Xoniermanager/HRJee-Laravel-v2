<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\UserAdvanceDetailServices;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Exception;


class UserAdvanceDetailsController extends Controller
{
    private $userAdvanceDetailsService;
    public function __construct(UserAdvanceDetailServices $userAdvanceDetailsService)
    {
        $this->userAdvanceDetailsService = $userAdvanceDetailsService;
    }

    public function store(Request $request)
    {
        try {
            $validateDetails = Validator::make($request->all(), [
                'aadhar_no' => ['required', 'numeric'],
                'pan_no' => ['required'],
            ]);
            if ($validateDetails->fails()) {
                return response()->json(['error' => $validateDetails->messages()], 400);
            }
            $data = $request->all();
            
            if ($this->userAdvanceDetailsService->create($data)) {
                UserDetail::where('user_id', $data['user_id'])->update([
                    'allow_face_nex' => $data['allow_face_nex']
                ]);
                
                return response()->json([
                    'message' => 'Advance Details Added Successfully! Please Continue',
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getAdvanceDetails($id)
    {
        $data = $this->userAdvanceDetailsService->getDetailById($id);
        return response()->json(['data' => $data]);
    }
}
