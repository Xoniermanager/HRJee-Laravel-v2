<?php

namespace App\Jobs;

use App\Http\Services\EmployeeLeaveAvailableService;
use App\Http\Services\EmployeeLeaveManagementService;
use App\Http\Services\EmployeeServices;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Services\LeaveCreditHistoryService;
use App\Http\Services\LeaveCreditManagementServices;


class CreditLeaveJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $leaveCreditManagementService;
    public $leaveCreditHistoryService;
    public $employeeLeaveAvailableService;
    public $employeeLeaveManagementService;
    public $employeeService;
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(LeaveCreditManagementServices $leaveCreditManagementService, LeaveCreditHistoryService $leaveCreditHistoryService, EmployeeLeaveAvailableService $employeeLeaveAvailableService, EmployeeLeaveManagementService $employeeLeaveManagementService, EmployeeServices $employeeService)
    {
        $this->leaveCreditManagementService = $leaveCreditManagementService;
        $this->leaveCreditHistoryService = $leaveCreditHistoryService;
        $this->employeeLeaveAvailableService = $employeeLeaveAvailableService;
        $this->employeeLeaveManagementService = $employeeLeaveManagementService;
        $this->employeeService = $employeeService;

        //Get Data of Leave Credit Details
        $leaveCreditDetails = $this->leaveCreditDetailsBasedOnCurrentDay();
        foreach ($leaveCreditDetails as $leaveCredit) {
            $companyBranchId = $leaveCredit->company_branch_id;
            $employeeTypeId = $leaveCredit->employee_type_id;
            $leaveCreditManagementId = $leaveCredit->id;
            $leaveTypeId = $leaveCredit->leave_type_id;
            $creditValue = $leaveCredit->number_of_leaves;
            $allUserDetails = $this->employeeService->getDetailsByCompanyBranchEmployeeType($companyBranchId, $employeeTypeId);

            foreach ($allUserDetails as $userDetail) {
                $userId = $userDetail->user_id;
                $baseLeaveCreditDate = '';
                $leaveCreditHistory = $this->leaveCreditHistoryService->getDetailsByLeaveCreditManagementIdUserId($leaveCreditManagementId, $userId);
                if (isset($leaveCreditHistory) && !empty($leaveCreditHistory)) {
                    $baseLeaveCreditDate = Carbon::parse($leaveCreditHistory->created_at);
                } else {
                    $baseLeaveCreditDate = Carbon::parse($userDetail->joining_date);
                }
                $startDate = Carbon::parse($baseLeaveCreditDate);
                $endDate = Carbon::parse();
                $months = $startDate->diffInMonths($endDate);
                $days = $startDate->diffInDays($endDate);
                if ($leaveCredit->repeat_in_months = '1') {
                    if ($days > $leaveCredit->minimum_working_days_if_month) {
                        $mode = "Every Month Leave Credited";
                        $creditLeaveDetails = $this->employeeLeaveAvailableService->createDetails($userId, $leaveTypeId, $creditValue, $mode);
                    }
                } else {
                    if ($months > $leaveCredit->repeat_in_months) {
                        $mode = $leaveCredit->repeat_in_months . " Month Leave Credited";
                        $creditLeaveDetails = $this->employeeLeaveAvailableService->createDetails($userId, $leaveTypeId, $creditValue, $mode);
                    }
                }
                if (isset($creditLeaveDetails) && $creditLeaveDetails == true) {
                    $historyDetails = $this->leaveCreditHistoryService->createHistory($userId, $leaveCreditManagementId);
                }
            }
        }
        if (isset($historyDetails) && $historyDetails == true) {
            \Log::info("Leave Created Succussfully");
            echo "Leave Created Succussfully";
        } else {
            \Log::info("No Created Leave Available For Current Month");
            echo "No Created Leave Available For Current Month";
        }
    }

    /** Get Details of Leave Credit Details Based On current Date  */
    public function leaveCreditDetailsBasedOnCurrentDay()
    {
        $currentDay = date('d');
        if ($currentDay > 28 && $currentDay = 31) {
            $currentDay = '0';
        }
        return $this->leaveCreditManagementService->getAllLeaveCreditManagementDetailsBasedOnCurrentDay($currentDay);
    }
}
