@extends('layouts.employee.main')
@section('title', 'KPI Employee Management')
@section('content')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl">
        <div class="card card-body">
            <div class="row g-2 mb-3">
                <div class="col-md-4">
                    <input type="text" id="search" class="form-control" placeholder="Search by subject, target, etc">
                </div>
                <div class="col-md-4">
                    <select id="cycle_id" class="form-control">
                        <option value="">Review Cycle</option>
                        @foreach($allCycles as $cycle)
                            <option value="{{ $cycle->id }}">{{ $cycle->type }} ({{ $cycle->start_date }} - {{ $cycle->end_date }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select id="category_id" class="form-control">
                        <option value="">Category</option>
                        @foreach($allCategories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="kpi_list">
                @include('employee.kpi-management.list')
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="viewDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md"> {{-- medium size --}}
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header bg-light py-2 px-3 border-bottom">
                <h6 class="modal-title mb-0 text-primary fw-semibold">
                    <i class="fas fa-info-circle me-1"></i> KPI Details
                </h6>
                <button type="button" class="btn-close btn-close-blue small" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-3 px-4">
                <div class="row g-3">
                    {{-- Left column: Review Cycle & Category --}}
                    <div class="col-md-6">
                        <div class="mb-2">
                            <span class="text-primary">Review Cycle:</span>
                            <div class="badge bg-light text-dark border mt-1">
                                <span id="modalReviewCycle"></span>
                                <small class="text-muted">
                                    (<span id="modalStartDate"></span> - <span id="modalEndDate"></span>)
                                </small>
                            </div>
                        </div>
                        <div class="mb-2">
                            <span class="text-primary">Category:</span>
                            <div class="border rounded bg-light p-1 mt-1" id="modalCategory"></div>
                        </div>
                    </div>

                    {{-- Right column: Subject & Target --}}
                    <div class="col-md-6">
                        <div class="mb-2">
                            <span class="text-primary">Subject:</span>
                            <div class="border rounded bg-light p-1 mt-1" id="modalSubject"></div>
                        </div>
                        <div class="mb-2">
                            <span class="text-primary">Target:</span>
                            <div class="border rounded bg-light p-1 mt-1" id="modalTarget"></div>
                        </div>
                    </div>
                </div>

                {{-- Full-width description --}}
                <div class="mb-2">
                    <span class="text-primary">Description:</span>
                    <div class="border rounded bg-light p-1 mt-1" id="modalDescription"></div>
                </div>

                {{-- Achievement input or view --}}
                <div id="achievementFormContainer" class="mt-3">
                    {{-- JS will insert achievement input or readonly view here --}}
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Filter + Pagination -->
<script>
function applyFilters(page = 1) {
    let data = {
        search: $('#search').val(),
        cycle_id: $('#cycle_id').val(),
        category_id: $('#category_id').val(),
        page: page
    };
    $.get("{{ route('kpi-employee.index') }}", data, function (res) {
        $('#kpi_list').html(res);
    });
}

$(document).ready(function () {
    $('#search').on('keyup', function () { applyFilters(); });
    $('#cycle_id, #category_id').on('change', function () { applyFilters(); });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        applyFilters(page);
    });
});
</script>

<!-- Modal load + AJAX submit -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.view-full-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('modalReviewCycle').textContent = btn.dataset.reviewCycle;
            document.getElementById('modalStartDate').textContent = btn.dataset.startDate;
            document.getElementById('modalEndDate').textContent = btn.dataset.endDate;
            document.getElementById('modalCategory').textContent = btn.dataset.category;
            document.getElementById('modalSubject').textContent = btn.dataset.subject;
            document.getElementById('modalTarget').textContent = btn.dataset.target;
            document.getElementById('modalDescription').textContent = btn.dataset.description;

            let kpiId = btn.dataset.kpiId;
            let achievement = btn.dataset.achievement;

            let container = document.getElementById('achievementFormContainer');
            if (achievement && achievement.trim() !== "") {
                // Show readonly value
                container.innerHTML = `
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Achievement -  ${achievement}</label>
                    </div>
                `;
            } else {
                // Show form
                container.innerHTML = `
                    <form method="POST" id="achievementForm">
                        @csrf
                        <div class="d-flex align-items-end gap-2">
                            <div class="flex-grow-1">
                                <label class="form-label fw-semibold">Achievement</label>
                                <input type="text" name="achievement" id="modalAchievementInput" class="form-control" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success mt-1">Submit</button>
                            </div>
                        </div>
                    </form>`;

                let form = document.getElementById('achievementForm');
                form.action = '/employee/kpi-employee-management/' + kpiId + '/submit-achievement';

                form.onsubmit = function (e) {
                    e.preventDefault();
                    let formData = new FormData(form);
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        Swal.fire('Success!', data.message, 'success').then(() => {
                            location.reload();
                        });
                    })
                    .catch(err => {
                        Swal.fire('Error!', 'Could not submit achievement.', 'error');
                    });
                };
            }
        });
    });
});
</script>
@endsection
