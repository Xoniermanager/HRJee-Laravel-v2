<?php

namespace App\Http\Services;

use App\Repositories\EmployeePRMRepository;

class EmployeePRMService
{
    private $employeePRMRepository;
    public function __construct(EmployeePRMRepository $employeePRMRepository)
    {
        $this->employeePRMRepository = $employeePRMRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->employeePRMRepository->with('category')->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $userDetails = Auth()->user() ?? Auth()->guard('employee_api')->user();
        $data['user_id'] = $userDetails->id;
        if (isset($data['document']) && !empty($data['document'])) {
            $data['document'] = uploadingImageorFile($data['document'], '/prm_document', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }
        return $this->employeePRMRepository->create($data);
    }


    public function update(array $data, $id)
    {
        $userDetails = Auth()->user() ?? Auth()->guard('employee_api')->user();
        $prmRequestDetails = $this->employeePRMRepository->find($id);
        if (isset($data['document']) && !empty($data['document'])) {
            if (!empty($prmRequestDetails->getRawOriginal('document'))) {
                unlinkFileOrImage($prmRequestDetails->getRawOriginal('document'));
            }
            $data['document'] = uploadingImageorFile($data['document'], '/prm_document', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }
        return $prmRequestDetails->update($data);
    }

    public function delete($id)
    {
        $prmRequestDetails = $this->employeePRMRepository->find($id);
        if (!empty($prmRequestDetails->getRawOriginal('document'))) {
            unlinkFileOrImage($prmRequestDetails->getRawOriginal('document'));
        }
        return $prmRequestDetails->delete();
    }

    /**
     * Undocumented function
     *
     * @param [type] $userId
     * @return void
     */
    public function getAllPRMByUserId($userId)
    {
        return $this->employeePRMRepository->where('user_id', $userId)->with('category')->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param [type] $Id
     * @return void
     */
    public function findById($Id)
    {
        return $this->employeePRMRepository->where('id',$Id)->with('category')->first();
    }
}
