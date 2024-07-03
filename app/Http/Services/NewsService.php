<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\NewsRepository;

class NewsService
{
  private $newsRepository;
  public function __construct(NewsRepository $newsRepository)
  {
    $this->newsRepository = $newsRepository;
  }
  public function all()
  {
    return $this->newsRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->newsRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->newsRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->newsRepository->find($id)->delete();
  }

  public function getAllActiveNewsCategory()
  {
    return $this->newsRepository->where('status', '1')->get();
  }

  public function serachNewsCategoryFilterList($request)
  {
    $assetCategoryDetails = $this->newsRepository;
    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $assetCategoryDetails = $assetCategoryDetails->where('name', 'Like', '%' . $request->search . '%');
    }
    /**List By Status or Filter */
    if (isset($request->status)) {
      $assetCategoryDetails = $assetCategoryDetails->where('status', $request->status);
    }
    return $assetCategoryDetails->orderBy('id', 'DESC')->paginate(10);
  }
}
