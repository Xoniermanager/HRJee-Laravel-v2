<?php

namespace App\Http\Services;

use App\Repositories\TaxSlabRuleRepository;

class TaxSlabRuleService
{
    private $taxSlabRuleRepository;
    public function __construct(TaxSlabRuleRepository $taxSlabRuleRepository)
    {
        $this->taxSlabRuleRepository = $taxSlabRuleRepository;
    }
    public function all($companyId)
    {
        return $this->taxSlabRuleRepository->where('company_id', $companyId)->orderBy('id', 'DESC');
    }
    public function getActiveTaxSlab($companyId)
    {
        return $this->taxSlabRuleRepository->where('company_id', $companyId)->where('status',1)->get();
    }
    public function create(array $data)
    {
        return $this->taxSlabRuleRepository->create($data);
    }

    public function updateDetails(array $data, $id)
    {
        return $this->taxSlabRuleRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->taxSlabRuleRepository->find($id)->delete();
    }
    public function serachTaxSlabFilterList($request)
    {
        $taxSlabDetails = $this->taxSlabRuleRepository->orderBy('id', 'DESC');
        // List By Search or Filter
        if (!empty($request['search'])) {
            $taxSlabDetails->where('income_range_start', 'LIKE', '%' . $request['search'] . '%')
                ->orWhere('income_range_end', 'LIKE', '%' . $request['search'] . '%')
                ->orWhere('tax_rate', 'LIKE', '%' . $request['search'] . '%');
        }
        // List By Status or Filter
        if (isset($request['status']) && $request['status'] !== null) {
            $taxSlabDetails->where('status', $request['status']);
        }
        // Return paginated results
        return $taxSlabDetails->paginate(10);
    }
}
