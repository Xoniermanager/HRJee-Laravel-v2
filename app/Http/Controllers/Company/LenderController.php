<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LenderStoreRequest;
use App\Http\Services\LenderService;
use App\Http\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LenderController extends Controller
{
    private $lenderService;
    private $productService;
    public function __construct(LenderService $lenderService, ProductService $productService)
    {
        $this->lenderService = $lenderService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyIDs = getCompanyIDs();

        return view("company.lenders.index", [
            'allLenderDetails' => $this->lenderService->all($companyIDs)
        ]);
    }


    public function add()
    {
        $allProducts = $this->productService->getAllProductsList(Auth()->user()->company_id);
        $allDefaultLenders = $this->lenderService->defaultLender();
        return view('company.lenders.add', compact('allProducts', 'allDefaultLenders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LenderStoreRequest $request)
    {
        try {
            $companyIDs = auth()->user()->company_id;
            $data = $request->all();
            $data['company_id'] = $companyIDs;
            $data['created_by'] = auth()->user()->id;
            $lender = $this->lenderService->checkLender($data);
            if ($lender) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lender already added'
                ], 409);
            } else {
                $this->lenderService->create($data);
                return response()->json([
                    'message' => 'Lender created successfully!',
                    'redirect' => route('lender.index')
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function edit($id)
    {
        $companyIDs = getCompanyIDs();
        $editLenderDetails = $this->lenderService->find($id);
        $allProducts = $this->productService->getAllProductsList(Auth()->user()->company_id);
        $allDefaultLenders = $this->lenderService->defaultLender();
        return view('company.lenders.edit', compact('editLenderDetails', 'allProducts', 'allDefaultLenders'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(LenderStoreRequest $request)
    {
        $companyIDs = auth()->user()->company_id;
        $updateData = $request->except(['_token', 'id']);
        $lenderUpdate = $this->lenderService->updateDetails($updateData, $request->id);
        if ($lenderUpdate) {
            return response()->json([
                'message' => 'Lender updated successfully!',
                'redirect' => route('lender.index')
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
        $data = $this->lenderService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Lenders Deleted Successfully',
                'data' => view("company.lenders.list", [
                    'allLenderDetails' => $this->lenderService->all($companyIDs)
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
        $statusDetails = $this->lenderService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Lenders Status Updated Successfully',
                'data' => view("company.lenders.list", [
                    'allLenderDetails' => $this->lenderService->all($companyIDs)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function searchLenderFilterList(Request $request)
    {
        $searchedItems = $this->lenderService->searchLenderFilterList($request, auth()->user()->company_id);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("company.lenders.list", [
                    'allLenderDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
