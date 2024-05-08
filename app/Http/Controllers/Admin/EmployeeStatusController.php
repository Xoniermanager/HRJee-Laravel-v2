<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeStatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\OnlyString;
use Exception;

class EmployeeStatusController extends Controller
{
    private $employeeStatusService;
    public function __construct(EmployeeStatusService $employeeStatusService)
    {
        $this->employeeStatusService = $employeeStatusService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('super_admin.employee_status.index', [
            'allEmployeeStatusDetails' => $this->employeeStatusService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCompanyStatus  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:employee_statuses,name'],
            ]);

            if ($validateCompanyStatus->fails()) {
                return response()->json(['error' => $validateCompanyStatus->messages()], 400);
            }
            $data = $request->all();
            if ($this->employeeStatusService->create($data)) {
                return response()->json(['message' => 'Employee Status Created Successfully!']);
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
            'name' => ['required', 'string', 'unique:employee_statuses,name,' . $request->id],
        ]);

        if ($validateCompanyStatus->fails()) {
            return response()->json(['error' => $validateCompanyStatus->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->employeeStatusService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(['message' => 'Employee Status Updated Successfully!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->employeeStatusService->deleteDetails($id);
        if ($data) {
            return back()->with('success', 'Employee Status Deleted Successfully! ');
        } else {
            return back()->with('error', 'Something Went Wrong! Pleaase try Again');
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->employeeStatusService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
