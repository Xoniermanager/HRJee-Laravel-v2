<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\UserRelativeDetailServices;
use Illuminate\Http\Request;
use Exception;

class UserRelativeDetailsController extends Controller
{
    private $userRelativeDetailsService;
    public function __construct(UserRelativeDetailServices $userRelativeDetailsService)
    {
        $this->userRelativeDetailsService = $userRelativeDetailsService;
    }

    public function store(Request $request)
    {
        try {
            $validateDetails  = Validator::make(
                $request->all(),
                [
                    'family_details'                     => "required|array",
                    'family_details.*'                   => "required|array",
                    'family_details.*.relation_name'     => "required",
                    'family_details.*.name'              => "required",
                    'family_details.*.dob'               => ["required", "date"],
                    'family_details.*.phone'             => "required",
                ],
                [
                    'family_details.*.name'   =>  'Please enter the name.'
                ]
            );
            if ($validateDetails->fails()) {
                return response()->json(['error' => $validateDetails->messages()], 400);
            }
            $data = $request->all();
            if ($this->userRelativeDetailsService->create($data)) {
                return response()->json([
                    'message' => 'Family Details Added Successfully! Please Continue',
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
