<?php

namespace App\Http\Controllers\Employee;

use Exception;
use Illuminate\Http\Request;
use App\Models\EmployeeComplain;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\PRMCategoryService;
use App\Http\Services\EmployeePRMService;
use App\Http\Services\EmployeeComplainLogService;

class PRMController extends Controller
{
    public $prmCategoryService;
    public $employeePRMService;
    public $employeeComplainLogService;

    public function __construct(PRMCategoryService $prmCategoryService, EmployeePRMService $employeePRMService, EmployeeComplainLogService $employeeComplainLogService)
    {
        $this->prmCategoryService = $prmCategoryService;
        $this->employeePRMService = $employeePRMService;
        $this->employeeComplainLogService = $employeeComplainLogService;
    }

    public function index()
    {
        $allPRMs = $this->employeePRMService->getAllPRMByUserId(Auth()->user()->id);

        return view('employee.prm.index', compact('allPRMs'));
    }

    public function add()
    {
        $allCategories = $this->prmCategoryService->getAllActiveCategoryByCompanyID([auth()->user()->company_id]);

        return view('employee.prm.add', compact('allCategories'));
    }

    public function store(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'category_id' => ['required', 'exists:prm_categories,id'],
                'remark' => ['required', 'string'],
                'bill_date' => ['required', 'string'],
                'amount' => ['required|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/']
            ]);
            if ($validateData->fails()) {
                return back()->withErrors($validateData->errors())->withInput();
            }
            $data = $request->except(['_token']);
            if ($this->employeePRMService->create($data)) {
                return redirect(route('prm.index'))->with('success', 'Added successfully');
            }
        } catch (Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }

    public function getDetails($id)
    {
        $prmDetails = $this->employeePRMService->findById($id);
        $allCategories = $this->prmCategoryService->getAllActiveCategoryByCompanyID([auth()->user()->company_id]);

        return view('employee.prm.view', compact('prmDetails', 'allCategories'));
    }

    public function edit($id)
    {
        $prmDetails = $this->employeePRMService->findById($id);
        $allCategories = $this->prmCategoryService->getAllActiveCategoryByCompanyID([auth()->user()->company_id]);

        return view('employee.prm.edit', compact('prmDetails', 'allCategories'));
    }

    public function update($id, Request $request)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'category_id' => ['required', 'exists:prm_categories,id'],
                'remark' => ['required', 'string'],
                'bill_date' => ['required', 'string'],
                'amount' => ['required', 'string']
            ]);

            if ($validateData->fails()) {
                return back()->withErrors($validateData->errors())->withInput();
            }

            $data = $request->except(['_token']);
            if ($this->employeePRMService->update($data, $id)) {
                return redirect(route('prm.index'))->with('success', 'Updated successfully');
            }
        } catch (Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {

            if ($this->employeePRMService->delete($request->id)) {
                return redirect(route('prm.index'))->with('success', 'Deleted successfully');
            }
        } catch (Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }
}
