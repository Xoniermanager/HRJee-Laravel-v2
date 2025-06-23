<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Models\User;
use App\Models\UserDetail;
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
use App\Http\Services\UserShiftService;
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
    private $userShiftService;


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
        SalaryService $salaryService,
        UserShiftService $userShiftService
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
        $this->userShiftService = $userShiftService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companyIDs = getCompanyIDs();

        if (Auth()->user()->type == "user") {
            $allUserDetails = $this->userService->getManagedUsers($request == null, Auth()->user()->id)->paginate(10);
        } else {
            $allUserDetails = $this->userService->searchFilterEmployee($request == null, Auth()->user()->company_id)->paginate(10);
        }

        $activeUserCount = $this->userService->getActiveEmployees($companyIDs)->count();

        $activeUserCount = $this->userService->getActiveEmployees($companyIDs)->count();

        $allEmployeeStatus = $this->employeeStatusService->getAllActiveEmployeeStatus();

        $allCountries = $this->countryService->getAllActiveCountry();
        $allEmployeeType = $this->employeeTypeService->getAllActiveEmployeeType();
        $alldepartmentDetails = $this->departmentService->getAllActiveDepartments();
        $allShifts = $this->shiftService->getAllActiveShifts();
        $allBranches = $this->branchService->all($companyIDs);
        $allQualification = $this->qualificationService->getAllActiveQualification();
        $allSkills = $this->skillServices->getAllActiveSkills();
        $allSalaryStructured = $this->salaryService->getAllActiveSalaries(Auth()->user()->company_id);

        return view('company.employee.index', compact('allUserDetails', 'allEmployeeStatus', 'allCountries', 'allEmployeeType', 'allEmployeeStatus', 'alldepartmentDetails', 'allShifts', 'allBranches', 'allQualification', 'allSkills', 'allSalaryStructured', 'activeUserCount'));
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
        $userShifts = [];
        return view(
            'company.employee.add_employee',
            compact('allCountries', 'allPreviousCompany', 'allQualification', 'allEmployeeType', 'allEmployeeStatus', 'alldepartmentDetails', 'allDocumentTypeDetails', 'languages', 'allBranches', 'allRoles', 'allShifts', 'allAssetCategory', 'allSalaryStructured', 'userShifts')
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
        $singleUserDetails = $user->load('details', 'addressDetails', 'bankDetails', 'advanceDetails', 'pastWorkDetails', 'documentDetails', 'qualificationDetails', 'familyDetails', 'skill', 'language', 'assetDetails', 'ctcDetails');
        $allManagers = $this->qualificationService->getAllActiveQualification();
        $userAllShifts = $this->userShiftService->getByUserId([$user->id])->get()->groupBy('shift_day');

        $userShifts = [];
        foreach ($userAllShifts as $key => $shifts) {
            if (str_contains($key, 'day')) {
                foreach ($shifts as $shift) {
                    $userShifts[$key][] = $shift->shift_id;
                }
            } else {
                foreach ($shifts as $shift) {
                    $userShifts[] = $shift->shift_id;
                }
            }
        }

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
                'allSalaryStructured',
                'userShifts'
            )
        );
    }

    public function store(EmployeeAddRequest $request)
    {
        DB::beginTransaction();
        try {
            $companyIDs = getCompanyIDs();
            $activeUserCount = $this->userService->getActiveEmployees($companyIDs)->count();

            if ($activeUserCount >= auth()->user()->companyDetails->company_size) {
                DB::rollBack();
                return response()->json(['error' => 'Company size limit has been exceeded!']);
            }

            $request['company_id'] = Auth()->user()->company_id;
            if (isset($request->id) && !empty($request->id)) {
                $userCreated = $this->userService->updateDetail($request->only('name', 'role_id'), $request->id);
                $request['user_id'] = $request->id;
            } else {
                $payload = $request->only('name', 'password', 'email', 'company_id', 'role_id');
                $payload['created_by'] = Auth()->user()->id;
                $userCreated = $this->userService->create($payload);
                $request['user_id'] = $userCreated->id;
            }
            if ($userCreated) {
                $userDetails = $this->employeeService->create($request->except('password', 'email', '_token', 'company_id'));
                $this->employeeService->addManagers($request['user_id'], $request->get('manager_id'));

                if ($request->get('office_shift_id')) {
                    $this->userShiftService->add($request->get('office_shift_id'), $request['user_id']);
                }

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
            $companyIDs = getCompanyIDs();
            $importedData = Excel::import($import, $request->file('file'));

            $activeUserCount = $this->userService->getActiveEmployees($companyIDs)->count();

            if (($activeUserCount + $import->count) > auth()->user()->companyDetails->company_size) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Company size limit has been exceeded!',
                ], 500);
            }

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

    public function updatePunchInRadius(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'user_id' => 'required|array|min:1',
                'user_id.*' => 'exists:users,id',
                'punch_in_radius' => 'required|numeric|min:500'
            ]);
            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            $updateDetails = UserDetail::whereIn('user_id', $request->user_id)->update(['punch_in_radius' => $request->punch_in_radius]);
            if ($updateDetails) {
                return response()->json([
                    'status' => true,
                    'message' => 'PunchIn radius Updated Successfully'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unable tp Updated PunchIn radius! Please try Again'
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getAllManager(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $departmentIds = $request->department_id;

        $allManagers = $this->userService->getAllManagerByDepartmentId($companyIDs, $departmentIds);

        if (isset($allManagers) && count($allManagers) > 0) {
            $response = [
                'status' => true,
                'data' => $allManagers
            ];
        } else {
            $response = [
                'status' => false,
                'error' => 'No manager found this department'
            ];
        }
        return json_encode($response);
    }

    public function getAllEmployeesByDepartment(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $departmentIds = $request->department_ids;

        $allEmployees = $this->userService->getAllEmployeesByDepartmentId($companyIDs, $departmentIds);

        if (isset($allEmployees) && count($allEmployees) > 0) {
            $response = [
                'status' => true,
                'data' => $allEmployees
            ];
        } else {
            $response = [
                'status' => false,
                'data' => [],
                'error' => 'No employee found this department'
            ];
        }

        return response()->json($response);
    }
}
