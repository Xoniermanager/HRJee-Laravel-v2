<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Role;
use App\Models\HrjeeRole;
use App\Models\CustomRole;
use App\Models\CompanyMenu;
use Illuminate\Http\Request;
use App\Http\Services\MenuService;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\CompanyDetailService;

class AssignMenuCompanyController extends Controller
{
    private $menuServices, $userService, $companyDetailService;
    public function __construct(MenuService $menuServices, UserService $userService, CompanyDetailService $companyDetailService)
    {
        $this->menuServices = $menuServices;
        $this->userService = $userService;
        $this->companyDetailService = $companyDetailService;
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
            'menu_id' => 'required|array',
            'menu_id.*' => 'required|exists:menus,id',
        ]);

        $company = $this->userService->getUserById($validated['company_id']);
        $adminRole = $company->role;
        $menus = Menu::whereIn('id', $validated['menu_id'])->get();
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

        return redirect(route('admin.assign_menu.index'))->with('success', 'Feature Updated Successfully');
    }

    public function get_assign_feature(Request $request)
    {
        $menuIds = $this->userService->getUserById($request->company_id);
        return response()->json([
            'success' => true,
            'data' => $menuIds->menu->pluck('id')->toArray()
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
