<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\DesignationServices;
use App\Http\Services\DepartmentServices;
use Illuminate\Support\Facades\Validator;

class DesignationsController extends Controller
{

    private $designationService;
    private $departmentService;
    public function __construct(DesignationServices $designationService, DepartmentServices $departmentService)
    {
        $this->designationService = $designationService;
        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyIDs = getCompanyIDs();

        return view('company.designation.index', [
            'allDesignationDetails' => $this->designationService->getByCompanyId($companyIDs),
            'allDepartments' => $this->departmentService->getByCompanyId($companyIDs)->where('status', '1')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $companyIDs = getCompanyIDs();
        try {
            $validateDesignation = Validator::make($request->all(), [
                'name' => ['required', 'string', 'regex:/^[A-Za-z\s]+$/', 'unique:designations,name,NULL,id,company_id,' . auth()->user()->company_id],
            ]);
            if ($validateDesignation->fails()) {
                return response()->json(['error' => $validateDesignation->messages()], 400);
            }
            $data = $request->all();
            $data['company_id'] = auth()->user()->company_id;
            $data['created_by'] = auth()->user()->id;
            if ($this->designationService->create($data)) {
                return response()->json(
                    [
                        'message' => 'Designation Created Successfully!',
                        'data' => view('company.designation.designation_list', [
                            'allDesignationDetails' => $this->designationService->getByCompanyId($companyIDs)
                        ])->render()
                    ]
                );
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
        $validateDesignation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'regex:/^[A-Za-z\s]+$/', 'unique:designations,name,' . $request->id . ',id,company_id,' . auth()->user()->company_id],
        ]);

        if ($validateDesignation->fails()) {
            return response()->json(['error' => $validateDesignation->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->designationService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'Designation Updated Successfully!',
                'data' => view('company.designation.designation_list', [
                    'allDesignationDetails' => $this->designationService->getByCompanyId($companyIDs)
                ])->render()
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $id = $request->id;
        $data = $this->designationService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success',
                'Deleted Successfully!',
                'data' => view('company.designation.designation_list', [
                    'allDesignationDetails' => $this->designationService->getByCompanyId($companyIDs)
                ])->render()
            ]);
        } else {
            return response()->json([
                'error',
                'Something Went Wrong! Please try Again',
                'data' => view('company.designation.designation_list', [
                    'allDesignationDetails' => $this->designationService->getByCompanyId($companyIDs)
                ])->render()
            ]);
        }
    }
    public function statusUpdate(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->designationService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Designation Status Updated Successfully',
                'data' => view("company.designation.designation_list", [
                    'allDesignationDetails' => $this->designationService->getByCompanyId($companyIDs)
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
    public function getAllDesignation(Request $request)
    {
        $validateDesignation = Validator::make($request->all(), [
            'all_departments' => 'in:false,true',
            'department_id' => 'required_if:all_departments,==,false',
            'department_id.*' => 'exists:departments,id',

        ]);
        $departmentIds = $request->department_id;
        if ($request->all_departments == true) {
            $allDesignationDetails = $this->designationService->getAllDesignationByDepartmentIds($departmentIds, true);
        } else {
            $allDesignationDetails = $this->designationService->getAllDesignationByDepartmentIds($departmentIds);
        }
        if (isset($allDesignationDetails) && count($allDesignationDetails) > 0) {
            $response = [
                'status' => true,
                'data' => $allDesignationDetails
            ];
        } else {
            $response = [
                'status' => false,
                'error' => 'No Designation found this Department'
            ];
        }
        return json_encode($response);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function serachDesignationFilterList(Request $request)
    {
        $searchedItems = $this->designationService->serachDesignationFilterList($request);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("company.designation.designation_list", [
                    'allDesignationDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
