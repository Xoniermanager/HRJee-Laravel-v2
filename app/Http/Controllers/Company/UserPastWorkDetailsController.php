<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\UserPastWorkDetailServices;
use Illuminate\Http\Request;
use Exception;

class UserPastWorkDetailsController extends Controller
{
    private $userPastWorkDetailsService;
    public function __construct(UserPastWorkDetailServices $userPastWorkDetailsService)
    {
        $this->userPastWorkDetailsService = $userPastWorkDetailsService;
    }

    public function store(Request $request)
    {
        try {
            $validateDetails  = Validator::make(
                $request->all(),
                [
                    'previous_company'                      => "required|array",
                    'previous_company.*'                    => "required|array",
                    'previous_company.*.designation'        => "required",
                    'previous_company.*.from'               => ["required", "date"],
                    'previous_company.*.to'                 => ["required", "date"],
                    'previous_company.*.duration'           => "required",
                ],
                [
                    'previous_company.*.designation'   =>  'Please enter the designation name.'
                ]
            );
            if ($validateDetails->fails()) {
                return response()->json(['error' => $validateDetails->messages()], 400);
            }
            $data = $request->except('previous_company_id');

            if ($this->userPastWorkDetailsService->create($data)) {
                return response()->json([
                    'message' => 'Past Experience Details Added Successfully! Please Continue',
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
