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
        return view('super_admin.document_type.index', [
            'allDocumentTypes' => $this->documentTypeService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCompanyStatus  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:document_types,name'],
                'is_mandatory' => ['boolean']
            ]);

            if ($validateCompanyStatus->fails()) {
                return response()->json(['error' => $validateCompanyStatus->messages()], 400);
            }
            $data = $request->all();
            if ($this->documentTypeService->create($data)) {
                return response()->json(['message' => 'Document Type Created Successfully!']);
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
        $validateCompanyStatus  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:document_types,name,' . $request->id],
            'is_mandatory' => ['boolean']
        ]);

        if ($validateCompanyStatus->fails()) {
            return response()->json(['error' => $validateCompanyStatus->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->documentTypeService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(['message' => 'Document Type Updated Successfully!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->documentTypeService->deleteDetails($id);
        if ($data) {
            return back()->with('success', 'Deleted Successfully! ');
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
            echo 1;
        } else {
            echo 0;
        }
    }
}
