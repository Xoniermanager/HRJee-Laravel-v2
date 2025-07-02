<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\NoticeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
    private $noticeService;
    public function __construct(NoticeService $noticeService)
    {
        $this->noticeService = $noticeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyIDs = getCompanyIDs();

        return view("company.notice.index", [
            'allNoticeDetails' => $this->noticeService->all($companyIDs)
        ]);
    }


    public function add()
    {
        return view('company.notice.add');
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
            $notice = $this->noticeService->checkNoticeTitle($data['title'], $companyIDs);
            if ($notice) {
                return response()->json([
                    'success' => false,
                    'message' => 'Notice already added'
                ], 409);
            } else {
                $this->noticeService->create($data);
                return response()->json([
                    'message' => 'Notice created successfully!',
                    'redirect' => route('notice.index')
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function edit($id)
    {
        $companyIDs = getCompanyIDs();
        $editNoticeDetails = $this->noticeService->find($id);
        return view('company.notice.edit', compact('editNoticeDetails'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $companyIDs = auth()->user()->company_id;
        $updateData = $request->except(['_token', 'id']);
        $noticeUpdate = $this->noticeService->updateDetails($updateData, $request->id);
        if ($noticeUpdate) {
            return response()->json([
                'message' => 'Notice updated successfully!',
                'redirect' => route('notice.index')
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
        $data = $this->noticeService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Notice Deleted Successfully',
                'data' => view("company.notice.list", [
                    'allNoticeDetails' => $this->noticeService->all($companyIDs)
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
        $statusDetails = $this->noticeService->updateStatus($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Notice Status Updated Successfully',
                'data' => view("company.notice.list", [
                    'allNoticeDetails' => $this->noticeService->all($companyIDs)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function searchNoticeFilterList(Request $request)
    {
        $searchedItems = $this->noticeService->searchNoticeFilterList($request, auth()->user()->company_id);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("company.notice.list", [
                    'allNoticeDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
