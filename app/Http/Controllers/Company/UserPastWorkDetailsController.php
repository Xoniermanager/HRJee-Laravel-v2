<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPastWorkDetailsAddRequest;
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

    public function store(UserPastWorkDetailsAddRequest $request)
    {
        try {
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
    public function delete($id)
    {
        $deleteData = $this->userPastWorkDetailsService->delete($id);
        if ($deleteData) {
            return response()->json(['success' => 'Deleted Successfully']);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
