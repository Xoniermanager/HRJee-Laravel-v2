<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CompanyTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class CompanyTypeController extends Controller
{

    private $companyTypeService;
    public function __construct(CompanyTypeService $companyTypeService)
    {
        $this->companyTypeService = $companyTypeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.company_type.index', [
            'allCompanyTypeDetails' => $this->companyTypeService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCountryData  = Validator::make($request->all(), [
                'name' => ['required', 'string'],
            ]);
            if ($validateCountryData->fails()) {
                return response()->json(['error' => $validateCountryData->messages()], 400);
            }
            $data = $request->all();
            if ($this->companyTypeService->create($data)) {
                return response()->json([
                    'message' => 'Company Type Created Successfully!',
                    'data'   =>  view('admin.company_type.list', [
                        'allCompanyTypeDetails' => $this->companyTypeService->all()
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
        $validateCountryData  = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ]);
        if ($validateCountryData->fails()) {
            return response()->json(['error' => $validateCountryData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->companyTypeService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Company Type Updated Successfully!',
                    'data'   =>  view('admin.company_type.list', [
                        'allCompanyTypeDetails' => $this->companyTypeService->all()
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
        $data = $this->companyTypeService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Country Deleted Successfully',
                'data'   =>  view('admin.company_type.list', [
                    'allCompanyTypeDetails' => $this->companyTypeService->all()
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
        $statusDetails = $this->companyTypeService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Company Type Status Updated Successfully',
                'data'   =>  view("admin.company_type.list", [
                    'allCompanyTypeDetails' => $this->companyTypeService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {
        $searchedItems = $this->companyTypeService->serachFilterList($request);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching...',
                'data'   =>  view("admin.company_type.list", [
                    'allCompanyTypeDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
