@extends('layouts.company.main')
@section('title','Performance Review Cycle')
@section('content')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="row gy-5 g-xl-10">
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <div class="card-title m-0"></div>
                    <a href="{{ route('performance-cycle-add') }}" class="btn btn-sm btn-primary align-self-center">Add Review Cycle</a>
                </div>
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="mb-5 mb-xl-10">
                    @include('company.performance_cycle.list')
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
</div>

<!-- Modal for creation form-->
<div class="modal" id="kt_modal_category" tabindex="-1" aria-modal="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0">
                <h2>Add Cycle</h2>
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y pb-5 border-top">
                <!--begin::Wrapper-->
                <form id="cycleForm">
                    @csrf
                    <div class="col-md-12 form-group">
                        <label for="">Title*</label>
                        <input class="form-control" name="title" type="text" id="title">
                        <input type="hidden" name="id" id="edit_id">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Date</label>
                        <input type="text" id="daterange" name="daterange"
                                class="form-control min-w-250px ml-10">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Departments</label>
                        <select id="department_id" class="form-control" data-control="select2" data-close-on-select="false"
                            data-placeholder="Select departments" data-allow-clear="true" multiple="multiple"
                            name="department_id[]">
                            @foreach ($allDepartments as $department)
                            <option value={{$department->id}}>{{$department->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-12 form-group">
                        <label>Employees</label>
                        <select id="manager_id" class="form-control" data-control="select2" data-close-on-select="false"
                            data-placeholder="Select employees" data-allow-clear="true" multiple="multiple"
                            name="employee_id[]">
                            {{-- @foreach ($allEmployeeDetails as $employee)
                            <option value={{$employee->id}}>{{$employee->name}}</option>
                            @endforeach --}}

                        </select>
                    </div>
                    <!--end::Wrapper-->
                    <div class="d-flex flex-end flex-row-fluid pt-2 border-top">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="kt_modal_upgrade_plan_btn">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">Submit</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>
                    </div>
                </form>
            </div>
            <!--end::Modal body-->
        </div>
    </div>
</div>
<script>
    jQuery.noConflict();
    jQuery(document).ready(function($) {
        $('#daterange').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            autoApply: true,
        });

        jQuery("#cycleForm").validate({
            rules: {
                title: "required",
                daterange: "required",
                "employee_id[]": {
                    required: true,
                    minlength: 1
                },
            },
            messages: {
                title: "Please enter title",
                daterange: "Please select date range",
                "employee_id[]": "Please select at least one employee",
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "employee_id[]") {
                    error.insertAfter($("#manager_id").next('.select2')); // place after Select2
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var leave_type_data = $(form).serialize();
                $.ajax({
                    url: "{{ route('performance-cycle.store') }}",
                    type: 'POST',
                    data: leave_type_data,
                    success: function(response) {
                        jQuery('#kt_modal_category').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        $('#leave_type_list').replaceWith(response.data);
                        $('#cycleForm')[0].reset();
                    },
                    error: function(error_messages) {
                        let errors = error_messages.responseJSON.error;
                        for (var error_key in errors) {
                            $(document).find('[name=' + error_key + ']').after(
                                '<span class="' + error_key +
                                '_error text text-danger" >' + errors[
                                    error_key] + '</span>');
                            setTimeout(function() {
                                jQuery("." + error_key + "_error").remove();
                            }, 4000);
                        }
                    }
                });
            }
        });

        jQuery('#department_id').on('change', function () {
            var departmentIds = $(this).val(); // Get selected department IDs
            var selectedEmployees = $('#manager_id').val(); // Already selected values if any

            if (departmentIds.length > 0) {
                $.ajax({
                    url: "{{ route('get.all-emp-by-dept') }}", // You will define this route
                    type: "POST",
                    data: {
                        department_ids: departmentIds,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        let $employeeSelect = jQuery('#manager_id');
                        $employeeSelect.empty(); // Clear old options
                        jQuery.each(response.data, function (index, employee) {
                            const isSelected = selectedEmployees && selectedEmployees.includes(employee.id.toString());
                            $employeeSelect.append(
                                `<option value="${employee.id}" ${isSelected ? 'selected' : ''}>${employee.name}</option>`
                            );
                        });

                        $employeeSelect.trigger('change');
                    },
                    error: function () {
                        alert('Error loading employees');
                    }
                });
            } else {
                $('#manager_id').empty().trigger('change');
            }
        });


    });

    function editPerformanceCycle(id) {
        let url = "{{ url('company/performance-review-cycles/edit') }}/" + id;
        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {
                $('#edit_id').val(response.data.id);
                $('#title').val(response.data.title);
                $('#daterange').val(response.data.start_date + ' - ' + response.data.end_date);
                $('#department_id').val(response.data.department_ids).trigger('change');
                // Wait for department employee AJAX to finish
                setTimeout(function () {
                    $('#manager_id').val(response.data.employee_ids).trigger('change');
                }, 500); // Give enough delay for employees to load

                // $('#manager_id').val(response.data.employee_ids).trigger('change');
                $('#kt_modal_category').modal('show');
            },
            error: function () {
                Swal.fire("Error!", "Unable to fetch data.", "error");
            }
        });
    }

    function deleteFunction(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('/company/performance-review-cycles/delete/') }}/" + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.status){
                            Swal.fire('Deleted!', response.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    }
    </script>
@endsection
