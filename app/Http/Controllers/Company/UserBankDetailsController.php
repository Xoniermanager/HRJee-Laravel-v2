<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\UserBankDetailServices;
use Illuminate\Http\Request;
use Exception;

class UserBankDetailsController extends Controller
{
    private $userBankDetailsService;
    public function __construct(UserBankDetailServices $userBankDetailsService)
    {
        $this->userBankDetailsService = $userBankDetailsService;
    }

    public function store(Request $request)
    {
        try {
            $validateDetails  = Validator::make($request->all(), [
                'account_name'          => ['required', 'unique:user_bank_details,account_name,' . $request->id],
                'account_number'        => ['required', 'unique:user_bank_details,account_number,' . $request->id],
                'bank_name'             => ['required'],
                'ifsc_code'             => ['required'],
            ]);
            if ($validateDetails->fails()) {
                return response()->json(['error' => $validateDetails->messages()], 400);
            }
            $data = $request->all();
            if ($this->userBankDetailsService->create($data)) {
                return response()->json([
                    'message' => 'Banks Details Added Successfully! Please Continue',
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
