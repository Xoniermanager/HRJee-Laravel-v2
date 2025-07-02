<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\OfferService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    private $offerService;
    public function __construct(OfferService $offerService)
    {
        $this->offerService = $offerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyIDs = getCompanyIDs();

        return view("company.offers.index", [
            'allOfferDetails' => $this->offerService->all($companyIDs)
        ]);
    }


    public function add()
    {
        return view('company.offers.add');
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
            $offer = $this->offerService->checkOfferTitle($data['title'], $companyIDs);
            if ($offer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Offer already added'
                ], 409);
            } else {
                $this->offerService->create($data);
                return response()->json([
                    'message' => 'Offer created successfully!',
                    'redirect' => route('offer.index')
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function edit($id)
    {
        $companyIDs = getCompanyIDs();
        $editOfferDetails = $this->offerService->find($id);
        return view('company.offers.edit', compact('editOfferDetails'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $companyIDs = auth()->user()->company_id;
        $updateData = $request->except(['_token', 'id']);
        $offerUpdate = $this->offerService->updateDetails($updateData, $request->id);
        if ($offerUpdate) {
            return response()->json([
                'message' => 'Offer updated successfully!',
                'redirect' => route('offer.index')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $id = $request->id;
        $data = $this->offerService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Offer Deleted Successfully',
                'data' => view("company.offers.list", [
                    'allOfferDetails' => $this->offerService->all($companyIDs)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function statusUpdate(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->offerService->updateStatus($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Offers Status Updated Successfully',
                'data' => view("company.offers.list", [
                    'allOfferDetails' => $this->offerService->all($companyIDs)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function searchOfferFilterList(Request $request)
    {
        $searchedItems = $this->offerService->searchOfferFilterList($request, auth()->user()->company_id);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("company.offers.list", [
                    'allOfferDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
