<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeTypeService;
use App\Models\CompanyStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\OnlyString;
use Exception;

class EmployeeTypeController extends Controller
{
    private $employeeTypeService;
    public function __construct(EmployeeTypeService $employeeTypeService)
    {
        $this->employeeTypeService = $employeeTypeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('super_admin.employee_type.index', [
            'allEmployeeTypeDetails' => $this->employeeTypeService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCompanyStatus  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:employee_types,name']
            ]);

            if ($validateCompanyStatus->fails()) {
                return response()->json(['error' => $validateCompanyStatus->messages()], 400);
            }
            $data = $request->all();
            if ($this->employeeTypeService->create($data)) {
                return response()->json([
                    'message' => 'Employee Type Created Successfully!',
                    'data'   =>  view('super_admin.employee_type.employee_type_list', [
                        'allEmployeeTypeDetails' => $this->employeeTypeService->all()
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
        $validateCompanyStatus  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:employee_types,name,' . $request->id],
        ]);

        if ($validateCompanyStatus->fails()) {
            return response()->json(['error' => $validateCompanyStatus->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->employeeTypeService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'Employee Type Updated Successfully!',
                'data'   =>  view('super_admin.employee_type.employee_type_list', [
                    'allEmployeeTypeDetails' => $this->employeeTypeService->all()
                ])->render()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->employeeTypeService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'message' => 'Employee Type Deleted Successfully!',
                'data'   =>  view('super_admin.employee_type.employee_type_list', [
                    'allEmployeeTypeDetails' => $this->employeeTypeService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error', 'Something Went Wrong! Pleaase try Again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->employeeTypeService->updateDetails($data, $id);
        return response()->json([
            'message' => 'Employee Type Status Updated Successfully!',
            'data'   =>  view('super_admin.employee_type.employee_type_list', [
                'allEmployeeTypeDetails' => $this->employeeTypeService->all()
            ])->render()
        ]);
    }

    public function search(Request $request)
    {   
        $searchedItems = $this->employeeTypeService->searchInEmployeeType($request->all());
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching...',
                'data'   =>  view('super_admin.employee_type.employee_type_list', [
                    'allEmployeeTypeDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
