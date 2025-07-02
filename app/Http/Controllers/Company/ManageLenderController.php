<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\DefaultLenderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ManageLenderController extends Controller
{
    private $defaultLenderService;

    public function __construct(DefaultLenderService $defaultLenderService)
    {
        $this->defaultLenderService = $defaultLenderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyIDs = getCompanyIDs();
        return view("company.default_lenders.index", [
            'allDefaultLenderDetails' => $this->defaultLenderService->getByCompanyId($companyIDs)
        ]);
    }


    public function store(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $data = $request->all();
        $data['company_id'] = auth()->user()->company_id;
        $data['created_by'] = auth()->user()->id;
        try {
            $validateProducts = Validator::make($request->all(), [
                'name' => ['required', 'max:255', 'regex:/^[A-Za-z\s]+$/', 'unique:default_lenders,name,NULL,id,company_id,' . auth()->user()->company_id],
            ]);
            if ($validateProducts->fails()) {
                return response()->json(['error' => $validateProducts->messages()], 400);
            }
            $lender = $this->defaultLenderService->checkDefaultLender($data['name'], $data['company_id']);
            if ($lender) {
                return response()->json(['error' => 'Already have lender'], 400);
            }

            if ($this->defaultLenderService->create($data)) {
                return response()->json([
                    'message' => 'Lender Created Successfully!',
                    'data' => view("company.default_lenders.lender_list", [
                        'allDefaultLenderDetails' => $this->defaultLenderService->getByCompanyId($companyIDs)
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $validateProducts = Validator::make($request->all(), [
            'name' => ['required', 'max:255', 'string', 'regex:/^[A-Za-z\s]+$/', 'unique:default_lenders,name,' . $request->id . ',id,company_id,' . auth()->user()->company_id],
        ]);

        if ($validateProducts->fails()) {
            return response()->json(['error' => $validateProducts->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->defaultLenderService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Lender Updated Successfully!',
                    'data' => view('company.default_lenders.lender_list', [
                        'allDefaultLenderDetails' => $this->defaultLenderService->getByCompanyId($companyIDs)
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
        $companyIDs = getCompanyIDs();
        $id = $request->id;

        $data = $this->defaultLenderService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Lender Deleted Successfully',
                'data' => view("company.default_lenders.lender_list", [
                    'allDefaultLenderDetails' => $this->defaultLenderService->getByCompanyId($companyIDs)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function statusUpdate(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $id = $request->id;
        $data['status'] = $request->status;

        $statusDetails = $this->defaultLenderService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Lender Status Updated Successfully',
                'data' => view("company.default_lenders.lender_list", [
                    'allDefaultLenderDetails' => $this->defaultLenderService->getByCompanyId($companyIDs)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }


    public function searchDefaultLenderFilterList(Request $request)
    {

        $searchedItems = $this->defaultLenderService->searchDefaultLenderFilterList($request, auth()->user()->company_id);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("company.default_lenders.lender_list", [
                    'allDefaultLenderDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
