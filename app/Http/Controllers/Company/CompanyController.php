<?php

namespace App\Http\Controllers\Company;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\BranchServices;
use App\Http\Services\CompanyServices;
use App\Http\Services\FileUploadService;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Requests\ValidateUpdateCompanyRequest;

class CompanyController extends Controller
{

    
    private $company_services;
    private $fileUploadService;
    private $branch_services;

    public function __construct(
        CompanyServices $company_services,
        FileUploadService $fileUploadService,
        BranchServices $branch_services)
        
    {
            $this->company_services  = $company_services;
            $this->fileUploadService = $fileUploadService;
            $this->branch_services = $branch_services;
    }
    /**
     * Display a listing of the resource.
     */
    public function company_profile()
    {
        $companyID      =  Auth::guard('admin')->user()->id;
        $companyDetails =  $this->company_services->get_company_with_branch_details($companyID);
        $companyBranch  =  $companyDetails->branches->firstWhere('branch_type','primary');
        $states = DB::table('states')->get();
        $countries = DB::table('countries')->get();
        return view('company.company.company_profile',compact('companyDetails','companyBranch','countries','states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_company(ValidateUpdateCompanyRequest $request)
    {
        try{
            $data = request()->except(['_token']);
            if ($request->logo !== null) {
                $upload_path = "/uploads";
                $image =  $data['logo'];
                $imagePath = $this->fileUploadService->imageUpload($image, $upload_path);
                if ($imagePath) {
                    $data['logo'] = $imagePath;
                }
            }        
        $updatedCompany = $this->company_services->update_company($data);
        if($updatedCompany)
        {    
        smilify('success','Profile Updated Successfully!');
        return redirect()->route('company.profile');
        }
    }
    catch(\Exception $e)
    {
        return $e->getMessage();
    }
    }
    public function company_change_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed', // Ensure new password matches the confirmation field
        ]);
        $companyUser = Auth::guard('admin')->user();
        if (!Hash::check($request->old_password, $companyUser->password)) {
            smilify('success','The old password is incorrect.');
            return false;
        }

        $companyUser->password = Hash::make($request->new_password);
        $companyUser->save();
        return true;
    }

    // public function update_branch(Request $request, $id)
    // {
    //     try {
    //         $data =  $request->except(['_token']);
    //         $branchUpdated = $this->branch_services->update_branch($data,$id);
    //         if(   $branchUpdated )
    //         {
    //            smilify('success','Branch Updated Successfully!');
    //            return redirect('/branch');
    //         }
            
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
  
}
