<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFamilyRelativeDetailsAddRequest;
use App\Http\Services\UserRelativeDetailServices;
use Exception;

class UserRelativeDetailsController extends Controller
{
    private $userRelativeDetailsService;
    public function __construct(UserRelativeDetailServices $userRelativeDetailsService)
    {
        $this->userRelativeDetailsService = $userRelativeDetailsService;
    }

    public function store(UserFamilyRelativeDetailsAddRequest $request)
    {
        try {
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
    public function delete($id)
    {
        $deleteData = $this->userRelativeDetailsService->delete($id);
        if ($deleteData) {
            return response()->json(['success' => 'Deleted Successfully']);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
