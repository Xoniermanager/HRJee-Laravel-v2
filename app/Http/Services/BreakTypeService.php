<?php

namespace App\Http\Services;

use App\Repositories\BreakTypeRepository;

class BreakTypeService
{
  private $breakTypeRepository;
  public function __construct(BreakTypeRepository $breakTypeRepository)
  {
    $this->breakTypeRepository = $breakTypeRepository;
  }
  public function all()
  {
    return $this->breakTypeRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    $data['company_id'] = Auth()->guard('admin')->user()->company_id;
    return $this->breakTypeRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->breakTypeRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->breakTypeRepository->find($id)->delete();
  }
  public function getAllActiveBreakTypeStatus()
  {
    return $this->breakTypeRepository->where('status', '1')->get();
  }

  public function serachBreakTypeStatusFilterList($request)
  {
    $assetStatusDetails = $this->breakTypeRepository;
    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $assetStatusDetails = $assetStatusDetails->where('name', 'Like', '%' . $request->search . '%');
    }
    /**List By Status or Filter */
    if (isset($request->status)) {
      $assetStatusDetails = $assetStatusDetails->where('status', $request->status);
    }
    return $assetStatusDetails->orderBy('id', 'DESC')->paginate(10);
  }
  public function getAllBreakTypeByCompanyId($companyId)
  {
    return $this->breakTypeRepository->where('company_id', $companyId)->orwhere('company_id', Null)->where('status', '1')->get();
  }
}
