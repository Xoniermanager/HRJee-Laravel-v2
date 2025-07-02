<?php

namespace App\Http\Services;

use App\Repositories\OfferRepository;

class OfferService
{
    private $offerRepository;
    public function __construct(OfferRepository $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }
    public function all($companyID)
    {
        return $this->offerRepository->where('company_id', $companyID)->orderBy('id', 'DESC')->paginate(10);
    }
    public function checkOfferTitle($title, $companyID)
    {
        return $this->offerRepository->where('title', $title)->where('company_id', $companyID)->first();
    }

    public function create(array $data)
    {
        $nameForImage = removingSpaceMakingName($data['title']);
        if (isset($data['web_offer_image']) && !empty($data['web_offer_image'])) {
            $upload_path = "/offer-img";
            $filePath = uploadingImageorFile($data['web_offer_image'], $upload_path, $nameForImage);
            $data['web_offer_image'] = $filePath;
        }
        return $this->offerRepository->create($data);
    }


    public function updateDetails(array $data, $id)
    {
        $offer = $this->offerRepository->find($id);
        $nameForImage = removingSpaceMakingName($data['title']);
        if (!empty($data['web_offer_image']) && $data['web_offer_image'] instanceof \Illuminate\Http\UploadedFile) {
            $upload_path = "/offer-img";
            if (!empty($offer->web_offer_image)) {
                unlinkFileOrImage($offer->web_offer_image);
            }
            $filePath = uploadingImageorFile($data['web_offer_image'], $upload_path, $nameForImage);
            $data['web_offer_image'] = $filePath;
        } else {
            unset($data['web_offer_image']);
        }
        return $offer->update($data);
    }
    public function updateStatus(array $data, $id)
    {
        $offer = $this->offerRepository->find($id);
        return $offer->update($data);
    }


    public function deleteDetails($id)
    {

        $offer = $this->offerRepository->find($id);
        if ($offer) {
            if (isset($offer->web_offer_image)) {
                unlinkFileOrImage($offer->web_offer_image);
                return $offer->delete();
            }
        }
    }

    public function find($id)
    {
        return $this->offerRepository->find($id);
    }

    public function searchOfferFilterList($request, $companyID)
    {
        $offerDetails = $this->offerRepository->where('company_id', $companyID);

        if (!empty($request['search'])) {
            $offerDetails = $offerDetails->where('title', 'Like', '%' . $request['search'] . '%');
        }
        return $offerDetails->orderBy('id', 'DESC')->paginate(10);
    }
}
