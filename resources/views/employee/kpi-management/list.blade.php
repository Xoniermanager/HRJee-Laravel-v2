<div class="card-body py-3">
    <div class="table-responsive">
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <thead >
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Review Cycle</th>
                    <th>Category</th>
                    <th>Subject</th>
                    <th>Target</th>
                    <th>Achievement</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assignedKpis as $kpi)
                    @php
                        $userAchievement = $kpi->users->where('id', auth()->id())->first()->pivot->achievement ?? null;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kpi->kpiReviewCycle->type ?? '-' }}
                            <small class="text-muted">({{ $kpi->kpiReviewCycle->start_date ?? '' }} -
                                {{ $kpi->kpiReviewCycle->end_date ?? '' }})</small>
                        </td>
                        <td>{{ $kpi->kpiCategory->name ?? '-' }}</td>
                        <td>{{ $kpi->subject ?? '-' }}</td>
                        <td>{{ $kpi->tgt ?? '-' }}</td>
                        <td>{{ $userAchievement ?? '-' }}</td>
                        <td class="text-end">
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm view-full-btn"
                                data-kpi-id="{{ $kpi->id }}" data-subject="{{ $kpi->subject }}"
                                data-target="{{ $kpi->tgt }}" data-category="{{ $kpi->kpiCategory->name ?? '-' }}"
                                data-review-cycle="{{ $kpi->kpiReviewCycle->type ?? '-' }}"
                                data-start-date="{{ $kpi->kpiReviewCycle->start_date ?? '' }}"
                                data-end-date="{{ $kpi->kpiReviewCycle->end_date ?? '' }}"
                                data-description="{{ $kpi->description ?? '-' }}" data-achievement="{{ $userAchievement }}"
                                data-bs-toggle="modal" data-bs-target="#viewDetailsModal">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center text-danger">
                            <strong>No Record Found!</strong>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {!! $assignedKpis->links() !!}
        </div>
    </div>
</div>
