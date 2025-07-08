<?php

namespace App\Http\Services;

use App\Repositories\SupportRepository;
use Throwable;

class SupportService
{
    private $supportRepository;
    public function __construct(SupportRepository $supportRepository)
    {
        $this->supportRepository = $supportRepository;
    }

    /**
     * Undocumented function
     *
     * @param string $userId
     * @return void
     */
    public function all($userId = '')
    {
        $query = $this->supportRepository->where('company_id', auth()->user()->company_id)->orderBy('id', 'DESC');
        if (!empty($userId))
            $query = $query->where('user_id', $userId);

        return $query->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param [type] $statuses
     * @param [type] $userId
     * @return void/object/null
     */
    public function getSupportStatusIds($statuses, $userId)
    {
        return $this->supportRepository
            ->whereIn('status', $statuses)
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->get();
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @param [type] $userId
     * @return void
     */
    public function support($data, $userId)
    {
        $data['user_id'] = $userId;
        $data['company_id'] = auth()->user()->company_id;
        $data['created_by'] = auth()->user()->id;
        $checkActionStatus = $this->supportRepository->create($data);
        if ($checkActionStatus)
            return true;
        else
            return false;
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @param [type] $resignationId
     * @return void
     */
    public function supportUpdate($data, $supportId)
    {
        $checkActionStatus = $this->supportRepository->where('id', $supportId)->update($data);
        if ($checkActionStatus)
            return true;
        else
            return false;
    }

    /**
     * Undocumented function
     *
     * @param [type] $resignationId
     * @return void/object/null
     */
    public function getSupportDetails($supportId)
    {
        return $this->supportRepository->find($supportId);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->supportRepository->find($id)->delete();
    }

    public function changeStatus($supportId, $data)
    {
        
        $checkActionStatus = $this->supportRepository->find($supportId)->update([
            'remark' => $data['remark'],
            'status' => 'close',
        ]);
        if ($checkActionStatus)
            return true;
        else
            return false;
    }
}
