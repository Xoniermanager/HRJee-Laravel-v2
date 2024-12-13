@extends('layouts.company.main')
@section('content')
@section('title')
Roles And Permissions
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                        transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
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
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_role"
                        class="btn btn-sm btn-primary align-self-center">
                        Assign Permission</a>
                    <!--end::Action-->
                </div>

                <div class="mb-5 mb-xl-10">
                    @include('company.roles_and_permission.assign_permission.assign_permission_list')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!----------modal------------>
    <div class="modal" id="add_role">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Assign Permission</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                    fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y pt-0 pb-5 border-top">
                    <form id="asssign_permission">
                        @csrf
                        <!--begin::Wrapper-->
                        <div class="mw-lg-600px mx-auto p-4">
                            <div class="col-md-12">
                                <label for="">Role*</label>
                                <select class="form-control" name="role_id" id="roles">
                                    <option value="">Select The Roles</option>
                                    @forelse ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        data-permission="{{ json_encode($role->permissions->pluck('id')->toArray()) }}">
                                        {{ $role->name }}
                                    </option>
                                    @empty
                                    <option value="">No Qualification Found</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-12 selectpermission mt-4">
                                <label>Assign Permissions*</label>
                                <div class="permisionList mt-2">
                                    @forelse ($permissions as $permission)
                                    <input type="checkbox" id="{{ $permission->id }}" value="{{ $permission->id }}"
                                        name="permission_id[]">
                                    <label>{{ $permission->name }}</label>
                                    @empty
                                    @endforelse
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
        $(document).ready(function() {
            $('#roles').on('change', function() {
                var roleId = $(this).val();
                var permissions = $(this).find('option:selected').data('permission');
                if (permissions && permissions.length > 0) {
                    $('.permisionList input[type="checkbox"]').prop('checked', false);
                    permissions.forEach(function(permissionId) {
                        $('#' + permissionId).prop('checked', true);
                    });
                } else {
                    $('.permisionList input[type="checkbox"]').prop('checked', false);
                }
            });

            $("#asssign_permission").validate({
                rules: {
                    role_id: {
                        required: true, // Role selection is mandatory
                    },
                    'permission_id[]': {
                        required: true, // At least one permission should be selected
                        minlength: 1 // Ensures at least one permission is selected
                    }
                },
                messages: {
                    role_id: {
                        required: "Please select a role."
                    },
                    'permission_id[]': {
                        required: "Please select at least one permission."
                    }
                },
                errorElement: "div", // Error message is displayed inside a div element
                errorPlacement: function(error, element) {
                    // Custom error placement for checkboxes
                    if (element.attr("name") == "permission_id[]") {
                        error.insertAfter(".permisionList");
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    // Serialize the form data
                    var assignPermission = $(form).serialize();

                    // AJAX call for form submission
                    $.ajax({
                        url: "{{ route('assign_permission.store') }}",
                        type: 'POST',
                        data: assignPermission,
                        success: function(response) {
                            console.log(response);
                            // Close modal and show success message
                            $('#add_role').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            // Update content after the response
                            $('#assigned_permission_list').replaceWith(response.data);
                            // Reset the form
                            $("#asssign_permission")[0].reset();
                            // Reset checkboxes and role selection
                            $('#roles').val('').trigger('change');
                            $('.permisionList input[type="checkbox"]').prop('checked',
                                false);
                        },
                        error: function(error_messages) {
                        let errors = error_messages.responseJSON.error;
                        for (let error_key in errors) {
                            $(document).find('[name="' + error_key + '"]').after(
                                '<span class="' + error_key +
                                '_error text text-danger">' + errors[error_key] +
                                '</span>');

                            setTimeout(function(error_key) {
                                jQuery("." + error_key + "_error").remove();
                            }, 4000, error_key);  // Pass 'error_key' as an argument to the setTimeout callback
                        }
                    }
                    });
                }
            });
        });
    </script>
    @endsection
