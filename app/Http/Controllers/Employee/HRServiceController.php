<?php

namespace App\Http\Controllers\Employee;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserMonthlySalary;
use App\Http\Controllers\Controller;

class HRServiceController extends Controller
{
    public $generatePayslipService;
    public function index()
    {
        return view('employee.hrService.index');
    }

    public function salaryIndex()
    {
        $employeeDetails = User::find(Auth()->user()->id);
        $checkExistingMonthDetails = UserMonthlySalary::where('user_id', Auth()->user()->id)->where('year', Carbon::now()->subMonth()->format('Y'))->where('month', Carbon::now()->subMonth()->format('n'))->first();
        $data = [];
        if (isset($checkExistingMonthDetails) && !empty($checkExistingMonthDetails)) {
            $data['getEmployeeMonthlySalary']['others'] = $checkExistingMonthDetails->toArray();
            $data['getEmployeeMonthlySalary']['monthlyCtc'] = $checkExistingMonthDetails->monthly_ctc;
            $data['getEmployeeMonthlySalary']['components'] = $checkExistingMonthDetails->userMonthlySalaryComponentLog->toArray();
            $data['employeeSalary'] = $employeeDetails;
            $data['status'] = true;
            $data['mail'] = $checkExistingMonthDetails->mail_send;
        }
        return view('employee.payslip.index', compact('data'));
    }
}
