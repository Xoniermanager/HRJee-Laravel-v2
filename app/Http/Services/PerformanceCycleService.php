<?php

namespace App\Http\Services;

use App\Repositories\PerformanceCycleRepository;
use App\Repositories\ReviewCycleUserRepository;

class PerformanceCycleService
{
    private $performanceCycleRepository;
    private $reviewCycleUserRepository;

    public function __construct(PerformanceCycleRepository $performanceCycleRepository, ReviewCycleUserRepository $reviewCycleUserRepository)
    {
        $this->performanceCycleRepository = $performanceCycleRepository;
        $this->reviewCycleUserRepository = $reviewCycleUserRepository;
    }

    /**
     * all function
     *
     * @return void
     */
    public function all($companyIDs = [])
    {
        return $this->performanceCycleRepository->whereIn('company_id', $companyIDs)->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * create function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        // Create the cycle record
        $cycle = $this->performanceCycleRepository->create([
            'company_id' => $data['company_id'],
            'title' => $data['title'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'department_id' => implode(',', $data['department_id']),
            'company_branch_id' => implode(',', $data['company_branch_id']),
            'designation_id' => implode(',', $data['designation_id']),
        ]);

        // Sync employees via relation (clean and efficient)
        $cycle->users()->sync($data['employee_id']);

        return true;
    }


    public function getCycle($cycleID)
    {
        return $this->performanceCycleRepository->where('id', $cycleID)->first();
    }

    /**
     * updateDetails function
     *
     * @param array $data
     * @param [type] $id
     * @return void
     */
    public function updateDetails(array $data, $id)
    {
        // Find and update the cycle
        $cycle = $this->performanceCycleRepository->find($id);
        $cycle->update([
            'title' => $data['title'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'department_id' => implode(',', $data['department_id']),
            'company_branch_id' => implode(',', $data['company_branch_id']),
            'designation_id' => implode(',', $data['designation_id']),
        ]);

        // Sync the users
        $cycle->users()->sync($data['employee_id']);

        return true;
    }

    /**
     * deleteDetails function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->performanceCycleRepository->find($id)->delete();
    }

    /**
     * serachFilterList function
     *
     * @param [type] $request
     * @return void
     */
    public function serachFilterList($request)
    {
        $performanceCategories = $this->performanceCycleRepository;

        /**List By Search or Filter */
        if (isset($request->search) && !empty($request->search)) {
            $performanceCategories = $performanceCategories->where('title', 'Like', '%' . $request->search . '%');
        }

        return $performanceCategories->orderBy('id', 'DESC')->paginate(10);
    }
}
