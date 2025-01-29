<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Models\CompanyMenu;
use App\Models\Role;
use App\Http\Controllers\Controller;

class AssignPermissionController extends Controller
{

    public function __construct()
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::where('category', 'custom')->with(['menus'])->get();
        
        return view('company.roles_and_permission.assign_permission.index', compact('roles'));
    }

    public function add()
    {
        $roles = Role::where('category', 'custom')->orderBy('id', 'DESC')->get();
        $allMenus = auth()->user()->menu->with(['children'])->where('parent_id', null);
        
        return view('company.roles_and_permission.assign_permission.add_assign', compact('roles', 'allMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'menu_id'    => 'required|array',
            'menu_id.*'    => 'required|exists:menus,id',
        ]);

        try {
            $syncData = [];
            foreach($request->menu_id as $menu_id) {
                $syncData[$menu_id] = [
                    'can_create' => true,
                    'can_read' => true,
                    'can_update' => true,
                    'can_delete' => true,
                ];
            }
            $adminRole = Role::where('id', $request->role_id)->first();
            $adminRole->menus()->sync($syncData);

            return redirect('/company/roles/assign_permissions')->with('success', 'Assigned Permissions Successfully!');

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAssignedPermissions(Request $request)
    {
        $menuIds = CompanyMenu::where('role_id', $request->role_id)->pluck('menu_id')->toArray();

        return response()->json([
            'success' => true,
            'data'   => $menuIds
        ]);
    }
}
