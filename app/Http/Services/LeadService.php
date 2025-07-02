<?php

namespace App\Http\Services;

use App\Models\Lead;
use App\Repositories\LeadDocumentRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LeadRepository;
use App\Repositories\LoanRepository;
use App\Repositories\LeadLenderRepository;
use Throwable;

class LeadService
{
    private $leadRepository;

    private $leadLenderRepository;
    private $leadDocumentRepository;
    private $loanRepository;

    public function __construct(LeadRepository $leadRepository, LoanRepository $loanRepository, LeadLenderRepository $leadLenderRepository, LeadDocumentRepository $leadDocumentRepository)
    {
        $this->leadRepository = $leadRepository;
        $this->loanRepository = $loanRepository;
        $this->leadLenderRepository = $leadLenderRepository;
        $this->leadDocumentRepository = $leadDocumentRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->orderBy('id', 'DESC')->paginate(10);
    }
    public function lead($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_sub_state', 'LEAD')->orderBy('id', 'DESC')->paginate(10);
    }
    public function prospect($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_sub_state', 'Prospect')->orderBy('id', 'DESC')->paginate(10);
    }
    public function visit($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_sub_state', 'Visit')->orderBy('id', 'DESC')->paginate(10);
    }
    public function documentation($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_sub_state', 'Documentation')->orderBy('id', 'DESC')->paginate(10);
    }
    public function lenderSelection($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_sub_state', 'LENDER_SELECTION')->orderBy('id', 'DESC')->paginate(10);
    }
    public function login($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_sub_state', 'LOGGED')->orderBy('id', 'DESC')->paginate(10);
    }
    public function sanctioned($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_sub_state', 'SANCTIONED')->orderBy('id', 'DESC')->paginate(10);
    }
    public function rejected($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_sub_state', 'REJECTED')->orderBy('id', 'DESC')->paginate(10);
    }
    public function withdrawn($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_sub_state', 'WITHDRAWN')->orderBy('id', 'DESC')->paginate(10);
    }
    public function pendency($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_sub_state', 'PENDENCY')->orderBy('id', 'DESC')->paginate(10);
    }
    public function disbursed($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_sub_state', 'DISBURSED')->orderBy('id', 'DESC')->paginate(10);
    }
    public function disbursementAll($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_state', 'DISBURSEMENT')->orderBy('id', 'DESC')->paginate(10);
    }
    public function completed($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_sub_state', 'COMPLETED')->orderBy('id', 'DESC')->paginate(10);
    }
    public function incompleted($companyId)
    {
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->where('lead_sub_state', 'INCOMPLETED')->orderBy('id', 'DESC')->paginate(10);
    }
    public function getActiveSalesList()
    {
        return $this->leadRepository->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->orderBy('id', 'DESC')->paginate(10);
    }
    public function leadDocuments($leadId, $companyId)
    {
        return $this->leadDocumentRepository->where('lead_id', $leadId)->where('company_id', $companyId)->get();
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
        return $this->leadRepository->create($finalPayload);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function findByLeadId($id)
    {
        return $this->leadRepository->where('lead_id', $id)->first();
    }

    public function findByLeadCaseId($id)
    {
        return $this->leadRepository->where('case_id', $id)->with(['connector'])->first();
    }
    public function find($id)
    {
        return $this->leadRepository->find($id);
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
        $editDetails = $this->leadRepository->find($id);
        /** for file or file Upload */
        $finalPayload = Arr::except($data, ['_token']);
        return $editDetails->update($finalPayload);
    }
    public function updateState(array $data, $id)
    {
        $editDetails = $this->leadRepository->find($id);
        /** for file or file Upload */
        $finalPayload = Arr::except($data, ['_token']);
        return $editDetails->update($finalPayload);
    }
    public function addLeadLender(array $data)
    {
        $finalPayload = Arr::except($data, ['_token']);
        $finalPayload['company_id'] = Auth()->user()->company_id;
        $finalPayload['created_by'] = Auth()->user()->id;
        return $this->leadLenderRepository->create($finalPayload);
    }
    public function selectedLender($leadId, $companyId)
    {
        return $this->leadLenderRepository->where('lead_id', $leadId)->where('company_id', $companyId)->pluck('lender_id')->toArray();
    }
    public function selectedLenderName($leadId, $companyId)
    {
        return $this->leadLenderRepository
            ->where('lead_id', $leadId)
            ->where('company_id', $companyId)->with(['leadLender'])->first();
    }
    // public function selectedLenderName($leadId, $companyId)
    // {
    //     return $this->leadLenderRepository
    //         ->where('lead_lenders.lead_id', $leadId)
    //         ->where('lead_lenders.company_id', $companyId)
    //         ->join('lenders', 'lead_lenders.lender_id', '=', 'lenders.id')
    //         ->join('default_lenders', 'default_lenders.id', '=', 'lenders.lender_name')
    //         ->value('default_lenders.name as lender_name');
    // }
    public function uploadLoanDocument(array $data)
    {
        $nameForImage = removingSpaceMakingName($data['lead_id']);
        if (isset($data['file']) && !empty($data['file'])) {
            $upload_path = "/lead-docs";
            $filePath = uploadingImageorFile($data['file'], $upload_path, $nameForImage);
            $data['file'] = $filePath;
            $data['company_id'] = auth()->user()->company_id;
            $data['created_by'] = auth()->user()->id;
            $this->leadDocumentRepository->create($data);

            return $filePath;
        }

        return null;
    }

    public function updateLoan(array $data)
    {
        $id = $data['lead_id'];
        $editDetails = $this->loanRepository->where('lead_id', $id)->first();
        if ($editDetails) {
            $finalPayload = Arr::except($data, ['_token']);
            return $editDetails->update($finalPayload);
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
        $deletedData = Lead::find($id);
        $deletedData->coApplicants()->delete();
        $deletedData->loan()->delete();
        $deletedData->incomeDetails()->delete();
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
        return $this->leadRepository->find($id)->update(['status' => $statusValue]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function serachLead($request)
    {
        $leadDetails = $this->leadRepository;


        /**List By Search or Filter */
        if (isset($request->search) && !empty($request->search)) {
            $searchKey = $request->search;

            $leadDetails = $leadDetails->where(function ($query) use ($searchKey) {
                $query->where('customer_name', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('connector_name', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('customer_number', 'LIKE', '%' . $searchKey . '%');
            });
        }
        return $leadDetails->orderBy('id', 'DESC')->paginate(10);
    }
}
