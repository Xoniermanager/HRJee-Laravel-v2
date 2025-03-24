<?php

namespace App\Http\Services;

use App\Repositories\MenuRepository;

class MenuService
{
    private $menuRepository;
    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->menuRepository->with('parent')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function allParentMenu()
    {
        return $this->menuRepository->whereNull('parent_id')->where('status', 1)->get();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getFeatures()
    {
        return $this->menuRepository->where('role', 'company')->whereNull('parent_id')->with([
            'children' => function ($query) {
                $query->where('role', 'company')
                    ->orderBy('order_no', 'ASC');
            }
        ])->get();
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @return void
     */
    public function create($data)
    {
        return $this->menuRepository->create($data);
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @param [type] $id
     * @return void
     */
    public function updateDetails(array $data, $id)
    {
        return $this->menuRepository->find($id)->update($data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->menuRepository->find($id)->delete();
    }

    /**
     * Undocumented function
     *
     * @param [type] $searchKey
     * @return void
     */
    public function searchMenu($searchKey)
    {
        $data['key']     =  array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
        $data['status']  =  array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

        return $this->menuRepository->where(function ($query) use ($data) {
            if (!empty($data['key'])) {
                $query->where('title', 'like', "%{$data['key']}%");
            }

            if (isset($data['status'])) {
                $query->where('status', $data['status']);
            }
        })->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function delete_menu_by_id($id)
    {
        return $this->menuRepository->getCompanyById($id)->delete();
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function getMenuById($id)
    {
        return $this->menuRepository->find($id);
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @return void
     */
    public function update_menu($data)
    {
        return $this->menuRepository->updateMenu($data);
    }
}
