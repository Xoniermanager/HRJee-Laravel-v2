<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\UserAddressDetailServices;
use Illuminate\Http\Request;
use Exception;

class AddressDetailsController extends Controller
{
    private $userAddressDetailsService;
    public function __construct(UserAddressDetailServices $userAddressDetailsService)
    {
        $this->userAddressDetailsService = $userAddressDetailsService;
    }

    public function store(Request $request)
    {
        try {
            $validateDetails  = Validator::make($request->all(), [
                'aadhar_no'                => ['required', 'numeric'],
                'pan_no'                   => ['required'],
            ]);
            if ($validateDetails->fails()) {
                return response()->json(['error' => $validateDetails->messages()], 400);
            }
            $data = $request->all();
            if ($this->userAddressDetailsService->create($data)) {
                return response()->json([
                    'message' => 'Advance Details Added Successfully! Please Continue',
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
