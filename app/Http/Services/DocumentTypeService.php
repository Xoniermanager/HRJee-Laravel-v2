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

  /**
   * all function
   *
   * @return void
   */
  public function all()
  {
    return $this->documentTypeRepository->orderBy('id','DESC')->paginate(10);
  }

  /**
   * create function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    return $this->documentTypeRepository->create($data);
  }

  /**
   * updateDetails function
   *
   * @param array $data
   * @param [type] $id
   * @return void
   */
  public function updateDetails(array $data, $id)
  {
    return $this->documentTypeRepository->find($id)->update($data);
  }

  /**
   * deleteDetails function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->documentTypeRepository->find($id)->delete();
  }

  /**
   * getAllActiveDocuments function
   *
   * @return void
   */
  public function getAllActiveDocuments()
  {
    return $this->documentTypeRepository->where('status','1')->get();
  }

  /**
   * searchInDocumentType function
   *
   * @param [type] $searchKey
   * @return void
   */
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

  /**
   * getAllActiveDocumentType function
   *
   * @return void
   */
  public function getAllActiveDocumentType()
  {
    return $this->documentTypeRepository->where('status','1')->get();
  }
}
