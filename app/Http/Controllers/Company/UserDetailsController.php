<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserDetailsAddRequest;
use App\Http\Services\UserDetailServices;
use Exception;

class UserDetailsController extends Controller
{
    private $userDetailsService;
    public function __construct(UserDetailServices $userDetailsService)
    {
        $this->userDetailsService = $userDetailsService;
    }

    public function store(UserDetailsAddRequest $request)
    {
        try {
            if ($this->userDetailsService->create($request->all())) {
                return response()->json([
                    'message' => 'Permission Details Added Successfully! Please Continue',
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
