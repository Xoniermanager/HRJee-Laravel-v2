<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Roles;

/**
 * Class rolesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RolesRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Roles::class;
    }
    public function getRolesById($id)
    {
       return $this->where('id',$id);
    }    
}
