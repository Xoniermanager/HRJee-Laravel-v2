<?php

namespace App\Http\Services;

use App\Repositories\DispositionCodeRepository;

class DispositionCodeService
{
    private $dispositionCodeRepository;
    public function __construct(DispositionCodeRepository $dispositionCodeRepository)
    {
        $this->dispositionCodeRepository = $dispositionCodeRepository;
    }

    /**
     * all function
     *
     * @return void
     */
    public function all()
    {
        return $this->dispositionCodeRepository->where('company_id', Auth()->user()->company_id)->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * create function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $data['company_id'] = Auth()->user()->company_id;
        $data['created_by'] = Auth()->user()->id;
        return $this->dispositionCodeRepository->create($data);
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
        return $this->dispositionCodeRepository->find($id)->update($data);
    }

    /**
     * deleteDetails function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->dispositionCodeRepository->find($id)->delete();
    }

    /**
     * serachFilterList function
     *
     * @param [type] $request
     * @return void
     */
    public function serachFilterList($request)
    {
        $dispositionCodeDetails = $this->dispositionCodeRepository->where('company_id', auth()->user()->company_id);
        /** List By Search or Filter */
        if (!empty($request['search'])) {
            $searchKey = $request['search'];
            $dispositionCodeDetails->where(function ($query) use ($searchKey) {
                $query->where('name', 'LIKE', '%' . $searchKey . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchKey . '%');
            });
        }
        /** List By Status or Filter */
        if ($request['status'] != '') {
            $dispositionCodeDetails->where('status', $request['status']);
        }
        return $dispositionCodeDetails->orderBy('id', 'DESC')->paginate(10);

    }

    public function getDispositionCodeByCompanyId($companyId)
    {
        return $this->dispositionCodeRepository->where('company_id', $companyId)->where('status', '1')->get();
    }
}
