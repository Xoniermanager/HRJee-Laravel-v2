<?php

namespace App\Http\Services;

use App\Repositories\UserDocumentsDetailRepository;

class UserDocumentDetailServices
{
    private $userDocumentDetailRepository;
    private $documentTypeService;
    public function __construct(UserDocumentsDetailRepository $userDocumentDetailRepository, DocumentTypeService $documentTypeService)
    {
        $this->userDocumentDetailRepository = $userDocumentDetailRepository;
        $this->documentTypeService = $documentTypeService;
    }

    public function create($allDocumentFile)
    {
        $allDocumentTypes = $this->documentTypeService->getAllActiveDocuments();
        $user_id = $allDocumentFile['user_id'];
        foreach ($allDocumentTypes as $documentType) {
            $fileName = removingSpaceMakingName($documentType->name);

            if ($allDocumentFile->hasFile($fileName)) {
                $nameForFile = $fileName . '_' . $user_id;
                $upload_path = "/user_documents";
                $filePath = uploadingImageorFile($allDocumentFile->$fileName, $upload_path, $nameForFile);
                $userDocumentExists = $this->userDocumentDetailRepository->getUserDocumentByUserIdAndDoumentId($user_id, $documentType->id);
                if ($userDocumentExists != null) {
                    unlinkFileOrImage($userDocumentExists->document);
                }
                $response = $this->userDocumentDetailRepository->updateOrCreate(
                    [
                        'user_id'     =>  $user_id,
                        'document_type_id'    =>  $documentType->id
                    ],
                    [
                        'document'    =>  $filePath
                    ]
                );
            }
        }
        return $response;
    }
    public function documents()
    {
        return $this->userDocumentDetailRepository->getUserDocuments();
    }
}
