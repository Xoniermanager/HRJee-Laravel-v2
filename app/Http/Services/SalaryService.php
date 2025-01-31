<?php

namespace App\Http\Services;

use App\Repositories\SalaryRepository;

class SalaryService
{
    private $salaryRepository;

    public function __construct(SalaryRepository $salaryRepository)
    {
        $this->salaryRepository = $salaryRepository;
    }

    public function getAllSalaries()
    {
        return $this->salaryRepository->orderBy('id', 'DESC')->paginate(10);
    }

    public function create(array $data)
    {
        return $this->salaryRepository->create($data);
    }

    public function updateDetails(array $data, $id)
    {
        return $this->salaryRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->salaryRepository->find($id)->delete();
    }
}
