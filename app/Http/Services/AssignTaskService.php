<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\AssignTaskResource;
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
        $data['response_data'] = json_encode(Arr::except($data, ['_token', 'user_id','document', 'image', 'disposition_code_id']));
        $data['company_id'] = Auth()->user()->company_id;
        $data['created_by'] = Auth()->user()->id;
        $userDetails = User::find($data['user_id']);
        if (isset($data['image']) && !empty($data['image'])) {
            $data['image'] = uploadingImageorFile($data['image'], '/task_image', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }
        if (isset($data['document']) && !empty($data['document'])) {
            $data['document'] = uploadingImageorFile($data['document'], '/task_document', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }

        // retrieve latitude longitude from visit address
        $result = app('geocoder')->geocode($data['visit_address'])->get();
        $coordinates = $result[0]->getCoordinates();
        $data['visit_address_latitude'] = $coordinates->getLatitude();
        $data['visit_address_longitude'] = $coordinates->getLongitude();
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
        $payload['visit_address'] =     $data['visit_address'];
        $payload['user_end_status']  =  $data['user_end_status'];
        $payload['final_status']  =  $data['final_status'];
        // retrieve latitude longitude from visit address
        $result = app('geocoder')->geocode($data['visit_address'])->get();
        $coordinates = $result[0]->getCoordinates();
        $payload['visit_address_latitude'] = $coordinates->getLatitude();
        $payload['visit_address_longitude'] = $coordinates->getLongitude();

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

        if (!empty($searchKey['user_id'])) {
            $taskDetails->where('user_id', $searchKey['user_id']);
        }

        if (!empty($searchKey['final_status'])) {
            $taskDetails->where(function ($query) use ($searchKey) {
                $query->where('user_end_status', $searchKey['final_status'])
                      ->orWhere('final_status', $searchKey['final_status']);
            });
        }

        if (!empty($searchKey['search'])) {
            $searchTerm = $searchKey['search'];
            $taskDetails->whereHas('user', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        return $taskDetails->orderBy('id', 'DESC');
    }


    public function getAssignedTaskByEmployeeId($userId, $payload = [])
    {
        $query = $this->assignTaskRepository->where('user_id', $userId);

        if (!empty($payload['final_status'])) {
            $query->where('final_status', $payload['final_status']);
        }

        if (!empty($payload['user_end_status'])) {
            $query->where('user_end_status', $payload['user_end_status']);
        }

        // if (!empty($payload['visit_address'])) {
        //     $keywords = explode(' ', strtolower($payload['visit_address']));
        //     $query->where(function ($q) use ($keywords) {
        //         foreach ($keywords as $word) {
        //             $q->whereRaw('LOWER(visit_address) LIKE ?', ["%$word%"]);
        //         }
        //     });
        // }
        if (!empty($payload['visit_address'])) {
            $address = strtolower($payload['visit_address']);
            $query->where(function ($q) use ($address) {
                $q->whereRaw('LOWER(visit_address) LIKE ?', ["%$address%"]);
            });
        }

        // if (!empty($payload['search_term'])) {
        //     $search = strtolower($payload['search_term']);
        //     $keywords = explode(' ', strtolower($payload['search_term']));

        //     $query->where(function ($q) use ($search) {
        //         $q->whereRaw("JSON_SEARCH(LOWER(response_data), 'all', ?) IS NOT NULL", ["%$search%"]);
        //     })->orWhere(function ($q) use ($keywords) {
        //         foreach ($keywords as $word) {
        //             $q->whereRaw('LOWER(visit_address) LIKE ?', ["%$word%"]);
        //         }
        //     });
        // }

        if (!empty($payload['search_term'])) {
            $search = strtolower($payload['search_term']);

            $query->where(function ($q) use ($search) {
                $q->whereRaw("JSON_SEARCH(LOWER(response_data), 'all', ?) IS NOT NULL", ["%$search%"]);
            })->orWhere(function ($q) use ($search) {
                $q->whereRaw('LOWER(visit_address) LIKE ?', ["%$search%"]);
            });
        }

        if (!empty($payload['month'])) {
            $month = $payload['month'] ?? now()->month;
            $year = now()->year;

            $query->whereMonth('created_at', $month);
            $query->whereYear('created_at', $year);
        }

        return $query;
    }

    public function taskStatusUpdateByApi($data, $taskId)
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

        if ($data['user_end_status'] === 'completed') {
            $data['completed_at'] = Carbon::now();
        }

        return $taskDetails->update($data);
    }

    public function getTaskByUserIdAndDateAndStatus($userId, $date, $status)
    {
        return $this->getAssignedTaskByEmployeeId($userId)->whereDate('created_at', $date)->whereIn('user_end_status', $status);
    }

    public function getTaskStatusCountsByEmployeeId($userId, $month = null)
    {
        $month = $month ?? now()->month;
        $year = now()->year;

        return $this->assignTaskRepository
            ->where('user_id', $userId)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->select('final_status', DB::raw('count(*) as count'))
            ->groupBy('final_status')
            ->pluck('count', 'final_status')
            ->toArray();
    }

    public function fetchVisitLocations($userId, $date = null)
    {
        $query = $this->assignTaskRepository->where('user_id', $userId);

        $providedDate = $date ? \Carbon\Carbon::parse($date)->toDateString() : now()->toDateString();
        $today = now()->toDateString();

        if ($providedDate === $today) {
            // Today: return completed today and all pending
            $query->where(function ($q) use ($today) {
                $q->whereDate('completed_at', $today)
                    ->orWhereNull('completed_at');
            });
        } else {
            // Not today: return only completed on provided date
            $query->whereDate('completed_at', $providedDate);
        }

        $locations = $query->get();

        return AssignTaskResource::collection($locations);
    }
}
