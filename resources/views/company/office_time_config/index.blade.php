@extends('layouts.company.main')
@section('content')
@section('title')
    Office Time Configs
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
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
                            <input data-kt-patient-filter="search" class="form-control form-control-solid ps-14"
                                placeholder="Search " type="text" id="SearchByPatientName" name="SearchByPatientName"
                                value="">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                        </div>

                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_department"
                        class="btn btn-sm btn-primary align-self-center">
                        Add Office TIme</a>

                    <!--end::Action-->
                </div>

                <div class="mb-5 mb-xl-10">
                    @include('company.office_time_config.office_time_list')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="modal" id="edit_department">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Edit Department</h2>
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
                    <form id="office_time_config_update_form">
                        @csrf
                        <!--begin::Wrapper-->
                        <div class="mw-lg-600px mx-auto p-4">
                            <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name<span style="color: red">*</span></label>
                                <input class="form-control mb-5 mt-3" type="text" name="name" id="name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Company Branches</label>
                                <select name="company_branch"  class="form-control mb-5 mt-3"  id="company_branch">
                                <option value="">Select Branch</option>    
                                @forelse ($allBranch as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name}}</option>      
                                @empty
                                    <p>No branches Available</p>
                                @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Shift_Hours<span style="color: red">*</span></label>
                                <input class="form-control mb-5 mt-3" type="number" name="shift_hours"  id="shift_hours">
                                @error('shift_hours')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Half_day_hours<span style="color: red">*</span></label>
                                <input class="form-control mb-5 mt-3" type="number" name="half_day_hours" id="half_day_hours">
                                @error('half_day_hours')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Min_shift_Hours<span style="color: red">*</span></label>
                                <input class="form-control mb-5 mt-3" type="number" name="min_shift_Hours" id="min_shift_Hours">
                                @error('min_shift_Hours')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Min_half_day_hours<span style="color: red">*</span></label>
                                <input class="form-control mb-5 mt-3" type="number" name="min_half_day_hours" id="min_half_day_hours">
                                @error('min_half_day_hours')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
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
    <!----------modal------------>
    <div class="modal" id="add_department">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Add Office Time</h2>
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
                    <form id="office_time_config_form">
                        @csrf
                        <!--begin::Wrapper-->
                        <div class="mw-lg-600px mx-auto p-4">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name<span style="color: red">*</span></label>
                                <input class="form-control mb-5 mt-3" type="text" name="name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Branches</label>
                                <select name="company_branch" id="company_branch" class="form-control mb-5 mt-3" >
                                 <option value="">Select Branch</option>    
                                @forelse ($allBranch as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name}}</option>      
                                @empty
                                    <p>No branches Available</p>
                                @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Shift_Hours<span style="color: red">*</span></label>
                                <input class="form-control mb-5 mt-3" type="number" name="shift_hours">
                                @error('shift_hours')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Half_day_hours<span style="color: red">*</span></label>
                                <input class="form-control mb-5 mt-3" type="number" name="half_day_hours">
                                @error('half_day_hours')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Min_shift_Hours<span style="color: red">*</span></label>
                                <input class="form-control mb-5 mt-3" type="number" name="min_shift_Hours">
                                @error('min_shift_Hours')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Min_half_day_hours<span style="color: red">*</span></label>
                                <input class="form-control mb-5 mt-3" type="number" name="min_half_day_hours">
                                @error('min_half_day_hours')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
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
        function edit_department_details(id,name,company_branch,shift_hours, half_day_hours, min_shift_Hours, min_half_day_hours) {
            $('#id').val(id);
            $('#name').val(name);
            $('#company_branch').val(company_branch);
            $('#shift_hours').val(shift_hours);
            $('#half_day_hours').val(half_day_hours);
            $('#min_shift_Hours').val(min_shift_Hours);
            $('#min_half_day_hours').val(min_half_day_hours);
            jQuery('#edit_department').modal('show');
        }
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            jQuery("#office_time_config_form").validate({
                rules: {
                name: "required",
                shift_hours: "required",
                half_day_hours: "required",
                min_shift_Hours: "required",
                min_half_day_hours : "required"
            },
            messages: {
                name: "Please enter name",
                shift_hours: "Please enter shift_hours",
                half_day_hours: "Please enter half day hours",
                min_shift_Hours: "Please enter min shift hours",
                min_half_day_hours: "Please enter min half day hours",
            },
                submitHandler: function(form) {
                    var office_time_data = $(form).serialize();
                    $.ajax({
                        url: "{{ route('office_time_config.store') }}",
                        type: 'POST',
                        data: office_time_data,
                        success: function(response) {
                            jQuery('#add_department').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#office_time_list').replaceWith(response.data);
                            jQuery("#office_time_config_form")[0].reset();

                        },
                        error: function(error_messages) {
                            let errors = error_messages.responseJSON.error;
                            for (var error_key in errors) {
                                $(document).find('[name=' + error_key + ']').after(
                                    '<span class="' + error_key +
                                    '_error text text-danger">' + errors[
                                        error_key] + '</span>');
                                setTimeout(function() {
                                    jQuery("." + error_key + "_error").remove();
                                }, 5000);
                            }
                        }
                    });
                }
            });
        });

        jQuery("#office_time_config_update_form").validate({
            rules: {
                name: "required",
                shift_hours: "required",
                half_day_hours: "required",
                min_shift_Hours: "required",
                min_half_day_hours : "required"
            },
            messages: {
                name: "Please enter name",
                shift_hours: "Please enter shift_hours",
                half_day_hours: "Please enter half day hours",
                min_shift_Hours: "Please enter min shift hours",
                min_half_day_hours: "Please enter min half day hours",
            },
            submitHandler: function(form) {
                var department_data = $(form).serialize();
                console.log(department_data);
                $.ajax({
                    url: "<?= route('office_time_config.update') ?>",
                    type: 'post',
                    data: department_data,
                    success: function(response) {
                        jQuery('#edit_department').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        jQuery('#office_time_list').replaceWith(response.data);
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
            $.ajax({
                url: "{{ route('office_time_config.statusUpdate') }}",
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
                        url: "<?= route('office_time_config.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#office_time_list').replaceWith(res.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }
    </script>
@endsection

<style>
.error {
    color: red;
}
</style>
