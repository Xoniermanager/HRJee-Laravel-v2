<?php

namespace App\Http\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LeadStatusManageRepository;
use Throwable;

class LeadStatusManageService
{
    private $leadStatusManageRepository;

    public function __construct(LeadStatusManageRepository $leadStatusManageRepository)
    {
        $this->leadStatusManageRepository = $leadStatusManageRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all($companyId)
    {
        return $this->leadStatusManageRepository->where('company_id', $companyId)->with(['user:id,name'])->orderBy('id', 'DESC')->get();
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $finalPayload = Arr::except($data, ['_token']);
        $finalPayload['company_id'] = Auth()->user()->company_id;
        $finalPayload['created_by'] = Auth()->user()->id;
        return $this->leadStatusManageRepository->create($finalPayload);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function findByLeadId($id, $companyId)
    {
        return $this->leadStatusManageRepository->where('lead_id', $id)->where('company_id', $companyId)->with(['user:id,name'])->orderBy('id', 'DESC')->get();
    }

    public function find($id)
    {
        return $this->leadStatusManageRepository->find($id);
    }

    
}
