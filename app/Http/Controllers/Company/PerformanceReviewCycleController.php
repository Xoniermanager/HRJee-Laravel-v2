<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Models\User;
use App\Models\Designations;
use Illuminate\Http\Request;
use App\Models\ReviewCycleUser;
use Illuminate\Validation\Rule;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Services\BranchServices;
use App\Http\Services\DepartmentServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\PerformanceCycleService;
use App\Models\UserDetail;

class PerformanceReviewCycleController extends Controller
{

    private $performanceCycleService;
    public $userService;
    private $departmentService;
    private $branchService;

    public function __construct(DepartmentServices $departmentService, UserService $userService, PerformanceCycleService $performanceCycleService, BranchServices $branchService)
    {
        $this->performanceCycleService = $performanceCycleService;
        $this->userService = $userService;
        $this->departmentService = $departmentService;
        $this->branchService = $branchService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyIDs = getCompanyIDs();


        return view('company.performance_cycle.index', [
            'performanceCategories' => $this->performanceCycleService->all($companyIDs)
        ]);
    }

    public function add()
    {
        $companyIDs = getCompanyIDs();
        $allDepartment = $this->departmentService->getAllActiveDepartmentsByCompanyId($companyIDs);
        $allBranch = $this->branchService->getAllCompanyBranchByCompanyId($companyIDs);
        return view('company.performance_cycle.add', compact('allDepartment', 'allBranch'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            // Validate
            $validateData = Validator::make($request->all(), [
                'title' => 'required|string',
                'daterange' => 'required|string',
                'company_branch_id' => 'required|array|min:1',
                'department_id' => 'required|array|min:1',
                'designation_id' => 'required|array|min:1',
                'employee_id' => 'required|array|min:1',
            ]);

            if ($validateData->fails()) {

                return response()->json(['error' => $validateData->messages()], 400);
            }

            if($request->get('id') != "") {
                $updateData = $request->except(['_token', 'id']);
                $dates = explode(' - ', $updateData['daterange']);


                $updateData['start_date'] = $dates[0];
                $updateData['end_date'] = $dates[1];
                $companyStatus = $this->performanceCycleService->updateDetails($updateData, $request->id);

                if ($companyStatus) {

                    return response()->json(
                        [
                            'message' => 'Cycle Updated Successfully!',
                            'data'   =>  view('company.performance_cycle.list', [
                                'performanceCategories' => $this->performanceCycleService->all([auth()->user()->id])
                            ])->render()
                        ]
                    );
                }
            } else {
                $data = $request->all();
                $dates = explode(' - ', $data['daterange']);

                $data['company_id'] = auth()->user()->company_id;
                $data['created_by'] = auth()->user()->id;
                $data['start_date'] = $dates[0];
                $data['end_date'] = $dates[1];
                if ($this->performanceCycleService->create($data)) {

                    return response()->json([
                        'message' => 'Cycle Created Successfully!',
                        'data'   =>  view('company.performance_cycle.list', [
                            'performanceCategories' => $this->performanceCycleService->all([auth()->user()->id])
                        ])->render()
                    ]);
                }
            }

        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }


    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void/null/object
     */
    public function edit($id)
    {
        try {
            $cycle = $this->performanceCycleService->getCycle($id);

            $cycle->employee_ids = $cycle->userList();
            $cycle->department_ids = explode(',',  $cycle->department_id);


            return response()->json([
                'status' => true,
                'data' => $cycle
            ]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], 400);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate
            $validateData = Validator::make($request->all(), [
                'title' => 'required|string',
                'daterange' => 'required|string',
                'company_branch_id' => 'required|array|min:1',
                'department_id' => 'required|array|min:1',
                'designation_id' => 'required|array|min:1',
                'employee_id' => 'required|array|min:1',
            ]);

        if ($validateData->fails()) {

            return response()->json(['error' => $validateData->messages()], 400);
        }

        $updateData = $request->except(['_token', 'id']);
        $dates = explode(' - ', $updateData['daterange']);


        $updateData['start_date'] = $dates[0];
        $updateData['end_date'] = $dates[1];
        $companyStatus = $this->performanceCycleService->updateDetails($updateData, $request->id);

        if ($companyStatus) {

            return response()->json(
                [
                    'message' => 'Cycle Updated Successfully!',
                    'data'   =>  view('company.performance_cycle.list', [
                        'performanceCategories' => $this->performanceCycleService->all([auth()->user()->id])
                    ])->render()
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cycle = $this->performanceCycleService->getCycle($id); // or use repository
        if ($cycle) {
            // Detach related users (if using pivot)
            $cycle->users()->detach();
            // Delete the cycle
            $cycle->delete();
            return response()->json(['status' => true, 'message' => 'Performance cycle deleted successfully.']);
        }

        return response()->json(['status' => false, 'message' => 'Performance cycle not found.']);
    }


    public function search(Request $request)
    {
        $searchedItems = $this->performanceCycleService->serachFilterList($request);
        if ($searchedItems) {

            return response()->json([
                'success' => 'Searching...',
                'data' => view("company.performance_cycle.list", [
                    'performanceCategories' => $searchedItems
                ])->render()
            ]);
        } else {

            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function getEmployeesByCycle($id)
    {
        $employee_ids = ReviewCycleUser::where('performance_review_cycle_id', $id)->pluck('user_id')->toArray();
        if (auth()->user()->type == "company") {
            $employees = User::whereIn('id', $employee_ids ?? [])->doesntHave('managerEmployees')->select('id', 'name')->get();

            // $employees = User::whereIn('id', $employee_ids ?? [])->select('id', 'name')->get();
        } else {
            $employees = User::managerFilter()->whereIn('id', $employee_ids ?? [])->whereHas('managerEmployees', function ($query) {
                $query->where('manager_id', auth()->user()->id);
            })->get();
        }

        return response()->json([
            'success' => true,
            'employees' => $employees
        ]);
    }
    public function getDesignationsByDept(Request $request)
    {
        $designations = Designations::whereIn('department_id', $request->department_ids)->get(['id', 'name']);
        return response()->json(['data' => $designations]);
    }

}
