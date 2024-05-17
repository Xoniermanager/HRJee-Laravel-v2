<?php

namespace App\Repositories;

use App\Models\UserDocumentDetail;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserDocumentsDetailRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserDocumentDetail::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getUserDocumentByUserIdAndDoumentId($userId,$documentId)
    {
        return $this->where('user_id',$userId)->where('document_type_id',$documentId)->first();
    }
    
}
