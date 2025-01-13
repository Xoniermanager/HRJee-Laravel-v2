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
  public function all()
  {
    return $this->menuRepository->with('parent')->all();
  }
  public function allParentMenu(){
    return $this->menuRepository->whereNull('parent_id')->where('status',1)->get();
  }
  public function getFeatures(){
    return $this->menuRepository->whereNull('parent_id')->with('children')->get();
}
  
  public function create($data)
  {
    return $this->menuRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->menuRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->menuRepository->find($id)->delete();
  }

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
    })->get();
  }









  // old methods
  public function delete_menu_by_id($id)
  {
    return $this->menuRepository->getCompanyById($id)->delete();
  }
  public function getMenuById($id)
  {
    return $this->menuRepository->find($id);
  }
  public function update_menu($data)
  {
    return $this->menuRepository->updateMenu($data);
  }

}
