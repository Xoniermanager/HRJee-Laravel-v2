<?php

namespace App\Http\Services;

use App\Models\IncomeDetail;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Repositories\IncomeDetailRepository;
use Throwable;

class IncomeDetailService
{
    private $incomeDetailRepository;
    public function __construct(IncomeDetailRepository $incomeDetailRepository)
    {
        $this->incomeDetailRepository = $incomeDetailRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->incomeDetailRepository->orderBy('id', 'DESC')->paginate(10);
    }

    public function findByLeadId($id)
    {
        return $this->incomeDetailRepository->where('lead_id', $id)->first();
    }
    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $finalPayload = Arr::except($data, ['_token']);
        $finalPayload['company_id'] = Auth()->user()->company_id;
        $finalPayload['created_by'] = Auth()->user()->id;
        return $this->incomeDetailRepository->create($finalPayload);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function updateIncome($leadId, $income)
    {
        $existingIncome = $this->incomeDetailRepository->where('lead_id', $leadId)->first();
        $finalPayload = Arr::except($income, ['_token']); 

        if ($existingIncome) {
            return $existingIncome->update($finalPayload);
        } else {
            $finalPayload['lead_id'] = $leadId;
            return $this->incomeDetailRepository->create($finalPayload);
        }
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @param [type] $id
     * @return void
     */


    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        $deletedData = IncomeDetail::find($id);
        $deletedData->delete();
        return true;
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @param [type] $statusValue
     * @return void
     */
    public function updateStatus($id, $statusValue)
    {
        return $this->incomeDetailRepository->find($id)->update(['status' => $statusValue]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */

    /**
     * Undocumented function
     *
     * @return void
     */
}
