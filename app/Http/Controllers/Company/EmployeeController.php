<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Services\RolesServices;
use App\Http\Services\ShiftServices;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\BranchServices;
use App\Http\Services\CountryServices;
use App\Http\Services\EmployeeServices;
use App\Http\Services\LanguagesServices;
use App\Http\Requests\EmployeeAddRequest;
use App\Http\Services\DepartmentServices;
use App\Http\Services\DocumentTypeService;
use App\Http\Services\EmployeeTypeService;
use App\Http\Services\QualificationService;
use App\Http\Services\EmployeeStatusService;
use App\Http\Services\PreviousCompanyService;

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
        LanguagesServices $languagesServices

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

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.employee.index');
    }

    public function add()
    {
        $allCountries = $this->countryService->all()->where('status', '1');
        $allPreviousCompany = $this->previousCompanyService->all()->where('status', '1');
        $allQualification = $this->qualificationService->all()->where('status', '1');
        $allEmployeeType = $this->employeeTypeService->all()->where('status', '1');
        $allEmployeeStatus = $this->employeeStatusService->all()->where('status', '1');
        $alldepartmentDetails = $this->departmentService->all()->where('status', '1');
        $allDocumentTypeDetails = $this->documentTypeService->all()->where('status', '1');
        $languages =   $this->languagesServices->defaultLanguages();
        $allBranches = $this->branchService->get_branches();
        $allRoles = $this->roleService->get_roles();
        $allShifts = $this->shiftService->all()->where('status', '1');

        return view(
            'company.employee.add_employee',
            compact(
                'allCountries',
                'allPreviousCompany',
                'allQualification',
                'allEmployeeType',
                'allEmployeeStatus',
                'alldepartmentDetails',
                'allDocumentTypeDetails','languages',
                'allBranches',
                'allRoles',
                'allShifts'
            )
        );
    }

    public function edit(User $user)
    {
        $allCountries = $this->countryService->all()->where('status', '1');
        $allPreviousCompany = $this->previousCompanyService->all()->where('status', '1');
        $allQualification = $this->qualificationService->all()->where('status', '1');
        $allEmployeeType = $this->employeeTypeService->all()->where('status', '1');
        $allEmployeeStatus = $this->employeeStatusService->all()->where('status', '1');
        $alldepartmentDetails = $this->departmentService->all()->where('status', '1');
        $allDocumentTypeDetails = $this->documentTypeService->all()->where('status', '1');
        $allBranches = $this->branchService->get_branches();
        $allRoles = $this->roleService->get_roles();
        $allShifts = $this->shiftService->all()->where('status', '1');
        $languages =   $this->languagesServices->defaultLanguages();


        // Get employee details to update
        $singleUserDetails = $user->load('familyDetails', 'qualificationDetails', 'advanceDetails', 'bankDetails', 'addressDetails', 'pastWorkDetails', 'documentDetails', 'userDetails');
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
                'languages'
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
                    'data' => $userDetails
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
