<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserDocumentDetailRequest;
use App\Http\Services\UserDocumentDetailServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class DocumentController extends Controller
{
    private $userDocumentDetailServices;
    public function __construct(UserDocumentDetailServices $userDocumentDetailServices)
    {
        $this->userDocumentDetailServices = $userDocumentDetailServices;
    }

     
    public function documents(UserDocumentDetailRequest $request)
    { 

       
        try {

            $documentDetails=   $this->userDocumentDetailServices->documents(Auth::user()->id,$request->documentTypeId,$request->dataType);

            if ($documentDetails)
                return apiResponse('document', $documentDetails);
            else
                return errorMessage('null', 'Document not found!');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }


    }

     
}
