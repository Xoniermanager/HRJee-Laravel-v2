<?php

namespace App\Http\Services;

use App\Repositories\TicketRepository;

class TicketService
{
    private $ticketRepository;
    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

   
    public function all($companyId)
    {
        return $this->ticketRepository->where('company_id', $companyId)->paginate(10);
    }
    public function deleteDetails($id)
    {
        return $this->ticketRepository->find($id)->delete();
    }
    public function find($id)
    {
        return $this->ticketRepository->find($id);
    }
    public function create(array $data)
    {
        return $this->ticketRepository->create($data);
    }
    
}
