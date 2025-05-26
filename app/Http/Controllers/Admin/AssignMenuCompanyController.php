<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Role;
use App\Models\MenuRole;
use Illuminate\Http\Request;
use App\Http\Services\MenuService;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;

class AssignMenuCompanyController extends Controller
{
    private $menuServices, $userService;
    public function __construct(MenuService $menuServices, UserService $userService)
    {
        $this->menuServices = $menuServices;
        $this->userService = $userService;
    }
    public function index()
    {
        $allCompanyDetails = $this->userService->getCompanies()->paginate(10);

        return view('admin.assign_menu.index', compact('allCompanyDetails'));
    }

    public function assignMenu()
    {
        return view('admin.assign_menu.add', [
            'allMenus' => $this->menuServices->getFeatures(),
            'allCompaniesDetails' => $this->userService->getCompanies()->get()
        ]);
    }

    public function update_feature(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required',
            'menu_id' => 'sometimes|array',
            'menu_id.*' => 'required|exists:menus,id',
        ]);

        $company = Role::where('company_id', $validated['company_id'])->first();
        // dd($company);
        // $adminRole = $company->role;

        // MenuRole::where('role_id', $company->role_id)->delete();
        if (isset($validated['menu_id'])) {
            $menus = Menu::whereIn('id', $validated['menu_id'])->get();
            $syncData = [];
            foreach ($menus as $menu) {
                $syncData[$menu->id] = [
                    'menu_id' => $menu->id,
                    'role_id' => $company->id,
                    'can_create' => true,
                    'can_read' => true,
                    'can_update' => true,
                    'can_delete' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                // $syncData[$menu->id] = [
                //     'can_create' => true,
                //     'can_read' => true,
                //     'can_update' => true,
                //     'can_delete' => true,
                // ];
            }
            // dd($adminRole);
            // MenuRole::insert($syncData);
            $company->menus()->sync($syncData);
        } else {
            $company->menus()->sync([]);
            // $adminRole->menus()->delete();
            // MenuRole::where('role_id', $company->role_id)->delete();
        }

        return redirect(route('admin.assign_menu.index'))->with('success', 'Feature Updated Successfully');
    }

    public function get_assign_feature(Request $request)
    {
        $company = $this->userService->getUserById($request->company_id);
        $menuIDs = [];
        foreach ($company->menus() as $menu) {
            $menuIDs[] = $menu['id'];
        }

        return response()->json([
            'success' => true,
            'data' => $menuIDs
        ]);
    }

    public function searchFilterMenu(Request $request)
    {
        $allCompanyDetails = $this->userService->searchCompanyMenu($request->searchKey);
        return response()->json([
            'success' => true,
            'data' => view("admin.assign_menu.list", compact('allCompanyDetails'))->render()
        ]);
    }
}
