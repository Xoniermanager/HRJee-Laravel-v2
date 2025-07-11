<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Services\MenuService;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidateCompany;
use App\Http\Services\CompanyTypeService;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\CompanyDetailService;
use App\Http\Services\SubscriptionPlanService;

class AdminCompanyController extends Controller
{

    private $companyDetailService;
    private $userService;
    private $companyTypeService;
    private $subscriptionPlanService;
    public function __construct(SubscriptionPlanService $subscriptionPlanService, CompanyDetailService $companyDetailService, CompanyTypeService $companyTypeService, UserService $userService)
    {
        $this->companyDetailService = $companyDetailService;
        $this->subscriptionPlanService = $subscriptionPlanService;
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
        $companyDetails = $this->userService->getUserById($request->query('id'));
        $subscriptionPlans = $this->subscriptionPlanService->getAllActivePlans();
        $allCompanyTypeDetails = $this->companyTypeService->getAllActiveCompanyType();

        return view('admin.company.edit_company', [
            'companyDetails' => $companyDetails,
            'subscriptionPlans' => $subscriptionPlans,
            'allCompanyTypeDetails' => $allCompanyTypeDetails
        ]);
    }

    protected function createRoleForCompany($companyId, $menuIds)
    {
        DB::beginTransaction();
        try {
            $menus = Menu::whereIn('id', $menuIds)->get();
            $roles = [
                'Admin' => [
                    'description' => 'Administrator with full access',
                    'permissions' => ['can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
                ],
                'Employee' => [
                    'description' => 'Standard employee role',
                    'permissions' => ['can_create' => false, 'can_read' => true, 'can_update' => false, 'can_delete' => false],
                ],
                'HR' => [
                    'description' => 'HR with specific permissions',
                    'permissions' => ['can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => false],
                ],
            ];
            $createdRoleIds = [];
            foreach ($roles as $roleName => $roleData) {
                // Create or update role
                $role = Role::updateOrCreate(
                    [
                        'company_id' => $companyId,
                        'created_by' => $companyId,
                        'name' => $roleName,
                    ],
                    [
                        'description' => $roleData['description'],
                        'category' => 'default',
                        'status' => true,
                    ]
                );
                // Build sync data for menus
                $syncData = [];
                foreach ($menus as $menu) {
                    $syncData[$menu->id] = $roleData['permissions'];
                }
                // Sync permissions
                $role->menus()->sync($syncData);
                // Store created role IDs
                $createdRoleIds[strtolower($roleName) . '_role_id'] = $role->id;
            }
            DB::commit();
            return $createdRoleIds;
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
                $userCreated->update(['role_id' => $roleId['admin_role_id'], 'company_id' => $userCreated->id]);
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
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong. Please try again.']);
        }
    }

    public function update_company(Request $request)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'username' => 'sometimes|required|string|max:255',
            'contact_no' => 'sometimes|required|string|max:20',
            'password' => 'sometimes|required|confirmed',
            'company_size' => 'sometimes|required|min:1',
            'subscription_id' => 'required|string',
            'onboarding_date' => 'required|string',
            'company_url' => 'sometimes|required|string|url|max:100',
            'company_address' => 'sometimes|required|string|max:255', // Removed duplicate 'sometimes'
            'logo' => 'sometimes|max:2048',
            'company_type_id' => 'sometimes|required|exists:company_types,id',
        ]);

        try {
            DB::beginTransaction();
            $this->userService->updateDetail($request->only('name'), $request->id);
            if ($request->hasFile('logo')) {
                $nameForImage = removingSpaceMakingName($request->name);
                $upload_path = "/company_profile";
                $filePath = uploadingImageorFile($request->logo, $upload_path, $nameForImage);
                $request->merge(['logo' => $filePath]);
            }

            $subscriptionPlan = $this->subscriptionPlanService->getDetails($request->subscription_id);
            $subscriptionDays = $subscriptionPlan ? $subscriptionPlan->days : 7;
            $expiryDate = date('Y-m-d', strtotime($request->onboarding_date . ' + ' . $subscriptionDays . 'days'));
            $request->merge(['subscription_expiry_date' => $expiryDate]);

            $this->companyDetailService->updateDetails($request->except('name', '_token', 'email'), $request->id);
            DB::commit();
            return response()->json(['success' => 'Company Updated Successfully']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong. Please try again.']);
        }
    }
    public function destroy(Request $request)
    {
        $deleted = $this->userService->deleteUserById($request->id);
        if ($deleted) {
            return response()->json([
                'success' => 'Company Deleted Successfully',
                'data' => view("admin.company.company_list", [
                    'allCompaniesDetails' => $this->userService->getCompanies()->paginate(10)
                ])->render()
            ]);
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

    public function resetPassword(Request $request)
    {
        $user = User::find($request->company_id);

        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:users,id',
            'password' => [
                'required',
                'confirmed',
                'min:6',
                function ($attribute, $value, $fail) use ($user) {
                    if ($user && Hash::check($value, $user->password)) {
                        $fail('The new password cannot be the same as the old password.');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['success' => true]);
    }

}
