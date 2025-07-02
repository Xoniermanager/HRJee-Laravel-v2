<?php

namespace App\Repositories;

use App\Models\Lead;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LeadRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Lead::class;
    }
    

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
