<?php

namespace App\Http\Services;

use App\Models\Loan;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LoanRepository;
use Throwable;

class LoanService
{
    private $loanRepository;
    public function __construct(LoanRepository $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->loanRepository->orderBy('id', 'DESC')->paginate(10);
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
        return $this->loanRepository->create($finalPayload);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function findByLoanId($id)
    {
        return $this->loanRepository->find($id);
    }
    public function findByLeadId($id)
    {
        return $this->loanRepository->where('lead_id', $id)->with(['productName'])->first();
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
        $editDetails = $this->loanRepository->find($id);
        /** for file or file Upload */
        $finalPayload = Arr::except($data, ['_token']);
        $leadUdatesDetails = $editDetails->update($finalPayload);
        return true;
    }

     public function updateProduct($leadId, $product)
    {
        $loan = $this->loanRepository->where('lead_id', $leadId)->first();
        $finalPayload = Arr::except($product, ['_token']);
        if ($loan) {

            return $loan->update($finalPayload);
        } else {
            $finalPayload['lead_id'] = $leadId;
            return $this->loanRepository->create($finalPayload);
        }
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        $deletedData = Loan::find($id);
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
        return $this->loanRepository->find($id)->update(['status' => $statusValue]);
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
