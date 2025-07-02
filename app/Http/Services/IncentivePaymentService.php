<?php

namespace App\Http\Services;

use App\Repositories\IncentivePaymentRepository;
use App\Repositories\ConnectorRepository;

class IncentivePaymentService
{
    private $incentivePaymentRepository;
    private $connectorRepository;
    public function __construct(IncentivePaymentRepository $incentivePaymentRepository, ConnectorRepository $connectorRepository)
    {
        $this->incentivePaymentRepository = $incentivePaymentRepository;
        $this->connectorRepository = $connectorRepository;
    }

   
    public function all($companyId)
    {
        return $this->incentivePaymentRepository->where('company_id', $companyId)->paginate(10);
    }
    public function getConnector($companyId)
    {
        return $this->connectorRepository->where('company_id', $companyId)->select('id', 'connector_name', 'msisdn')->get();
    }
    public function deleteDetails($id)
    {
        return $this->incentivePaymentRepository->find($id)->delete();
    }
    public function find($id)
    {
        return $this->incentivePaymentRepository->find($id);
    }
    public function create(array $data)
    {
        return $this->incentivePaymentRepository->create($data);
    }

   

    public function updateDetails(array $data, $id)
    {
        return $this->incentivePaymentRepository->find($id)->update($data);
    }
   

    
}
