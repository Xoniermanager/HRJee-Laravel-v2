<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\StateServices;
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
        $companyIDs = getCompanyIDs();
        $branches = $this->branch_services->all($companyIDs);
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
        $companyIDs = getCompanyIDs();
        try {
            $payload = $request->all();

            if(!isset($payload['company_id'])){
                $payload['company_id'] = auth()->user()->company_id;
            }
            $companyBranches = $this->branch_services->create($request->all());
            if ($companyBranches) {
                return response()->json(
                    [
                        'message' => 'Company Branches Created Successfully!',
                        'data' => view('company.branch.branches-list', [
                            'branches' => $this->branch_services->all($companyIDs)
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
        $companyIDs = getCompanyIDs();
        $companyBranchId = $request->id;
        try {
            $validator = Validator::make($request->all(), [
                'company_id' => 'sometimes',
                'name' => 'required|string',
                'type' => 'required|in:primary,secondary',
                'contact_no' => 'required|numeric|unique:company_branches,contact_no,' . $companyBranchId,
                'email' => 'required|email|unique:company_branches,email,' . $companyBranchId,
                'hr_email' => 'required|email|unique:company_branches,hr_email,' . $companyBranchId,
                'address' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (!app('geocoder')->geocode($value)->get()->count()) {
                            $fail('The provided address is incorrect.');
                        }
                    }
                ],
                'city' => 'required|string',
                'pincode' => 'required|string',
                'country_id' => 'required_if:address_type,==,0|exists:countries,id',
                'state_id' => 'required_if:address_type,==,0|exists:states,id',

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
                        'data' => view('company.branch.branches-list', ['branches' => $this->branch_services->all($companyIDs)])->render()
                    ]
                );
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $id = $request->id;
        $data = $this->branch_services->deleteDetails($id);
        if ($data) {

            return response()->json([
                'success' => 'Country Deleted Successfully',
                'data' => view('company.branch.branches-list', [
                    'branches' => $this->branch_services->all($companyIDs)
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
        $statusDetails = $this->branch_services->updateDetails($data, $id);
        if ($statusDetails) {

            return response()->json([
                'success' => 'Branch Status Updated Successfully',
                'data' => view('company.branch.branches-list', [
                    'branches' => $this->branch_services->all($companyIDs)
                ])->render()
            ]);
        } else {

            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
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

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
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
