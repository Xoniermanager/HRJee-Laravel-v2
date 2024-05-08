<?php

namespace App\Repositories;

use App\Models\Designations;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DesignationsRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Designations::class;
    }

    // public function deleteDepartmentById($id)
    // {
    //    return $this->where('id',$id);
    // }
    public function getDesignationsById($id)
    {
       return $this->where('id',$id);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
