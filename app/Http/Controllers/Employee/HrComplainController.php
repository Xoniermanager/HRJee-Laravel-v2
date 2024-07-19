<?php

namespace App\Http\Controllers\Employee;

use Exception;
use Illuminate\Http\Request;
use App\Models\EmployeeComplain;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\ComplainCategoryService;
use App\Http\Services\EmployeeComplainService;
use App\Http\Services\EmployeeComplainLogService;

class HrComplainController extends Controller
{
    public $complainCategoryService;

    public $employeeComplainService;

    public $employeeComplainLogService;

    public function __construct(ComplainCategoryService $complainCategoryService, EmployeeComplainService $employeeComplainService, EmployeeComplainLogService $employeeComplainLogService)
    {
        $this->complainCategoryService =  $complainCategoryService;
        $this->employeeComplainService =  $employeeComplainService;
        $this->employeeComplainLogService =  $employeeComplainLogService;
    }
    public function index()
    {
        $user = Auth()->guard('employee')->user()->load('userDetails');
        if ($user->userDetails->role_id == 4) {
            $allComplainDetails = $this->employeeComplainService->all();
            return view('employee.complain.index', compact('allComplainDetails'));
        } else {
            $allComplainDetails = $this->employeeComplainService->getAllComplainDetailsByUserId(Auth()->guard('employee')->user()->id);
            return view('employee.hr_complain.index', compact('allComplainDetails'));
        }
    }

    public function add()
    {
        $allComplainCategory = $this->complainCategoryService->getAllActiveComplainStatus();
        return view('employee.hr_complain.add', compact('allComplainCategory'));
    }
    public function store(Request $request)
    {
        try {
            $validateData  = Validator::make($request->all(), [
                'complain_category_id'  => ['required', 'exists:complain_categories,id'],
                'description' => ['required', 'string']
            ]);

            if ($validateData->fails()) {
                return back()->withErrors($validateData->errors())->withInput();
            }
            $data = $request->all();
            if ($this->employeeComplainService->create($data)) {
                return redirect(route('employee.hr_complain.index'))->with('success', 'Added successfully');
            }
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function getComplainDetails($id)
    {
        $employeeComplainDetails = $this->employeeComplainService->findById($id);
        $user = Auth()->guard('employee')->user()->load('userDetails');
        if ($user->userDetails->role_id == 4) {
            $toId = $employeeComplainDetails->user_id;
            $fromId = 0;
        } else {
            $toId = 0;
            $fromId = $employeeComplainDetails->user_id;
        }
        $complainDetails = $this->employeeComplainLogService->findDetailsByComplainId($id);
        return view('employee.hr_complain.chatbox', compact('complainDetails', 'toId', 'fromId'));
    }
}
