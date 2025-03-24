<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\SalaryComponentService;
use App\Http\Requests\SalaryComponentStoreRequest;
use App\Http\Requests\SalaryComponentUpdateRequest;

class SalaryComponentController extends Controller
{
    private $salaryComponentService;

    public function __construct(SalaryComponentService $salaryComponentService)
    {
        $this->salaryComponentService = $salaryComponentService;
    }
    public function index()
    {
        $allSalaryComponent = $this->salaryComponentService->getAllSalaryComponentByCompanyId(Auth()->user()->company_id)->paginate(10);
        return view('company.salary_component.index', compact('allSalaryComponent'));
    }
    public function add()
    {
        $basicDetails = $this->salaryComponentService->getBasicPayDetails(Auth()->user()->company_id);
        return view('company.salary_component.add', compact('basicDetails'));
    }
    public function store(SalaryComponentStoreRequest $request)
    {
        try {
            $data = $request->all();
            $data['company_id'] = auth()->user()->company_id;
            $data['created_by'] = auth()->user()->id;
            if ($this->salaryComponentService->create($data)) {
                return redirect(route('salary.component.index'))->with(['success' => 'Salary Component Added Succussfully']);
            }
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($salaryComponentId)
    {
        $salaryComponentDetails = $this->salaryComponentService->getDetailsBySalaryComponentId($salaryComponentId);
        $basicDetails = $this->salaryComponentService->getBasicPayDetails(Auth()->user()->company_id);
        return view('company.salary_component.edit', compact('salaryComponentDetails', 'basicDetails'));
    }

    public function update(SalaryComponentUpdateRequest $request, $salaryComponentId)
    {
        try {
            $data = $request->except(['_token', 'id']);
            if ($this->salaryComponentService->updateDetails($data, $salaryComponentId)) {
                return redirect(route('salary.component.index'))->with(['success' => 'Salary Component Updated Succussfully']);
            }
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function serachSalaryComponentFilterList(Request $request)
    {
        $searchedItems = $this->salaryComponentService->serachSalaryComponentFilterList($request, auth()->user()->company_id);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("company.salary_component.list", [
                    'allSalaryComponent' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
