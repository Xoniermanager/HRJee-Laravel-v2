<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\CompanyBranch;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CompanyRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Company::class;
    }

    // public function deleteDepartmentById($id)
    // {
    //    return $this->where('id',$id);
    // }
    public function getCompanyById($id)
    {
       return $this->where('id',$id);
    }
    public function updateCompany($data)
    {
       $companyID = Auth::guard('admin')->user()->id;
       return $this->where('id',$companyID)->update($data);
    }

    public function getPrimaryBranchForCompany($id)
    {
         return $this->with('branches')->findOrFail($id);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
