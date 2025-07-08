<?php
namespace App\Http\Services;

use Exception;
use Illuminate\Support\Facades\Auth;
use App\Repositories\KpiEmployeeRepository;
use Illuminate\Validation\ValidationException;

class KpiEmployeeService
{
    protected $repo;

    public function __construct(KpiEmployeeRepository $repo)
    {
        $this->repo = $repo;
    }

    public function store(array $data): void
    {
        $companyId = Auth::user()->company_id;
        $createdBy = Auth::id();

        // foreach ($data['employee_id'] as $empId) {
        //     if ($this->repo->existsForEmployee($companyId, $data['cycle_id'], $empId)) {
        //         throw ValidationException::withMessages([
        //             'employee_id' => "Duplicate KPI exists for employee ID {$empId} in this cycle."
        //         ]);
        //     }
        // }
        $kpi = $this->repo->create([
            'company_id' => $companyId,
            'cycle_id' => $data['cycle_id'],
            'category_id' => $data['category_id'],
            'subject' => $data['subject'],
            'tgt' => $data['tgt'],
            'description' => $data['description'],
            'created_by' => $createdBy,
        ]);

        $this->repo->attachRelations($kpi, $data['company_branch_id'], $data['department_id'], $data['designation_id'], $data['employee_id']);
    }

    public function update(int $id, array $data): void
    {
        $kpi = $this->repo->find($id);
        if (!$kpi)
            throw new \Exception('KPI not found');

        $companyId = $kpi->company_id;

        foreach ($data['employee_id'] as $empId) {
            if ($this->repo->existsForEmployee($companyId, $data['cycle_id'], $empId, $id)) {
                throw ValidationException::withMessages([
                    'employee_id' => "Duplicate KPI exists for employee ID {$empId} in this cycle."
                ]);
            }
        }

        $this->repo->update($kpi, [
            'cycle_id' => $data['cycle_id'],
            'category_id' => $data['category_id'],
            'subject' => $data['subject'],
            'tgt' => $data['tgt'],
            'description' => $data['description'],
        ]);

        $this->repo->syncRelations($kpi, $data['company_branch_id'], $data['department_id'], $data['designation_id'], $data['employee_id']);
    }

    /**
     * Delete KPI if no employees are assigned.
     *
     * @param int $id
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $kpi = $this->repo->find($id);
        if (!$kpi) {
            throw new Exception('KPI not found');
        }

        // Prevent delete if employees are assigned
        if ($kpi->users()->exists()) {
            throw new Exception('Cannot delete: Employees are assigned to this KPI');
        }

        $this->repo->delete($kpi);
    }

    /**
     * Toggle status of KPI and return new status.
     *
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function toggleStatus(int $id): bool
    {
        $kpi = $this->repo->find($id);
        if (!$kpi) {
            throw new Exception('KPI not found');
        }

        return $this->repo->toggleStatus($kpi);
    }

    public function list(array $filters = [], $comanyIds)
    {
        return $this->repo->listWithFilters($filters, $comanyIds);
    }

    public function find(int $id)
    {
        $kpi = $this->repo->findWithRelations($id);
        if (!$kpi)
            throw new \Exception('KPI not found');
        return $kpi;
    }

    public function getAllAssignedKpiForUserPaginatedWithFilters(int $userId, array $filters = [], int $perPage = 10)
    {
        return $this->repo->getAllAssignedToUserWithFiltersPaginated($userId, $filters, $perPage);
    }

    public function submitAchievement($kpiEmployeeId, $userId, $achievement)
    {
        return $this->repo->updateAchievementByUser($kpiEmployeeId, $userId, $achievement);
    }
}
