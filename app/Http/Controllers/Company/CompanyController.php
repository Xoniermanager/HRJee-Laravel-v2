<?php

namespace App\Http\Controllers\Company;

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
use App\Models\Company;

class CompanyController extends Controller
{


    private $company_services;
    private $branch_services;

    public function __construct(
        CompanyServices $company_services,
        BranchServices $branch_services
    ) {
        $this->company_services  = $company_services;
        $this->branch_services = $branch_services;
    }
    /**
     * Display a listing of the resource.
     */
    public function company_profile()
    {
        if (empty(Auth::guard('admin')->user()->branch_id))
            $companyID = Auth::guard('admin')->user()->company_id;
        else
            $companyID = Auth::guard('admin')->user()->branch_id;


        $companyDetails =  $this->company_services->get_company_with_branch_details($companyID);
        $companyBranch = $companyDetails->branches->where('type', 'primary')->first();
        return view('company.company.company_profile', compact('companyDetails', 'companyBranch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_company(ValidateUpdateCompanyRequest $request)
    {
        try {
            $data = request()->except(['_token']);
            if ($request->logo !== null) {
                $upload_path = "/uploads";
                $image =  $data['logo'];
                $filePath = uploadingImageorFile($image, $upload_path, 'company_profile');
                if ($filePath) {
                    $data['logo'] = $filePath;
                }
            }


            $updatedCompany = $this->company_services->update_company($data);
            if ($updatedCompany) {
                smilify('success', 'Profile Updated Successfully!');
                return redirect()->route('company.profile');
            }
        } catch (\Exception $e) {
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
            smilify('success', 'The old password is incorrect.');
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
