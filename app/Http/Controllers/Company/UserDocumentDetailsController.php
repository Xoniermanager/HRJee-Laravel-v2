<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\UserDocumentDetailServices;
use App\Http\Requests\UserDocumentDetailsRequest;

class UserDocumentDetailsController extends Controller
{
    private $userDocumentDetailsService;
    public function __construct(UserDocumentDetailServices $userDocumentDetailsService)
    {
        $this->userDocumentDetailsService = $userDocumentDetailsService;
    }

    public function store(UserDocumentDetailsRequest $userDocumentDetailsRequest)
    {
        try {
            $data  = $userDocumentDetailsRequest->validated();
            return $this->userDocumentDetailsService->create($userDocumentDetailsRequest);
            // if ($this->userDocumentDetailsService->create($userDocumentDetailsRequest)) {
            //     return response()->json([
            //         'message' => 'Document Uploaded Added Successfully! Please Continue',
            //     ]);
            // }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
