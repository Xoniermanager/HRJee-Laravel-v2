<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\SalaryService;
use App\Http\Requests\SalaryStoreRequest;

class SalaryController extends Controller
{
    private $salaryService;

    public function __construct(SalaryService $salaryService)
    {
        $this->salaryService = $salaryService;
    }
    
    /**
     * Lists all salaries
     */
    public function index()
    {
        $salaries = $this->salaryService->getAllSalaries();
        return view('company.salary.index')->with(['salaries' => $salaries]);
    }
    
    /**
     * Created new salary by saving all salary details
     */
    public function createSalary(SalaryStoreRequest $request)
    {
        $salaryData = $request->validated();
    }


    /**
     * Created new salary by saving all salary details
     */
    // public function editSalary()
    // {
    //     $salaryData = $request->validated();
    // }
}
