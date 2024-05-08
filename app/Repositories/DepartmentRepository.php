<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Department;
use App\Validators\DepartmentValidator;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DepartmentRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Department::class;
    }

    // public function deleteDepartmentById($id)
    // {
    //    return $this->where('id',$id);
    // }
    public function getDepartmentById($id)
    {
       return $this->where('id',$id);
    }

    public function getDepartmentByCompany($id)
    {
       return $this->where('company_id',$id);
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
