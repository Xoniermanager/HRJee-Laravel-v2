<?php

namespace App\Http\Services;

use App\Repositories\KpiCategoryRepository;

class KpiCategoryService
{
    private $kpiCategoryRepository;
    public function __construct(KpiCategoryRepository $kpiCategoryRepository)
    {
        $this->kpiCategoryRepository = $kpiCategoryRepository;
    }

    /**
     * all function
     *
     * @return void
     */
    public function all($companyIDs = [])
    {
        return $this->kpiCategoryRepository->whereIn('company_id', $companyIDs)->orderBy('id', 'DESC')->paginate(10);
    }


    public function getAllCategoryByCompanyId($companyIDs = [])
    {
        return $this->kpiCategoryRepository->whereIn('company_id', $companyIDs)->where('status',true)->get();
    }

    /**
     * create function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        return $this->kpiCategoryRepository->create($data);
    }

    /**
     * updateDetails function
     *
     * @param array $data
     * @param [type] $id
     * @return void
     */
    public function updateDetails(array $data, $id)
    {
        return $this->kpiCategoryRepository->find($id)->update($data);
    }

    /**
     * deleteDetails function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->kpiCategoryRepository->find($id)->delete();
    }

    /**
     * serachFilterList function
     *
     * @param [type] $request
     * @return void
     */
    public function serachFilterList($request)
    {
        $kpiCategories = $this->kpiCategoryRepository;

        /**List By Search or Filter */
        if (isset($request->search) && !empty($request->search)) {
            $kpiCategories = $kpiCategories->where('name', 'Like', '%' . $request->search . '%');
        }
         /**List By Status */
         if ($request->status != null) {
            $kpiCategories = $kpiCategories->where('status', $request->status);
        }

        return $kpiCategories->orderBy('id', 'DESC')->paginate(10);
    }
}
