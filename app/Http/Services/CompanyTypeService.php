<?php

namespace App\Http\Services;

use App\Repositories\CompanyTypeRepository;

class CompanyTypeService
{
    private $companyTypeRepository;
    public function __construct(CompanyTypeRepository $companyTypeRepository)
    {
        $this->companyTypeRepository = $companyTypeRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->companyTypeRepository->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        return $this->companyTypeRepository->create($data);
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
        return $this->companyTypeRepository->find($id)->update($data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->companyTypeRepository->find($id)->delete();
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function serachFilterList($request)
    {
        $countryDetails = $this->companyTypeRepository;

        /**List By Search or Filter */
        if (isset($request->search) && !empty($request->search)) {
            $countryDetails = $countryDetails->where('name', 'Like', '%' . $request->search . '%');
        }
        /**List By Status or Filter */
        if (isset($request->status)) {
            $countryDetails = $countryDetails->where('status', $request->status);
        }
        return $countryDetails->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAllActiveCompanyType()
    {
        return $this->companyTypeRepository->where('status', '1')->get();
    }
}
