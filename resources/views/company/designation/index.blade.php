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
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    {{ session('success') }}
                </div>
            @endif
            <!--begin::Col-->
            <div class="card card-body col-md-12">
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
                            <input data-kt-patient-filter="search"
                                class="min-w-200px form-control form-control-solid ps-14" placeholder="Search "
                                type="text" id="SearchByPatientName" name="SearchByPatientName" value="">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                        </div>
                        {{-- <select class="form-control ml-2">
                            <option value="">Select Department</option>
                            <option value="">Development</option>
                            <option value="">Marketing</option>
                            <option value="">Management</option>
                        </select> --}}
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_designation"
                        class="btn btn-sm btn-primary align-self-center">
                        Add Designation</a>
                    <!--end::Action-->
                </div>

                <div class="mb-5 mb-xl-10">
                    <div class="">
                        <div class="">
                            <!--begin::Body-->
                            <div class="">
                                <div class="card-body py-3">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fw-bold">
                                                    <th>Sr. No.</th>
                                                    <th>Designation Name</th>
                                                    <th>Department </th>
                                                    <th>Status</th>
                                                    <th class="float-right">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            @forelse ($allDesignationDetails as $key => $designationDetail)
                                                <tbody class="">
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td><a href="#" data-bs-toggle="modal"
                                                                onClick="edit_designation_details('{{ $designationDetail->id }}', '{{ $designationDetail->name }}','{{ $designationDetail->department_id }}')">{{ $designationDetail->name }}</a>
                                                        </td>
                                                        <td>{{ $designationDetail->departments->name }}</td>
                                                        <td data-order="Invalid date">
                                                            <label class="switch">
                                                                <input type="checkbox"
                                                                    <?= $designationDetail->status == '1' ? 'checked' : '' ?>
                                                                    onchange="handleStatus({{ $designationDetail->id }})"
                                                                    id="checked_value">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">

                                                                <a href="{{ route('designation.delete', $designationDetail->id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="alert('Are you sure want to delete')">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-trash"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @empty
                                                <td colspan="3">
                                                    <span class="text-danger">
                                                        <strong>No Designation Found!</strong>
                                                    </span>
                                                </td>
                                            @endforelse
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->

                                </div>
                            </div>
                            <!--begin::Body-->

                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--begin::Body-->
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
                                <option value="">Select Development</option>
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
                                <option value="">Select Development</option>
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
    jQuery(document).ready(function($) {
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
                        swal.fire("Done!", response.message, "success");
                        // refresh page after 2 seconds
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error_messages) {
                        let errors = error_messages.responseJSON.error;
                        for (var error_key in errors) {
                            $(document).find('[name=' + error_key + ']').after(
                                '<span id="' + error_key +
                                '_error" class="text text-danger">' + errors[
                                    error_key] + '</span>');
                            setTimeout(function() {
                                jQuery("#" + error_key + "_error").remove();
                            }, 5000);
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
                        swal.fire("Done!", response.message, "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error_messages) {
                        let errors = error_messages.responseJSON.error;
                        for (var error_key in errors) {
                            $(document).find('[name=' + error_key + ']').after(
                                '<span id="' + error_key +
                                '_error" class="text text-danger">' + errors[
                                    error_key] + '</span>');
                            setTimeout(function() {
                                jQuery("#" + error_key + "_error").remove();
                            }, 5000);
                        }
                    }
                });
            }
        });
    });

    function handleStatus(id) {
        var checked_value = $('#checked_value').prop('checked');
        let status;
        let status_name;
        if (checked_value == true) {
            status = 1;
            status_name = 'Active';
        } else {
            status = 0;
            status_name = 'Inactive';
        }
        console.log(checked_value);
        console.log(status);
        console.log(status_name);
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
</script>
@endsection
