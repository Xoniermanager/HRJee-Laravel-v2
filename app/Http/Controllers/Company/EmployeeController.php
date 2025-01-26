<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Models\User;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use App\Jobs\EmployeeExportFileJob;
use App\Http\Controllers\Controller;
use App\Http\Services\RolesServices;
use App\Http\Services\ShiftServices;
use App\Http\Services\SkillsService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Services\BranchServices;
use App\Http\Services\CountryServices;
use App\Http\Services\EmployeeServices;
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
        $allUserDetails = $this->employeeService->all($request == null, Auth::guard('company')->user()->company_id)->paginate(10);
        $allEmployeeStatus = $this->employeeStatusService->getAllActiveEmployeeStatus();
        $allCountries = $this->countryService->getAllActiveCountry();
        $allEmployeeType = $this->employeeTypeService->getAllActiveEmployeeType();
        $alldepartmentDetails = $this->departmentService->getAllActiveDepartments();
        $allShifts = $this->shiftService->getAllActiveShifts();
        $allBranches = $this->branchService->all(Auth()->guard('company')->user()->company_id);
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
        $languages = $this->languagesServices->defaultLanguages();
        $allBranches = $this->branchService->all(Auth()->guard('company')->user()->company_id);
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
        $allBranches = $this->branchService->all(Auth()->guard('company')->user()->company_id);
        $allRoles = $this->roleService->all();
        $allShifts = $this->shiftService->getAllActiveShifts();
        $languages = $this->languagesServices->defaultLanguages();
        $allAssetCategory = $this->assetCategoryServices->getAllActiveAssetCategory();
        // Get employee details to update
        $singleUserDetails = $user->load('officeShift', 'language', 'skill', 'assetDetails', 'familyDetails', 'qualificationDetails', 'advanceDetails', 'bankDetails', 'addressDetails', 'pastWorkDetails', 'documentDetails');
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
                        'allUserDetails' => $this->employeeService->all('', Auth::guard('company')->user()->company_id)->paginate(10)
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
            $allUserDetails = $this->employeeService->all($request, Auth::guard('company')->user()->company_id)->paginate(10);
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
        $singleViewEmployeeDetails = $user->load('assetDetails', 'familyDetails', 'qualificationDetails', 'advanceDetails', 'bankDetails', 'addressDetails', 'pastWorkDetails', 'documentDetails');
        return view('company.employee.view', compact('singleViewEmployeeDetails'));
    }

    public function deleteEmployee(User $user)
    {
        try {
            $updateDetails = $user->update(['exit_date' => now()->format('Y-m-d'), 'status' => '0']);
            if ($updateDetails) {
                $deleteDetails = $user->delete();

                if ($deleteDetails) {
                    // Fetch all user details after deletion
                    $allUserDetails = $this->employeeService->all('', Auth::guard('company')->user()->company_id)->paginate(10);

                    return response()->json([
                        'data' => view('company.employee.list', compact('allUserDetails'))->render()
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function statusUpdate(Request $request, $userId)
    {
        try {
            $updateStatus = User::find($userId)->update(['status' => $request->status]);
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
        $allEmployeeExitDetails = $this->employeeService->getExitEmployeeList(Auth::guard('company')->user()->company_id);
        return view('company.exit_employee.index', compact('allEmployeeExitDetails'));
    }

    public function searchFilterForExitEmployee(Request $request)
    {
        try {
            $allEmployeeExitDetails = $this->employeeService->searchFilterForExitEmployee(Auth::guard('company')->user()->company_id, $request->all());
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
            $allEmployeeDetails = $this->employeeService->all($request, Auth::guard('company')->user()->company_id)->get();
            // $userEmail = Auth::guard('company')->user()->email;
            $userEmail = "arjun@xoniertechnologies.com";
            $userName = "Xonier";
            EmployeeExportFileJob::dispatch($userEmail, $userName, $allEmployeeDetails);
            return response()->json([
                'status' => true,
                'message' => 'The file is being processed and will be sent to your email shortly.'
            ]);
        } catch (Exception $e) {
            // Return error response if there is an exception
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function uploadImport(Request $request)
    {
        // Validate that the file is uploaded
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'The file is required and must be an Excel or CSV file.'
            ], 400);
        }

        $import = new UserImport();

        try {
            // Try to import the file
            Excel::import($import, $request->file('file'));
            // If there are validation failures, return them as JSON
            $failures = $import->getFailures();
            if (count($failures) > 0) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $failures,
                ]);
            }
            // No errors, return success message
            return response()->json([
                'status' => 'success',
                'message' => 'Employee imported successfully!',
            ]);
        } catch (\Exception $e) {
            // Catch any general exceptions and return an error message
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while importing the file.',
            ], 500);
        }
    }
}
