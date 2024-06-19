<?php

namespace App\Http\Services;

use App\Repositories\DocumentTypeRepository;

class DocumentTypeService
{
  private $documentTypeRepository;
  public function __construct(DocumentTypeRepository $documentTypeRepository)
  {
    $this->documentTypeRepository = $documentTypeRepository;
  }
  public function all()
  {
    return $this->documentTypeRepository->orderBy('id','DESC')->paginate(10);
  }

  public function create(array $data)
  {
    return $this->documentTypeRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->documentTypeRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->documentTypeRepository->find($id)->delete();
  }

  public function getAllActiveDocuments()
  {
    return $this->documentTypeRepository->where('status','1')->get();
  }
  public function searchInDocumentType($searchKey)
  {
    $data['key']     =  array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status']  =  array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

    return $this->documentTypeRepository->where(function($query) use ($data) {
      if (!empty($data['key'])) {
          $query->where('name', 'like', "%{$data['key']}%")
           ->orWhere('description', 'like', "%{$data['key']}%");
      }

      if (isset($data['status'])) {
          $query->where('status', $data['status']);
      }
    })->get();
  }
}
