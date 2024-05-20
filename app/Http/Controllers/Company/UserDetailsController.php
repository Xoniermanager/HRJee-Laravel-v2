<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddressDetailsAddRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\UserDetailServices;
use Illuminate\Http\Request;
use Exception;

class UserDetailsController extends Controller
{
    private $userDetailsService;
    public function __construct(UserDetailServices $userDetailsService)
    {
        $this->userDetailsService = $userDetailsService;
    }

    public function store(UserAddressDetailsAddRequest $request)
    {
        try {
            $data = $request->all();
            if ($this->userDetailsService->create($data)) {
                return response()->json([
                    'message' => 'Permission Details Added Successfully! Please Continue',
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
