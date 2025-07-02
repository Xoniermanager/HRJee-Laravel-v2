<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\TicketService;

class TicketController extends Controller
{
    private $ticketService;
    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyIDs = getCompanyIDs();
        return view("company.ticket.index", [
            'allTicketDetails' => $this->ticketService->all($companyIDs)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $companyIDs = auth()->user()->company_id;
            $data = $request->all();
            $data['company_id'] = $companyIDs;
            $data['created_by'] = auth()->user()->id;

            $this->ticketService->create($data);
            return response()->json([
                'success' => 'Ticket added Successfully',
                'data' => view("company.ticket.list", [
                    'allTicketDetails' => $this->ticketService->all($companyIDs),
                ])->render()
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $id = $request->id;
        $data = $this->ticketService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Ticket Deleted Successfully',
                'data' => view("company.ticket.list", [
                    'allTicketDetails' => $this->ticketService->all($companyIDs),
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
