<?php

namespace App\Http\Services;

use App\Repositories\LenderRepository;
use App\Repositories\DefaultLenderRepository;

class LenderService
{
    private $lenderRepository;
    private $defaultLenderRepository;
    public function __construct(LenderRepository $lenderRepository, DefaultLenderRepository $defaultLenderRepository)
    {
        $this->lenderRepository = $lenderRepository;
        $this->defaultLenderRepository = $defaultLenderRepository;
    }
    public function all($companyID)
    {
        return $this->lenderRepository->where('company_id', $companyID)->with(['user:id,name,email', 'product:id,type', 'lender:id,name'])->orderBy('id', 'DESC')->paginate(10);
    }
    public function lenderList($productId)
{
    return $this->lenderRepository->where('product_id', $productId)->with(['lender:id,name'])->orderBy('id', 'DESC')->paginate(5);
}

    public function create(array $data)
    {
        return $this->lenderRepository->create($data);
    }

    public function checkLender(array $data)
    {
        return $this->lenderRepository->where('lender_name', $data['lender_name'])->where('product_id', $data['product_id'])->where('consent_type', $data['consent_type'])->where('individual_case_routing', $data['individual_case_routing'])->where('bulk_case_routing', $data['bulk_case_routing'])->first();
    }
    public function lenderByCompanyId($companyID)
    {
        return $this->lenderRepository->where('company_id', $companyID)->orderBy('id', 'DESC')->get();
    }
    public function defaultLender()
    {
        return $this->defaultLenderRepository->orderBy('id', 'ASC')->get();
    }
    public function updateDetails(array $data, $id)
    {
        return $this->lenderRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->lenderRepository->find($id)->delete();
    }
    public function find($id)
    {
        return $this->lenderRepository->find($id);
    }

    public function searchLenderFilterList($request, $companyID)
    {
        $lenderDetails = $this->lenderRepository->where('company_id', $companyID);

        if (!empty($request['search'])) {
            $searchTerm = $request['search'];
            $matchingDefaultLenders = $this->defaultLenderRepository
                ->where('name', 'LIKE', '%' . $searchTerm . '%')
                ->pluck('id');
            $lenderDetails = $lenderDetails->where(function ($query) use ($searchTerm, $matchingDefaultLenders) {
                $query->where('lender_name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhereIn('lender_name', $matchingDefaultLenders);
            });
        }
        return $lenderDetails->orderBy('id', 'DESC')->paginate(10);
    }
}
