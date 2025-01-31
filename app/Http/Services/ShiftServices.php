<?php

namespace App\Http\Services;

use App\Repositories\ShiftRepository;

class ShiftServices
{
    private $shiftRepository;
    public function __construct(ShiftRepository $shiftRepository)
    {
        $this->shiftRepository = $shiftRepository;
    }
    public function all()
    {
        return $this->shiftRepository->orderBy('id', 'DESC')->paginate(10);
    }
    public function create(array $data)
    {
        $data['company_id'] = Auth()->user()->company_id;
        $data['created_by'] = Auth()->user()->id;
        return $this->shiftRepository->create($data);
    }

    public function updateDetails(array $data, $id)
    {
        return $this->shiftRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->shiftRepository->find($id)->delete();
    }

    public function serachDepartmentFilterList($request)
    {
        $shiftsDetails = $this->shiftRepository;

        /**List By Search or Filter */
        if (isset($request->search) && !empty($request->search)) {
            $searchKey = $request->search;
            $shiftsDetails = $shiftsDetails->where(function ($query) use ($searchKey) {
                $query->where('name', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('start_time', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('end_time', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('half_day_login', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('check_in_buffer', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('check_out_buffer', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('min_late_count', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('early_checkout_count', 'LIKE', '%' . $searchKey . '%');
            });
        }
        /**List By Status or Filter */
        if (isset($request->status) && !empty($request->status)) {
            if ($request->status == 2) {
                $status = 0;
            } else {
                $status = $request->status;
            }
            $shiftsDetails = $shiftsDetails->where('status', $status);
        }
        /**List By Default or Filter */
        if (isset($request->default) && !empty($request->default)) {
            if ($request->default == 2) {
                $default = 0;
            } else {
                $default = $request->default;
            }
            $shiftsDetails = $shiftsDetails->where('is_default', $default);
        }
        return $shiftsDetails->orderBy('id', 'DESC')->paginate(10);
    }

    public function getAllActiveShifts()
    {
        return $this->shiftRepository->where('status', '1')->get();
    }
}
