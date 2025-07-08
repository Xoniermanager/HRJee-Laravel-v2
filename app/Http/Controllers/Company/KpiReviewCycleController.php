<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Services\KpiReviewCycleService;

class KpiReviewCycleController extends Controller
{
    protected $service;

    public function __construct(KpiReviewCycleService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $companyId = auth()->user()->company_id;
        $cycles = $this->service->list($request->only(['type', 'start_date', 'end_date']), $companyId);

        if ($request->ajax()) {
            return view('company.kpi-review-cycle.list', compact('cycles'))->render();
        }

        return view('company.kpi-review-cycle.index', compact('cycles'));
    }

    public function store(Request $request)
    {
        $companyId = auth()->user()->company_id;

        $validated = $request->validate([
            'type' => [
                'required',
                Rule::unique('kpi_review_cycles')->where(fn($q) =>
                    $q->where('company_id', $companyId)
                      ->where('type', $request->type)
                      ->where('start_date', $request->start_date)
                )
            ],
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'type.unique' => 'Duplicate cycle for this type and start date.'
        ]);

        $validated['company_id'] = $companyId;
        $this->service->create($validated);

        return response()->json([
            'message' => 'Created successfully!',
            'data' => $this->getListHtml()
        ]);
    }

    public function update(Request $request)
    {
        $companyId = auth()->user()->company_id;

        $validated = $request->validate([
            'id' => 'required|exists:kpi_review_cycles,id',
            'type' => [
                'required',
                Rule::unique('kpi_review_cycles')->where(fn($q) =>
                    $q->where('company_id', $companyId)
                      ->where('type', $request->type)
                      ->where('start_date', $request->start_date)
                )->ignore($request->id)
            ],
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'type.unique' => 'Duplicate cycle for this type and start date.'
        ]);

        $this->service->update($request->id, $validated);

        return response()->json([
            'message' => 'Updated successfully!',
            'data' => $this->getListHtml()
        ]);
    }

    public function delete(Request $request)
    {
        $this->service->delete($request->id);

        return response()->json([
            'message' => 'Deleted successfully!',
            'data' => $this->getListHtml()
        ]);
    }

    private function getListHtml()
    {
        $companyId = auth()->user()->company_id;
        $cycles = $this->service->list([], $companyId);
        return view('company.kpi-review-cycle.list', compact('cycles'))->render();
    }

    public function toggleStatus(Request $request)
    {
        $this->service->toggleStatus($request->id);

        return response()->json([
            'message' => 'Status updated!',
            'data' => $this->getListHtml()
        ]);
    }

}
