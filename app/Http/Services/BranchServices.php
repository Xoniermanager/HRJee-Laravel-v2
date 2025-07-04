<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\BranchRepository;

class BranchServices
{
    private $branchRepository;
    public function __construct(BranchRepository $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    /**
     * Undocumented function
     *
     * @param [type] $companyId
     * @return void
     */
    public function all($companyId)
    {
        return $this->branchRepository->with('country', 'state')->whereIn('company_id', $companyId)->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function allActiveBranches()
    {
        return $this->branchRepository->with('country', 'state')->where('status', 1)->orderBy('id', 'DESC')->get();
    }

    /**
     * Undocumented function
     *
     * @param [type] $companyId
     * @return void
     */
    public function getAllCompanyBranchByCompanyId($companyId)
    {
        return $this->branchRepository->whereIn('company_id', $companyId)->where('status', 1)->orderBy('id', 'DESC')->get();
    }

    public function create($data)
    {
        $data['company_id'] = Auth()->user()->company_id ?? $data['company_id'];
        $data['created_by'] = Auth()->user()->id ?? $data['company_id'];
        return $this->branchRepository->create($data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->branchRepository->find($id)->delete();
    }

    public function updateDetails($data, $id)
    {
        return $this->branchRepository->find($id)->update($data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function searchInCompanyBranch($request)
    {
        $branchDetails = $this->branchRepository;

        /**List By Search or Filter */
        if (isset($request->search) && !empty($request->search)) {
            $searchKey = $request->search;

            $branchDetails = $branchDetails->where(function ($query) use ($searchKey) {
                $query->where('name', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('email', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('contact_no', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('address', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('hr_email', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('city', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('pincode', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('type', 'LIKE', '%' . $searchKey . '%');
            });
        }

        /**List By Country ID or Filter */
        if (isset($request->country_id) && !empty($request->country_id)) {
            $branchDetails = $branchDetails->where('country_id', $request->country_id);
        }

        /**List By State ID  or Filter */
        if (isset($request->state_id) && !empty($request->state_id)) {
            $branchDetails = $branchDetails->where('state_id', $request->state_id);
        }

        /**List By Status or Filter */
        if (isset($request->status) && $request->status != '') {
            if ($request->status == 2 || $request->status == "2") {
                $status = 0;
            } else {
                $status = (int) $request->status;
            }
            $branchDetails = $branchDetails->where('status', $status);
        }

        return $branchDetails->orderBy('id', 'DESC')->paginate(10);
    }

    // if for this use already have created then let me know
    public function getAllBranchByBranchId($ids)
    {
        return $this->branchRepository->whereIn('id', $ids)->get();
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @return void
     */
    public function getAllAssignedCompanyBranches($data)
    {
        if ($data->all_company_branch == 1) {
            return $this->getAllCompanyBranchByCompanyId([$data->company_id])->pluck('id')->toArray();
        } else {
            return $data->companyBranches->pluck('id')->toArray();
        }
    }
}
