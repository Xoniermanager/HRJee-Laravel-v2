<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\DocumentTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class DocumentTypeController extends Controller
{
    private $documentTypeService;
    public function __construct(DocumentTypeService $documentTypeService)
    {
        $this->documentTypeService = $documentTypeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.document_type.index', [
            'allDocumentTypes' => $this->documentTypeService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateDocumentType  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:document_types,name'],
                'is_mandatory' => ['boolean']
            ]);

            if ($validateDocumentType->fails()) {
                return response()->json(['error' => $validateDocumentType->messages()], 400);
            }
            $data = $request->all();
            if ($this->documentTypeService->create($data)) {
                return response()->json([
                    'message' => 'Document Type Created Successfully!',
                    'data'   =>  view('admin.document_type.document_type_list', [
                        'allDocumentTypes' => $this->documentTypeService->all()
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateDocumentType  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:document_types,name,' . $request->id],
            'is_mandatory' => ['boolean']
        ]);

        if ($validateDocumentType->fails()) {
            return response()->json(['error' => $validateDocumentType->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $documentType = $this->documentTypeService->updateDetails($updateData, $request->id);
        if ($documentType) {
            return response()->json([
                'message' => 'Document Type Updated Successfully!!',
                'data'   =>  view('admin.document_type.document_type_list', [
                    'allDocumentTypes' => $this->documentTypeService->all()
                ])->render()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->documentTypeService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Document Type Deleted Successfully!!',
                'data'   =>  view('admin.document_type.document_type_list', [
                    'allDocumentTypes' => $this->documentTypeService->all()
                ])->render()
            ]);
        } else {
            return back()->with('error', 'Something Went Wrong! Pleaase try Again');
        }
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->documentTypeService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Document Type Status Updated Successfully!!',
                'data'   =>  view('admin.document_type.document_type_list', [
                    'allDocumentTypes' => $this->documentTypeService->all()
                ])->render()
            ]);
        } else {
            return back()->with('error', 'Something Went Wrong! Pleaase try Again');
        }
}

public function search(Request $request)
{
    $searchedItems = $this->documentTypeService->searchInDocumentType($request->all());

    if ($searchedItems) {
        return response()->json([
            'success' => 'Searching...',
            'data'   =>  view('admin.document_type.document_type_list', [
                'allDocumentTypes' => $searchedItems
            ])->render()
        ]);
    } else {
        return response()->json(['error' => 'Something Went Wrong!! Please try again']);
    }
}

}
