<?php

namespace App\Http\Controllers\Company;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeServices;
use App\Http\Services\GenerateSalaryService;

class EmployeeSalaryController extends Controller
{
    protected $generateSalaryService;
    protected $employeeService;

    public function __construct(GenerateSalaryService $generateSalaryService,EmployeeServices $employeeService)
    {
        $this->generateSalaryService = $generateSalaryService;
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $allEmployeeDetails = $this->employeeService->getAllEmployeeByCompanyId(Auth()->user()->company_id)->paginate(10);
        return view('company.salary_employee.index',compact('allEmployeeDetails'));
    }
    public function viewSalary($userId)
    {
        $employeeDetails = User::find($userId);
        $data = $this->getPdfData($employeeDetails);
        return view('salary_temp', compact('data'));
    }
    public function generatePDF($userId)
    {
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
}
