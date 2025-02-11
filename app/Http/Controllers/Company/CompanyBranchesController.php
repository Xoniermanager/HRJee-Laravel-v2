<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Models\CompanyBranch;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\StateServices;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidateBranch;
use App\Http\Services\BranchServices;
use App\Http\Services\CountryServices;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Validator;

class CompanyBranchesController extends Controller
{
    private $branch_services;
    private $countryService;
    private $stateService;
    private $userService;
    public function __construct(BranchServices $branch_services, CountryServices $countryService, UserService $userService, StateServices $stateService)
    {
        $this->branch_services = $branch_services;
        $this->countryService = $countryService;
        $this->stateService = $stateService;
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = $this->branch_services->all(Auth()->user()->company_id);
        $countries = $this->countryService->getAllActiveCountry();
        return view('company.branch.index', [
            'branches' => $branches,
            'countries' => $countries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function branch_form()
    {
        $countries = DB::table('countries')->get();
        return view('company.branch.index', compact('countries'));
    }
    public function store(ValidateBranch $request)
    {
        try {
            $payload = $request->all();
            
            if(!isset($payload['company_id'])){
                $payload['company_id'] = auth()->user()->company_id;
            }
            $companyBranches = $this->branch_services->create($request->all());
            if ($companyBranches) {
                return response()->json(
                    [
                        'message' => 'Created Successfully!',
                        'data' => view('company.branch.branches-list', [
                            'branches' => $this->branch_services->all(Auth()->user()->id)
                        ])->render()
                    ]
                );
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:company_branches,name,' . $request->id],
                'address' => ['required', 'string'],
                'pincode' => ['required', 'integer'],
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 400);
            }

            $updateData = $request->except(['_token', 'id']);
            $companyBranches = $this->branch_services->updateDetails($updateData, $request->id);
            if ($companyBranches) {
                return response()->json(
                    [
                        'message' => 'Updated Successfully!',
                        'data' => view('company.branch.branches-list', ['branches' => $this->branch_services->all(Auth()->user()->id)])->render()
                    ]
                );
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function updateBranch(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:company_branches,name,' . $request->id],
                'address' => ['required', 'string'],
                'pincode' => ['required', 'integer'],
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }

            $updateData = $request->except(['_token', 'id']);
            $companyBranches = $this->branch_services->updateDetails($updateData, $request->id);
            if ($companyBranches) {
                return response()->json(
                    [
                        'message' => 'Updated Successfully!',
                        'data' => view('company.branch.branches-list', ['branches' => $this->branch_services->all(Auth()->user()->id)])->render()
                    ]
                );
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->branch_services->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Country Deleted Successfully',
                'data' => view('company.branch.branches-list', [
                    'branches' => $this->branch_services->all(Auth()->user()->id)
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
        $statusDetails = $this->branch_services->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Branch Status Updated Successfully',
                'data' => view('company.branch.branches-list', [
                    'branches' => $this->branch_services->all(Auth()->user()->id)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function searchBranchFilter(Request $request)
    {
        $branches = $this->branch_services->searchInCompanyBranch($request);
        if ($branches) {
            return response()->json([
                'success' => 'Searching',
                'data' => view('company.branch.branches-list', compact('branches'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function getAllManagers(Request $request)
    {
        $branchIds = $request->branch_id;
        $allManagers = $this->userService->getManagersByBranchId($branchIds);

        $response = [
            'status' => true,
            'data' => $allManagers
        ];
        
        return json_encode($response);
    }
}
