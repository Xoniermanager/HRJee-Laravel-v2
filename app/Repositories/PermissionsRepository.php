<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class permissionsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PermissionsRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }
    public function getPermissionsById($id)
    {
       return $this->where('id',$id);
    }

}
