<?php

namespace App\Http\Services;
use App\Repositories\KpiReviewCycleRepository;


class KpiReviewCycleService
{
    protected $repository;

    public function __construct(KpiReviewCycleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list($filters, $companyId)
    {
        return $this->repository->getAllPaginated($filters, $companyId);
    }

    public function getAllActiveCycelBycompanyId($companyId)
    {
        return $this->repository->getAllActiveCycelBycompanyId($companyId)->get();
    }

    public function create($data)
    {
        return $this->repository->create($data);
    }

    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function toggleStatus($id)
    {
        return $this->repository->toggleStatus($id);
    }
}
