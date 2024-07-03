<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\BranchServices;
use App\Http\Services\DepartmentServices;
use App\Http\Services\DesignationServices;
use App\Http\Services\NewsCategoryService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public $companyBranchService;
    public $designationService;
    public $departmentService;
    public $newsCategoryService;
    public function __construct(BranchServices $companyBranchService, DesignationServices $designationService, DepartmentServices $departmentService, NewsCategoryService $newsCategoryService)
    {
        $this->companyBranchService = $companyBranchService;
        $this->designationService = $designationService;
        $this->departmentService = $departmentService;
        $this->newsCategoryService = $newsCategoryService;
    }
    public function index()
    {
        return view('company.news.index');
    }

    public function add()
    {
        $allCompanyBranchesDetails = $this->companyBranchService->allActiveCompanyBranchesByUsingCompanyId(Auth()->guard('admin')->user()->id);
        $allDepartmentsDetails = $this->departmentService->getAllActiveDepartmentsUsingByCompanyID(Auth()->guard('admin')->user()->id);
        $allNewsCategoryDetails = $this->newsCategoryService->getAllActiveNewsCategoryUsingByCompanyID(Auth()->guard('admin')->user()->id);
        return view('company.news.add',compact('allCompanyBranchesDetails','allDepartmentsDetails','allNewsCategoryDetails'));
    }
}
