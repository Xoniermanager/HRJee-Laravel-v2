<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeServices;
use App\Http\Services\SpreadsheetService;
use App\Http\Services\UserBankDetailServices;
use Illuminate\Http\Request;
use Throwable;

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
        try {

            $data =  $request->except('_token', 'emp_type_id', 'gender_filter', 'marital_status_filter', 'emp_status_id', 'depertment_id');
            $data['gender'] = $request->gender_filter;
            $data['marital_status'] = $request->marital_status_filter;
            $allEmployees = $this->employeeServices->all((object)$data);

            $selectKeys = array_keys($data);
            $headers = $selectKeys;
            // $allEmployees = $this->employeeServices->getAllEmployee();
            $employees = $allEmployees->select($selectKeys)->toArray();
            $response =   $this->spreadsheetService->exportData($employees, $headers);
            if ($response['status'] == true) {
                $this->spreadsheetService->createSpreadsheet($response['data'], $response['path']);
                return response()->download($response['path'])->deleteFileAfterSend(true);
            }
        } catch (Throwable $th) {
            return response()->json(['error' =>  $th->getMessage()], 400);
        }
    }


    public function exportEmployeeBankDetails(Request $request)
    {
        try {
            $employeesWithBankDetails = $this->employeeServices->all($request);

            $selectKeys = array_keys($request->except('_token', 'emp_type_id', 'marital_status', 'gender', 'emp_status_id', 'depertment_id'));
            $headers = $selectKeys;
            $AllBankDetails = $employeesWithBankDetails->select($selectKeys)->toArray();
            $response =   $this->spreadsheetService->exportData($AllBankDetails, $headers);
            if ($response['status'] == true) {
                $this->spreadsheetService->createSpreadsheet($response['data'], $response['path']);
                return response()->download($response['path'])->deleteFileAfterSend(true);
            }
        } catch (Throwable $th) {
            return response()->json(['error' =>  $th->getMessage()], 400);
        }
    }


    public function exportEmployeeAddressDetails(Request $request)
    {
        try {
            $employeesWithAddressDetails = $this->employeeServices->all($request);
            $selectKeys = array_keys($request->except('_token', 'emp_type_id', 'marital_status', 'gender', 'emp_status_id', 'depertment_id'));
            $headers = $selectKeys;
           
            $AllAddressDetailsFinalPayload = $employeesWithAddressDetails->select($selectKeys)->toArray();
        //    dd($selectKeys);
        //    dd($AllAddressDetailsFinalPayload);
            $response =   $this->spreadsheetService->exportData($AllAddressDetailsFinalPayload, $headers);
            if ($response['status'] == true) {
                $this->spreadsheetService->createSpreadsheet($response['data'], $response['path']);
                return response()->download($response['path'])->deleteFileAfterSend(true);
            }
        } catch (Throwable $th) {
            return response()->json(['error' =>  $th->getMessage()], 400);
        }
    }
}
