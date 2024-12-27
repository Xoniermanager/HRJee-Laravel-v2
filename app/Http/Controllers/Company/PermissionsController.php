<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Rules\OnlyString;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Services\permissionServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\PermissionsServices;

class PermissionsController extends Controller
{
    private $permissionServices;
    public function __construct(PermissionsServices $permissionServices)
    {
            $this->permissionServices = $permissionServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission = $this->permissionServices->all();
        return view('company.roles_and_permission.permission.index')->with(['permissions'=> $permission]);
    }

    public function role_form()
    {
        return view('company.roles_and_permission.create-permission-form');
    }
    public function store(Request $request)
    {

        try {
            $validator  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:permissions,name'],
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 400);
            }
            $data = $request->all();
            if ($this->permissionServices->create($data)) {
                return response()->json([
                    'message' => 'Permission Created Successfully!',
                    'data'   =>  view('company/roles_and_permission/permission/permissions_list', [
                        'permissions' => $this->permissionServices->all()
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
        $companyStatus = $this->permissionServices->updateDetails($updateRole, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Permission Updated Successfully!',
                    'data'   =>  view('company/roles_and_permission/permission/permissions_list', [
                        'permissions' => $this->permissionServices->all()
                    ])->render()
                ]
            );
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->permissionServices->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'message' => 'Permission Updated Successfully!',
                'data'   =>  view('company/roles_and_permission/permission/permissions_list', [
                    'permissions' => $this->permissionServices->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error', 'Something Went Wrong! Please try Again']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->permissionServices->deleteDetails($id);
        if ($data) {
            return response()->json([
                'message' => 'Permission Deleted Successfully!',
                'data'   =>  view('company/roles_and_permission/permission/permissions_list', [
                    'permissions' => $this->permissionServices->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
