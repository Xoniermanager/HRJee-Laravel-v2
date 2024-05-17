<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\UserAddressDetailServices;
use Illuminate\Http\Request;
use Exception;

class UserAddressDetailsController extends Controller
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
                'l_address'                => ['required'],
                'l_country_id'             => ['required', 'exists:countries,id'],
                'l_state_id'               => ['required', 'exists:states,id'],
                'l_city'                   => ['required'],
                'l_pincode'                => ['required'],
                'p_address'                => ['required_if:address_type,==,0'],
                'p_country_id'             => ['required_if:address_type,==,0', 'exists:countries,id'],
                'p_state_id'               => ['required_if:address_type,==,0', 'exists:states,id'],
                'p_city'                   => ['required_if:address_type,==,0'],
                'p_pincode'                => ['required_if:address_type,==,0'],
            ]);
            if ($validateDetails->fails()) {
                return response()->json(['error' => $validateDetails->messages()], 400);
            }
            $data = $request->all();
            if ($this->userAddressDetailsService->create($data)) {
                return response()->json([
                    'message' => 'Address Details Added Successfully! Please Continue',
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
