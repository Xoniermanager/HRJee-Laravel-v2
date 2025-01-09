<?php

namespace App\Http\Services;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\WeekendRepository;

class WeekendService
{
    private $weekendRepository;
    public function __construct(WeekendRepository $weekendRepository)
    {
        $this->weekendRepository = $weekendRepository;
    }
    public function all($companyId)
    {
        return $this->weekendRepository->with(['companyBranch', 'department', 'weekday'])->where('company_id', $companyId)->orderBy('id', 'DESC')->paginate(10);
    }
    public function create(array $data)
    {
        try {
            $data['company_id'] = Auth::guard('company')->user()->company_id;
            $payload = Arr::except($data, ['weekday_id', '_token', 'weekend_id']);
            if (isset($data['weekend_id']) && !empty($data['weekend_id'])) {
                $this->weekendRepository->find($data['weekend_id'])->update($payload);
                $response = $this->weekendRepository->find($data['weekend_id']);
            } else {
                $response = $this->weekendRepository->create($payload);
            }
            if ($response) {
                $response->weekday()->sync($data['weekday_id']);
            }
            DB::commit();
            return $response;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred, please try again later.'], 400);
        }
    }
    public function deleteDetails($id)
    {
        $deletedData = $this->weekendRepository->find($id);
        $deletedData->weekday()->detach();
        $deletedData->delete();
        return $deletedData;
    }
    public function updateStatus($weekendId, $status)
    {
        return $this->weekendRepository->find($weekendId)->update(['status' => $status]);
    }
    public function getWeekendDetailsByCompanyBranchIdByCompanyId($companyId, $companyBranchId, $departmentId)
    {
        return $this->weekendRepository->with('weekday')->where('company_id', $companyId)->where('company_branch_id', $companyBranchId)->where('department_id', $departmentId)->first();
    }
}
