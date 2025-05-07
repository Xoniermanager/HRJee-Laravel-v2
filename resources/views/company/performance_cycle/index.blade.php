@extends('layouts.company.main')
@section('title','Performance Review Cycle')
@section('content')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_category"
                        class="btn btn-sm btn-primary align-self-center">
                        Add Review Cycle</a>
                    <!--end::Action-->
                </div>
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
                        <input class="form-control" name="title" type="text">
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
                            @foreach ($allEmployeeDetails as $employee)
                            <option value={{$employee->id}}>{{$employee->name}}</option>
                            @endforeach
                            
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
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>


<!-- Modal for Edit Review Cycle -->
<div class="modal" id="kt_modal_category_edit" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h2>Edit Cycle</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24"><rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect><rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect></svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y pb-5 border-top">
                <form id="editCycleForm">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    <div class="col-md-12 form-group">
                        <label for="">Title*</label>
                        <input class="form-control" name="title" id="edit_title" type="text">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Date</label>
                        <input type="text" id="edit_daterange" name="daterange"
                            class="form-control min-w-250px ml-10">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Employees</label>
                        <select id="edit_employee_id" class="form-control" data-control="select2"
                            multiple="multiple" name="employee_id[]">
                            @foreach ($allEmployeeDetails as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex flex-end flex-row-fluid pt-2 border-top">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Update</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<!-- Moment.js (required by Daterangepicker) -->
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Daterangepicker CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    function editPerformanceCycle(id) {
        console.log("id => ", id)
        let url = "{{ url('company/performance-review-cycles/edit') }}/" + id;
        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {
                $('#edit_id').val(response.data.id);
                $('#edit_title').val(response.data.title);
                $('#edit_daterange').val(response.data.start_date + ' - ' + response.data.end_date);
                $('#edit_employee_id').val(response.data.employee_ids).trigger('change');
                $('#kt_modal_category_edit').modal('show');
            },
            error: function () {
                Swal.fire("Error!", "Unable to fetch data.", "error");
            }
        });
    }

    jQuery.noConflict();
    jQuery(document).ready(function($) {
        $('#daterange').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            autoApply: true,
        });

        $('#edit_daterange').daterangepicker({
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
        $("#editCycleForm").validate({
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
            errorPlacement: function (error, element) {
                if (element.attr("name") == "employee_id[]") {
                    error.insertAfter($("#edit_employee_id").next('.select2')); // after Select2
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                const data = $(form).serialize();
                const id = $('#edit_id').val();

                $.ajax({
                    url: "{{ url('company/performance-review-cycles/update') }}/",
                    type: "POST",
                    data: data,
                    success: function (response) {
                        jQuery('#kt_modal_category_edit').modal('hide');
                        swal.fire("Updated!", response.message, "success");
                        $('#leave_type_list').replaceWith(response.data);
                    },
                    error: function (xhr) {
                        const errors = xhr.responseJSON?.error || {};
                        for (const key in errors) {
                            const el = $(form).find(`[name="${key}"]`);
                            el.after(`<span class="text-danger ${key}_error">${errors[key]}</span>`);
                            setTimeout(() => {
                                $(`.${key}_error`).remove();
                            }, 4000);
                        }
                    }
                });
            }
        });

    });

    function deleteFunction(id) {
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= route('performance-categories.delete') ?>",
                    type: "get",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        Swal.fire("Done!", "It was succesfully deleted!", "success");
                        $('#leave_type_list').replaceWith(res.data);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire("Error deleting!", "Please try again", "error");
                    }
                });
            }
        });
    }
</script>
<style>
.error {
    color: red;
}
</style>
