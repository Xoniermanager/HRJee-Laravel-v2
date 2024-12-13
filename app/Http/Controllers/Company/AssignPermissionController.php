<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Services\RolesServices;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\PermissionsServices;

class AssignPermissionController extends Controller
{
    private $rolesServices;
    private $permissionServices;
    public function __construct(RolesServices $rolesServices, PermissionsServices $permissionServices)
    {
        $this->rolesServices = $rolesServices;
        $this->permissionServices = $permissionServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('id', 'DESC')->get();
        $permissions = $this->permissionServices->all();
        return view('company.roles_and_permission.assign_permission.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $validateData  = Validator::make($request->all(), [
            'role_id' => 'required|exits:roles,id',
            'permission_id' => 'required|array',
            'permission_id.*' => 'required|exists:permissions,id'
        ]);
        try {
            $role = Role::find($request->role_id);
            $permissions = Permission::whereIn('id', $request->permission_id)->get(['name'])->toArray();
            if ($role->syncPermissions($permissions)) {
                return response()->json([
                    'message' => 'Assigned Permission Successfully!',
                    'data'   =>  view('company.roles_and_permission.assign_permission.assign_permission_list', [
                        'roles' => Role::with('permissions')->orderBy('id', 'DESC')->get()
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
