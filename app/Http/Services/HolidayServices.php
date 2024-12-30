<?php

namespace App\Http\Services;

use App\Models\AssignHolidayBranches;
use App\Repositories\HolidayRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HolidayServices
{
    private $holidayRepository;
    public function __construct(HolidayRepository $holidayRepository)
    {
        $this->holidayRepository = $holidayRepository;
    }
    public function all()
    {
        return $this->holidayRepository->orderBy('id', 'DESC')->paginate(10);
    }
    public function create(array $data)
    {
        $data['company_id'] = Auth::guard('company')->user()->company_id;
        $response = $this->holidayRepository->create($data);
        if ($response) {
            $payload = [];

            foreach ($data['company_branch_id'] as $branchID) {
                if ($branchID !== 'all' && $branchID !== '') {
                    $payload[] = [
                        'company_branch_id' => $branchID,
                        'holiday_id' => $response->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
            }

            if (!empty($payload)) {
                AssignHolidayBranches::insert($payload); // Use insert for bulk insert
            }
        }
        return $response;
    }

    public function createBranchHoliday() {}

    public function updateDetails(array $data, $id)
    {
        return $this->holidayRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->holidayRepository->find($id)->delete();
    }
    public function getListByCompanyId($companyID)
    {
        return $this->holidayRepository->where('company_id', $companyID)->where('year', date('Y'))->where('status', '1')->get();
    }
    public function getHolidayByDate($companyID, $date)
    {
        return $this->holidayRepository->where('company_id', $companyID)->where('date', $date)->where('status', '1')->first();
    }
    public function getAllHolidayByDate($companyID, $date)
    {
        return $this->holidayRepository->where('company_id', $companyID)->where('date', $date)->where('status', '1')->get();
    }
    public function getHolidayByMonth($companyID, $month)
    {
        return $this->holidayRepository->where('company_id', $companyID)->where('date', 'LIKE', '%' . $month . '%')->where('year', date('Y'))->where('status', '1')->get();
    }
}
