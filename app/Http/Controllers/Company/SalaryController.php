<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\SalaryService;
use App\Http\Requests\SalaryStoreRequest;
use App\Http\Requests\SalaryUpdateRequest;
use App\Http\Services\SalaryComponentService;
use Illuminate\Support\Facades\Validator;

class SalaryController extends Controller
{
    private $salaryService;
    private $salaryComponentService;

    public function __construct(SalaryService $salaryService, SalaryComponentService $salaryComponentService)
    {
        $this->salaryService = $salaryService;
        $this->salaryComponentService = $salaryComponentService;
    }

    /**
     * Lists all salaries
     */
    public function index()
    {
        $allSalaryDetails = $this->salaryService->getAllSalariesByCompanyId(Auth()->user()->company_id)->with('salaryComponentAssignments')->paginate(10);
        $allSalaryComponentDetails = $this->salaryComponentService->getActiveSalaryComponentByCompanyId(Auth()->user()->company_id);
        return view('company.salary.index', compact('allSalaryDetails', 'allSalaryComponentDetails'));
    }
    public function add()
    {
        $allSalaryComponentDetails = $this->salaryComponentService->getActiveSalaryComponentByCompanyId(Auth()->user()->company_id);
        $basicDetails = $this->salaryComponentService->getBasicPayDetails(Auth()->user()->company_id);
        return view('company.salary.add', compact('allSalaryComponentDetails', 'basicDetails'));
    }
    public function view($salaryId)
    {
        $salariesDetails = $this->salaryService->getSalaryIdById($salaryId);
        return view('company.salary.view', compact('salariesDetails'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalaryStoreRequest $request)
    {
        try {
            $data = $request->all();
            $data['company_id'] = auth()->user()->company_id;
            $data['created_by'] = auth()->user()->id;
            $this->salaryService->create($data);
            return redirect(route('salary.index'))->with(['success' => 'Salary Structured Added Successfully']);
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($salaryId)
    {
        $salariesDetails = $this->salaryService->getSalaryIdById($salaryId);
        $allSalaryComponentDetails = $this->salaryComponentService->getActiveSalaryComponentByCompanyId(Auth()->user()->company_id);
        $assignedComponentIds = $salariesDetails->salaryComponentAssignments->pluck('salary_component_id')->toArray();
        $allSalaryComponentDetails = $allSalaryComponentDetails->filter(function ($parentComponent) use ($assignedComponentIds) {
            return !in_array($parentComponent->id, $assignedComponentIds);
        })->values();
        $basicDetails = $this->salaryComponentService->getBasicPayDetails(Auth()->user()->company_id);
        return view('company.salary.edit', compact('salariesDetails', 'basicDetails', 'allSalaryComponentDetails'));
    }

    /**
     *
     "
     * Update the specified resource in storage.
     */
    public function update(SalaryUpdateRequest $request)
    {
        try {
            $updateData = $request->except(['_token', 'id']);
            $this->salaryService->updateDetails($updateData, $request->id);
            return redirect(route('salary.index'))->with(['success' => 'Salary Structured Updated Successfully']);
        }
        catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->salaryService->deleteDetails($id);
        if ($data) {
            $allSalaryDetails = $this->salaryService->getAllSalariesByCompanyId(Auth()->user()->company_id)->paginate(10);
            return response()->json([
                'message' => 'Salary Deleted Successfully!',
                'data' => view("company.salary.list", compact('allSalaryDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function statusUpdate(Request $request)
    {
        $statusDetails = $this->salaryService->statusUpdatebyStructuredId($request->id, $request->status);
        if ($statusDetails) {
            $allSalaryDetails = $this->salaryService->getAllSalariesByCompanyId(Auth()->user()->company_id)->paginate(10);
            return response()->json([
                'message' => 'Salary Created Successfully!',
                'data' => view("company.salary.list", compact('allSalaryDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function serachSalaryFilterList(Request $request)
    {
        $searchedItems = $this->salaryService->serachSalaryFilterList($request, auth()->user()->company_id);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("company.salary.list", [
                    'allSalaryDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
