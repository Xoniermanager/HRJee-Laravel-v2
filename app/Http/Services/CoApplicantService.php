<?php

namespace App\Http\Services;

use App\Models\CoApplicant;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CoApplicantRepository;
use Throwable;

class CoApplicantService
{
    private $coApplicantRepository;
    public function __construct(CoApplicantRepository $coApplicantRepository)
    {
        $this->coApplicantRepository = $coApplicantRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->coApplicantRepository->orderBy('id', 'DESC')->paginate(10);
    }
    public function findByLeadId($id)
    {
        return $this->coApplicantRepository->where('lead_id', $id)->first();
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
        return $this->coApplicantRepository->create($finalPayload);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function findByCoApplicantId($id)
    {
        return $this->coApplicantRepository->find($id);
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @param [type] $id
     * @return void
     */

    public function updateCoApplicant($leadId, $coApplicant)
    {
        $existingCoApplicant = $this->coApplicantRepository->where('lead_id', $leadId)->first();
        $finalPayload = Arr::except($coApplicant, ['_token']); 

        if ($existingCoApplicant) {
            return $existingCoApplicant->update($finalPayload);
        } else {
            $finalPayload['lead_id'] = $leadId;
            return $this->coApplicantRepository->create($finalPayload);
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
        $deletedData = CoApplicant::find($id);
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
        return $this->coApplicantRepository->find($id)->update(['status' => $statusValue]);
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
