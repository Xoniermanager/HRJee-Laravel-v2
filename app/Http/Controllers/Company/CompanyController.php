<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\BranchServices;
use App\Http\Services\CompanyDetailService;
use App\Http\Services\UserService;
use App\Http\Services\FileUploadService;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Requests\ValidateUpdateCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{


    private $branchService;
    private $userService;
    private $companyDetailService;

    public function __construct(
        BranchServices $branchService,CompanyDetailService $companyDetailService, UserService $userService
    ) {
        $this->branchService = $branchService;
        $this->userService = $userService;
        $this->companyDetailService = $companyDetailService;
    }
    /**
     * Display a listing of the resource.
     */
    public function company_profile()
    {  
        $companyDetails = $this->companyDetailService->get_company_by_id(auth()->id());
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
            

            $this->userService->updateDetail(['name' => $data['name'],'email' => $data['email']], auth()->id());
            $detailPayload = [
                'username' => $data['username'],
                'contact_no' => $data['contact_no'],
            ];
            if ($request->logo !== null) {
                $upload_path = "/uploads";
                $image = $data['logo'];
                $filePath = uploadingImageorFile($image, $upload_path, 'company_profile');
                if ($filePath) {
                    $detailPayload['logo'] = $filePath;
                }
            }
            $updatedCompany = $this->companyDetailService->updateCompanyDetails($detailPayload, auth()->id());
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
        $companyUser = Auth()->user();
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
    //         $branchUpdated = $this->branchService->update_branch($data,$id);
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
