<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Services\MenuService;
use App\Http\Controllers\Controller;
use App\Http\Services\CompanyServices;
use App\Repositories\CompanyRepository;

class AssignMenuCompanyController extends Controller
{
    private $companyServices;
    private $menuServices;
    private $companyRepository;
    public function __construct(CompanyServices $companyServices, MenuService $menuServices, CompanyRepository $companyRepository)
    {
        $this->companyServices = $companyServices;
        $this->menuServices = $menuServices;
        $this->companyRepository = $companyRepository;
    }
    public function index()
    {

        $allCompanyDetails = $this->companyServices->all();
        return view('admin.assign_menu.index', compact('allCompanyDetails'));
    }

    public function assignMenu()
    {
        return view('admin.assign_menu.add', [
            'allMenus' => $this->menuServices->getFeatures(),
            'allCompaniesDetails' => $this->companyServices->allCompanyDetails()
        ]);
    }
    public function update_feature(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required',
            'menu_id'    => 'required|array',
            'menu_id.*'    => 'required|exists:menus,id',
        ]);
        $company = $this->companyRepository->getCompanyById($validated['company_id'])->first();
        $company->menu()->sync($validated['menu_id']);
        return redirect(route('admin.assign_menu.index'))->with('success', 'Feature Updated Successfully');
    }
    public function get_assign_feature(Request $request)
    {
        $menuIds = $this->companyRepository->getCompanyById($request->company_id)->with('menu')->first();
        return response()->json([
            'success' => true,
            'data'   => $menuIds->menu->pluck('id')->toArray()
        ]);
    }

    public function searchFilterMenu(Request $request)
    {
        $allCompanyDetails = $this->companyServices->searchCompanyMenu($request->searchKey);
        return response()->json([
            'success' => true,
            'data'   => view("admin.assign_menu.list", compact('allCompanyDetails'))->render()
        ]);
    }
}
