<?php

namespace App\Http\Controllers\Company;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeServices;
use App\Jobs\EmployeePayslipGenerateJob;
use App\Http\Services\GenerateSalaryService;

class EmployeeSalaryController extends Controller
{
    protected $generateSalaryService;
    protected $userService;
    protected $employeeService;

    public function __construct(GenerateSalaryService $generateSalaryService, EmployeeServices $employeeService, UserService $userService)
    {
        $this->generateSalaryService = $generateSalaryService;
        $this->employeeService = $employeeService;
        $this->userService = $userService;
    }

    public function index()
    {
        $allEmployeeDetails = $this->employeeService->getAllEmployeeByCompanyId(Auth()->user()->company_id)->paginate(10);
        return view('company.salary_employee.index', compact('allEmployeeDetails'));
    }
    public function viewSalary($userId)
    {
        $userId = getDecryptId($userId);
        return view('company.salary_employee.view', compact('userId'));
    }
    public function generatePDF(Request $request)
    {
        $employeeDetails = User::find($request->user_id);
        $data = $this->getPdfData($request->all());
        $pdf = PDF::loadView('salary_temp', ['data' => $data]);
        return $pdf->download($employeeDetails->name . '_salary.pdf');
    }
    public function getPdfData($request)
    {
        return $this->generateSalaryService->generateSalaryByEmployeeDetails($request);
    }

    public function serachEmployeeSalaryFilterList(Request $request)
    {
        $allEmployeeDetails = $this->userService->searchFilterEmployee($request, Auth()->user()->company_id)->paginate(10);
        return response()->json([
            'success' => true,
            'data' => view('company.salary_employee.list', compact('allEmployeeDetails'))->render()
        ]);
    }

    public function showEmployeePayslip(Request $request)
    {
        $data = $this->getPdfData($request->all());
        if ($data['status']) {
            return response()->json([
                'status' => true,
                'data' => view('salary_temp', compact('data'))->render()
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => $data['message']
            ]);
        }
    }
    public function generatePayslipPreviousMonth()
    {
        $userDetails = $this->employeeService->getAllEmployeeByCompanyId(Auth()->user()->company_id)->get();
        if ($userDetails) {
            EmployeePayslipGenerateJob::dispatch($userDetails);
            return response()->json([
                'status' => true,
                'message' => "Employee Payslip being process and send to employee mail"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "No Employee found for Generate Payslip"
            ]);
        }
    }
}
