<?php

namespace App\Http\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    private $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function all()
    {
        return $this->productRepository->orderBy('id', 'ASC')->paginate(10);
    }

    public function getByCompanyId($companyID)
    {
        return $this->productRepository->whereIn('company_id', $companyID)->orderBy('listing_order', 'ASC')->paginate(10);
    }
    public function getAllProduct($companyID)
    {
        return $this->productRepository->whereIn('company_id', $companyID)->orderBy('listing_order', 'ASC')->get();
    }

    public function checkProduct($type, $companyID)
    {
        return $this->productRepository->where('type', $type)->where('company_id', $companyID)->where('status', '1')->first();
    }
    public function checkProductListingOrder($listingOrder, $companyID)
    {
        return $this->productRepository->where('listing_order', $listingOrder)->where('company_id', $companyID)->where('status', '1')->first();
    }
    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function getAllProductByCompanyId($companyID)
    {
        return $this->productRepository->whereIn('company_id', $companyID)->get();
    }
    public function getProductByCompanyId($companyID)
    {
        return $this->productRepository->where('company_id', $companyID)->first();
    }
    public function getAllProductsList($companyID)
    {
        return $this->productRepository->where('company_id', $companyID)->where('status', '1')->get();
    }

    public function updateDetails(array $data, $id)
    {
        return $this->productRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->productRepository->find($id)->delete();
    }

    public function searchProductFilterList($request, $companyID)
    {
        $productDetails = $this->productRepository->where('company_id', $companyID);
        /**List By Search or Filter */
        if (isset($request['search']) && !empty($request['search'])) {
            $productDetails = $productDetails->where('type', 'Like', '%' . $request['search'] . '%');
        }
        /**List By Status or Filter */
        if (isset($request['status']) && $request['status'] != "") {
            $productDetails = $productDetails->where('status', $request['status']);
        }
        return $productDetails->orderBy('id', 'ASC')->paginate(10);
    }

    public function getAllActiveProducts()
    {
        return $this->productRepository->where('status', '1')->get();
    }
    public function getAllActiveProductsByCompanyId($companyId)
    {
        if(is_array($companyId)) {
            return $this->productRepository->whereIn('company_id', $companyId)->where('status', '1')->get();
        } else {
            return $this->productRepository->where('company_id', $companyId)->where('status', '1')->get();
        }
    }
    public function getAllAssignedProduct($data)
    {
        if ($data->all_product == 1) {
            return $this->getAllActiveProductsByCompanyId($data->company_id)->pluck('id')->toArray();
        } else {
            return $data->products->pluck('id')->toArray();
        }
    }
}
