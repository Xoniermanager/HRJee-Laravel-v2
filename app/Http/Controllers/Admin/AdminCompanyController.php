<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Services\MenuService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidateCompany;
use App\Http\Services\CompanyServices;
use App\Repositories\CompanyRepository;
use App\Http\Services\CompanyUserService;

class AdminCompanyController extends Controller
{

    private $companyServices;
    private $companyUserService;
    private $menuServices;
    private $companyRepository;
    public function __construct(CompanyServices $companyServices, CompanyUserService $companyUserService, MenuService $menuServices, CompanyRepository $companyRepository)
    {
        $this->companyServices = $companyServices;
        $this->companyUserService = $companyUserService;
        $this->menuServices = $menuServices;
        $this->companyRepository = $companyRepository;
    }
    public function index()
    {
        return view('admin.company.index', [
            'allCompaniesDetails' => $this->companyServices->all()
        ]);
    }


    public function add_company()
    {
        return view('admin.company.add_company');
    }

    public function edit_company(Request $request)
    {
        $companyDetails = $this->companyServices->get_company_by_id($request->query('id'));
        return view('admin.company.edit_company', ['companyDetails' => $companyDetails]);
    }

    public function store(ValidateCompany $request)
    {
        // dd($request->all());
        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $nameForImage = removingSpaceMakingName($request->name);
            $upload_path = "/company_profile";
            $filePath = uploadingImageorFile($request->logo, $upload_path, $nameForImage);
            $request->merge(['logo' => $filePath]);
        }
        $request->merge([
            'joining_date' => Carbon::today()->toDateString(),
        ]);
        $createdCompany = $this->companyServices->create($request->except('_token', 'password', 'password_confirmation'));

        if (isset($createdCompany) && $createdCompany->id != '') {
            $data['company_id'] = $createdCompany->id;
            $data['name'] = $request->name;
            $data['password'] = Hash::make($request->password);
            $data['email'] = $request->email;

            $this->companyUserService->create($data);
            return response()->json([
                'success' => 'Company Created Successfully',
            ]);
        } else {
            return response()->json([
                'error' => 'Please try again after sometime!',
            ]);
        }
    }

    public function update_company(Request $request)
    {
        // dd($request->all());


        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255,',
            'username' => 'sometimes|required|string|max:255',
            'contact_no' => 'sometimes|required|string|max:20',
            'email' => 'sometimes|required|string|email|max:255|unique:companies,email,' . $request->company_id . '',
            'password' => 'sometimes|required|confirmed',
            'password_confirmation' => 'sometimes|required',
            'company_size' => 'sometimes|required|string',
            'company_url' => 'sometimes|required|string|url|max:100',
            'company_address' => 'sometimes|sometimes|required|string|max:255',
            'industry_type' => 'sometimes|required|string|max:255',
            'logo' => 'sometimes|max:2048',
        ]);
        if ($request->hasFile('logo')) {
            $nameForImage = removingSpaceMakingName($request->name);
            $upload_path = "/company_profile";
            $filePath = uploadingImageorFile($request->logo, $upload_path, $nameForImage);
            $request->merge(['logo' => $filePath]);
        }
        $request->merge([
            'joining_date' => Carbon::today()->toDateString(),
        ]);
        $createdCompany = $this->companyServices->updateDetails($request->except('_token', 'password', 'password_confirmation'), $request->company_id);

        if ($createdCompany) {
            $data['name'] = $request->name;
            $data['email'] = $request->email;

            $this->companyUserService->updateDetailsByCompanyId($data, $request->company_id);
            return response()->json([
                'success' => 'Company Updated Successfully',
            ]);
        } else {
            return response()->json([
                'error' => 'Please try again after sometime!',
            ]);
        }
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        $deleted = $this->companyUserService->deleteCompanyUserByCompanyId($id);
        if ($deleted) {
            $data = $this->companyServices->deleteDetails($id);
            if ($data) {
                return response()->json([
                    'success' => 'Company Deleted Successfully',
                    'data'   =>  view("admin.company.company_list", [
                        'allCompaniesDetails' => $this->companyServices->all()
                    ])->render()
                ]);
            }
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {
        $searchedItems = $this->companyServices->searchInCompany($request->all());
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("admin.company.company_list", [
                    'allCompaniesDetails' =>  $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->companyServices->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Company Status Updated Successfully',
                'data'   =>  view("admin.company.company_list", [
                    'allCompaniesDetails' => $this->companyServices->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function assign_feature()
    {

        return view('admin.company.assign-feature', [
            'allMenus' => $this->menuServices->getFeatures(),
            'allCompaniesDetails' => $this->companyServices->all()
        ]);
    }
    public function update_feature(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required',
            'menu_id'    => 'required|array',
            'menu_id.*'    => 'required|exists:menus,id',
        ]);
        $company = $this->companyRepository->getCompanyById($validated['company_id'])->first();
        $company->menu()->sync($validated['menu_id']);
        return back()->with('success', 'Feature Updated Successfully');
    }
    public function get_assign_feature(Request $request)
    {
        $menuIds = $this->companyRepository->getCompanyById($request->company_id)->with('menu')->first();
        return response()->json([
            'success' => true,
            'data'   => $menuIds->menu->pluck('id')->toArray()
        ]);
    }
}
