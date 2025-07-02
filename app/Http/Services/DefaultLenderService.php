<?php

namespace App\Http\Services;

use App\Repositories\DefaultLenderRepository;

class DefaultLenderService
{
    private $defaultLenderRepository;
    public function __construct(DefaultLenderRepository $defaultLenderRepository)
    {
        $this->defaultLenderRepository = $defaultLenderRepository;
    }
    

    public function getByCompanyId($companyID)
    {
        return $this->defaultLenderRepository->whereIn('company_id', $companyID)->orderBy('id', 'DESC')->paginate(10);
    }
    public function lenderByCompanyId($companyID)
    {
        return $this->defaultLenderRepository->where('company_id', $companyID)->orderBy('id', 'DESC')->get();
    }
   

    public function checkDefaultLender($name, $companyID)
    {
        return $this->defaultLenderRepository->where('name', $name)->where('company_id', $companyID)->where('status', '1')->first();
    }
    public function create(array $data)
    {
        return $this->defaultLenderRepository->create($data);
    }

    public function updateDetails(array $data, $id)
    {
        return $this->defaultLenderRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->defaultLenderRepository->find($id)->delete();
    }

    public function searchDefaultLenderFilterList($request, $companyID)
    {
        $defaultLenderDetails = $this->defaultLenderRepository->where('company_id', $companyID);
        /**List By Search or Filter */
        if (isset($request['search']) && !empty($request['search'])) {
            $defaultLenderDetails = $defaultLenderDetails->where('name', 'Like', '%' . $request['search'] . '%');
        }
        /**List By Status or Filter */
        if (isset($request['status']) && $request['status'] != "") {
            $defaultLenderDetails = $defaultLenderDetails->where('status', $request['status']);
        }
        return $defaultLenderDetails->orderBy('id', 'DESC')->paginate(10);
    }

}
