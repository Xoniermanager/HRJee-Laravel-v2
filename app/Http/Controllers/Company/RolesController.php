<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Models\MenuRole;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Services\CustomRoleService;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    private $customRoleService;
    public function __construct(CustomRoleService $customRoleService)
    {
        $this->customRoleService = $customRoleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->customRoleService->getRolesByCompanyID(Auth()->user()->company_id)->paginate(10);
        return view('company.roles_and_permission.roles.index', compact('roles'));
    }

    public function role_form()
    {
        return view('company.roles_and_permission.create-roles-form');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    'max:255',
                    'regex:/^[a-zA-Z\s&]+$/',
                    Rule::unique('roles', 'name')
                        ->where(function ($query) {
                            return $query->where('company_id', auth()->user()->company_id)
                                ->whereNull('deleted_at');
                        })
                ],
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 400);
            }
            $data = $request->all();
            $data = $request->except(['_token']);
            $data['company_id'] = Auth()->user()->company_id;
            $data['created_by'] = Auth()->user()->id;
            $data['category'] = 'custom';

            if ($this->customRoleService->create($data)) {

                return response()->json([
                    'message' => 'Role Created Successfully!',
                    'data' => view('company/roles_and_permission/roles/roles_list', [
                        'roles' => $this->customRoleService->getRolesByCompanyID(Auth()->user()->company_id)->paginate(10)
                    ])->render()
                ]);
            }
        } catch (Exception $e) {

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'max:255',
                'regex:/^[a-zA-Z\s&]+$/',
                Rule::unique('roles', 'name')
                    ->ignore($request->id) // ignore current record by ID
                    ->where(function ($query) {
                        return $query->where('company_id', auth()->user()->company_id)
                            ->whereNull('deleted_at');
                    })
            ],
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }
        $updateRole = $request->except(['_token', 'id']);
        $companyStatus = $this->customRoleService->updateDetails($updateRole, $request->id);
        if ($companyStatus) {

            return response()->json(
                [
                    'message' => 'Role Updated Successfully!',
                    'data' => view('company/roles_and_permission/roles/roles_list', [
                        'roles' => $this->customRoleService->getRolesByCompanyID(Auth()->user()->company_id)->paginate(10)
                    ])->render()
                ]
            );
        }
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->customRoleService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'message' => 'Role Status Updated Successfully!',
                'sucess' => true
            ]);
        } else {
            return response()->json(['error', 'Something Went Wrong! Plesase try Again']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        $role = $this->customRoleService->getDetails($id);

        if (count($role->users)) {
            return response()->json([
                'status' => false,
                'message' => 'This role is already assigned to users',
                'data' => view('company/roles_and_permission/roles/roles_list', [
                    'roles' => $this->customRoleService->getRolesByCompanyID(Auth()->user()->company_id)->paginate(10)
                ])->render()
            ]);
        }

        $data = $this->customRoleService->deleteDetails($id);
        MenuRole::where('role_id', $request->role_id)->delete();
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Role Deleted Successfully!',
                'data' => view('company/roles_and_permission/roles/roles_list', [
                    'roles' => $this->customRoleService->getRolesByCompanyID(Auth()->user()->company_id)->paginate(10)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function serachRoleFilterList(Request $request)
    {
        $searchedItems = $this->customRoleService->serachRoleFilterList($request, auth()->user()->company_id);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("company/roles_and_permission/roles/roles_list", [
                    'roles' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
