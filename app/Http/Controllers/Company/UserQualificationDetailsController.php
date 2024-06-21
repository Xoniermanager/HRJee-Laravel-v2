<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserQualificationDetailsAddRequest;
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

    public function store(UserQualificationDetailsAddRequest $request)
    {
        try {
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

    public function delete($id)
    {
        $deleteData = $this->userQualificationDetailsService->delete($id);
        if ($deleteData) {
            return response()->json(['success' => 'Deleted Successfully']);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
