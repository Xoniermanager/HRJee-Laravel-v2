<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Services\MenuService;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidateCompany;
use App\Http\Services\CompanyTypeService;
use App\Http\Services\CompanyUserService;
use App\Http\Services\CompanyDetailService;

class AdminCompanyController extends Controller
{

    private $companyDetailService;
    private $userService;
    private $companyUserService;
    private $menuServices;
    private $companyRepository;
    private $companyTypeService;
    public function __construct(CompanyDetailService $companyDetailService, CompanyUserService $companyUserService, MenuService $menuServices, CompanyTypeService $companyTypeService, UserService $userService)
    {
        $this->companyDetailService = $companyDetailService;
        $this->companyUserService = $companyUserService;
        $this->menuServices = $menuServices;
        $this->companyTypeService = $companyTypeService;
        $this->userService = $userService;
    }
    public function index()
    {
        return view('admin.company.index', [
            'allCompaniesDetails' => $this->userService->getCompanies()->paginate(10),
            'allCompanyTypeDetails' => $this->companyTypeService->getAllActiveCompanyType()
        ]);
    }


    public function add_company()
    {
        $allCompanyTypeDetails = $this->companyTypeService->getAllActiveCompanyType();
        return view('admin.company.add_company', compact('allCompanyTypeDetails'));
    }

    public function edit_company(Request $request)
    {
        $companyDetails = $this->companyDetailService->get_company_by_id($request->query('id'));
        return view('admin.company.edit_company', ['companyDetails' => $companyDetails]);
    }

    protected function createRoleForCompany($companyId, $menuIds, $companyName)
    {
        DB::beginTransaction();

        try {
            $menus = Menu::whereIn('id', $menuIds)->get();
            $adminRole = Role::updateOrCreate(
                [
                    'user_id' => $companyId,
                    'name' => "$companyName Admin",
                ],
                [
                    'description' => 'Administrator with full access',
                    'category' => 'default',
                    'status' => true,
                ]
            );

            $syncData = [];
            foreach ($menus as $menu) {
                $syncData[$menu->id] = [
                    'can_create' => true,
                    'can_read' => true,
                    'can_update' => true,
                    'can_delete' => true,
                ];
            }

            $adminRole->menus()->sync($syncData);
            DB::commit();

            return $adminRole->id;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function store(ValidateCompany $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();
        try {
            $request['type'] = 'company';
            $userCreated = $this->userService->create($request->only('name', 'password', 'email', 'type'));

            if ($userCreated) {
                // Assign Admin Role
                try {
                    $roleId = $this->createRoleForCompany($userCreated->id, [], $userCreated->name);
                } catch (\Throwable $th) {
                    return response()->json(['error' => 'Something went wrong. Please try again.']);
                }

                $userCreated->update(['role_id' => $roleId]);

                $request['user_id'] = $userCreated->id;
                if ($request->hasFile('logo')) {
                    $nameForImage = removingSpaceMakingName($request->name);
                    $upload_path = "/company_log";
                    $filePath = uploadingImageorFile($request->logo, $upload_path, $nameForImage);
                    $request->merge(['logo' => $filePath]);
                }
                $this->companyDetailService->create($request->except('name', 'email', '_token', 'password', 'password_confirmation', 'role_id'));
                DB::commit();
                return response()->json(['success' => 'Company Created Successfully']);
            } else {
                DB::rollBack();
                return response()->json(['error' => 'Please try again later!']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.']);
        }
    }

    public function update_company(Request $request)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255,',
            'username' => 'sometimes|required|string|max:255',
            'contact_no' => 'sometimes|required|string|max:20',
            'password' => 'sometimes|required|confirmed',
            'password_confirmation' => 'sometimes|required',
            'company_size' => 'sometimes|required|string',
            'company_url' => 'sometimes|required|string|url|max:100',
            'company_address' => 'sometimes|sometimes|required|string|max:255',
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
        $createdCompany = $this->companyDetailService->updateDetails($request->except('_token', 'password', 'password_confirmation'), $request->company_id);

        if ($createdCompany) {
            $data['name'] = $request->name;
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
        $companyId = $request->id;
        $deleted = $this->userService->deleteUserById($companyId);
        if ($deleted) {
            $data = $this->companyDetailService->deleteDetails($companyId);
            if ($data) {
                return response()->json([
                    'success' => 'Company Deleted Successfully',
                    'data' => view("admin.company.company_list", [
                        'allCompaniesDetails' => $this->userService->getCompanies()->paginate(10)
                    ])->render()
                ]);
            }
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {
        $searchedItems = $this->userService->searchFilterCompany($request->all());
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("admin.company.company_list", [
                    'allCompaniesDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $statusDetails = $this->userService->updateStatus($request->id, $request->status);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Company Status Updated Successfully',
                'data' => view("admin.company.company_list", [
                    'allCompaniesDetails' => $this->userService->getCompanies()->paginate(10)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
