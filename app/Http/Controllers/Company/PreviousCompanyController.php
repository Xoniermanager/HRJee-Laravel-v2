<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Rules\UniqueForAdminOnly;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\PreviousCompanyService;

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
            $validator  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:previous_companies,name'],
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 400);
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
        $validator  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:previous_companies,name,' . $request->id],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
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
            return response()->json([
                'success' => 'Status Successfully',
                'data'   =>  view('company.previous_company.previous_company_list', [
                    'allPreviousCompanyDetails' => $this->previousCompanyService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }


    public function get_all_previous_company_ajax_call()
    {
       $data =  $this->previousCompanyService->get_previous_company_ajax_call();
       return json_encode($data);
    }
    public function ajax_store_previous_company(Request $request)
    {
        try {
            $dataTest = $request->all()['models'];
            $data = collect(json_decode($dataTest, true))->first();
            $data['company_id'] = isset(Auth::guard('admin')->user()->id)?Auth::guard('admin')->user()->id:'';
            $validatePreviousCompany  = Validator::make($data, [
                'name'        => ['required', 'string', new UniqueForAdminOnly('previous_companies')],
                'description' => ['string']
            ]);

            if ($validatePreviousCompany->fails()) {
                return response()->json(['error' => $validatePreviousCompany->messages()], 400);
            }
        
            if ($this->previousCompanyService->create($data)){
                return  $this->previousCompanyService->get_previous_company_ajax_call();
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()()], 400);
        }
    }

    public function searchPreviousCompanyFilter(Request $request)
    {   
        $searchedItems = $this->previousCompanyService->searchPreviousCompanyFilter($request);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching...',
                'data'   =>  view("company.previous_company.previous_company_list", [
                    'allPreviousCompanyDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}

