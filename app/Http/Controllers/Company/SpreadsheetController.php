<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeServices;
use App\Http\Services\SpreadsheetService;
use App\Http\Services\UserBankDetailServices;
use Illuminate\Http\Request;

class SpreadsheetController extends Controller
{

    protected $employeeServices;
    protected $spreadsheetService;
    protected $userBankDetailServices;

    public function __construct(UserBankDetailServices $userBankDetailServices, SpreadsheetService $spreadsheetService, EmployeeServices $employeeServices)
    {
        $this->employeeServices = $employeeServices;
        $this->spreadsheetService = $spreadsheetService;
        $this->userBankDetailServices = $userBankDetailServices;
    }

    public function exportEmployee(Request $request)
    {
        dd($request->all());
        $allEmployees = $this->employeeServices->all($request);
        dd($allEmployees);
        $selectKeys = array_keys($request->except('_token', 'emp_type_id','marital_status','gender', 'emp_status_id', 'depertment_id'));
        $headers = $selectKeys;
        // $allEmployees = $this->employeeServices->getAllEmployee();
        $employees = $allEmployees->select($selectKeys)->toArray();
        $response =   $this->employeeServices->exportData($employees, $headers);
        if ($response['status'] == true) {
            $this->spreadsheetService->createSpreadsheet($response['data'], $response['path']);
            return response()->download($response['path'])->deleteFileAfterSend(true);
        }
    }


    public function exportEmployeeBankDetails(Request $request)
    {
        $employeesWithBankDetails = $this->employeeServices->all($request);

        $selectKeys = array_keys($request->except('_token', 'emp_type_id', 'marital_status', 'gender', 'emp_status_id', 'depertment_id'));
        $headers = $selectKeys;
        $AllBankDetails = $employeesWithBankDetails->select($selectKeys)->toArray();
        // dd($AllBankDetails);
        $response =   $this->employeeServices->exportData($AllBankDetails, $headers);
        if ($response['status'] == true) {
            $this->spreadsheetService->createSpreadsheet($response['data'], $response['path']);
            return response()->download($response['path'])->deleteFileAfterSend(true);
        }
    }


    public function exportEmployeeAddressDetails(Request $request)
    {
        $employeesWithAddressDetails = $this->employeeServices->all($request);
        $selectKeys = array_keys($request->except('_token', 'emp_type_id', 'marital_status', 'gender', 'emp_status_id', 'depertment_id'));
        $headers = $selectKeys;
        $AllAddressDetailsFinalPayload = $employeesWithAddressDetails->select($selectKeys)->toArray();
        $response =   $this->employeeServices->exportData($AllAddressDetailsFinalPayload, $headers);
        if ($response['status'] == true) {
            $this->spreadsheetService->createSpreadsheet($response['data'], $response['path']);
            return response()->download($response['path'])->deleteFileAfterSend(true);
        }
    }
}
