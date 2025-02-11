<?php

namespace App\Http\Services;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\HolidayRepository;

class HolidayServices
{
    private $holidayRepository;
    public function __construct(HolidayRepository $holidayRepository)
    {
        $this->holidayRepository = $holidayRepository;
    }
    public function all()
    {
        return $this->holidayRepository->where('company_id', Auth()->user()->id)->with('companyBranch')->orderBy('id', 'DESC')->paginate(10);
    }
    public function create(array $data)
    {
        try {
            $data['company_branch_id'] = array_filter($data['company_branch_id'], function ($value) {
                return $value !== 'all';
            });
            $data['company_branch_id'] = array_values($data['company_branch_id']);
            $data['company_id'] = Auth()->user()->company_id;
            $data['created_by'] = Auth()->user()->id;

            $response = $this->holidayRepository->create(Arr::except($data, 'company_branch_id'));
            if ($response) {
                $response->companyBranch()->sync($data['company_branch_id']);
            }
            DB::commit();
            return $response;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred, please try again later.'], 400);
        }
    }
    public function updateDetails(array $data, $id)
    {
        
        DB::beginTransaction();
        try {
            $holidayDetails = $this->holidayRepository->find($id);
            $data['company_branch_id'] = array_filter($data['company_branch_id'], function ($value) {
                return $value !== 'all';
            });
                    
            $data['company_branch_id'] = array_values($data['company_branch_id']);
            $data['company_id'] = Auth()->user()->id;
            $holidayDetails->update(Arr::except($data, 'company_branch_id'));
            if ($holidayDetails) {
                $holidayDetails->companyBranch()->sync($data['company_branch_id']);
            }
            DB::commit();
            return $holidayDetails;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred, please try again later.'], 400);
        }
    }
    public function deleteDetails($id)
    {
        $deletedData = $this->holidayRepository->find($id);
        $deletedData->companyBranch()->detach();
        $deletedData->delete();
        return $deletedData;
    }

    public function getListByCompanyId($companyID, $year = NULL, $month = NULL, $date = NULL)
    {
        $holidayQuery = $this->holidayRepository->where('company_id', $companyID)->where('year', $year)->where('status', '1');
        if($month) {
            $holidayQuery = $holidayQuery->whereMonth('date', $month);
        } 
        
        if($date) {
            $holidayQuery = $holidayQuery->where('date', $date);
        }

        return $holidayQuery->whereHas('companyBranch', function ($query) {
            $query->where('company_branch_id', auth()->user()->details->company_branch_id);
        })->get();
    }

    public function getHolidayByDate($companyID, $date)
    {
        return $this->holidayRepository->where('company_id', $companyID)->where('date', $date)->where('status', '1');
    }
    public function getHolidayByMonth($companyID, $month)
    {
        return $this->holidayRepository->where('company_id', $companyID)->where('date', 'LIKE', '%' . $month . '%')->where('year', date('Y'))->where('status', '1')->get();
    }

    public function getHolidayByCompanyBranchId($companyId, $date, $companyBranchId)
    {
        return $this->holidayRepository->where('company_id', $companyId)->where('date', $date)->where('status', '1')
            ->whereHas('companyBranch', function ($query) use ($companyBranchId) {
                $query->where('company_branch_id', $companyBranchId);
            })->first();
    }
    public function getHolidayByMonthByCompanyBranchId($companyId, $month, $year, $companyBranchId)
    {
        return $this->holidayRepository->where('company_id', $companyId)->whereMonth('date', $month)->where('year', $year)->where('status', '1')
            ->whereHas('companyBranch', function ($query) use ($companyBranchId) {
                $query->where('company_branch_id', $companyBranchId);
            });
    }

    public function searchFilterData($companyId, $request)
    {
        $holidayDetails = $this->holidayRepository->where('company_id', $companyId);

        /** List By Search or Filter */
        if (isset($request['search']) && !empty($request['search'])) {
            $holidayDetails = $holidayDetails->where('name', 'like', '%' . $request['search'] . '%');
        }

        /** List By Status or Filter */
        if (isset($request['status']) && $request['status'] !== null) {
            $holidayDetails = $holidayDetails->where('status', $request['status']);
        }

        /** List By Company Branch Filter */
        if (isset($request['companyBranchId']) && !empty($request['companyBranchId'])) {
            $companyBranchId = $request['companyBranchId'];
            $holidayDetails = $holidayDetails->whereHas('companyBranch', function ($query) use ($companyBranchId) {
                $query->where('company_branch_id', $companyBranchId);
            });
        }
        return $holidayDetails->paginate(10);
    }

    public function updateStatus($holidayId,$statusValue)
    {
        return $this->holidayRepository->find($holidayId)->update(['status' => $statusValue]);
    }
}
