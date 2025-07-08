<?php

namespace App\Repositories;

use App\Models\KpiReviewCycle;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class KpiReviewCycleRepository extends BaseRepository
{
    public function model()
    {
        return KpiReviewCycle::class;
    }

    public function getAllPaginated($filters = [], $companyId)
    {
        $query = $this->model::where('company_id', $companyId);

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('start_date', [$filters['start_date'], $filters['end_date']]);
        }

        return $query->orderBy('start_date', 'desc')->paginate(10);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function getAllActiveCycelBycompanyId($companyId)
    {
        return $this->model->whereIn('company_id',$companyId)->where('status',true);
    }

    public function update($id, $data)
    {
        $cycle = $this->model->findOrFail($id);
        $cycle->update($data);
        return $cycle;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function toggleStatus($id)
    {
        $cycle = $this->model->findOrFail($id);
        $cycle->status = !$cycle->status;
        $cycle->save();
        return $cycle;
    }

}
