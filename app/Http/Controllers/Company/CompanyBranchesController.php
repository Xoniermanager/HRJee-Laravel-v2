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
use Illuminate\Support\Facades\Validator;

class CompanyBranchesController extends Controller
{
    private $branch_services;
    private $countryService;
    private $stateService;
    public function __construct(BranchServices $branch_services , CountryServices $countryService, StateServices $stateService)
    {
            $this->branch_services = $branch_services;
            $this->countryService = $countryService;
            $this->stateService = $stateService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches  = $this->branch_services->get_branches();
        $countries = $this->countryService->all()->where('status', '1');
        $states    = $this->stateService->all()->where('status', '1');
        return view('company.branch.index',[
                'branches' => $branches,
                'countries' => $countries,
                'states' => $states,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function branch_form()
    {
        $states = DB::table('states')->get();
        $countries = DB::table('countries')->get();
        return view('company.branch.index',compact('states','countries'));
    }
    public function store(ValidateBranch $request)
    {
    try {
        $validator  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:company_branches,name,' . $request->id],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }
        $companyStatus = $this->branch_services->create($request->all());
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Created Successfully!',
                    'data'   =>  view('company.branch.branches-list', [
                        'branches' => $this->branch_services->get_branches()
                    ])->render()
                ]
            );
        }
    }
    catch (Exception $e) {
        return $e->getMessage();
    }
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request)
     {
         try {
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
                        'data'   =>  view('company.branch.branches-list', [
                            'branches' => $this->branch_services->get_branches()
                        ])->render()
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
                'data'    =>  view('company.branch.branches-list', [
                    'branches' => $this->branch_services->get_branches()
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
                'data'    =>  view('company.branch.branches-list', [
                    'branches' => $this->branch_services->get_branches()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {   
        $searchedItems = $this->branch_services->searchInCompanyBranch($request->all());
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data'    =>  view('company.branch.branches-list', [
                    'branches' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
        
    }
}