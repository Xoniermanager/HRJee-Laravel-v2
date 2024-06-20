@extends('layouts.company.main')

@section('title', 'main')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class=" symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{ $companyDetails->logo }}" alt="image" width="200px">

                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a
                                            class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ isset($companyDetails) ? $companyDetails->name : 'Admin' }}</a>

                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3"
                                                        d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z"
                                                        fill="currentColor"></path>
                                                    <path
                                                        d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z"
                                                        fill="currentColor"></path>
                                                    <rect x="7" y="6" width="4" height="4" rx="2"
                                                        fill="currentColor"></rect>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{ isset($companyDetails) ? $companyDetails->name : 'Admin' }}</a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3"
                                                        d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                        fill="currentColor"></path>
                                                    <path
                                                        d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{ isset($companyDetails) ? $companyDetails->company_address : '' }}</a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3"
                                                        d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                        fill="currentColor"></path>
                                                    <path
                                                        d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{ isset($companyDetails) ? $companyDetails->company_url : '' }}</a>
                                    </div>
                                    <!--end::Info-->


                                </div>
                                <!--end::User-->
                                <!--begin::Actions-->
                                <div class="d-flex my-4">

                                    <a href="#" class="btn btn-sm btn-primary ms-3 align-self-center wt-space"
                                        data-bs-toggle="modal" data-bs-target="#change_password">
                                        Change Password</a>
                                    <div class="modal fade" id="change_password" tabindex="-1" aria-hidden="true">
                                        <!--begin::Modal dialog-->
                                        <div class="modal-dialog modal-dialog-centered mw-500px">
                                            <!--begin::Modal content-->
                                            <div class="modal-content">
                                                <!--begin::Modal header-->
                                                <div class="modal-header pb-0 border-0 justify-content-end">
                                                    <!--begin::Close-->
                                                    <div class="btn btn-sm btn-icon btn-active-color-primary"
                                                        data-bs-dismiss="modal">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                        <span class="svg-icon svg-icon-1">
                                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.5" x="6" y="17.3137" width="16"
                                                                    height="2" rx="1"
                                                                    transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                                <rect x="7.41422" y="6" width="16" height="2"
                                                                    rx="1" transform="rotate(45 7.41422 6)"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <!--end::Close-->
                                                </div>
                                                <!--begin::Modal header-->
                                                <!--begin::Modal body-->
                                                <div class="modal-body scroll-y pt-0 pb-10">
                                                    <!--begin::Wrapper-->
                                                    <div class="mw-lg-600px mx-auto">
                                                        <!--begin::Heading-->
                                                        <div class="mb-13  ">
                                                            <!--begin::Title-->
                                                            <h1 class="mb-3">Change Password</h1>
                                                            <!--end::Title-->
                                                        </div>
                                                        <!--end::Heading-->
                                                        <!--begin::Input group-->
                                                        <div class="d-flex align-items-center mt-10  ">
                                                            <!--begin::Switch-->
                                                            <form method="post" id="chnge_pass_form">
                                                                <div class="row">
                                                                    <div class="col-md-12 form-group">
                                                                        <label for="">Old Password *</label>
                                                                        <input type="password" class="form-control"
                                                                            name="old_password" id="old_password">
                                                                    </div>
                                                                    <div class="col-md-12 form-group">
                                                                        <label for="">New Password *</label>
                                                                        <input type="password" class="form-control"
                                                                            name="new_password" id="new_password">
                                                                    </div>
                                                                    <div class="col-md-12 form-group">
                                                                        <label for="">Confirm Password *</label>
                                                                        <input type="password" class="form-control"
                                                                            name="new_password_confirmation"
                                                                            id="new_password_confirmation">
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-end flex-row-fluid pt-12 ">
                                                                    <button type="reset" class="btn btn-light me-3"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">submit</button>
                                                                </div>
                                                                <!--end::Switch-->
                                                        </div>
                                                        <!--end::Input group-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                    </form>
                                                </div>
                                                <!--end::Modal body-->
                                            </div>
                                            <!--end::Modal content-->
                                        </div>
                                        <!--end::Modal dialog-->
                                    </div>

                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Title-->

                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <ul class="nav nav-pills nav-pills-custom mb-3 mt-10" role="tablist">
                        <!--begin::Item-->
                        <li class="nav-item  me-3 me-lg-6" role="presentation">
                            <!--begin::Link-->
                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden  h-55px py-4 active"
                                data-bs-toggle="pill" href="#kt_profile_details_view" aria-selected="false"
                                role="tab" tabindex="-1">

                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-700 fw-bold fs-6 ">Personal Details</span>
                                <!--end::Subtitle-->
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                <!--end::Bullet-->

                            </a>
                            <!--end::Link-->
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item  me-3 me-lg-6" role="presentation">
                            <!--begin::Link-->
                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden  h-55px py-4"
                                data-bs-toggle="pill" href="#company_detail" aria-selected="false" role="tab"
                                tabindex="-1">

                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-700 fw-bold fs-6 ">Company Details</span>
                                <!--end::Subtitle-->
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                <!--end::Bullet-->

                            </a>
                            <!--end::Link-->
                        </li>
                        <!--end::Item-->


                    </ul>

                </div>
            </div>
            <!--end::Navbar-->
            <!--begin::details View-->
            <div class="tab-content">
                <div class="card tab-pane fade active show  mb-5 mb-xl-10" id="kt_profile_details_view" role="tabpanel">
                    <!--begin::Card header-->
                    <div class="card-header cursor-pointer">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Personal Details</h3>
                        </div>
                        <!--end::Card title-->

                    </div>
                    <!--begin::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <form method="post" action="{{ route('update.company', ['id' => $companyDetails->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Logo </label>
                                    <input class="form-control" name="logo" type="file">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Company Name </label>
                                    <input class="form-control" name="name" type="text"
                                        value="{{ isset($companyDetails) ? $companyDetails->name : '' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">User Name </label>
                                    <input class="form-control" name="username" type="text"
                                        value="{{ isset($companyDetails) ? $companyDetails->username : '' }}">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="">Company Email Id </label>
                                    <input class="form-control" name="email" type="email"
                                        value="{{ isset($companyDetails) ? $companyDetails->email : '' }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Contact Number </label>
                                    <input class="form-control" name="contact_no" type="number"
                                        value="{{ isset($companyDetails) ? $companyDetails->contact_no : '' }}">
                                </div>


                            </div>

                            <button class="btn btn-primary">Update</button>

                        </form>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::details View-->

                <div class="card tab-pane fade   mb-5 mb-xl-10" id="company_detail" role="tabpanel">
                    <!--begin::Card header-->
                    <div class="card-header cursor-pointer">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Company Details</h3>
                        </div>
                        <!--end::Card title-->

                    </div>
                    <!--begin::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <form method="post" action="">
                            <div class="row">
                                @csrf
                                <div class="col-md-6 form-group">
                                    <label for="">Company Branch Name </label>
                                    <input class="form-control" name="name" type="text"
                                        value="{{ isset($companyBranch) ? $companyBranch->name : '' }}">
                                </div>


                                <div class="col-md-6 form-group">
                                    <label for="">Branch Type </label>
                                    <select class="form-control" name="branch_type">
                                        <option value="">Select Branch Type</option>
                                        <option value="Primary"
                                            {{ collect(isset($companyBranch->branch_type) ? $companyBranch->branch_type : '')->contains('primary') ? 'selected' : '' }}>
                                            Primary</option>
                                        <option value="Secondary"
                                            {{ collect(isset($companyBranch->branch_type) ? $companyBranch->branch_type : '')->contains('secondary') ? 'selected' : '' }}>
                                            Secondary</option>
                                    </select>
                                    @error('branch_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="">Contact Number</label>
                                    <input class="form-control" name="contact_no" type="text"
                                        value="{{ isset($companyBranch) ? $companyBranch->contact_no : '' }}">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="">Email</label>
                                    <input class="form-control" name="email" type="text"
                                        value="{{ isset($companyBranch) ? $companyBranch->email : '' }}">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="">HR Email</label>
                                    <input class="form-control" name="hr_email" type="text"
                                        value="{{ isset($companyBranch) ? $companyBranch->hr_email : '' }}">
                                </div>


                                <div class="col-md-6 form-group">
                                    <label for="">Company Address *</label>
                                    <input class="form-control" name="address" type="text"
                                        value="{{ isset($companyBranch) ? $companyBranch->address : '' }}">
                                </div>
                                    {{-- <input class="form-control" name="" type="text" value="@countryName($companyBranch->country_id)">  --}}
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Pin code *</label>
                                    <input class="form-control" name="pincode" type="text"
                                        value="{{ isset($companyBranch) ? $companyBranch->pincode : '' }}">
                                </div>


                            </div>

                            <button class="btn btn-primary">Update</button>

                        </form>
                    </div>
                    <!--end::Card body-->


                </div>


            </div>


        </div>
        <!--end::Container-->
    </div>
@endsection

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    jQuery.noConflict();
    jQuery(document).ready(function($) {
        $("#chnge_pass_form").validate({

            rules: {
                old_password: "required",
                new_password: "required",
                new_password_confirmation: "required",
            },
            messages: {
                old_password: "Please enter old password",
                new_password: "Please enter a new password",
                new_password_confirmation: "Please enter confirm password",
            },
            submitHandler: function(form) {

                var old_password = $('#old_password').val();
                var new_password = $('#new_password').val();
                var new_password_confirmation = $('#new_password_confirmation').val();
                $.ajax({
                    url: "{{ route('company.change.password') }}",
                    type: 'post',
                    data: {
                        "old_password": old_password,
                        "new_password": new_password,
                        "new_password_confirmation": new_password_confirmation,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('password updated', response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {

                        console.error(xhr.responseText);
                    }
                });
            }
        });

    });
</script>
