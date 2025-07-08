<?php
namespace App\Repositories;

use App\Models\KpiEmployee;

class KpiEmployeeRepository
{
    public function create(array $data): KpiEmployee
    {
        return KpiEmployee::create($data);
    }

    public function update(KpiEmployee $kpi, array $data): bool
    {
        return $kpi->update($data);
    }

    public function delete(KpiEmployee $kpi): bool
    {
        return $kpi->delete();
    }

    public function toggleStatus(KpiEmployee $kpi): bool
    {
        $kpi->status = !$kpi->status;
        return $kpi->save();
    }

    public function attachRelations(KpiEmployee $kpi, array $branches, array $departments, array $designations, array $employees): void
    {
        $kpi->branches()->attach($branches);
        $kpi->departments()->attach($departments);
        $kpi->designations()->attach($designations);
        $kpi->users()->attach($employees);
    }

    public function syncRelations(KpiEmployee $kpi, array $branches, array $departments, array $designations, array $employees): void
    {
        $kpi->branches()->sync($branches);
        $kpi->departments()->sync($departments);
        $kpi->designations()->sync($designations);
        $kpi->users()->sync($employees);
    }

    public function existsForEmployee(int $companyId, int $cycleId, int $employeeId, ?int $excludeId = null): bool
    {
        $query = KpiEmployee::where('company_id', $companyId)
            ->where('cycle_id', $cycleId)
            ->whereHas('users', fn($q) => $q->where('user_id', $employeeId));

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    public function find(int $id): ?KpiEmployee
    {
        return KpiEmployee::find($id);
    }

    public function listWithFilters(array $filters = [], $companyIds)
    {
        $query = KpiEmployee::with(['branches', 'departments', 'designations', 'users'])
            ->whereIn('company_id', $companyIds);

        if (!empty($filters['cycle_id'])) {
            $query->where('cycle_id', $filters['cycle_id']);
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if ($filters['status'] != null) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('tgt', 'like', '%' . $search . '%')
                    ->orWhereHas('kpiCategory', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('kpiReviewCycle', function ($q) use ($search) {
                        $q->where('type', 'like', '%' . $search . '%');
                    });
            });
        }

        return $query->latest()->paginate(10);
    }


    public function findWithRelations(int $id): ?KpiEmployee
    {
        return KpiEmployee::with(['branches', 'departments', 'designations', 'users'])->find($id);
    }
    public function getAllAssignedToUserWithFiltersPaginated(int $userId, array $filters = [], int $perPage = 10)
    {
        $query = KpiEmployee::with(['branches', 'departments', 'designations', 'users', 'kpiReviewCycle', 'kpiCategory'])
            ->where('status',true)
            ->whereHas('users', function ($q) use ($userId) {
                $q->where('users.id', $userId);
            });

        if (!empty($filters['cycle_id'])) {
            $query->where('cycle_id', $filters['cycle_id']);
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('subject', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('description', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('tgt', 'like', '%' . $filters['search'] . '%');
            });
        }

        return $query->latest()->paginate($perPage);
    }

    public function updateAchievementByUser($kpiEmployeeId, $userId, $achievement)
    {
        $kpi = KpiEmployee::where('id', $kpiEmployeeId)
            ->whereHas('users', function ($q) use ($userId) {
                $q->where('users.id', $userId);
            })
            ->first();
        if (!$kpi) {
            throw new \Exception('KPI not found or not assigned to user.');
        }
        // update pivot
        $kpi->users()->updateExistingPivot($userId, ['achievement' => $achievement]);
        return true;
    }
}
