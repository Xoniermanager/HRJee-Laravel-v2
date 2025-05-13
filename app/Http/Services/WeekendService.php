<?php

namespace App\Http\Services;

use Illuminate\Support\Arr;
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
        return $this->weekendRepository->with(['companyBranch', 'department'])->whereIn('company_id', $companyId)->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        try {
            $data['company_id'] = Auth()->user()->company_id;
            $data['created_by'] = Auth()->user()->id;
            // if(is_array($data['weekend_dates'])) {
                $data['weekend_dates'] = json_encode(explode(",", $data['weekend_dates']));
            // } else {
            //     $data['weekend_dates'] = json_encode(explode(",", [$data['weekend_dates']]));
            // }
            
            $payload = Arr::except($data, ['_token', 'weekend_id']);
            
            if (isset($data['weekend_id']) && !empty($data['weekend_id'])) {
                $this->weekendRepository->find($data['weekend_id'])->update($payload);
                $response = $this->weekendRepository->find($data['weekend_id']);
            } else {
                $response = $this->weekendRepository->create($payload);
            }
            
            return $response;
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred, please try again later.'], 400);
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        $deletedData = $this->weekendRepository->find($id);
        $deletedData->delete();
        return $deletedData;
    }
    public function updateStatus($weekendId, $status)
    {
        return $this->weekendRepository->find($weekendId)->update(['status' => $status]);
    }
    public function getWeekendDetailsByCompanyBranchIdByCompanyId($companyId, $companyBranchId, $departmentId)
    {
        return $this->weekendRepository->where('company_id', $companyId)->where('company_branch_id', $companyBranchId)->where('department_id', $departmentId)->first();
    }
    public function getWeekendDetailByWeekdayId($companyId, $companyBranchId, $departmentId, $searchDate)
    {
        return $this->weekendRepository->where('company_id', $companyId)->where('company_branch_id', $companyBranchId)->where('department_id', $departmentId)->where('status', '1')->whereJsonContains('weekend_dates', $searchDate)->first();
    }
}
