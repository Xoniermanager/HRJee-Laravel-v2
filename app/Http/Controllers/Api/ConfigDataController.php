<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\DocumentTypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigDataController extends Controller
{
    private $documentTypeService;
    public function __construct(DocumentTypeService $documentTypeService)
    {
        $this->documentTypeService = $documentTypeService;
    }

    public function requiredDocuments(Request $request){
        $data = $this->documentTypeService->getAllActiveDocumentType();

        return response()->json([
            'status' => true,
            'message' => 'Required documents fetched successfully',
            'data' => $data,
        ], 200);
    }
    
}
