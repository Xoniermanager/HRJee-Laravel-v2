<?php

namespace App\Http\Services;

use App\Repositories\BankerProductRepository;

class BankerProductService
{
    private $bankerProductRepository;
    public function __construct(BankerProductRepository $bankerProductRepository)
    {
        $this->bankerProductRepository = $bankerProductRepository;
    }
    public function all($createdBy)
    {
        return $this->bankerProductRepository->where('banker_products.created_by', $createdBy)->join('products', 'products.id', '=', 'banker_products.product_id')->orderBy('banker_products.listing_order', 'ASC')->select('products.*', 'banker_products.*')->paginate(10);
    }


    public function create(array $data)
    {
        return $this->bankerProductRepository->create($data);
    }
    public function checkProduct($productId, $createdBy)
    {
        return $this->bankerProductRepository->where('product_id', $productId)->where('created_by', $createdBy)->where('status', '1')->first();
    }
    public function checkProductListingOrder($listingOrder, $createdBy)
    {
        return $this->bankerProductRepository->where('listing_order', $listingOrder)->where('created_by', $createdBy)->where('status', '1')->first();
    }
    public function updateDetails(array $data, $id)
    {
        return $this->bankerProductRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->bankerProductRepository->find($id)->delete();
    }

    public function searchProductFilterList($request, $companyID, $createdBy)
    {
        $productDetails = $this->bankerProductRepository
            ->where('banker_products.company_id', $companyID)
            ->where('banker_products.created_by', $createdBy)
            ->join('products', 'banker_products.product_id', '=', 'products.id')
            ->select('banker_products.*', 'products.*');

        if (isset($request['search']) && !empty($request['search'])) {
            $productDetails = $productDetails->where(function ($query) use ($request) {
                $query->where('products.type', 'LIKE', '%' . $request['search'] . '%');
            });
        }

        if (isset($request['status']) && $request['status'] != "") {
            $productDetails = $productDetails->where('banker_products.status', $request['status']);
        }
        return $productDetails->orderBy('banker_products.listing_order', 'ASC')->paginate(10);
    }


    public function getAllActiveProducts()
    {
        return $this->bankerProductRepository->where('status', '1')->get();
    }
}
