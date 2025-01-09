<?php

namespace App\Http\Controllers\Company;

use App\Models\WeekDay;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\BranchServices;
use App\Http\Services\DepartmentServices;
use App\Http\Services\WeekendService;
use Illuminate\Support\Facades\Validator;

class WeekendController extends Controller
{
    private $weekendService;
    private $branchService;
    private $departmentService;
    public function __construct(WeekendService $weekendService, BranchServices $branchService, DepartmentServices $departmentService)
    {
        $this->weekendService = $weekendService;
        $this->branchService = $branchService;
        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd($this->weekendService->all());
        return view('company.weekend.index', [
            'allWeekendDetails' => $this->weekendService->all(Auth()->guard('company')->user()->id),
            'allCompanyBranchesDetails' => $this->branchService->getAllCompanyBranchByCompanyId(Auth()->guard('company')->user()->id),
            'allWeekDay' => WeekDay::get(),
            'allDepartments' => $this->departmentService->getAllDepartmentsByCompanyId()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateWeekendData  = Validator::make($request->all(), [
                'company_branch_id'  => 'required|exists:company_branches,id',
                'department_id'      => 'required|exists:departments,id',
                'weekday_id'         =>   'required|array',
                'weekday_id.*'       =>   'required'
            ]);
            if ($validateWeekendData->fails()) {
                return response()->json(['error' => $validateWeekendData->messages()], 400);
            }
            $data = $request->all();
            if ($this->weekendService->create($data)) {
                return response()->json([
                    'message' => 'Weekend Added Successfully!',
                    'data'   =>  view('company.weekend.weekend_list', [
                        'allWeekendDetails' => $this->weekendService->all(Auth()->guard('company')->user()->id)
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->weekendService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Holiday Deleted Successfully',
                'data'   =>  view('company.weekend.weekend_list', [
                    'allWeekendDetails' => $this->weekendService->all(Auth()->guard('company')->user()->id)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $statusDetails = $this->weekendService->updateStatus($request->id,  $request->status);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function getWeekEndDetailByCompanyId(Request $request)
    {
        $data = $this->weekendService->getWeekendDetailsByCompanyBranchIdByCompanyId(Auth()->guard('company')->user()->id, $request->company_branch_id, $request->department_id);
        if (isset($data) && !empty($data)) {
            return response()->json([
                'status' => true,
                'data'   => $data,
                'weekdayId'   => $data->weekday->pluck('id')->toArray(),
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
