<?php

namespace App\Http\Controllers\Company;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeServices;
use Illuminate\Http\Request;
use App\Http\Services\GenerateSalaryService;

class EmployeeSalaryController extends Controller
{
    protected $generateSalaryService;
    protected $employeeService;
    protected $userService;

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
        $employeeDetails = User::find($userId);
        $data = $this->getPdfData($employeeDetails);
        return view('company.salary_employee.view', compact('data'));
    }
    public function generatePDF($userId)
    {
        $userId = getDecryptId($userId);
        $employeeDetails = User::find($userId);
        $data = $this->getPdfData($employeeDetails);
        $pdf = PDF::loadView('salary_temp', ['data' => $data]);
        // return $pdf->stream($employeeDetails->name . '_salary.pdf');
        return $pdf->download($employeeDetails->name . '_salary.pdf');
    }
    public function getPdfData($employeeDetails)
    {
        return $this->generateSalaryService->generateSalaryByEmployeeDetails($employeeDetails);
    }

    public function serachEmployeeSalaryFilterList(Request $request)
    {
        $allEmployeeDetails = $this->userService->searchFilterEmployee($request, Auth()->user()->company_id)->paginate(10);
        return response()->json([
            'success' => true,
            'data' => view('company.salary_employee.list', compact('allEmployeeDetails'))->render()
        ]);
    }
}
