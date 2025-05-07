<?php

namespace App\Http\Services;

use App\Repositories\PerformanceManagementRepository;

class PerformanceManagementService
{
    private $performanceManagementRepository;

    public function __construct(PerformanceManagementRepository $performanceManagementRepository)
    {
        $this->performanceManagementRepository = $performanceManagementRepository;
    }

    public function getPerformancesByCompanyId($companyIds)
    {
        return $this->performanceManagementRepository->whereIn('company_id', $companyIds)->with(['user']);
    }

    public function getDetailsById($requestId)
    {
        return $this->performanceManagementRepository->where('id', $requestId)->with(['categoryRecords'])->first();
    }
}
