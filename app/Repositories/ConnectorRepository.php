<?php

namespace App\Repositories;

use App\Models\CompanyConnector;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ConnectorRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CompanyConnector::class;
    }

    public function getConnectorById($id)
    {
       return $this->where('id',$id);
    }

    public function updateConnector($data, $id)
    {
        return  $this->getConnectorById($id)->update($data);
    }


    /**
     * Boot up the repository, pushing criteria
     */
    
}
