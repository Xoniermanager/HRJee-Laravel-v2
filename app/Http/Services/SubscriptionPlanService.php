<?php

namespace App\Http\Services;

use App\Repositories\SubscriptionPlanRepository;

class SubscriptionPlanService
{
    private $subscriptionPlanRepository;
    public function __construct(SubscriptionPlanRepository $subscriptionPlanRepository)
    {
        $this->subscriptionPlanRepository = $subscriptionPlanRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->subscriptionPlanRepository->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        return $this->subscriptionPlanRepository->create($data);
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
        return $this->subscriptionPlanRepository->find($id)->update($data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->subscriptionPlanRepository->find($id)->delete();
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return object
     */
    public function getDetails($id)
    {
        return $this->subscriptionPlanRepository->find($id);
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function serachFilterList($request)
    {
        $countryDetails = $this->subscriptionPlanRepository;

        /**List By Search or Filter */
        if (isset($request->search) && !empty($request->search)) {
            $countryDetails = $countryDetails->where('title', 'Like', '%' . $request->search . '%');
        }
        /**List By Status or Filter */
        if (isset($request->status)) {
            $countryDetails = $countryDetails->where('status', $request->status);
        }
        return $countryDetails->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAllActivePlans()
    {
        return $this->subscriptionPlanRepository->where('status', '1')->get();
    }
}
