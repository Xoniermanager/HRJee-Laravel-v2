<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\PrmRequestRepository;

class PrmRequestService
{
  private $prmRequestRepository;
  public function __construct(PrmRequestRepository $prmRequestRepository)
  {
    $this->prmRequestRepository = $prmRequestRepository;
  }

  public function getAllRequest($companyId)
  {
    
    return $this->prmRequestRepository
            ->whereHas('user', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })->orderBy('id', 'desc')->paginate(10);
    
  }
  public function updateDetails(array $data, $id)
  {
    return $this->prmRequestRepository->find($id)->update($data);
  }
  public function searchPRMRequestFilterList($request)
  {
    $assetCategoryDetails = $this->prmRequestRepository;
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
