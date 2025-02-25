<?php

namespace App\Http\Services;

use App\Repositories\LeaveCreditManagementRepository;

class LeaveCreditManagementServices
{
    private $leaveCreditManagementRepository;
    public function __construct(LeaveCreditManagementRepository $leaveCreditManagementRepository)
    {
        $this->leaveCreditManagementRepository = $leaveCreditManagementRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->leaveCreditManagementRepository->where('company_id', Auth()->user()->company_id)->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $data['company_id'] = Auth()->user()->company_id;
        $data['created_by'] = Auth()->user()->id;
        return $this->leaveCreditManagementRepository->create($data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @return void
     */
    public function updateDetails($data)
    {
        return $this->leaveCreditManagementRepository->find($data['id'])->update($data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->leaveCreditManagementRepository->find($id)->delete();
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function serachLeaveCreditFilterList($request)
    {
        $leaveCreditManagementDetails = $this->leaveCreditManagementRepository;
        /**List By Status or Filter */
        if (isset($request->status)) {
            $leaveCreditManagementDetails = $leaveCreditManagementDetails->where('status', $request->status);
        }
        /**List By Company Branches or Filter */
        if (isset($request->filter_company_branch)) {
            $leaveCreditManagementDetails = $leaveCreditManagementDetails->where('company_branch_id', $request->filter_company_branch);
        }
        /**List By Employee Type or Filter */
        if (isset($request->filter_employee_type)) {
            $leaveCreditManagementDetails = $leaveCreditManagementDetails->where('employee_type_id', $request->filter_employee_type);
        }
        /**List By Leave Type or Filter */
        if (isset($request->filter_leave_type)) {
            $leaveCreditManagementDetails = $leaveCreditManagementDetails->where('leave_type_id', $request->filter_leave_type);
        }
        return $leaveCreditManagementDetails->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAllActiveLeaveCreditManagementDetails()
    {
        return $this->leaveCreditManagementRepository->where('status', '1')->get();
    }

    /**
     * Undocumented function
     *
     * @param [type] $currentDay
     * @return void
     */
    public function getAllLeaveCreditManagementDetailsBasedOnCurrentDay($currentDay)
    {
        return $this->leaveCreditManagementRepository->where('credit_leave_on_day', $currentDay)->where('status', '1')->get();
    }
}
