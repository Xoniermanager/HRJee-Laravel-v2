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

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->shiftRepository->orderBy('id', 'DESC')->paginate(10);
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
        return $this->shiftRepository->create($data);
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @param [type] $id
     * @return void
     */
    public function updateDetails(array $data, $id)
    {
        if(isset($data['is_default']) && $data['is_default']) {
            $alreadyDefaultShift = $this->shiftRepository->where('company_id', auth()->user()->company_id)->where('is_default', 1)->first();

            if($alreadyDefaultShift) {
                return ['success' => false, 'message' => 'Already a default shift exists'];
            }
        }
        $this->shiftRepository->find($id)->update($data);

        return ['success' => true, 'message' => 'Shift details updated successfully'];
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->shiftRepository->find($id)->delete();
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
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

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAllActiveShifts()
    {
        return $this->shiftRepository->where('status', '1')->get();
    }

    public function getByIdShifts($shiftIds)
    {
        return $this->shiftRepository->whereIn('id', $shiftIds)->get();
    }
}
