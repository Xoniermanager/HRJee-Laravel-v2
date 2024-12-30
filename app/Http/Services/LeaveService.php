<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\LeaveStatus;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LeaveRepository;

class LeaveService
{
    private $leaveRepository;
    private $employeeLeaveAvailableService;
    public function __construct(LeaveRepository $leaveRepository, EmployeeLeaveAvailableService $employeeLeaveAvailableService)
    {
        $this->leaveRepository = $leaveRepository;
        $this->employeeLeaveAvailableService = $employeeLeaveAvailableService;
    }
    public function all()
    {
        return $this->leaveRepository->orderBy('id', 'DESC')->paginate(10);
    }
    public function create(array $data)
    {
        $payload = array();
        $payload =
            [
                'leave_type_id'            => $data['leave_type_id'],
                'from'                     => $data['from'],
                'to'                       => $data['to'],
                'reason'                   => $data['reason'],
                'leave_status_id'          => LeaveStatus::PENDING
            ];

        if (isset($data['leave_applied_by']) && !empty($data['leave_applied_by'])) {
            $payload['user_id']          = $data['user_id'];
        } else {
            $payload['leave_applied_by'] = Auth::guard('company')->user()->id ?? Auth::guard('employee')->user()->id ?? Auth()->user()->id;
            $payload['user_id'] = Auth::guard('company')->user()->id ?? Auth::guard('employee')->user()->id ?? Auth()->user()->id;
        }

        if (isset($data['is_half_day']) && !empty($data['is_half_day'])) {
            $payload['is_half_day']      = $data['is_half_day'];
            $payload['from_half_day']    = $data['from_half_day'];
            $payload['to_half_day']      = $data['to_half_day'] ?? '';
        }
        $appliedLeaveDetails = $this->leaveRepository->create($payload);
        //dd($appliedLeaveDetails);
        $response = array('status'=>true,'message'=>'Leave Apply successfully','data'=>[]);
        if ($appliedLeaveDetails) {
            $startDate = Carbon::parse($data['from']);
            $endDate = Carbon::parse($data['to']);
            $days = $startDate->diffInDays($endDate);
            $data = $this->employeeLeaveAvailableService->debitLeaveDetails($payload['user_id'], $data['leave_type_id'], $days);
            $response = array('status'=>true,'message'=>'Leave Apply successfully','data'=>$data);
        }
        return $response;
    }
    public function updateDetails(array $data, $id)
    {
        $existingUpdateDetails = $this->leaveRepository->find($id);
        if ($existingUpdateDetails) {
            $response = $existingUpdateDetails->update($data);
            if ($existingUpdateDetails->leave_status_id == 3 || $existingUpdateDetails->leave_status_id == 4) {
                $startDate = Carbon::parse($existingUpdateDetails->from);
                $endDate = Carbon::parse($existingUpdateDetails->to);
                $days = $startDate->diffInDays($endDate);
                $mode = "Leave Cancelled Or Rejected Reverse Leave Credit Amount";
                $response = $this->employeeLeaveAvailableService->createDetails($existingUpdateDetails->user_id, $existingUpdateDetails->leave_type_id, $days, $mode);
            }
        }
        return $response;
    }
    public function getLeaveDetailsOnlyUserId()
    {
        return $this->leaveRepository->select('id', 'user_id')->get();
    }
    public function getAllAppliedLeave()
    {
        return $this->leaveRepository->with(['leaveStatus:id,status,name', 'leaveType:id,name', 'leaveAppliedBy:id,name', 'leaveAction:id,leave_id,remarks,action_taken_by,leave_status_id', 'leaveAction.leaveStatus:id,name,status', 'leaveAction.actionTakenBy:id,name,email'])->where('user_id', auth()->guard('employee_api')->user()->id)->get();
    }
    public function getAppliedLeaveDetailsUsingId($id)
    {
        return $this->leaveRepository->where('id', $id)->where('leave_status_id', '!=', 3)->where('leave_status_id', '!=', 4)->first();
    }
    public function getDetailsById($id)
    {
        return $this->leaveRepository->find($id);
    }
    public function getUserConfirmLeaveByDate($id,$date){
        return $this->leaveRepository->where('user_id',$id)->where('from', '<=', $date)
        ->where('to', '>=', $date)
        ->where('leave_status_id',2)
        ->first();

    }
    public function checkTodayLeaveData($data){
        if($data){
            if($data->from==$data->to){
                if($data->is_half_day){
                    if($data->from_half_day==1){
                        return $response = ['success'=>true,'message'=>'Today on half day','status'=>'1 Half'];
                    }else if($data->from_half_day==2){
                        return $response = ['success'=>true,'message'=>'Today on half day','status'=>'2 Half'];
                    }
                }else{
                    return $response = ['success'=>true,'message'=>'Today on leave','status'=>'Full'];
                }
            }else{
                if($data->is_half_day && date('Y-m-d')==$data->from){
                    if($data->from_half_day==1){
                        return $response = ['success'=>true,'message'=>'Today on half day','status'=>'1 Half'];
                    }else if($data->from_half_day==2){
                        return $response = ['success'=>true,'message'=>'Today on half day','status'=>'2 Half'];
                    }else{
                        return $response = ['success'=>true,'message'=>'Today on leave','status'=>'Full'];
                    }
                }else if( $data->is_half_day &&  date('Y-m-d')==$data->to ){
                    if($data->to_half_day==1){
                        return $response = ['success'=>true,'message'=>'Today on half day','status'=>'1 Half'];
                    }else if($data->to_half_day==2){
                        return $response = ['success'=>true,'message'=>'Today on half day','status'=>'2 Half'];
                    }else{
                        return $response = ['success'=>true,'message'=>'Today on leave','status'=>'Full'];
                    }
                }else{
                    return $response = ['success'=>true,'message'=>'Today on leave','status'=>'Full'];
                } 
            }
        }else{
            return $response = ['success'=>false,'message'=>'Leave not available'];
        }
       
    }
}
