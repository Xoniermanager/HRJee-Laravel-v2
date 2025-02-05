<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\SalaryComponentAssignmentService;
use App\Http\Requests\SalaryComponentAssignmentStoreRequest;
use App\Http\Requests\SalaryComponentAssignmentUpdateRequest;
use App\Http\Services\SalaryComponentService;
use App\Http\Services\SalaryService;

class SalaryComponentAssignmentController extends Controller
{
    private $salaryComponentAssignmentService;
    private $salaryComponentService;
    private $salaryService;
    public function __construct(SalaryComponentAssignmentService $salaryComponentAssignmentService,SalaryService $salaryService,SalaryComponentService $salaryComponentService)
    {
        $this->salaryComponentAssignmentService = $salaryComponentAssignmentService;
        $this->salaryService = $salaryService;
        $this->salaryComponentService = $salaryComponentService;
    }
    public function index()
    {
        $allSalaryComponent = $this->salaryComponentAssignmentService->getAllSalaryComponentAssignmentByCompanyId(Auth()->user()->company_id)->paginate(10);
        return view('company.salary_component_assign.index', compact('allSalaryComponent'));
    }
    public function add()
    {
        $allSalaries = $this->salaryService->getAllActiveSalaries(Auth()->user()->company_id);
        $allSalaryComponentDetails = $this->salaryComponentService->getActiveSalaryComponentByCompanyId(Auth()->user()->company_id);
        $basicDetails = $this->salaryComponentService->getBasicPayDetails(Auth()->user()->company_id);
        return view('company.salary_component_assign.add', compact('allSalaries','allSalaryComponentDetails','basicDetails'));
    }
    public function store(SalaryComponentAssignmentStoreRequest $request)
    {
        try {
            $data = $request->all();
            $data['company_id'] = auth()->user()->company_id;
            $data['created_by'] = auth()->user()->id;
            if ($this->salaryComponentAssignmentService->create($data)) {
                return redirect(route('salary.component.index'))->with(['success' => 'Salary Component Added Succussfully']);
            }
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($salaryComponentId)
    {
        $salaryComponentDetails = $this->salaryComponentAssignmentService->getDetailsBySalaryComponentAssignmentId($salaryComponentId);
        $basicDetails = $this->salaryComponentAssignmentService->getBasicPayDetails(Auth()->user()->company_id);
        return view('company.salary_component_assign.edit', compact('salaryComponentDetails', 'basicDetails'));
    }

    public function update(SalaryComponentAssignmentUpdateRequest $request, $salaryComponentId)
    {
        try {
            $data = $request->except(['_token', 'id']);
            if ($this->salaryComponentAssignmentService->updateDetails($data, $salaryComponentId)) {
                return redirect(route('salary.component.index'))->with(['success' => 'Salary Component Updated Succussfully']);
            }
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function serachSalaryComponentAssignmentFilterList(Request $request)
    {
        $searchedItems = $this->salaryComponentAssignmentService->serachSalaryComponentAssignmentFilterList($request, auth()->user()->company_id);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("company.salary_component_assign.list", [
                    'allSalaryComponent' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}

