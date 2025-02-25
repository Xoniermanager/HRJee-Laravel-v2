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

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->breakTypeRepository->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $data['company_id'] = Auth()->user()->company_id;
        $data['created_by'] = Auth()->user()->id;
        return $this->breakTypeRepository->create($data);
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
        return $this->breakTypeRepository->find($id)->update($data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->breakTypeRepository->find($id)->delete();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAllActiveBreakTypeStatus()
    {
        return $this->breakTypeRepository->where('status', '1')->get();
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
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
    
    /**
     * Undocumented function
     *
     * @param [type] $companyId
     * @return void
     */
    public function getAllBreakTypeByCompanyId($companyId)
    {
        return $this->breakTypeRepository->where('company_id', $companyId)->orwhere('company_id', Null)->where('status', '1')->get();
    }
}
