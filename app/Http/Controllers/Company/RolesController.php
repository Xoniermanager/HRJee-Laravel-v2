<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Models\roles;
use App\Models\CustomRole;
use App\Rules\OnlyString;
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
        $roles = $this->customRoleService->getRolesByCompanyID(auth()->guard('company')->user()->company_id);
        
        return view('company.roles_and_permission.roles.index')->with(['roles'=> $roles]);
    }

    public function role_form()
    {
        return view('company.roles_and_permission.create-roles-form');
    }

    public function store(Request $request)
    {

        try {
            $validator  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:custom_roles,name'],
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 400);
            }

            $data = $request->all();
            $data['company_id'] = auth()->guard('company')->user()->company_id;
            if ($this->customRoleService->create($data)) {

                return response()->json([
                    'message' => 'Role Created Successfully!',
                    'data'   =>  view('company/roles_and_permission/roles/roles_list', [
                        'roles' => $this->customRoleService->all()
                    ])->render()
                ]);
            }
        } catch (Exception $e) {

            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'name' => ['required', 'string', new OnlyString, 'unique:states,name,' . $request->id],
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
                    'data'   =>  view('company/roles_and_permission/roles/roles_list', [
                        'roles' => $this->customRoleService->all()
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
                'data'   =>  view('company/roles_and_permission/roles/roles_list', [
                    'roles' => $this->customRoleService->all()
                ])->render()
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
        $data = $this->customRoleService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'message' => 'Role Deleted Successfully!',
                'data'   =>  view('company/roles_and_permission/roles/roles_list', [
                    'roles' => $this->customRoleService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
