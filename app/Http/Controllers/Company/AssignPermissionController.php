<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\CompanyMenu;
use App\Models\CustomRole;
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
        $roles = CompanyMenu::with(['role', 'menu'])->whereNotNull('role_id')->get()->groupBy('role_id');
        
        return view('company.roles_and_permission.assign_permission.index', compact('roles'));
    }

    public function add()
    {
        $roles = CustomRole::orderBy('id', 'DESC')->get();
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
                    'role_id' => $request->role_id
                ];
            }
            CompanyMenu::where('role_id', $request->role_id)->delete();
            CompanyMenu::insert($rolesWithMenuArray);

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
