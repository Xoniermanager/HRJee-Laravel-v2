<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeResignationStatusRequest;
use App\Http\Services\EmployeeServices;
use App\Http\Services\ResignationStatusService;
use Throwable;

class ResignationStatusController extends Controller
{

    protected $employeeServicess;
    protected $resignationStatusService;
    public function __construct(EmployeeServices $employeeServices, ResignationStatusService $resignationStatusService)
    {
        $this->resignationStatusService = $resignationStatusService;
        // $this->employeeServices = $employeeServices;
    }

    public function getResignationStatusList()
    {
        try {
            $resignationStatus =  $this->resignationStatusService->all('all');
            return apiResponse('resignation_status_lists', $resignationStatus);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }

    public function changeResignationStatus(ChangeResignationStatusRequest $request)
    {
        try {
            $userType = auth()->guard('employee_api')->user()->userDetails->roles->name;
            $data = $request->all();
            $data['action_taken_by'] = auth()->guard('employee_api')->user()->id;
            $resignationStatus =  $this->resignationStatusService->changeStatus($data, $userType);
            if ($resignationStatus['status'] == true)
                return apiResponse($resignationStatus['msg']);
            elseif ($resignationStatus['status'] == false)
                return errorMessage('', $resignationStatus['msg']);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
