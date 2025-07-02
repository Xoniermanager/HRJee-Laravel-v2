<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\BankerProductService;
use App\Http\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $productService;
    private $bankerProductService;

    public function __construct(ProductService $productService, BankerProductService $bankerProductService)
    {
        $this->productService = $productService;
        $this->bankerProductService = $bankerProductService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyIDs = getCompanyIDs();
        $userType = Auth()->user()->userRole;
        if ($userType->name == 'Banker') {
            $companyID = Auth()->user()->id;
            return view("company.loan_products.index", [
                'allProductDetails' => $this->bankerProductService->all($companyID),
                'allProducts' => $this->productService->getAllProduct($companyIDs)
            ]);
        } else {
            return view("company.loan_products.index", [
                'allProductDetails' => $this->productService->getByCompanyId($companyIDs)
            ]);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $userType = Auth()->user()->userRole;
        $data = $request->all();
        $data['company_id'] = auth()->user()->company_id;
        $data['created_by'] = auth()->user()->id;
        try {
            if ($userType->name == 'Banker') {
                $productListingOrder = $this->bankerProductService->checkProductListingOrder($data['listing_order'], $data['created_by']);
                if ($productListingOrder) {
                    return response()->json(['error' => 'Already have listing order please enter another listing order.'], 400);
                }
                $product = $this->bankerProductService->checkProduct($data['product_id'], $data['created_by']);
                if ($product) {
                    return response()->json(['error' => 'Already have same product'], 400);
                }
                if ($this->bankerProductService->create($data)) {
                    return response()->json([
                        'message' => 'Products Created Successfully!',
                        'data' => view("company.loan_products.product_list", [
                            'allProductDetails' => $this->bankerProductService->all($data['created_by'])
                        ])->render()
                    ]);
                }
            } else {
                $validateProducts = Validator::make($request->all(), [
                    'type' => ['required', 'max:255', 'regex:/^[A-Za-z\s]+$/', 'unique:products,type,NULL,id,company_id,' . auth()->user()->company_id],
                ]);
                if ($validateProducts->fails()) {
                    return response()->json(['error' => $validateProducts->messages()], 400);
                }
                $productListingOrder = $this->productService->checkProductListingOrder($data['listing_order'], $data['company_id']);
                if ($productListingOrder) {
                    return response()->json(['error' => 'Already have listing order please enter another listing order.'], 400);
                }
                $product = $this->productService->checkProduct($data['type'], $data['company_id']);
                if ($product) {
                    return response()->json(['error' => 'Already have same product'], 400);
                }
                $lastProduct = $this->productService->getProductByCompanyId(auth()->user()->company_id);

                if ($lastProduct && preg_match('/LP(\d+)/', $lastProduct->loan_product_id, $matches)) {
                    $lastNumber = (int) $matches[1];
                } else {
                    $lastNumber = 0;
                }

                $nextNumber = $lastNumber + 1;
                $data['loan_product_id'] = 'LP' . str_pad($nextNumber, 8, '0', STR_PAD_LEFT);

                if ($this->productService->create($data)) {
                    return response()->json([
                        'message' => 'Products Created Successfully!',
                        'data' => view("company.loan_products.product_list", [
                            'allProductDetails' => $this->productService->getByCompanyId($companyIDs)
                        ])->render()
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $validateProducts = Validator::make($request->all(), [
            'type' => ['required', 'max:255', 'string', 'regex:/^[A-Za-z\s]+$/', 'unique:products,type,' . $request->id . ',id,company_id,' . auth()->user()->company_id],
        ]);

        if ($validateProducts->fails()) {
            return response()->json(['error' => $validateProducts->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->productService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Products Updated Successfully!',
                    'data' => view('company.loan_products.product_list', [
                        'allProductDetails' => $this->productService->getByCompanyId($companyIDs)
                    ])->render()
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $id = $request->id;
        $userType = Auth()->user()->userRole;
        if ($userType->name == 'Banker') {
            $companyID = Auth()->user()->id;
            $data = $this->bankerProductService->deleteDetails($id);
            if ($data) {
                return response()->json([
                    'success' => 'Products Deleted Successfully',
                    'data' => view("company.loan_products.product_list", [
                        'allProductDetails' => $this->bankerProductService->all($companyID)
                    ])->render()
                ]);
            } else {
                return response()->json(['error' => 'Something Went Wrong!! Please try again']);
            }
        } else {
            $data = $this->productService->deleteDetails($id);
            if ($data) {
                return response()->json([
                    'success' => 'Products Deleted Successfully',
                    'data' => view("company.loan_products.product_list", [
                        'allProductDetails' => $this->productService->getByCompanyId($companyIDs)
                    ])->render()
                ]);
            } else {
                return response()->json(['error' => 'Something Went Wrong!! Please try again']);
            }
        }
        if ($data) {
            return response()->json([
                'success' => 'Products Deleted Successfully',
                'data' => view("company.loan_products.product_list", [
                    'allProductDetails' => $this->productService->getByCompanyId($companyIDs)
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
        $userType = Auth()->user()->userRole;
        if ($userType->name == 'Banker') {
            $companyID = Auth()->user()->id;
            $statusDetails = $this->bankerProductService->updateDetails($data, $id);
            if ($statusDetails) {
                return response()->json([
                    'success' => 'Products Status Updated Successfully',
                    'data' => view("company.loan_products.product_list", [
                        'allProductDetails' => $this->bankerProductService->all($companyID)
                    ])->render()
                ]);
            } else {
                return response()->json(['error' => 'Something Went Wrong!! Please try again']);
            }
        } else {
            $statusDetails = $this->productService->updateDetails($data, $id);
            if ($statusDetails) {
                return response()->json([
                    'success' => 'Products Status Updated Successfully',
                    'data' => view("company.loan_products.product_list", [
                        'allProductDetails' => $this->productService->getByCompanyId($companyIDs)
                    ])->render()
                ]);
            } else {
                return response()->json(['error' => 'Something Went Wrong!! Please try again']);
            }
        }
    }

    public function searchProductFilterList(Request $request)
    {
        $userType = Auth()->user()->userRole;
        if ($userType->name == 'Banker') {
            $companyID = Auth()->user()->id;
            $searchedItems = $this->bankerProductService->searchProductFilterList($request, auth()->user()->company_id, $companyID);
            if ($searchedItems) {
                return response()->json([
                    'success' => 'Searching',
                    'data' => view("company.loan_products.product_list", [
                        'allProductDetails' => $searchedItems
                    ])->render()
                ]);
            } else {
                return response()->json(['error' => 'Something Went Wrong!! Please try again']);
            }
        } else {
            $searchedItems = $this->productService->searchProductFilterList($request, auth()->user()->company_id);
            if ($searchedItems) {
                return response()->json([
                    'success' => 'Searching',
                    'data' => view("company.loan_products.product_list", [
                        'allProductDetails' => $searchedItems
                    ])->render()
                ]);
            } else {
                return response()->json(['error' => 'Something Went Wrong!! Please try again']);
            }
        }
    }
}
