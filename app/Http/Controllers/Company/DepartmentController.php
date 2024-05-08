<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\DepartmentServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

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
        return view('company.department.index', [
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
                return response()->json(['message' => 'Departments Created Successfully!']);
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
            return response()->json(['message' => 'Departments Updated Successfully!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->departmentService->deleteDetails($id);
        if ($data) {
            return back()->with('success', 'Deleted Successfully! ');
        } else {
            return back()->with('error', 'Something Went Wrong! Pleaase try Again');
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->departmentService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
