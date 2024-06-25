<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserDocumentDetailRequest;
use App\Http\Services\UserDocumentDetailServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Throwable;

class DocumentController extends Controller
{
    private $userDocumentDetailServices;
    public function __construct(UserDocumentDetailServices $userDocumentDetailServices)
    {
        $this->userDocumentDetailServices = $userDocumentDetailServices;
    }


    public function documents(Request $request)
    {
        try {
            $documentDetails =   $this->userDocumentDetailServices->documents();
            if ($documentDetails)
                return apiResponse('document', $documentDetails);
            else
                return errorMessage('null', 'Document not found!');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
