<?php

namespace App\Http\Services;

use App\Models\Menu;
use App\Models\CompanyMenu;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\Session;
use App\Repositories\CompanyUserRepository;

class CompanyServices
{
    private $companyRepository;
    private $companyUserRepository;
    public function __construct(CompanyRepository $companyRepository, CompanyUserRepository $companyUserRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->companyUserRepository = $companyUserRepository;
    }
    public function all()
    {
        return $this->companyRepository->with('menu')->paginate(10);
    }
    public function allCompanyDetails()
    {
        return $this->companyRepository->all();
    }
    public function create($data)
    {
        return $this->companyRepository->create($data);
    }

    public function updateDetails(array $data, $id)
    {
        return $this->companyRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->companyRepository->find($id)->delete();
    }

    public function searchInCompany($searchKey)
    {
        return $this->companyRepository->where(function ($query) use ($searchKey) {
            if (!empty($searchKey['key'])) {
                $query->where('name', 'like', "%{$searchKey['key']}%")
                    ->orWhere('username', 'like', "%{$searchKey['key']}%")
                    ->orWhere('email', 'like', "%{$searchKey['key']}%")
                    ->orWhere('contact_no', 'like', "%{$searchKey['key']}%")
                    ->orWhere('company_address', 'like', "%{$searchKey['key']}%");
            }
            if (isset($searchKey['status'])) {
                $query->where('status', $searchKey['status']);
            }
            if (isset($searchKey['deletedAt'])) {
                $query->onlyTrashed();
            }
            if (isset($searchKey['companyTypeId'])) {
                $query->where('company_type_id', $searchKey['companyTypeId']);
            }
        })->paginate(10);
    }
    public function delete_company_by_id($id)
    {
        return $this->companyRepository->getCompanyById($id)->delete();
    }
    public function get_company_by_id($id)
    {
        return $this->companyRepository->getCompanyById($id)->first();
    }
    public function update_company($data)
    {
        return $this->companyRepository->updateCompany($data);
    }

    public function get_company_with_branch_details($id)
    {
        return $this->companyRepository->getPrimaryBranchForCompany($id);
    }

    public function searchCompanyMenu($searchKey)
    {
        return $this->companyRepository->where(function ($query) use ($searchKey) {
            if (!empty($searchKey)) {
                $query->where('name', 'like', "%{$searchKey}%")
                    ->orWhereHas('menu', function ($menuQuery) use ($searchKey) {
                        $menuQuery->where('title', 'like', "%{$searchKey}%");
                    });
            }
        })->with('menu')->paginate(10);
    }

    public function updateStatus($companyId, $statusValue)
    {
        $companyStatusUpdate =  $this->companyRepository->find($companyId)->update(['status' => $statusValue]);
        if ($companyStatusUpdate) {
            $this->companyUserRepository->where('company_id', $companyId)->update(['status' => $statusValue]);
        }
        return $companyStatusUpdate;
    }

    public function getCompanyMenus()
    {
        // $menus = $this->companyRepository->with([
        //     'menu' => function ($query) {
        //         $query->where('status', 1)
        //             ->whereNull('parent_id') // Only fetch parent menus
        //             ->orderBy('order_no', 'ASC');
        //     },
        //     'menu.children' => function ($query) {
        //         $query->where('status', 1) // Fetch only active children
        //             ->orderBy('order_no', 'ASC');
        //     }
        // ])->find(auth()->guard('company')->user()->company_id);

        // return $menus->menu;


        $companyMenuSql = CompanyMenu::with(['menu' => function ($query) {
            $query->where('status', 1);
            $query->orderBy('order_no', 'ASC');
        }, 'menu.parent'])->where('company_id', auth()->guard('company')->user()->company_id);   
    

        $companyMenuIDs = $companyMenuSql->pluck('menu_id')->toArray();
        $companyMenus = $companyMenuSql->get();
        foreach ($companyMenus as $companyMenu) {
            $menu = $companyMenu->menu;
            $companyMenuIDs[] = $menu->parent_id;
        }

        $companyMenus = Menu::where('status', 1)->whereNull('parent_id')->whereIn('id', $companyMenuIDs)->with([
                'children' => function ($query) use($companyMenuIDs) {
                    $query->whereIn('id', $companyMenuIDs)
                        ->orderBy('order_no', 'ASC');
                }
            ])->orderBy('order_no', 'ASC')->get();

        return $companyMenus;


    }
}
