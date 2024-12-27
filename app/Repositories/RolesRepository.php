<?php

namespace App\Repositories;

use Spatie\Permission\Contracts\Role;
use Prettus\Repository\Eloquent\BaseRepository;

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
        return Role::class;
    }
    public function getRolesById($id)
    {
       return $this->where('id',$id);
    }
}
