<?php

namespace App\Http\Services;

use App\Repositories\ComplainCategoryRepository;

class ComplainCategoryService
{
    private $complainCategoryRepository;
    public function __construct(ComplainCategoryRepository $complainCategoryRepository)
    {
        $this->complainCategoryRepository = $complainCategoryRepository;
    }
    public function all()
    {
        return $this->complainCategoryRepository->orderBy('id', 'DESC')->paginate(10);
    }
    public function create(array $data)
    {
        $data['created_by'] = Auth()->user()->id;
        $data['company_id'] = Auth()->user()->company_id;
        return $this->complainCategoryRepository->create($data);
    }

    public function updateDetails(array $data, $id)
    {
        return $this->complainCategoryRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->complainCategoryRepository->find($id)->delete();
    }
    public function getAllActiveComplainStatus()
    {
        return $this->complainCategoryRepository->where('status', '1')->get();
    }

    public function serachComplainCategoryFilterList($request)
    {
        $complainCategoryDetails = $this->complainCategoryRepository;
        /**List By Search or Filter */
        if (isset($request->search) && !empty($request->search)) {
            $complainCategoryDetails = $complainCategoryDetails->where('name', 'Like', '%' . $request->search . '%');
        }
        /**List By Status or Filter */
        if (isset($request->status)) {
            $complainCategoryDetails = $complainCategoryDetails->where('status', $request->status);
        }
        return $complainCategoryDetails->orderBy('id', 'DESC')->paginate(10);
    }
}
