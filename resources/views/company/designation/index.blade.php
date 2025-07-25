@extends('layouts.company.main')
@section('content')
@section('title')
    Designation
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <div class="custom-table card p-0">
                <div class="card-header cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input class="form-control form-control-solid ps-14 min-w-150px me-2" placeholder="Search "
                                type="text" name="search" value="{{ request()->get('search') }}" id="search">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>

                        </div>
                        <select class="form-control min-w-150px me-2" id="status">
                            <option value="">Status</option>
                            <option {{ old('status') == '1' || request()->get('status') == '1' ? 'selected' : '' }}
                                value="1">Active</option>
                            <option {{ old('status') == '0' || request()->get('status') == '0' ? 'selected' : '' }}
                                value="0">Inactive</option>
                        </select>
                        <select class="form-control min-w-150px me-2" id="filter_department">
                            <option value="">Select Department</option>
                            @forelse ($allDepartments as $departments)
                                <option value="{{ $departments->id }}"
                                    {{ request()->get('department') == $departments->id ? 'selected' : '' }}>
                                    {{ $departments->name }}</option>
                            @empty
                                <option value="">No Departments Available</option>
                            @endforelse
                        </select>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_designation"
                        class="btn btn-sm btn-primary align-self-center">
                        Add Designation</a>
                    <!--end::Action-->
                </div>

                <div class="card-body mb-5 mb-xl-10">
                    @include('company.designation.designation_list')
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::Content-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Root-->
<!--end::Scrolltop-->
<div class="modal" id="edit_designation">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Close-->
                <h2>Edit Designation</h2>
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
            <div class="modal-body scroll-y pt-0 pb-5 border-top">
                <!--begin::Wrapper-->
                <form id="designation-update-form">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mw-lg-600px mx-auto p-4">
                        <div class="mt-3 mb-3">
                            <label>Department*</label>
                            <select class="form-control mb-3" name="department_id" id="department_id">
                                <option value="">Select Department</option>
                                @forelse ($allDepartments as $departments)
                                    <option value="{{ $departments->id }}">{{ $departments->name }}</option>
                                @empty
                                    <option value="">No Departments Available</option>
                                @endforelse
                            </select>
                        </div>
                        <!--begin::Input group-->
                        <div class="mt-3">
                            <label>Designation Name*</label>
                            <input class="form-control mb-5 mt-3" type="text" name="name" id="name">
                            <!--end::Switch-->
                        </div>
                        <!--end::Input group-->
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
<!---------Modal---------->
<div class="modal" id="add_designation">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Close-->
                <h2>Add Designation</h2>
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
            <div class="modal-body scroll-y pt-0 pb-5 border-top">
                <!--begin::Wrapper-->
                <form id="designation_form">
                    @csrf
                    <div class="mw-lg-600px mx-auto p-4">
                        <!--begin::Input group-->
                        <div class="mt-3 mb-3">
                            <label>Department</label>
                            <select class="form-control mb-3" name="department_id">
                                <option value="">Select Departments</option>
                                @forelse ($allDepartments as $departments)
                                    <option value="{{ $departments->id }}">{{ $departments->name }}</option>
                                @empty
                                    <option value="">No Departments Available</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mt-3">
                            <label>Designation Name</label>
                            <input class="form-control mb-5 mt-3" type="text" name="name">
                            <!--end::Switch-->
                        </div>
                        <!--end::Input group-->
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
<script>
    function edit_designation_details(id, name, department_id) {
        $('#id').val(id);
        $('#name').val(name);
        $('#department_id').val(department_id);
        jQuery('#edit_designation').modal('show');
    }
    jQuery.noConflict();
    jQuery(document).ready(function($)
    {
        jQuery("#designation_form").validate({
            rules: {
                name: "required",
                department_id: "required"
            },
            messages: {
                name: "Please enter name",
                department_id: "Please Select Department",
            },
            submitHandler: function(form) {
                var designation_data = $(form).serialize();
                console.log(designation_data);
                $.ajax({
                    url: "{{ route('designation.store') }}",
                    type: 'POST',
                    data: designation_data,
                    success: function(response) {
                        jQuery('#add_designation').modal('hide');
                        jQuery("#designation_form")[0].reset();
                        swal.fire("Done!", response.message, "success");
                        $('#designation_list').replaceWith(response.data);

                    },
                    error: function(error_messages) {
                        let errors = error_messages.responseJSON.error;
                        for (var error_key in errors) {
                            $(document).find('.' + error_key + '_error').remove();
                            $(document).find('[name=' + error_key + ']').after(
                                '<span class="' + error_key +
                                '_error text text-danger">' + errors[
                                    error_key] + '</span>');
                            setTimeout(function() {
                                jQuery("." + error_key + "_error").remove();
                            }, 3000);
                        }
                    }
                });
            }
        });
        $("#designation-update-form").validate({
            rules: {
                name: "required",
                department_id: "required"
            },
            messages: {
                name: "Please enter name",
                department_id: "Please Select Department",
            },
            submitHandler: function(form) {
                var designation_data = $(form).serialize();
                var id = $('#id').val();
                $.ajax({
                    url: "<?= route('designation.update') ?>",
                    type: 'post',
                    data: designation_data,
                    success: function(response) {
                        jQuery('#edit_designation').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        jQuery('#designation_list').replaceWith(response.data);
                    },
                    error: function(error_messages) {
                        let errors = error_messages.responseJSON.error;
                        for (var error_key in errors) {
                            $(document).find('.' + error_key + '_error').remove();
                            $(document).find('[name=' + error_key + ']').after(
                                '<span id="' + error_key +
                                '_error" class="text text-danger">' + errors[
                                    error_key] + '</span>');
                            setTimeout(function() {
                                jQuery("#" + error_key + "_error").remove();
                            }, 3000);
                        }
                    }
                });
            }
        });
    });

    function handleStatus(id) {
        var checked_value = $('#checked_value_' + id).prop('checked');
        let status;
        let status_name;
        if (checked_value == true) {
            status = 1;
            status_name = 'Active';
        } else {
            status = 0;
            status_name = 'Inactive';
        }
        $.ajax({
            url: "{{ route('designation.statusUpdate') }}",
            type: 'get',
            data: {
                'id': id,
                'status': status,
            },
            success: function(res) {
                if (res) {
                    swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                } else {
                    swal.fire("Oops!", 'Something Went Wrong', "error");
                }
            }
        })
    }

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
                    url: "<?= route('designation.delete') ?>",
                    type: "get",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        Swal.fire("Done!", "It was succesfully deleted!", "success");
                        $('#designation_list').replaceWith(res.data);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire("Deletion Error", "This Designation is assigned to a user, so it cannot be deleted.", "error");
                    }
                });
            }
        });
    }
    jQuery("#search").on('blur', function() {
        search_filter_results();
    });
    jQuery("#status").on('change', function() {
        search_filter_results();
    });
    jQuery("#filter_department").on('change', function() {
        search_filter_results();
    });

    function search_filter_results() {
        $.ajax({
            type: 'GET',
            url: company_ajax_base_url + '/designation/search/filter',
            data: {
                'status': $('#status').val(),
                'search': $('#search').val(),
                'department_id': $('#filter_department').val()
            },
            success: function(response) {
                $('#designation_list').replaceWith(response.data);
            }
        });
    }
</script>
@endsection
