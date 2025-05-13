<?php

namespace App\Http\Services;

use App\Repositories\PerformanceCategoryRepository;

class PerformanceCategoryService
{
    private $performanceCategoryRepository;
    public function __construct(PerformanceCategoryRepository $performanceCategoryRepository)
    {
        $this->performanceCategoryRepository = $performanceCategoryRepository;
    }

    /**
     * all function
     *
     * @return void
     */
    public function all($companyIDs = [])
    {
        return $this->performanceCategoryRepository->whereIn('company_id', $companyIDs)->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * create function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        return $this->performanceCategoryRepository->create($data);
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
        return $this->performanceCategoryRepository->find($id)->update($data);
    }

    /**
     * deleteDetails function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->performanceCategoryRepository->find($id)->delete();
    }

    /**
     * serachFilterList function
     *
     * @param [type] $request
     * @return void
     */
    public function serachFilterList($request)
    {
        $performanceCategories = $this->performanceCategoryRepository;

        /**List By Search or Filter */
        if (isset($request->search) && !empty($request->search)) {
            $performanceCategories = $performanceCategories->where('name', 'Like', '%' . $request->search . '%');
        }
        
        return $performanceCategories->orderBy('id', 'DESC')->paginate(10);
    }
}
