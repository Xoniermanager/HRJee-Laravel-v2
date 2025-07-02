<?php

namespace App\Http\Services;

use App\Repositories\ConfigurePayoutRepository;
use App\Repositories\ConnectorRepository;
use App\Repositories\PayoutRepository;

class ConnectorService
{
  private $connectorRepository;
  private $payoutRepository;
  private $configurePayoutRepository;
  public function __construct(ConnectorRepository $connectorRepository, PayoutRepository $payoutRepository, ConfigurePayoutRepository $configurePayoutRepository)
  {
    $this->connectorRepository = $connectorRepository;
    $this->payoutRepository = $payoutRepository;
    $this->configurePayoutRepository = $configurePayoutRepository;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->connectorRepository
      ->with(['user:id,name,email']) // Load user with only required columns
      ->orderBy('id', 'DESC')
      ->paginate(10);
  }
  public function byStatus(array $companyIDs, ?string $status = null)
  {
    $query = $this->connectorRepository
      ->whereIn('company_id', $companyIDs)
      ->with(['user:id,name']); 

    switch ($status) {
      case 'UNASSIGNED':
        $query->where('status', 'UNASSIGNED');
        break;

      case 'ASSIGNED':
        $query->where('status', 'ASSIGNED');
        break;

      case 'APPROVED':
        $query->where('status', 'APPROVED');
        break;

      case 'REJECTED':
        $query->where('status', 'REJECTED');
        break;

      case 'all':
      default:
        break;
    }
    return $query;
  }
  public function allConnector()
  {
    return $this->connectorRepository->orderBy('id', 'DESC')->select('connector_name')->get();
  }
  public function connectorList($companyId)
  {
    return $this->connectorRepository->where('status', 'APPROVED')->where('company_id', $companyId)->orderBy('id', 'DESC')->get();
  }
  public function allConnectorCount()
  {
    return $this->connectorRepository->count();
  }
  public function pendingApprovalUnassignedConnectorCount()
  {
    return $this->connectorRepository->where('status', 'UNASSIGNED')->count();
  }
  public function pendingApprovalAssignedConnectorCount()
  {
    return $this->connectorRepository->where('status', 'ASSIGNED')->count();
  }
  public function approvedConnectorCount()
  {
    return $this->connectorRepository->where('status', 'APPROVED')->count();
  }
  public function rejectedConnectorCount()
  {
    return $this->connectorRepository->where('status', 'REJECTED')->count();
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    return $this->connectorRepository->create($data);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @param [type] $id
   * @return void
   */
  public function updateDetails(array $data, $id)
  {
    return $this->connectorRepository->find($id)->update($data);
  }
  public function updateKyc(array $data, $id)
  {
    $editKyc = $this->connectorRepository->find($id);
    $nameForImage = removingSpaceMakingName($data['pan_number']);
    if (isset($data['address_proof']) && !empty($data['address_proof'])) {
      $upload_path = "/kyc-doc";
      if (!empty($editKyc->address_proof)) {
        unlinkFileOrImage($editKyc->address_proof);
      }
      $filePath = uploadingImageorFile($data['address_proof'], $upload_path, $nameForImage);
      $data['address_proof'] = $filePath;
      $data['uploaded_file'] = $filePath;
    }
    return $editKyc->update($data);
  }

  public function findByConnectorId($id)
  {
    return $this->connectorRepository->where('connector_id', $id)->first();
  }
  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    $connector = $this->connectorRepository->find($id);
    $payout = $this->payoutRepository->where('connector_id', $connector->connector_id)->first();
    if ($payout) {
      if (isset($payout->cancel_cheque)) {
        unlinkFileOrImage($payout->cancel_cheque);
        $payout->delete();
      }
    }
    if (isset($connector->address_proof)) {
      unlinkFileOrImage($connector->address_proof);
    }
    $configurePayout = $this->configurePayoutRepository->where('connector_id', $connector->connector_id)->get();
    $configurePayout->each->delete();
    $connector->delete();
    return true;
  }

  /**
   * Undocumented function
   *
   * @param [type] $searchKey
   * @return void
   */

  public function searchConnector($request)
  {
    $connectorDetails = $this->connectorRepository;
    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $searchKey = $request->search;

      $connectorDetails = $connectorDetails->where(function ($query) use ($searchKey) {
        $query->where('connector_name', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('email', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('msisdn', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('connector_id', 'LIKE', '%' . $searchKey . '%');
      });
    }
    return $connectorDetails->orderBy('id', 'DESC')->select('connector_name', 'msisdn', 'connector_id', 'id')->get();
  }

  public function searchInCompanyConnector($request)
  {
    $connectorDetails = $this->connectorRepository;
    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $searchKey = $request->search;

      $connectorDetails = $connectorDetails->where(function ($query) use ($searchKey) {
        $query->where('connector_name', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('email', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('msisdn', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('address', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('city', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('pincode', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('profession', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('bussiness_id', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('pan_number', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('gst_in', 'LIKE', '%' . $searchKey . '%');
      });
    }
    return $connectorDetails->orderBy('id', 'DESC')->paginate(10);
  }
}
