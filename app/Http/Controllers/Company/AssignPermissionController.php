<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\RoleHasMenu;
use App\Http\Controllers\Controller;
use App\Http\Services\CompanyServices;

class AssignPermissionController extends Controller
{
    private $companyServices;

    public function __construct(CompanyServices $companyServices)
    {
        $this->companyServices = $companyServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = RoleHasMenu::with(['role', 'menu'])->get()->groupBy('role_id');

        return view('company.roles_and_permission.assign_permission.index', compact('roles'));
    }

    public function add()
    {
        $roles = Role::with('permissions')->orderBy('id', 'DESC')->get();
        $allMenus = $this->companyServices->getCompanyMenus();

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
            $rolesWithMenuArray = [];
            foreach($request->menu_id as $menu_id) {
                $rolesWithMenuArray[] = [
                    'menu_id' => $menu_id,
                    'role_id' => $request->role_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            RoleHasMenu::where('role_id', $request->role_id)->delete();
            RoleHasMenu::insert($rolesWithMenuArray);

            return redirect('/company/roles/assign_permissions')->with('success', 'Assigned Permissions Successfully!');

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAssignedPermissions(Request $request)
    {
        $menuIds = RoleHasMenu::where('role_id', $request->role_id)->pluck('menu_id')->toArray();

        return response()->json([
            'success' => true,
            'data'   => $menuIds
        ]);
    }
}
