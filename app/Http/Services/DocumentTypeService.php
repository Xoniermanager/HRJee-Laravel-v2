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
}
