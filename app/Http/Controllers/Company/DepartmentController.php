<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\DepartmentServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    private $departmentService;

    public function __construct(DepartmentServices $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("company.department.index", [
            'allDepartmentDetails' => $this->departmentService->getByCompanyId(auth()->user()->company_id)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateDepartments = Validator::make($request->all(), [
                'name' => ['required', 'string', 'alpha','unique:departments,name,NULL,id,company_id,' . auth()->user()->company_id],
            ]);
            if ($validateDepartments->fails()) {
                return response()->json(['error' => $validateDepartments->messages()], 400);
            }
            $data = $request->all();
            $data['company_id'] = auth()->user()->company_id;
            $data['created_by'] = auth()->user()->id;
            if ($this->departmentService->create($data)) {
                return response()->json([
                    'message' => 'Departments Created Successfully!',
                    'data' => view("company.department.department_list", [
                        'allDepartmentDetails' => $this->departmentService->getByCompanyId(auth()->user()->company_id)
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
        $validateDepartments = Validator::make($request->all(), [
            'name' => ['required', 'string', 'alpha','unique:departments,name,' . $request->id . ',id,company_id,' . auth()->user()->company_id],
        ]);

        if ($validateDepartments->fails()) {
            return response()->json(['error' => $validateDepartments->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->departmentService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Departments Updated Successfully!',
                    'data' => view('company.department.department_list', [
                        'allDepartmentDetails' => $this->departmentService->getByCompanyId(auth()->user()->company_id)
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
        $data = $this->departmentService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Departments Deleted Successfully',
                'data' => view("company.department.department_list", [
                    'allDepartmentDetails' => $this->departmentService->getByCompanyId(auth()->user()->company_id)
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
        $statusDetails = $this->departmentService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Departments Status Updated Successfully',
                'data' => view("company.department.department_list", [
                    'allDepartmentDetails' => $this->departmentService->getByCompanyId(auth()->user()->company_id)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    
    public function serachDepartmentFilterList(Request $request)
    {
        $searchedItems = $this->departmentService->serachDepartmentFilterList($request, auth()->user()->company_id);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("company.department.department_list", [
                    'allDepartmentDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
