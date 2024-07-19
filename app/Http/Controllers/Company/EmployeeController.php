<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\RolesServices;
use App\Http\Services\ShiftServices;
use App\Http\Services\BranchServices;
use App\Http\Services\CountryServices;
use App\Http\Services\EmployeeServices;
use App\Http\Services\LanguagesServices;
use App\Http\Requests\EmployeeAddRequest;
use App\Http\Services\AssetCategoryService;
use App\Http\Services\DepartmentServices;
use App\Http\Services\DocumentTypeService;
use App\Http\Services\EmployeeTypeService;
use App\Http\Services\QualificationService;
use App\Http\Services\EmployeeStatusService;
use App\Http\Services\PreviousCompanyService;
use App\Http\Services\SkillsService;

class EmployeeController extends Controller
{
    private $countryService;
    private $previousCompanyService;
    private $qualificationService;
    private $employeeTypeService;
    private $employeeStatusService;
    private $departmentService;
    private $documentTypeService;
    private $employeeService;
    private $branchService;
    private $roleService;
    private $shiftService;
    private $languagesServices;
    private $skillServices;
    private $assetCategoryServices;


    public function __construct(

        CountryServices $countryService,
        PreviousCompanyService $previousCompanyService,
        QualificationService $qualificationService,
        EmployeeTypeService $employeeTypeService,
        EmployeeStatusService $employeeStatusService,
        DepartmentServices $departmentService,
        DocumentTypeService $documentTypeService,
        EmployeeServices $employeeService,
        BranchServices $branchService,
        RolesServices $roleService,
        ShiftServices $shiftService,
        LanguagesServices $languagesServices,
        SkillsService $skillServices,
        AssetCategoryService $assetCategoryServices

    ) {
        $this->countryService = $countryService;
        $this->previousCompanyService = $previousCompanyService;
        $this->qualificationService = $qualificationService;
        $this->employeeTypeService = $employeeTypeService;
        $this->employeeStatusService = $employeeStatusService;
        $this->departmentService = $departmentService;
        $this->documentTypeService = $documentTypeService;
        $this->employeeService = $employeeService;
        $this->branchService = $branchService;
        $this->roleService = $roleService;
        $this->shiftService = $shiftService;
        $this->languagesServices = $languagesServices;
        $this->skillServices = $skillServices;
        $this->assetCategoryServices = $assetCategoryServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allUserDetails = $this->employeeService->all($request == null);
        $allEmployeeStatus = $this->employeeStatusService->getAllActiveEmployeeStatus();
        $allCountries = $this->countryService->getAllActiveCountry();
        $allEmployeeType = $this->employeeTypeService->getAllActiveEmployeeType();
        $alldepartmentDetails = $this->departmentService->getAllActiveDepartments();
        $allShifts = $this->shiftService->getAllActiveShifts();
        $allBranches = $this->branchService->all(Auth()->guard('admin')->user()->company_id);
        $allQualification = $this->qualificationService->getAllActiveQualification();
        $allSkills = $this->skillServices->getAllActiveSkills();
        return view('company.employee.index', compact('allUserDetails', 'allEmployeeStatus', 'allCountries', 'allEmployeeType', 'allEmployeeStatus', 'alldepartmentDetails', 'allShifts', 'allBranches', 'allQualification', 'allSkills'));
    }

    public function add()
    {
        $allCountries = $this->countryService->getAllActiveCountry();
        $allPreviousCompany = $this->previousCompanyService->getAllActivePreviousCompany();
        $allQualification = $this->qualificationService->getAllActiveQualification();
        $allEmployeeType = $this->employeeTypeService->getAllActiveEmployeeType();
        $allEmployeeStatus = $this->employeeStatusService->getAllActiveEmployeeStatus();
        $alldepartmentDetails = $this->departmentService->getAllActiveDepartments();
        $allDocumentTypeDetails = $this->documentTypeService->getAllActiveDocumentType();
        $languages =   $this->languagesServices->defaultLanguages();
        $allBranches = $this->branchService->all(Auth()->guard('admin')->user()->company_id);
        $allRoles = $this->roleService->all();
        $allShifts = $this->shiftService->getAllActiveShifts();
        $allAssetCategory = $this->assetCategoryServices->getAllActiveAssetCategory();

        return view(
            'company.employee.add_employee',
            compact(
                'allCountries',
                'allPreviousCompany',
                'allQualification',
                'allEmployeeType',
                'allEmployeeStatus',
                'alldepartmentDetails',
                'allDocumentTypeDetails',
                'languages',
                'allBranches',
                'allRoles',
                'allShifts',
                'allAssetCategory'
            )
        );
    }

    public function edit(User $user)
    {
        
        $allCountries = $this->countryService->getAllActiveCountry();
        $allPreviousCompany = $this->previousCompanyService->getAllActivePreviousCompany();
        $allQualification = $this->qualificationService->getAllActiveQualification();
        $allEmployeeType = $this->employeeTypeService->getAllActiveEmployeeType();
        $allEmployeeStatus = $this->employeeStatusService->getAllActiveEmployeeStatus();
        $alldepartmentDetails = $this->departmentService->getAllActiveDepartments();
        $allDocumentTypeDetails = $this->documentTypeService->getAllActiveDocumentType();
        $allBranches = $this->branchService->all(Auth()->guard('admin')->user()->company_id);
        $allRoles = $this->roleService->all();
        $allShifts = $this->shiftService->getAllActiveShifts();
        $languages =   $this->languagesServices->defaultLanguages();
        $allAssetCategory = $this->assetCategoryServices->getAllActiveAssetCategory();

        // Get employee details to update
        $singleUserDetails = $user->load('assetDetails','familyDetails', 'qualificationDetails', 'advanceDetails', 'bankDetails', 'addressDetails', 'pastWorkDetails', 'documentDetails', 'userDetails');
        return view(
            'company.employee.add_employee',
            compact(
                'allCountries',
                'allPreviousCompany',
                'allQualification',
                'allEmployeeType',
                'allEmployeeStatus',
                'alldepartmentDetails',
                'allDocumentTypeDetails',
                'singleUserDetails',
                'allBranches',
                'allRoles',
                'allShifts',
                'languages',
                'allAssetCategory'
            )
        );
    }

    public function store(EmployeeAddRequest $request)
    {
        try {
            $userDetails = $this->employeeService->create($request->all());
            if ($userDetails) {
                return response()->json([
                    'message' => 'Basic Details Added Successfully! Please Continue',
                    'data' => $userDetails,
                    'allUserDetails' => view('company.employee.list', [
                        'allUserDetails' => $this->employeeService->all()
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function getPersonalDetails($id)
    {
        $data = $this->employeeService->getUserDetailById($id);
        return response()->json(['data' => $data]);
    }

    public function getfilterlist(Request $request)
    {
        try {
            $allUserDetails = $this->employeeService->all($request);
            if ($allUserDetails) {
                return response()->json([
                    'data' => view('company.employee.list', compact('allUserDetails'))->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function view(User $user)
    {
        $singleViewEmployeeDetails = $user->load('assetDetails','familyDetails', 'qualificationDetails', 'advanceDetails', 'bankDetails', 'addressDetails', 'pastWorkDetails', 'documentDetails', 'userDetails');
        return view('company.employee.view', compact('singleViewEmployeeDetails'));
    }
}
