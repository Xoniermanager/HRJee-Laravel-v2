@extends('layouts.company.main')
@section('title', 'KPI Management')
@section('content')
<style>
    .scrollable-list {
        max-height: 150px;
        overflow-y: auto;
    }

    /* Custom scrollbar styling */
    .scrollable-list::-webkit-scrollbar {
        width: 6px;
    }

    .scrollable-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .scrollable-list::-webkit-scrollbar-thumb {
        background: #4e73df;
        border-radius: 4px;
    }

    .scrollable-list::-webkit-scrollbar-thumb:hover {
        background: #2e59d9;
    }

    /* For Firefox */
    .scrollable-list {
        scrollbar-width: thin;
        scrollbar-color: #4e73df #f1f1f1;
    }

</style>
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <div class="row gx-2 gy-2 align-items-center">
                            <div class="col-auto">
                                <input class="form-control min-w-200px" placeholder="Search by subject, target, etc" type="text" id="search">
                            </div>
                            <div class="col-auto">
                                <select id="status" class="form-control min-w-150px">
                                    <option value="">Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <select id="cycle_id" class="form-control min-w-200px">
                                    <option value="">Review Cycle</option>
                                    @foreach ($allkpiReviewCycle as $cycle)
                                        <option value="{{ $cycle->id }}">{{ $cycle->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <select id="category_id" class="form-control min-w-200px">
                                    <option value="">Category</option>
                                    @foreach ($allCategories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="{{ route('kpi-management.add')}}" class="btn btn-sm btn-primary align-self-center">
                        Add New</a>
                    <!--end::Action-->
                </div>
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="mb-5 mb-xl-10" id="kpi_employee_list">
                    @include('company.kpi_management.list')
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
</div>

<div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-4 border-0">
            <div class="modal-header" style="background: linear-gradient(90deg, #4e73df, #1cc88a); color: #fff;">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle me-2"></i> KPI Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="row g-3">

                    <!-- Branches -->
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body p-3">
                                <h6 class="fw-semibold text-primary mb-2">
                                    <i class="fas fa-building me-1"></i> Branches
                                </h6>
                                <div class="border rounded bg-white p-2 scrollable-list">
                                    <ul class="mb-0 small ps-3 modal-list" id="modalBranches" style="list-style-type: disc;"></ul>
                                    <button type="button" class="btn btn-link p-0 mt-1 small show-more-btn" data-target="modalBranches">Show more</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Departments -->
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body p-3">
                                <h6 class="fw-semibold text-primary mb-2">
                                    <i class="fas fa-sitemap me-1"></i> Departments
                                </h6>
                                <div class="border rounded bg-white p-2 scrollable-list">
                                    <ul class="mb-0 small ps-3 modal-list" id="modalDepartments" style="list-style-type: disc;"></ul>
                                    <button type="button" class="btn btn-link p-0 mt-1 small show-more-btn" data-target="modalDepartments">Show more</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Designations -->
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body p-3">
                                <h6 class="fw-semibold text-primary mb-2">
                                    <i class="fas fa-briefcase me-1"></i> Designations
                                </h6>
                                <div class="border rounded bg-white p-2 scrollable-list">
                                    <ul class="mb-0 small ps-3 modal-list" id="modalDesignations" style="list-style-type: disc;"></ul>
                                    <button type="button" class="btn btn-link p-0 mt-1 small show-more-btn" data-target="modalDesignations">Show more</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Employees -->
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body p-3">
                                <h6 class="fw-semibold text-primary mb-2">
                                    <i class="fas fa-users me-1"></i> Employees
                                </h6>
                                <div class="border rounded bg-white p-2 scrollable-list">
                                    <ul class="mb-0 small ps-3 modal-list" id="modalEmployees" style="list-style-type: disc;"></ul>
                                    <button type="button" class="btn btn-link p-0 mt-1 small show-more-btn" data-target="modalEmployees">Show more</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="reportModalLabel">
                    <i class="fa fa-users me-1"></i> Employee & Achievement
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="reportUserList" class="list-unstyled mb-0"></ul>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.view-details-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const branches = JSON.parse(this.dataset.branches || '[]');
            const departments = JSON.parse(this.dataset.departments || '[]');
            const designations = JSON.parse(this.dataset.designations || '[]');
            const employees = JSON.parse(this.dataset.employees || '[]');

            renderListWithShowMore('modalBranches', branches);
            renderListWithShowMore('modalDepartments', departments);
            renderListWithShowMore('modalDesignations', designations);
            renderEmployeeListWithShowMore('modalEmployees', employees);
        });
    });

    function renderListWithShowMore(containerId, items) {
        const container = document.getElementById(containerId);
        container.innerHTML = '';

        items.forEach((item, index) => {
            const li = document.createElement('li');
            li.textContent = item;
            if (index >= 3) li.style.display = 'none';
            container.appendChild(li);
        });

        const btn = document.querySelector(`.show-more-btn[data-target="${containerId}"]`);
        if (items.length <= 3) {
            btn.style.display = 'none';
        } else {
            btn.style.display = 'inline';
            btn.textContent = 'Show more';
            btn.dataset.expanded = 'false';
        }
    }

    function renderEmployeeListWithShowMore(containerId, employees) {
        const container = document.getElementById(containerId);
        container.innerHTML = '';

        employees.forEach((emp, index) => {
            const li = document.createElement('li');
            li.classList.add('mb-1'); // small bottom margin between items

            // Create inner HTML: name bold + badge
            li.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                   ${emp.name}
                    <span class="badge bg-secondary">ID: ${emp.emp_id}</span>
                </div>
            `;
            if (index >= 3) li.style.display = 'none';
            container.appendChild(li);
        });

        const btn = document.querySelector(`.show-more-btn[data-target="${containerId}"]`);
        if (employees.length <= 3) {
            btn.style.display = 'none';
        } else {
            btn.style.display = 'inline';
            btn.textContent = 'Show more';
            btn.dataset.expanded = 'false';
        }
    }

    document.querySelectorAll('.show-more-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const target = this.dataset.target;
            const list = document.getElementById(target);
            const expanded = this.dataset.expanded === 'true';
            list.querySelectorAll('li').forEach((li, index) => {
                if (index >= 3) li.style.display = expanded ? 'none' : 'list-item';
            });
            this.textContent = expanded ? 'Show more' : 'Show less';
            this.dataset.expanded = (!expanded).toString();
        });
    });
});

    function deleteFunction(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This KPI will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route('kpi-management.delete', ':id') }}'.replace(':id', id),
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire('Deleted!', response.message, 'success').then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    let message = xhr.responseJSON && xhr.responseJSON.message
                        ? xhr.responseJSON.message
                        : 'Delete failed';
                    Swal.fire('Error!', message, 'error');
                }
            });
        }
    });
}

function handleStatus(id) {
    $.ajax({
        url: '{{ route('kpi-management.toggle-status', ':id') }}'.replace(':id', id),
        type: 'GET',
        success: function(response) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: response.message || 'Status updated',
                showConfirmButton: false,
                timer: 1500
            });
        },
        error: function(xhr) {
            let message = xhr.responseJSON && xhr.responseJSON.message
                ? xhr.responseJSON.message
                : 'Status update failed';
            Swal.fire('Error!', message, 'error');
        }
    });
}


</script>
<script>
    $(function() {
        function applyFilter(page = 1) {
            let search = $('#search').val();
            let status = $('#status').val();
            let cycle_id = $('#cycle_id').val();
            let category_id = $('#category_id').val();

            $.ajax({
                url: "{{ route('kpi-management.index') }}"
                , type: "GET"
                , data: {
                    search: search
                    , status: status
                    , cycle_id: cycle_id
                    , category_id: category_id
                    , page: page
                }
                , beforeSend: function() {
                    $('#kpi_employee_list').html('<div class="text-center py-5">Loading...</div>');
                }
                , success: function(data) {
                    $('#kpi_employee_list').html(data);
                }
                , error: function() {
                    $('#kpi_employee_list').html('<div class="text-center text-danger">Failed to load data.</div>');
                }
            });
        }

        // Trigger on input / change
        $('#search, #status, #cycle_id, #category_id').on('keyup change', function() {
            applyFilter();
        });

        // Handle pagination click
        $(document).on('click', '#kpi_employee_list .pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            applyFilter(page);
        });
    });

</script>
<script>
    $(document).on('click', '.show-report-btn', function() {
        let users = $(this).data('kpi-users');
        let listHtml = '';

        if(users && users.length) {
            users.forEach(user => {
                listHtml += `
                    <li class="mb-3">
                        <div class="p-2 rounded bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>${user.name}</strong>
                                <span class="badge bg-secondary">ID: ${user.emp_id}</span>
                            </div>
                            <div class="small text-muted mt-1 ms-1">Achievement: ${user.achievement || ' Not Completed'}</div>
                        </div>
                    </li>`;
            });
        } else {
            listHtml = '<div class="text-muted">No users found</div>';
        }

        $('#reportUserList').html(listHtml);
    });
    </script>

@endsection
