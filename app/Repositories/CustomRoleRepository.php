<?php

namespace App\Repositories;

use App\Models\CustomRole;
use Spatie\Permission\Contracts\Role;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CustomRoleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CustomRoleRepository extends BaseRepository
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
        return $this->where('id', $id);
    }
}
