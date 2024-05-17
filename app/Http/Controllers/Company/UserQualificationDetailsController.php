<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\UserQualificationDetailServices;
use Illuminate\Http\Request;
use Exception;

class UserQualificationDetailsController extends Controller
{
    private $userQualificationDetailsService;
    public function __construct(UserQualificationDetailServices $userQualificationDetailsService)
    {
        $this->userQualificationDetailsService = $userQualificationDetailsService;
    }

    public function store(Request $request)
    {
        try {
            $validateDetails  = Validator::make($request->all(), [
                'degree'              => "required|array",
                'degree.*'            => "required|array",
                'degree.*.institute'  => "required",
                'degree.*.university' => "required",
                'degree.*.course'     => "required",
                'degree.*.year'       => "required",
                'degree.*.percentage' => "required",
            ],
            [
                'degree.*.course'   =>  'Please enter the course name.'
            ]);
            if ($validateDetails->fails()) {
                return response()->json(['error' => $validateDetails->messages()], 400);
            }
            $data = $request->except('qualification_id');
            if ($this->userQualificationDetailsService->create($data)) {
                return response()->json([
                    'message' => 'Qualification Details Added Successfully! Please Continue',
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
