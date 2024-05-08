<?php

namespace App\Repositories;

use App\Models\CompanyBranch;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BranchRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CompanyBranch::class;
    }

    // public function deleteDepartmentById($id)
    // {
    //    return $this->where('id',$id);
    // }
    public function getBranchById($id)
    {
       return $this->where('id',$id);
    }

    public function updateBranch($data, $id)
    {
        return  $this->getBranchById($id)->update($data);
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
