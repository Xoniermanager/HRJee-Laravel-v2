<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use App\Repositories\AssignTaskRepository;

class AssignTaskService
{
    private $assignTaskRepository;
    public function __construct(AssignTaskRepository $assignTaskRepository)
    {
        $this->assignTaskRepository = $assignTaskRepository;
    }
    public function create(array $data)
    {
        $data['response_data'] = json_encode(Arr::except($data, ['_token', 'user_id', 'user_end_status', 'final_status', 'document', 'image', 'disposition_code_id']));
        $data['company_id'] = Auth()->user()->company_id;
        $data['created_by'] = Auth()->user()->id;
        $userDetails = User::find($data['user_id']);
        if (isset($data['image']) && !empty($data['image'])) {
            $data['image'] = uploadingImageorFile($data['image'], '/task_image', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }
        if (isset($data['document']) && !empty($data['document'])) {
            $data['document'] = uploadingImageorFile($data['document'], '/task_document', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }
        return $this->assignTaskRepository->create(Arr::except($data, ['_token']));
    }
    public function getTaskDetailsByCompanyId($companyId)
    {
        return $this->assignTaskRepository->where('company_id', $companyId);
    }

    public function getTaskDetailsById($taskId)
    {
        return $this->assignTaskRepository->find($taskId);
    }

    public function updateTaskDetails($data, $taskId)
    {
        $taskDetails = $this->assignTaskRepository->find($taskId);
        $userDetails = User::find($data['user_id']);
        if (isset($data['image']) && !empty($data['image'])) {
            if (!empty($taskDetails->getRawOriginal('image'))) {
                unlinkFileOrImage($taskDetails->getRawOriginal('image'));
            }
            $payload['image'] = uploadingImageorFile($data['image'], '/task_image', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }
        if (isset($data['document']) && !empty($data['document'])) {
            if (!empty($taskDetails->getRawOriginal('document'))) {
                unlinkFileOrImage($taskDetails->getRawOriginal('document'));
            }
            $payload['document'] = uploadingImageorFile($data['document'], '/task_document', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }
        $payload['response_data'] = json_encode(Arr::except($data, ['_token', 'user_id', 'document', 'image', 'disposition_code_id', 'user_end_status', 'final_status']));
        $payload['user_id'] = $data['user_id'];
        $payload['disposition_code_id'] = $data['disposition_code_id'];
        $payload['visit_address'] = $data['visit_address'];
        return $taskDetails->update($payload);
    }

    public function deleteTaskDetails($taskId)
    {
        $taskDetails = $this->assignTaskRepository->find($taskId);
        if (!empty($taskDetails->getRawOriginal('document'))) {
            unlinkFileOrImage($taskDetails->getRawOriginal('document'));
        }
        if (!empty($taskDetails->getRawOriginal('image'))) {
            unlinkFileOrImage($taskDetails->getRawOriginal('image'));
        }
        return $taskDetails->delete();
    }

    public function searchFilterTask($searchKey)
    {
        $taskDetails = $this->assignTaskRepository->where('company_id', Auth()->user()->company_id);

        if (isset($searchKey['user_id']) && !empty($searchKey['user_id'])) {
            $taskDetails->where('user_id', $searchKey['user_id']);
        }

        if (isset($searchKey['final_status']) && !empty($searchKey['final_status'])) {
            $taskDetails->where('user_end_status', $searchKey['final_status']);
            $taskDetails->orWhere('final_status', $searchKey['final_status']);
        }

        if (isset($searchKey['search']) && !empty($searchKey['search'])) {
            $searchKey = $searchKey['search'];
            // Searching by name or email in the related user
            $taskDetails->whereHas('user', function ($query) use ($searchKey) {
                $query->where('name', 'like', '%' . $searchKey . '%')
                    ->orWhere('email', 'like', '%' . $searchKey . '%');
            });
        }
        return $taskDetails->paginate(10);
    }

    public function getAssignedTaskByEmployeeId($userId)
    {
        return $this->assignTaskRepository->where('user_id', $userId);
    }

    public function taskStatusUpdateByApi($data,$taskId)
    {
        $taskDetails = $this->assignTaskRepository->find($taskId);
        $userDetails = User::find($taskDetails->user_id);
        if (isset($data['image']) && !empty($data['image'])) {
            if (!empty($taskDetails->getRawOriginal('image'))) {
                unlinkFileOrImage($taskDetails->getRawOriginal('image'));
            }
            $data['image'] = uploadingImageorFile($data['image'], '/task_image', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }
        if (isset($data['document']) && !empty($data['document'])) {
            if (!empty($taskDetails->getRawOriginal('document'))) {
                unlinkFileOrImage($taskDetails->getRawOriginal('document'));
            }
            $data['document'] = uploadingImageorFile($data['document'], '/task_document', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }
        return $taskDetails->update($data);
    }

    public function getTaskByUserIdAndDateAndStatus($userId, $date, $status)
    {
        return $this->getAssignedTaskByEmployeeId($userId)->whereDate('created_at', $date)->whereIn('user_end_status', $status);
    }
}
