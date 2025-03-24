<?php

namespace App\Http\Services;

use App\Repositories\CompanyDetailRepository;

class CompanyDetailService
{
    private $companyDetailRepository;
    public function __construct(CompanyDetailRepository $companyDetailRepository)
    {
        $this->companyDetailRepository = $companyDetailRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->companyDetailRepository->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function allCompanyDetails()
    {
        return $this->companyDetailRepository->all();
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @return mixed
     */
    public function create($data): mixed
    {
        $data['joining_date'] = date('Y-m-d');
        return $this->companyDetailRepository->create($data);
    }
    
    /**
     * Undocumented function
     *
     * @param [type] $data
     * @param [type] $userId
     * @return void
     */
    public function updateDetails($data, $userId)
    {
        return $this->companyDetailRepository->where('user_id', $userId)->update($data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $searchKey
     * @return void
     */
    public function searchInCompany($searchKey)
    {
        return $this->companyDetailRepository->where(function ($query) use ($searchKey) {
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

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function delete_company_by_id($id)
    {
        return $this->companyDetailRepository->getCompanyById($id)->delete();
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function get_company_by_id($id)
    {
        return $this->companyDetailRepository->where('user_id', $id)->first();
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @return void
     */
    public function update_company($data)
    {
        return $this->companyDetailRepository->updateCompany($data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @param [type] $userId
     * @return void
     */
    public function updateCompanyDetails($data, $userId)
    {
        return $this->companyDetailRepository->where('user_id', $userId)->update($data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function get_company_with_branch_details($id)
    {
        return $this->companyDetailRepository->getPrimaryBranchForCompany($id);
    }

    /**
     * Undocumented function
     *
     * @param [type] $searchKey
     * @return void
     */
    public function searchCompanyMenu($searchKey)
    {
        return $this->companyDetailRepository->where(function ($query) use ($searchKey) {
            if (!empty($searchKey)) {
                $query->where('name', 'like', "%{$searchKey}%")
                    ->orWhereHas('menu', function ($menuQuery) use ($searchKey) {
                        $menuQuery->where('title', 'like', "%{$searchKey}%");
                    });
            }
        })->with('menu')->paginate(10);
    }

    // public function updateStatus($companyId, $statusValue)
    // {
    //     $companyStatusUpdate =  $this->companyDetailRepository->find($companyId)->update(['status' => $statusValue]);
    //     if ($companyStatusUpdate) {
    //         $this->companyUserRepository->where('company_id', $companyId)->update(['status' => $statusValue]);
    //     }
    //     return $companyStatusUpdate;
    // }

    // public function getCompanyMenus()
    // {
    //     $companyMenuSql = CompanyMenu::with(['menu' => function ($query) {
    //         $query->where('status', 1);
    //         $query->where('role', 'company');
    //         $query->orderBy('order_no', 'ASC');
    //     }, 'menu.parent'])->where('company_id', Auth()->user()->id);


    //     $companyMenuIDs = $companyMenuSql->pluck('menu_id')->toArray();
    //     $companyMenus = $companyMenuSql->get();
    //     foreach ($companyMenus as $companyMenu) {
    //         $menu = $companyMenu->menu;
    //         $companyMenuIDs[] = $menu->parent_id;
    //     }

    //     $companyMenus = Menu::where(['status' => 1, 'role' => 'company'])->whereNull('parent_id')->whereIn('id', $companyMenuIDs)->with([
    //         'children' => function ($query) use ($companyMenuIDs) {
    //             $query->whereIn('id', $companyMenuIDs);
    //             $query->where('role', 'company')
    //                 ->orderBy('order_no', 'ASC');
    //         }
    //     ])->orderBy('order_no', 'ASC')->get();

    //     return $companyMenus;
    // }
}
