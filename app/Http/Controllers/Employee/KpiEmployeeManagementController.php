<?php

namespace App\Http\Controllers\Employee;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\KpiCategoryService;
use App\Http\Services\KpiEmployeeService;
use App\Http\Services\KpiReviewCycleService;

class KpiEmployeeManagementController extends Controller
{
    public $kpiService;
    private $kpiReviewCycleService;
    public $kpiCategoryService;


    public function __construct(KpiEmployeeService $kpiService, KpiCategoryService $kpiCategoryService, KpiReviewCycleService $kpiReviewCycleService)
    {
        $this->kpiService = $kpiService;
        $this->kpiReviewCycleService = $kpiReviewCycleService;
        $this->kpiCategoryService = $kpiCategoryService;
    }

    public function index(Request $request)
    {
        $companyIDs = getCompanyIDs();

        $filters = [
            'search' => $request->get('search'),
            'cycle_id' => $request->get('cycle_id'),
            'category_id' => $request->get('category_id'),
        ];

        $assignedKpis = $this->kpiService->getAllAssignedKpiForUserPaginatedWithFilters(auth()->id(), $filters, 10);
        // Load filter dropdowns
        $allCycles = $this->kpiReviewCycleService->getAllActiveCycelBycompanyId($companyIDs);
        $allCategories = $this->kpiCategoryService->getAllCategoryByCompanyId($companyIDs);

        if ($request->ajax()) {
            return view('employee.kpi-management.list', compact('assignedKpis'))->render();
        }

        return view('employee.kpi-management.index', compact('assignedKpis', 'allCycles', 'allCategories'));
    }

    public function submitAchievement(Request $request, $kpiEmployeeId)
    {
        $request->validate([
            'achievement' => 'required|string|max:255'
        ]);

        try {
            $this->kpiService->submitAchievement($kpiEmployeeId, auth()->id(), $request->achievement);
            return response()->json(['message' => 'Achievement submitted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}
