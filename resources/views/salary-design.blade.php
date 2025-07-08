@extends('layouts.company.main')
@section('title','Salary System Designed')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0 text-primary">
            <i class="fa fa-sack-dollar me-1"></i> Salary Design Components
        </h4>
        <div>
            <button class="btn btn-outline-primary me-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#viewModal">
                <i class="fa fa-eye"></i> View Details
            </button>
            <div class="dropdown d-inline">
                <button class="btn btn-success shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fa fa-plus-circle"></i> Add Component
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="addComponent('earning')">
                        <i class="fa fa-plus text-success"></i> Add to Earnings</a></li>
                    <li><a class="dropdown-item" href="#" onclick="addComponent('deduction')">
                        <i class="fa fa-plus text-danger"></i> Add to Deductions</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('salary-components.store') }}">
        @csrf
        <div class="row g-4">
            {{-- Earnings --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success text-white fw-semibold d-flex align-items-center">
                        <i class="fa fa-coins me-2"></i> EARNINGS
                    </div>
                    <div class="card-body p-3" id="earnings-list">
                        @foreach($earnings as $i => $e)
                        <div class="row g-2 align-items-center mb-2 component-item">
                            <input type="hidden" name="earnings[{{ $i }}][id]" value="{{ $e->id ?? '' }}">
                            <div class="col-7">
                                <input type="text" name="earnings[{{ $i }}][name]" value="{{ $e->name }}"
                                       class="form-control form-control-sm" readonly>
                            </div>
                            <div class="col-4">
                                <input type="number" name="earnings[{{ $i }}][value]" value="{{ $e->value }}"
                                       class="form-control form-control-sm" placeholder="Value" min="0" step="0.01" required>
                            </div>
                            <div class="col-1 text-end">
                                @if(!in_array(strtolower($e->name), ['basic', 'hra']))
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="deleteComponent(this, '{{ $e->id ?? '' }}')">
                                    <i class="fa fa-times"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Deductions --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-danger text-white fw-semibold d-flex align-items-center">
                        <i class="fa fa-minus-circle me-2"></i> DEDUCTIONS
                    </div>
                    <div class="card-body p-3" id="deductions-list">
                        @foreach($deductions as $i => $d)
                        <div class="row g-2 align-items-center mb-2 component-item">
                            <input type="hidden" name="deductions[{{ $i }}][id]" value="{{ $d->id ?? '' }}">
                            <div class="col-7">
                                <input type="text" name="deductions[{{ $i }}][name]" value="{{ $d->name }}"
                                       class="form-control form-control-sm" readonly>
                            </div>
                            <div class="col-4">
                                <input type="number" name="deductions[{{ $i }}][value]" value="{{ $d->value }}"
                                       class="form-control form-control-sm" placeholder="Value" min="0" step="0.01" required>
                            </div>
                            <div class="col-1 text-end">
                                @if(!in_array(strtolower($d->name), ['pf', 'taxrate']))
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="deleteComponent(this, '{{ $d->id ?? '' }}')">
                                    <i class="fa fa-times"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end mt-4">
            <button class="btn btn-success shadow-sm">
                <i class="fa fa-save"></i> Save Components
            </button>
        </div>
    </form>
</div>

{{-- View modal --}}
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="fa fa-list-check"></i> Stored Components</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <h6 class="fw-semibold text-success">EARNINGS</h6>
                        <ul class="list-group">
                            @forelse($storedComponents->where('type','earning') as $e)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $e->name }}
                                    <span class="badge bg-success">{{ $e->value }}</span>
                                </li>
                            @empty
                                <li class="list-group-item">No earnings found.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-semibold text-danger">DEDUCTIONS</h6>
                        <ul class="list-group">
                            @forelse($storedComponents->where('type','deduction') as $d)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $d->name }}
                                    <span class="badge bg-danger">{{ $d->value }}</span>
                                </li>
                            @empty
                                <li class="list-group-item">No deductions found.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
let earningIndex = {{ count($earnings) }};
let deductionIndex = {{ count($deductions) }};
function addComponent(type) {
    let index = type === 'earning' ? earningIndex : deductionIndex;
    let html = `
    <div class="row g-2 align-items-center mb-2 component-item">
        <input type="hidden" name="${type}s[${index}][id]" value="">
        <div class="col-7">
            <input type="text" name="${type}s[${index}][name]" class="form-control form-control-sm" placeholder="Component Name" required>
        </div>
        <div class="col-4">
            <input type="number" name="${type}s[${index}][value]" class="form-control form-control-sm" placeholder="Value" min="0" step="0.01" required>
        </div>
        <div class="col-1 text-end">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteComponent(this)">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>`;
    document.getElementById(type+'s-list').insertAdjacentHTML('beforeend', html);
    if (type === 'earning') earningIndex++;
    else deductionIndex++;
}

function deleteComponent(btn, id = null) {
    if (id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This component will be deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Delete from backend
                $.ajax({
                    url: '{{ url('salary-components') }}/' + id,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Deleted!', response.message, 'success');
                            $(btn).closest('.component-item').remove();
                        } else {
                            Swal.fire('Error!', 'Could not delete.', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Server error occurred.', 'error');
                    }
                });
            }
        });
    } else {
        // No id → just remove from DOM
        $(btn).closest('.component-item').remove();
        // Swal.fire('Removed!', 'Component removed.', 'success');
    }
}
</script>
@endsection
