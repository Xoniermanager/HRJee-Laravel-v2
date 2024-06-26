<?php

namespace App\Repositories;

use App\Models\UserDocumentDetail;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;

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

    public function getUserDocumentByUserIdAndDoumentId($userId, $documentId)
    {
        return $this->where('user_id', $userId)->where('document_type_id', $documentId)->first();
    }

    public function getUserDocuments()
    {
        return  $this->where('user_id', Auth::user()->id)->get();
    }
}
