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
                return back()
                    ->withErrors($validateData)
                    ->withInput();
            }

            // Process dates
            $dates = explode(' - ', $request->daterange);
            $startDate = $dates[0] ?? null;
            $endDate = $dates[1] ?? null;

            $data = $request->except(['_token', 'id', 'daterange']);
            $data['start_date'] = $startDate;
            $data['end_date'] = $endDate;
            // Create mode
            $data['company_id'] = auth()->user()->company_id;
            $data['created_by'] = auth()->user()->id;
            $created = $this->performanceCycleService->create($data);
            if ($created) {
                return redirect(route('performance-cycle-index'))->with('success', 'Review Cycle created successfully!');
            } else {
                return back()->with('error', 'Creation failed. Please try again.');
            }
            // }
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
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
        $companyIDs = getCompanyIDs();

        $allDepartment = $this->departmentService->getAllActiveDepartmentsByCompanyId($companyIDs);
        $allBranch = $this->branchService->getAllCompanyBranchByCompanyId($companyIDs);

        $performanceCycle = $this->performanceCycleService->getCycle($id);
        if (!$performanceCycle) {
            abort(404, 'Performance Cycle not found');
        }

        // explode saved IDs to arrays (stored as CSV)
        $selectedDepartments = $performanceCycle->department_id ? explode(',', $performanceCycle->department_id) : [];
        $selectedBranches = $performanceCycle->company_branch_id ? explode(',', $performanceCycle->company_branch_id) : [];
        $selectedDesignations = $performanceCycle->designation_id ? explode(',', $performanceCycle->designation_id) : [];
        $selectedEmployees = $performanceCycle->users ? $performanceCycle->users->pluck('id')->toArray() : [];

        // load designations & employees from selected departments
        $allDesignations = Designations::whereIn('department_id', $selectedDepartments)->get();
        $allEmployees = UserDetail::whereIn('department_id', $selectedDepartments)->get();

        return view('company.performance_cycle.edit', compact(
            'allDepartment',
            'allBranch',
            'performanceCycle',
            'allDesignations',
            'allEmployees',
            'selectedDepartments',
            'selectedBranches',
            'selectedDesignations',
            'selectedEmployees'
        ));
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
                return back()
                    ->withErrors($validateData)
                    ->withInput();
            }

            // Process dates
            $dates = explode(' - ', $request->daterange);
            $startDate = $dates[0] ?? null;
            $endDate = $dates[1] ?? null;
            $data = $request->except(['_token', 'id', 'daterange']);
            $data['start_date'] = $startDate;
            $data['end_date'] = $endDate;
            $updated = $this->performanceCycleService->updateDetails($data, $id);
            if ($updated) {
                return redirect(route('performance-cycle-index'))->with('success', 'Review Cycle updated successfully!');
            } else {
                return back()->with('error', 'Update failed. Please try again.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
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
            $employees = User::whereIn('id', $employee_ids ?? [])->whereHas('managerEmployees', function ($query) {
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
