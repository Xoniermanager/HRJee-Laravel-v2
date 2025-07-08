<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Services\UserService;
use App\Http\Services\LeaveService;
use App\Http\Controllers\Controller;
use App\Http\Services\BranchServices;
use App\Http\Services\WeekendService;
use App\Http\Services\HolidayServices;
use App\Http\Services\EmployeeServices;
use App\Http\Services\DepartmentServices;
use App\Http\Services\KpiCategoryService;
use App\Http\Services\KpiEmployeeService;
use App\Http\Services\KpiReviewCycleService;
use App\Http\Services\PerformanceCycleService;
use App\Http\Services\EmployeeAttendanceService;
use App\Http\Services\PerformanceManagementService;


class KpiManagementController extends Controller
{
    public $employeeService;
    public $employeeAttendanceService;
    public $holidayService;
    public $leaveService;
    public $weekendService;
    public $userService;
    public $performanceManagementService;
    public $kpiCategoryService;
    private $departmentService;
    private $branchService;

    private $kpiReviewCycleService;

    protected $service;

    public function __construct(KpiEmployeeService $service, KpiCategoryService $kpiCategoryService, PerformanceManagementService $performanceManagementService, UserService $userService, EmployeeServices $employeeService, EmployeeAttendanceService $employeeAttendanceService, HolidayServices $holidayService, LeaveService $leaveService, WeekendService $weekendService,BranchServices $branchService, DepartmentServices $departmentService, KpiReviewCycleService $kpiReviewCycleService)
    {
        $this->employeeService = $employeeService;
        $this->employeeAttendanceService = $employeeAttendanceService;
        $this->holidayService = $holidayService;
        $this->leaveService = $leaveService;
        $this->weekendService = $weekendService;
        $this->userService = $userService;
        $this->performanceManagementService = $performanceManagementService;
        $this->kpiCategoryService = $kpiCategoryService;
        $this->departmentService = $departmentService;
        $this->branchService = $branchService;
        $this->kpiReviewCycleService = $kpiReviewCycleService;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $companyIDs = getCompanyIDs();

        // Collect filters from request
        $filters = [
            'search'      => $request->get('search'),
            'status'      => $request->get('status'),
            'cycle_id'    => $request->get('cycle_id'),
            'category_id' => $request->get('category_id'),
        ];

        // Get paginated filtered data
        $allKpiEmployee = $this->service->list($filters, $companyIDs);

        // Needed for dropdowns
        $allCategories       = $this->kpiCategoryService->getAllCategoryByCompanyId($companyIDs);
        $allkpiReviewCycle   = $this->kpiReviewCycleService->getAllActiveCycelBycompanyId($companyIDs);

        // If AJAX call, return partial list
        if ($request->ajax()) {
            return view('company.kpi_management.list', compact('allKpiEmployee'))->render();
        }

        // Normal page load
        return view('company.kpi_management.index', compact('allKpiEmployee', 'allCategories', 'allkpiReviewCycle'));
    }

    public function add(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $allDepartment = $this->departmentService->getAllActiveDepartmentsByCompanyId($companyIDs);
        $allBranch = $this->branchService->getAllCompanyBranchByCompanyId($companyIDs);
        $allCategories = $this->kpiCategoryService->getAllCategoryByCompanyId($companyIDs);
        $allkpiReviewCycle = $this->kpiReviewCycleService->getAllActiveCycelBycompanyId($companyIDs);
        return view('company.kpi_management.add', compact('allCategories', 'allkpiReviewCycle', 'allDepartment', 'allBranch'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cycle_id' => 'required|exists:kpi_review_cycles,id',
            'category_id' => 'required|exists:kpi_categories,id',
            'company_branch_id' => 'required|array|min:1',
            'department_id' => 'required|array|min:1',
            'designation_id' => 'required|array|min:1',
            'employee_id' => 'required|array|min:1',
            'subject' => 'required|string|max:255',
            'tgt' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        try {
            $this->service->store($validated);
            return redirect()->route('kpi-management.index')->with('success', 'KPI Employee added successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->getMessage());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'Failed to add KPI Employee.');
        }
    }
    public function edit($id)
    {
        $companyIDs = getCompanyIDs();

        // Get the KPI employee (with related pivot data)
        $kpi = $this->service->find($id);
        // Load data for dropdowns
        $allBranch = $this->branchService->getAllCompanyBranchByCompanyId($companyIDs);
        $allDepartment = $this->departmentService->getAllActiveDepartmentsByCompanyId($companyIDs);
        $allCategories = $this->kpiCategoryService->getAllCategoryByCompanyId($companyIDs);
        $allkpiReviewCycle = $this->kpiReviewCycleService->getAllActiveCycelBycompanyId($companyIDs);

        // Preselected IDs
        $selectedBranches = $kpi->branches->pluck('id')->toArray();
        $selectedDepartments = $kpi->departments->pluck('id')->toArray();
        $selectedDesignations = $kpi->designations->pluck('id')->toArray();
        $selectedEmployees = $kpi->users->pluck('id')->toArray();
        return view('company.kpi_management.edit', compact(
            'kpi',
            'allBranch',
            'allDepartment',
            'allCategories',
            'allkpiReviewCycle',
            'selectedBranches',
            'selectedDepartments',
            'selectedDesignations',
            'selectedEmployees'
        ));
    }


    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'cycle_id' => 'required|exists:kpi_review_cycles,id',
            'category_id' => 'required|exists:kpi_categories,id',
            'company_branch_id' => 'required|array|min:1',
            'department_id' => 'required|array|min:1',
            'designation_id' => 'required|array|min:1',
            'employee_id' => 'required|array|min:1',
            'subject' => 'required|string|max:255',
            'tgt' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {
            $this->service->update($id, $validated);
            return redirect()->route('kpi-management.index')->with('success', 'KPI Employee updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update KPI Employee.');
        }
    }

    public function destroy(Request $request): JsonResponse
    {
        try {
            $this->service->delete((int) $request->id);
            return response()->json(['message' => 'KPI deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function toggleStatus(Request $request): JsonResponse
    {
        try {
            $newStatus = $this->service->toggleStatus((int) $request->id);
            return response()->json(['message' => 'Status updated', 'status' => $newStatus]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
