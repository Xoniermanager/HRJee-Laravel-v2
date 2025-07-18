<div class="card-body py-3">
    <div class="table-responsive">
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <thead class="fw-bold">
                <tr>
                    <th>Sr. No.</th>
                    <th>Review Cycle</th>
                    <th>Category</th>
                    <th>Subject</th>
                    <th>Target</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allKpiEmployee as $key => $kpi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kpi->kpiReviewCycle->type ?? '-' }}
                            <small class="text-muted">({{ $kpi->kpiReviewCycle->start_date ?? '' }} -
                                {{ $kpi->kpiReviewCycle->end_date ?? '' }})</small>
                        </td>
                        <td>{{ $kpi->kpiCategory->name ?? '-' }}</td>
                        <td>{{ $kpi->subject ?? '-' }}</td>
                        <td>{{ $kpi->tgt ?? '-' }}</td>

                        <td>
                            <label class="switch">
                                <input type="checkbox" {{ $kpi->status == '1' ? 'checked' : '' }}
                                    onchange="handleStatus({{ $kpi->id }})" id="checked_value_{{ $kpi->id }}">
                                <span class="slider round"></span>
                            </label>
                        </td>

                        <td class="text-end">
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <button type="button"
                                    class="btn btn-info btn-sm me-1 show-report-btn btn-light"
                                    title="Show Report" data-kpi-users='@json($kpi->users->map(function ($user) {
                                        return [
                                            "name" => $user->name,
                                            "emp_id" => $user->details->emp_id ?? '',
                                            "achievement" => $user->pivot->achievement ?? '' // adjust field name if it's different
                                        ];
                                    }))' data-bs-toggle="modal" data-bs-target="#reportModal">
                                    <i class="fa fa-file-alt"></i>
                                </button>
                                <!-- View Details -->
                                <button type="button"
                                    class="btn btn-dark btn-sm me-1 view-details-btn"
                                    title="View Details" data-branches='@json($kpi->branches->pluck("name"))'
                                    data-departments='@json($kpi->departments->pluck("name"))'
                                    data-designations='@json($kpi->designations->pluck("name"))'
                                    data-employees='@json($kpi->users->map(function($user) {
                                        return [
                                            "name" => $user->name,
                                            "emp_id" => $user->details->emp_id ?? '' // adjust if your relation/column is different
                                        ];
                                    }))'
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewDetailsModal">
                                    <i class="fa fa-eye"></i>
                                </button>

                                <!-- Edit -->
                                <a href="{{ route('kpi-management.edit', $kpi->id) }}"
                                    class="btn btn-primary btn-sm me-1" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <!-- Delete -->
                                <a href="#" class="btn btn-danger btn-sm me-1"
                                    title="Delete" onclick="deleteFunction('{{ $kpi->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-danger">No record found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{-- Pagination --}}
@if ($allKpiEmployee->hasPages())
    <div class="d-flex  mt-3">
        {{ $allKpiEmployee->withQueryString()->links() }}
    </div>
@endif
