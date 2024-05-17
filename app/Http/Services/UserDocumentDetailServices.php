<?php

namespace App\Http\Services;

use App\Repositories\UserDocumentsDetailRepository;
use Illuminate\Support\Facades\Storage;
class UserDocumentDetailServices
{
  private $userDocumentDetailRepository;
  private $documentTypeService;
  private $fileUploadService;

  public function __construct(UserDocumentsDetailRepository $userDocumentDetailRepository, DocumentTypeService $documentTypeService, FileUploadService $fileUploadService)
  {
    $this->userDocumentDetailRepository = $userDocumentDetailRepository;
    $this->documentTypeService = $documentTypeService;
    $this->fileUploadService = $fileUploadService;
  }

  public function create($allDocumentFile)
  {
    $allDocumentTypes = $this->documentTypeService->getAllActiveDocuments();
    $user_id = $allDocumentFile['user_id'];
    foreach ($allDocumentTypes as $documentType)
    {
      $fileName = removingSpaceMakingName($documentType->name);

      if ($allDocumentFile->hasFile($fileName))
      {
        $nameForFile = $fileName . '_' . $user_id;
        $upload_path = "/user_documents";
        $imagePath = $this->fileUploadService->imageUpload($allDocumentFile->$fileName, $upload_path, $nameForFile);

        $userDocumentExists = $this->userDocumentDetailRepository->getUserDocumentByUserIdAndDoumentId($user_id,$documentType->id);
        if($userDocumentExists != null)
        {
          if(file_exists(storage_path('app/public'). $userDocumentExists->document))
          {
            unlink(storage_path('app/public'). $userDocumentExists->document);
          }
        }
       
        $this->userDocumentDetailRepository->updateOrCreate([
          'user_id'     =>  $user_id,
          'document_type_id'    =>  $documentType->id
        ],
        [
          'document'    =>  $imagePath
        ]);
      }
    }
  }
}
