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
    private $view;
    public function __construct(DesignationServices $designationService, DepartmentServices $departmentService)
    {
        $this->designationService = $designationService;
        $this->departmentService = $departmentService;
        $role = 'super_admin';
        if($role == 'super_admin') 
        {
            $this->view  = 'super_admin.designation';
        }
        else
        {
            $this->view = 'company.designation';
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view($this->view.'.index', [
            'allDesignationDetails' => $this->designationService->all(),
            'allDepartments' => $this->departmentService->all()->where('status', '1')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateDesignation  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:designations,name'],
            ]);
            if ($validateDesignation->fails()) {
                return response()->json(['error' => $validateDesignation->messages()], 400);
            }
            $data = $request->all();
            if ($this->designationService->create($data)) {
                return response()->json(
                    [
                        'message' => 'Designation Created Successfully!',
                        'data'   =>  view($this->view.'.designation_list', [
                            'allDesignationDetails' => $this->designationService->all()
                        ])->render()
                    ]
                );
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
        $validateDesignation  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:designations,name,' . $request->id],
        ]);

        if ($validateDesignation->fails()) {
            return response()->json(['error' => $validateDesignation->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->designationService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'Designation Updated Successfully!',
                'data'   =>  view($this->view.'.designation_list', [
                    'allDesignationDetails' => $this->designationService->all()
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
        $data = $this->designationService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success', 'Deleted Successfully!',
                'data'   =>  view($this->view.'.designation_list', [
                    'allDesignationDetails' => $this->designationService->all()
                ])->render()
            ]);
        } else {
            return response()->json([
                'error', 'Something Went Wrong! Please try Again',
                'data'   =>  view($this->view.'.designation_list', [
                    'allDesignationDetails' => $this->designationService->all()
                ])->render()
            ]);
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->designationService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Designation Status Updated Successfully',
                'data'   =>  view($this->view.".designation_list", [
                    'allDesignationDetails' => $this->designationService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function getAllDesignation(Request $request)
    {
        $department_id = $request->department_id;
        $allDesignationDetails = $this->designationService->getAllDesignationUsingDepartmentID($department_id);
        if (count($allDesignationDetails) > 0 && isset($allDesignationDetails)) {
            $response = [
                'status'    =>  true,
                'data'      =>  $allDesignationDetails
            ];
        } else {
            $response = [
                'status'    =>  false,
                'error'     => 'No Designation found this Department'
            ];
        }
        return json_encode($response);
    }
    public function search(Request $request)
    {   
        $searchedItems = $this->designationService->searchInDesignation($request->all());
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view($this->view.".designation_list", [
                    'allDesignationDetails' => $searchedItems 
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
        
    }
}
