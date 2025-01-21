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
    public function all()
    {
        return $this->companyTypeRepository->orderBy('id', 'DESC')->paginate(10);
    }
    public function create(array $data)
    {
        return $this->companyTypeRepository->create($data);
    }

    public function updateDetails(array $data, $id)
    {
        return $this->companyTypeRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->companyTypeRepository->find($id)->delete();
    }

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
    public function getAllActiveCompanyType()
    {
        return $this->companyTypeRepository->where('status', '1')->get();
    }
}
