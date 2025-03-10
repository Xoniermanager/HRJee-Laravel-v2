<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Models\User;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\DB;
use App\Jobs\EmployeeExportFileJob;
use App\Http\Controllers\Controller;
use App\Http\Services\RolesServices;
use App\Http\Services\SalaryService;
use App\Http\Services\ShiftServices;
use App\Http\Services\SkillsService;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Services\BranchServices;
use App\Http\Services\CountryServices;
use App\Http\Services\EmployeeServices;
use App\Http\Services\CustomRoleService;
use App\Http\Services\LanguagesServices;
use App\Http\Requests\EmployeeAddRequest;
use App\Http\Services\DepartmentServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\DocumentTypeService;
use App\Http\Services\EmployeeTypeService;
use App\Http\Services\AssetCategoryService;
use App\Http\Services\QualificationService;
use App\Http\Services\EmployeeStatusService;
use App\Http\Services\PreviousCompanyService;

class EmployeeController extends Controller
{
    private $countryService;
    private $userService;
    private $previousCompanyService;
    private $qualificationService;
    private $employeeTypeService;
    private $employeeStatusService;
    private $departmentService;
    private $documentTypeService;
    private $employeeService;
    private $branchService;
    private $roleService;
    private $customRoleService;
    private $shiftService;
    private $languagesServices;
    private $skillServices;
    private $assetCategoryServices;
    private $salaryService;
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
        AssetCategoryService $assetCategoryServices,
        CustomRoleService $customRoleService,
        UserService $userService,
        SalaryService $salaryService

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
        $this->customRoleService = $customRoleService;
        $this->shiftService = $shiftService;
        $this->languagesServices = $languagesServices;
        $this->skillServices = $skillServices;
        $this->assetCategoryServices = $assetCategoryServices;
        $this->userService = $userService;
        $this->salaryService = $salaryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companyIDs = getCompanyIDs();

        if(Auth()->user()->type == "user") {
            $allUserDetails = $this->userService->getManagedUsers($request == null, Auth()->user()->id)->paginate(10);
        } else {
            $allUserDetails = $this->userService->searchFilterEmployee($request == null, Auth()->user()->company_id)->paginate(10);
        }
        
        $allEmployeeStatus = $this->employeeStatusService->getAllActiveEmployeeStatus();
        $allCountries = $this->countryService->getAllActiveCountry();
        $allEmployeeType = $this->employeeTypeService->getAllActiveEmployeeType();
        $alldepartmentDetails = $this->departmentService->getAllActiveDepartments();
        $allShifts = $this->shiftService->getAllActiveShifts();
        $allBranches = $this->branchService->all($companyIDs);
        $allQualification = $this->qualificationService->getAllActiveQualification();
        $allSkills = $this->skillServices->getAllActiveSkills();
        $allSalaryStructured = $this->salaryService->getAllActiveSalaries(Auth()->user()->company_id);

        return view('company.employee.index', compact('allUserDetails', 'allEmployeeStatus', 'allCountries', 'allEmployeeType', 'allEmployeeStatus', 'alldepartmentDetails', 'allShifts', 'allBranches', 'allQualification', 'allSkills','allSalaryStructured'));
    }

    public function add()
    {

        $allCountries = $this->countryService->getAllActiveCountry();
        $allPreviousCompany = $this->previousCompanyService->getAllActivePreviousCompany();
        $allQualification = $this->qualificationService->getAllActiveQualification();
        $allEmployeeType = $this->employeeTypeService->getAllActiveEmployeeType();
        $allEmployeeStatus = $this->employeeStatusService->getAllActiveEmployeeStatus();
        $alldepartmentDetails = $this->departmentService->getAllActiveDepartmentsByCompanyId(Auth()->user()->company_id);
        $allDocumentTypeDetails = $this->documentTypeService->getAllActiveDocumentType();
        $languages = $this->languagesServices->defaultLanguages();
        $allBranches = $this->branchService->all([Auth()->user()->company_id]);
        $allRoles = $this->customRoleService->all(auth()->user()->company_id);
        $allShifts = $this->shiftService->getAllActiveShifts();
        $allAssetCategory = $this->assetCategoryServices->getAllActiveAssetCategory();
        $allSalaryStructured = $this->salaryService->getAllActiveSalaries(Auth()->user()->company_id);
        return view(
            'company.employee.add_employee',
            compact('allCountries', 'allPreviousCompany', 'allQualification', 'allEmployeeType', 'allEmployeeStatus', 'alldepartmentDetails', 'allDocumentTypeDetails', 'languages', 'allBranches', 'allRoles', 'allShifts', 'allAssetCategory','allSalaryStructured')
        );
    }

    public function edit(User $user)
    {
        $allCountries = $this->countryService->getAllActiveCountry();
        $allPreviousCompany = $this->previousCompanyService->getAllActivePreviousCompany();
        $allQualification = $this->qualificationService->getAllActiveQualification();
        $allEmployeeType = $this->employeeTypeService->getAllActiveEmployeeType();
        $allEmployeeStatus = $this->employeeStatusService->getAllActiveEmployeeStatus();
        $alldepartmentDetails = $this->departmentService->getAllActiveDepartmentsByCompanyId(Auth()->user()->company_id);
        $allDocumentTypeDetails = $this->documentTypeService->getAllActiveDocumentType();
        $allBranches = $this->branchService->all([Auth()->user()->id]);
        $allRoles = $this->customRoleService->all(Auth()->user()->company_id);
        $allShifts = $this->shiftService->getAllActiveShifts();
        $languages = $this->languagesServices->defaultLanguages();
        $allAssetCategory = $this->assetCategoryServices->getAllActiveAssetCategory();
        $allSalaryStructured = $this->salaryService->getAllActiveSalaries(Auth()->user()->company_id);
        $singleUserDetails = $user->load('details', 'addressDetails', 'bankDetails', 'advanceDetails', 'pastWorkDetails', 'documentDetails', 'qualificationDetails', 'familyDetails', 'skill', 'language', 'assetDetails','ctcDetails');
        $allManagers = $this->qualificationService->getAllActiveQualification();

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
                'allAssetCategory',
                'allSalaryStructured'
            )
        );
    }

    public function store(EmployeeAddRequest $request)
    {
        DB::beginTransaction();
        try {
            $request['company_id'] = Auth()->user()->company_id;
            if (isset($request->id) && !empty($request->id)) {
                $userCreated = $this->userService->updateDetail($request->only('name', 'role_id'), $request->id);
                $request['user_id'] = $request->id;
            } else {
                $userCreated = $this->userService->create($request->only('name', 'password', 'email', 'company_id', 'role_id'));
                $request['user_id'] = $userCreated->id;
            }
            if ($userCreated) {

                $userDetails = $this->employeeService->create($request->except('password', 'email', '_token', 'company_id'));
                $this->employeeService->addManagers($request['user_id'], $request->get('manager_id'));

                DB::commit();
                return response()->json([
                    'message' => 'Basic Details Added Successfully! Please Continue',
                    'data' => $userDetails,
                    'allUserDetails' => view('company.employee.list', [
                        'allUserDetails' => $this->userService->searchFilterEmployee('', Auth()->user()->company_id)->paginate(10)
                    ])->render()
                ]);
            } else {
                DB::rollBack();
                return response()->json(['error' => 'Please try again later!']);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getPersonalDetails($id)
    {
        $data = $this->userService->getUserById($id);
        return response()->json(['data' => $data, 'details' => $data->details]);
    }

    public function getfilterlist(Request $request)
    {
        try {
            $allUserDetails = $this->userService->searchFilterEmployee($request, Auth()->user()->company_id)->paginate(10);
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
        $singleViewEmployeeDetails = $user->load('details', 'addressDetails', 'bankDetails', 'advanceDetails', 'pastWorkDetails', 'documentDetails', 'qualificationDetails', 'familyDetails', 'skill', 'language', 'assetDetails');

        return view('company.employee.view', compact('singleViewEmployeeDetails'));
    }

    public function deleteEmployee(User $user)
    {
        try {
            $statusValue = '0';
            $user->update(['status' => $statusValue]);
            $updateDetails = $user->details->update(['exit_date' => now()->format('Y-m-d'), 'status' => $statusValue]);
            if ($updateDetails) {
                $allUserDetails = $this->userService->searchFilterEmployee('', Auth()->user()->company_id)->paginate(10);

                return response()->json([
                    'data' => view('company.employee.list', compact('allUserDetails'))->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function statusUpdate(Request $request, $userId)
    {
        try {
            $updateStatus = $this->userService->updateStatus($userId, $request->status);
            if ($updateStatus) {
                return response()->json([
                    'status' => true,
                    'message' => "Employee status updated successfully."
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Unable to update the status. Please try again."
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function exitEmployeeList()
    {
        $allEmployeeExitDetails = $this->employeeService->getExitEmployeeList(Auth()->user()->company_id);
        return view('company.exit_employee.index', compact('allEmployeeExitDetails'));
    }

    public function searchFilterForExitEmployee(Request $request)
    {
        try {
            $allEmployeeExitDetails = $this->employeeService->searchFilterForExitEmployee(Auth()->user()->company_id, $request->all());
            return response()->json([
                'data' => view('company.exit_employee.list', compact('allEmployeeExitDetails'))->render()
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function exportEmployee(Request $request)
    {
        try {
            $allEmployeeDetails = $this->userService->searchFilterEmployee($request, Auth()->user()->company_id)->get();
            if (isset($allEmployeeDetails) && count($allEmployeeDetails) > 0) {
                $userEmail = Auth()->user()->email;
                $userName = Auth()->user()->name;
                EmployeeExportFileJob::dispatch($userEmail, $userName, $allEmployeeDetails);
                return response()->json([
                    'status' => true,
                    'message' => 'The file is being processed and will be sent to your email shortly.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No Employee Available'
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function uploadImport(Request $request)
    {
        // Validate that the file is uploaded
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'The file is required and must be an Excel or CSV file.'
            ], 400);
        }
        $import = new UserImport();
        try {
            Excel::import($import, $request->file('file'));
            $failures = $import->getFailures();
            if (count($failures) > 0) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $failures,
                ]);
            }
            $allUserDetails = $this->userService->searchFilterEmployee('', Auth()->user()->company_id)->paginate(10);
            return response()->json([
                'status' => 'success',
                'message' => 'Employee imported successfully!',
                'data' => view('company.employee.list', compact('allUserDetails'))->render()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while importing the file.',
            ], 500);
        }
    }
}
