<?php

namespace App\Http\Services;

use App\Repositories\NoticeRepository;

class NoticeService
{
    private $noticeRepository;
    public function __construct(NoticeRepository $noticeRepository)
    {
        $this->noticeRepository = $noticeRepository;
    }
    public function all($companyID)
    {
        return $this->noticeRepository->where('company_id', $companyID)->orderBy('id', 'DESC')->paginate(10);
    }
    public function checkNoticeTitle($title, $companyID)
    {
        return $this->noticeRepository->where('title', $title)->where('company_id', $companyID)->first();
    }

    public function create(array $data)
    {
        $nameForImage = removingSpaceMakingName($data['title']);
        if (isset($data['attachment']) && !empty($data['attachment'])) {
            $upload_path = "/notices";
            $filePath = uploadingImageorFile($data['attachment'], $upload_path, $nameForImage);
            $data['attachment'] = $filePath;
        }
        return $this->noticeRepository->create($data);
    }


    public function updateDetails(array $data, $id)
    {
        $notice = $this->noticeRepository->find($id);
        $nameForImage = removingSpaceMakingName($data['title']);
        if (!empty($data['attachment']) && $data['attachment'] instanceof \Illuminate\Http\UploadedFile) {
            $upload_path = "/notices";
            if (!empty($notice->attachment)) {
                unlinkFileOrImage($notice->attachment);
            }
            $filePath = uploadingImageorFile($data['attachment'], $upload_path, $nameForImage);
            $data['attachment'] = $filePath;
        } else {
            unset($data['attachment']);
        }
        return $notice->update($data);
    }
    public function updateStatus(array $data, $id)
    {
        $notice = $this->noticeRepository->find($id);
        return $notice->update($data);
    }


    public function deleteDetails($id)
    {

        $notice = $this->noticeRepository->find($id);
        if ($notice) {
            if (isset($notice->attachment)) {
                unlinkFileOrImage($notice->attachment);
                return $notice->delete();
            }
        }
    }

    public function find($id)
    {
        return $this->noticeRepository->find($id);
    }

    public function searchNoticeFilterList($request, $companyID)
    {
        $noticeDetails = $this->noticeRepository->where('company_id', $companyID);

        if (!empty($request['search'])) {
            $noticeDetails = $noticeDetails->where('title', 'Like', '%' . $request['search'] . '%');
        }
        return $noticeDetails->orderBy('id', 'DESC')->paginate(10);
    }
}
