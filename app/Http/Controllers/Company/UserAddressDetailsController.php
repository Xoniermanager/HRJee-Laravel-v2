<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddressDetailsAddRequest;
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

    public function store(UserAddressDetailsAddRequest $request)
    {
        try {
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
    public function getAddressDetails($id)
    {
        $data = $this->userAddressDetailsService->getDetailById($id);
        return response()->json(['data' => $data->toArray()]);
    }
}
