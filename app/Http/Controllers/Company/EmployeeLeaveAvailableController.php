<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeLeaveAvailableService;
use Illuminate\Http\Request;

class EmployeeLeaveAvailableController extends Controller
{
     public $employeeAvailableLeaveService;
     public function __construct(EmployeeLeaveAvailableService $employeeAvailableLeaveService)
     {
          $this->employeeAvailableLeaveService = $employeeAvailableLeaveService;
     }
     public function getAllEmployeeLeaveAvailableList()
     {
          $getAllEmployeeLeaveAvailableDetails = $this->employeeAvailableLeaveService->getAllEmployeeLeaveAvailable();
          return view('company.employee_leave_available.index', compact('getAllEmployeeLeaveAvailableDetails'));
     }
}
