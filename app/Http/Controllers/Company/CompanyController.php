<?php

namespace App\Http\Controllers\Company;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\BranchServices;
use App\Http\Services\FileUploadService;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Services\CompanyDetailService;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\ValidateUpdateCompanyRequest;

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
        return view('company.company.company_profile');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_company(ValidateUpdateCompanyRequest $request)
    {
        try {
            $data = request()->except(['_token']);


            $this->userService->updateDetail(['name' => $data['name']], auth()->id());
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
                return redirect(route('company.profile'))->with('success', 'Profile Updated Successfully!');

                // smilify('success', 'Profile Updated Successfully!');

                // return redirect()->route('company.profile');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
