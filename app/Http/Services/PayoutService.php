<?php

namespace App\Http\Services;

use App\Models\PayoutDetail;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PayoutRepository;
use Throwable;

class PayoutService
{
    private $payoutRepository;
    public function __construct(PayoutRepository $payoutRepository)
    {
        $this->payoutRepository = $payoutRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function findByConnectorId($id)
    {
        return $this->payoutRepository->where('connector_id', $id)->first();
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */

    /**
     * Undocumented function
     *
     * @param array $data
     * @param [type] $id
     * @return void
     */
    public function updateDetails(array $data)
    {
        $id = $data['connector_id'] ?? null;
        $editDetails = $this->payoutRepository->where('connector_id', $id)->first();
        $nameForImage = removingSpaceMakingName($id);
        if (isset($data['cancel_cheque']) && $data['cancel_cheque'] instanceof \Illuminate\Http\UploadedFile) {
            $upload_path = "/cancel-cheque";
            if ($editDetails && !empty($editDetails->cancel_cheque)) {
                unlinkFileOrImage($editDetails->cancel_cheque);
            }
            $filePath = uploadingImageorFile($data['cancel_cheque'], $upload_path, $nameForImage);
            $data['cancel_cheque'] = $filePath;
        } else {
            unset($data['cancel_cheque']);
        }

        $finalPayload = Arr::except($data, ['_token']);

        if ($editDetails) {
            return $editDetails->update($finalPayload);
        } else {
            return $this->payoutRepository->create($finalPayload);
        }
    }


    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */


    /**
     * Undocumented function
     *
     * @param [type] $id
     * @param [type] $statusValue
     * @return void
     */

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */

    /**
     * Undocumented function
     *
     * @return void
     */
}
