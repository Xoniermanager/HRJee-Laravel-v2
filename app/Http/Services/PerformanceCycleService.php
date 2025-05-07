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
        $cycle = $this->performanceCycleRepository->create([
            'company_id' => $data['company_id'],
            'title' => $data['title'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        $userPayload = [];
        foreach ($data['employee_id'] as $value) {
            $userPayload[] = [
                'performance_review_cycle_id' => $cycle->id,
                'user_id' => $value,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];
        }

        $this->reviewCycleUserRepository->insert($userPayload);

        return true;
    }


    public function getCycle($cycleID)
    {
        $cycle = $this->performanceCycleRepository->where('id', $cycleID)->first();

        return $cycle;
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
        $this->performanceCycleRepository->find($id)->update([
            'title' => $data['title'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        $userPayload = [];
        foreach ($data['employee_id'] as $value) {
            $userPayload[] = [
                'performance_review_cycle_id' => $id,
                'user_id' => $value,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];
        }
        $this->reviewCycleUserRepository->where('performance_review_cycle_id', $id)->delete();
        $this->reviewCycleUserRepository->insert($userPayload);

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
