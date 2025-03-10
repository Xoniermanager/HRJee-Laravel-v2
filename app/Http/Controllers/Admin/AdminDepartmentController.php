<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\DepartmentServices;
use Illuminate\Support\Facades\Validator;

class AdminDepartmentController extends Controller
{
    private $departmentService;

    public function __construct(DepartmentServices $departmentService )
    {
        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view("admin.department.index", [
            'allDepartmentDetails' => $this->departmentService->all()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateDepartments  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:departments,name'],
            ]);
            if ($validateDepartments->fails()) {
                return response()->json(['error' => $validateDepartments->messages()], 400);
            }
            $data = $request->all();
            if ($this->departmentService->create($data)) {
                return response()->json([
                    'message' => 'Departments Created Successfully!',
                    'data'   =>  view("admin.department.department_list", [
                        'allDepartmentDetails' => $this->departmentService->all()
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
        $validateDepartments  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:departments,name,' . $request->id],
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
                    'data'   =>  view("admin.department.department_list", [
                        'allDepartmentDetails' => $this->departmentService->all()
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
                'data'   =>  view("admin.department.department_list", [
                    'allDepartmentDetails' => $this->departmentService->all()
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
                'data'   =>  view("admin.department.department_list", [
                    'allDepartmentDetails' => $this->departmentService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {
        $searchedItems = $this->departmentService->serachDepartmentFilterList($request->all());
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("admin.department.department_list", [
                    'allDepartmentDetails' =>  $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }

    }
}

