<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Models\User;
use App\Models\Employee;
use App\Models\UserAddress;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use App\Models\UserBankDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\BranchServices;
use App\Http\Requests\ValidateEmployee;
use App\Http\Services\EmployeeServices;
use App\Http\Services\FileUploadService;
use App\Http\Services\DepartmentServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\DesignationServices;

class EmployeeController extends Controller
{
    private $employee_services; 
    private $departments_services;
    private $designation_services;
    private $branch_services;
    private $fileUploadService;
    public function __construct(
        EmployeeServices $employee_services, 
        DepartmentServices $departments_services,
        DesignationServices $designation_services,
        BranchServices $branch_services, 
        FileUploadService $fileUploadService
        )
    {
            $this->employee_services    = $employee_services;
            $this->departments_services = $departments_services;
            $this->designation_services = $designation_services; 
            $this->branch_services      = $branch_services;
            $this->fileUploadService    = $fileUploadService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $employees = $this->employee_services->get_employee();
        $employees = array();
        return view('company.employee.employee-list',compact('employees'));
    }
    public function view_employee($id)
    {
        try{
            $employee = $this->employee_services->get_employee_all_details_by_id($id);
            if (!$employee) {
                smilify('error','Item Does Not Exists !');
                return redirect('/employees');
            }
             return view('company.employee.employee-view', compact('employee'));
        }
            catch (Exception $e) {
                return $e->getMessage();
            }
    }


    public function employee_form()
    {
        // $departments  = $this->departments_services->all();
        // $designations = $this->designation_services->all();
        // $branches = $this->branch_services->get_branches();
        // return view('company.employee.create-employee-form', compact('departments','designations','branches'));
    
        return view('company.employee.create');
    }

    public function add_employee(ValidateEmployee $request)
    {
        $data = $request->all();
        return  $data;

        if ($request->file('profile_image') !== null) {
            $upload_path = "/uploads";
            $image =  $data['profile_image'];
            $imagePath = $this->fileUploadService->imageUpload($image, $upload_path);
            if ($imagePath) {
                $data['profile_image'] = $imagePath;
            }
        }

        DB::beginTransaction(); 
        try
        {    
        $userPayload  = [
            'full_name' =>  $data['full_name'],
            'email' =>  $data['email'] ,
            'password' =>  Hash::make($data['password']), 
            'phone' =>  $data['phone'],
            'profile_image' =>  $data['profile_image'],
           // 'joining_date' =>  $data['joining_date'],
            //'employee_id' =>  $data['employee_id'],
            // 'role_id' =>  null,    // TODO  comes from session when compnay logged in 
            'company_id' =>  null, // TODO  comes from session when compnay logged in 
        ];
    
        $user = User::create($userPayload);
        $userDetailPayload  = [
            'user_id' => $user->id,
            'gender' =>  $data['gender'] ,
            'date_of_birth' =>  $data['date_of_birth'],
            'department_id' =>  $data['department_id'],
            'designation_id' =>  $data['designation_id'],
            'manager_id'     =>  $data['manager_id']??1,
            'gurdian_name' =>    $data['father_name'],
            'gurdian_contact' => $data['family_contact_number'] ,
            'company_id' =>  null, // TODO  comes from session when compnay logged in 
            'aadhar_no' => $data['aadhar_no'],
            'country_id' =>  1,
            'resume' =>  $resume = $data['resume'] ?? null ,
            'offer_letter' =>  $data['offer_letter']  ?? null,
            'joining_letter' =>  $data['joining_letter']  ?? null,
            'contract_document' =>  null,
            'exit_date' => null,
            'Salary' =>  null,
        ];
        $userDetails = UserDetails::create($userDetailPayload);
        $userBankDetailPayload  = [
            'user_id' => $user->id,
            'account_name' =>  $data['account_name'] ,
            'account_number' =>  $data['account_number'],
            'bank_name' =>  $data['bank_name'],
            'ifsc_code' =>  $data['ifsc_code'],
            'pan_no' =>  $data['pan_no'],
            'uan_no' =>  $data['uan_no'],
        ];
        $userBankDetails = UserBankDetails::create($userBankDetailPayload);
        UserAddress::create([
            'address_type' => 'parmanent_address',
            'user_id' => $user->id,
            'address' => $data['permanent_address'],
            'city' => $data['permanent_city'],
            'state' => $data['permanent_state'],
            'pin_code' => $data['permanent_pincode'],
        ]);
    
        UserAddress::create([
            'address_type' => 'temporary_address',
            'user_id' => $user->id, 
            'address' => $data['temporary_address'],
            'city' => $data['temporary_city'],
            'state' => $data['temporary_state'],
            'pin_code' => $data['temporary_pincode'],
        ]);
        DB::commit();

        if ($user && $userDetails && $userBankDetails) { 
            // All creations were successful
            smilify('success', 'Employee Created Successfully!');
            return redirect('/employee');
        }
    }
    catch (Exception $e) {
        DB::rollback();
        return $e->getMessage();
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_employee($id)
    {;
        try{
        $departments  = $this->departments_services->get_departments();
        $designations = $this->designation_services->get_designations();
        $branches = $this->branch_services->get_branches();
        $employee = $this->employee_services->get_employee_all_details_by_id($id);
        if (!$employee) {
            smilify('error','Item Does Not Exists !');
            return redirect('/employees');
        }
         return view('company.employee.create-employee-form', compact('employee','departments','designations','branches'));
    }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update_employees(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_employee($id)
    {
        try {
        $validateemployee = Validator::make(['id' => $id],
            ['id' => 'required|exists:users,id']
        );
        if ($validateemployee->fails()) {
            smilify('error','Item Does Not Exists !');
            return redirect('/employee');
        }
        $response  = $this->employee_services->delete_employee_by_id($id);
        if($response)
        {
            smilify('success','employee Deleted Successfully!');
            return redirect('/employee');
        }
    }
    catch (Exception $e) {
        return $e->getMessage();
    }
    }
}
