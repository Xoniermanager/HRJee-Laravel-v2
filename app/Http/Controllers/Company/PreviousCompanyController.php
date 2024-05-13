<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\PreviousCompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class PreviousCompanyController extends Controller
{

    private $previousCompanyService;
    public function __construct(PreviousCompanyService $previousCompanyService)
    {
        $this->previousCompanyService = $previousCompanyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.previous_company.index', [
            'allPreviousCompanyDetails' => $this->previousCompanyService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatePreviousCompanyData  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:previous_companies,name'],
            ]);
            if ($validatePreviousCompanyData->fails()) {
                return response()->json(['error' => $validatePreviousCompanyData->messages()], 400);
            }
            $data = $request->all();
            if ($this->previousCompanyService->create($data)) {
                return response()->json([
                    'message' => 'Added Successfully!',
                    'data'   =>  view('company.previous_company.previous_company_list', [
                        'allPreviousCompanyDetails' => $this->previousCompanyService->all()
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
        $validatePreviousCompanyData  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:previous_companies,name,' . $request->id],
        ]);

        if ($validatePreviousCompanyData->fails()) {
            return response()->json(['error' => $validatePreviousCompanyData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->previousCompanyService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Updated Successfully!',
                    'data'   =>  view('company.previous_company.previous_company_list', [
                        'allPreviousCompanyDetails' => $this->previousCompanyService->all()
                    ])->render()
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->previousCompanyService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Deleted Successfully',
                'data'   =>  view('company.previous_company.previous_company_list', [
                    'allPreviousCompanyDetails' => $this->previousCompanyService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->previousCompanyService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
