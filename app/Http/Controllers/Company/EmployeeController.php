<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\CountryServices;
use App\Http\Services\EmployeeServices;
use App\Http\Services\FileUploadService;
use App\Http\Services\DepartmentServices;
use Illuminate\Support\Facades\Validator;
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


    public function __construct(
        CountryServices $countryService,
        PreviousCompanyService $previousCompanyService,
        QualificationService $qualificationService,
        EmployeeTypeService $employeeTypeService,
        EmployeeStatusService $employeeStatusService,
        DepartmentServices $departmentService,
        DocumentTypeService $documentTypeService,
        EmployeeServices $employeeService

    ) {
        $this->countryService                       = $countryService;
        $this->previousCompanyService               = $previousCompanyService;
        $this->qualificationService                 = $qualificationService;
        $this->employeeTypeService                  = $employeeTypeService;
        $this->employeeStatusService                = $employeeStatusService;
        $this->departmentService                    = $departmentService;
        $this->documentTypeService                  = $documentTypeService;
        $this->employeeService                      = $employeeService;
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
        
        return view('company.employee.add_employee', compact('allCountries', 'allPreviousCompany', 'allQualification', 'allEmployeeType', 'allEmployeeStatus', 'alldepartmentDetails', 'allDocumentTypeDetails'));
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

        // Get employee details to update
        $userDetails = $user->load('qualificationDetails','advanceDetails','bankDetails','addressDetails','pastWorkDetails','documentDetails');
        // dd($userDetails->qualificationDetails);
        return view('company.employee.add_employee', compact('allCountries', 'allPreviousCompany', 'allQualification', 
        'allEmployeeType', 'allEmployeeStatus', 'alldepartmentDetails', 'allDocumentTypeDetails','userDetails'));
    }

    public function store(Request $request)
    {
        try {
            $validateBasicDetails  = Validator::make($request->all(), [
                'name'                => ['required', 'string'],
                'email'               => ['required', 'unique:users,email'],
                'password'            => ['required', 'string'],
                'official_email_id'   => ['required', 'unique:users,official_email_id'],
                'blood_group'         => ['required', 'in:A-,A+,B-,B+,O-,O+'],
                'gender'              => ['required', 'in:M,F,O'],
                'marital_status'      => ['required', 'in:M,S'],
                'employee_status_id'  => ['required', 'exists:employee_statuses,id'],
                'date_of_birth'       => ['required', 'date'],
                'joining_date'        => ['required', 'date'],
                'phone'               => ['required', 'min:10', 'numeric'],
                'profile_image'       => ['required', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            ]);
            if ($validateBasicDetails->fails()) {
                return response()->json(['error' => $validateBasicDetails->messages()], 400);
            }
            $data = $request->all();
           
            $nameForImage = removingSpaceMakingName($data['name']);
            $data['password'] = Hash::make($request->password);
            $data['company_id'] = Auth()->user()->id;
            $data['last_login_ip'] = request()->ip();
            if ($data['profile_image']) {
                $upload_path = "/user_profile_picture";
                $file_upload_service = new FileUploadService();
                $image = $request->file('profile_image');
                $imagePath = $file_upload_service->imageUpload($image, $upload_path, $nameForImage);
                if ($imagePath) {
                    $data['profile_image'] = $imagePath;
                }
            }
            $createData = $this->employeeService->create($data);
            if ($createData) {
                return response()->json([
                    'message' => 'Basic Details Added Successfully! Please Continue',
                    'data'    => $createData
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
