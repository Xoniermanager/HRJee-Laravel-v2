<?php

namespace App\Http\Controllers\Admin;

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

class AdminCompanyBranchesController extends Controller
{
    private $branch_services;
    private  $countryService;
    private $stateService;
    private $userService;
    public function __construct(BranchServices $branch_services , UserService $userService, CountryServices $countryService,StateServices $stateService)
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
        $branches  = $this->branch_services->allActiveBranches();
        $countries = $this->countryService->getAllActiveCountry();
        $states    = $this->stateService->all()->where('status', '1');
        return view('admin.company_branch.index',[
                'allCompanyBranchDetails' => $branches,
                'countries' => $countries,
                'states' => $states,
                'allCompaniesDetails' => $this->userService->getCompanies()->get()
            ]);
    }

    public function store(ValidateBranch $request)
    {
        $companyStatus = $this->branch_services->create($request->all());
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Created Successfully!',
                    'data'   =>  view('admin.company_branch.company_branch_list', [
                        'allCompanyBranchDetails' => $this->branch_services->allActiveBranches()
                    ])->render()
                ]
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request)
     {
        $validator  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:company_branches,name,' . $request->id],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->branch_services->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Updated Successfully!',
                    'data'   =>  view('admin.company_branch.company_branch_list', [
                        'allCompanyBranchDetails' => $this->branch_services->allActiveBranches()
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
        $data = $this->branch_services->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Country Deleted Successfully',
                'data'    =>  view('admin.company_branch.company_branch_list', [
                    'allCompanyBranchDetails' => $this->branch_services->allActiveBranches()
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
                'success' => 'Country Status Updated Successfully',
                'data'    =>  view('admin.company_branch.company_branch_list', [
                    'allCompanyBranchDetails' => $this->branch_services->allActiveBranches()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {
        $searchedItems = $this->branch_services->searchInCompanyBranch($request);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data'    =>  view('admin.company_branch.company_branch_list', [
                    'allCompanyBranchDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }

    }

}
