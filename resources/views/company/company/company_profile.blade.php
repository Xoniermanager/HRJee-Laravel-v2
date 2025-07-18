@extends('layouts.company.main')

@section('title', 'My Profile')

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
                            <img src="{{ Auth()->user()->companyDetails->logo }}" alt="image" width="200px">

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
                                    <a class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{
                                        Auth()->user()->name }}</a>

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
                                                <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor">
                                                </rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->{{ Auth()->user()->name }}
                                    </a>
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
                                        <!--end::Svg Icon-->{{ Auth()->user()->companyDetails->company_address }}
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
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
                                        <!--end::Svg Icon-->{{ Auth()->user()->companyDetails->company_url }}
                                    </a>
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
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                                                rx="1" transform="rotate(-45 6 17.3137)"
                                                                fill="currentColor" />
                                                            <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                                transform="rotate(45 7.41422 6)" fill="currentColor" />
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
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12 form-group">
                                                                    <label for="" class="required">Old Password</label>
                                                                    <input type="password" class="form-control"
                                                                        name="old_password" id="old_password"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <label for="" class="required">New Password</label>
                                                                    <input type="password" class="form-control"
                                                                        name="password" id="password"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <label for="" class="required">Confirm
                                                                        Password</label>
                                                                    <input type="password" class="form-control"
                                                                        name="confirm_password" id="confirm_password"
                                                                        autocomplete="off">
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
            </div>
        </div>
        <!--end::Navbar-->
        <!--begin::details View-->
        <div class="tab-content">
            <div class="card tab-pane fade active show  mb-5 mb-xl-10" id="kt_profile_details_view" role="tabpanel">
                <div class="card-header cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Personal Details</h3>
                    </div>
                </div>
                <div class="card-body p-9">
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
                    <form method="post" action="{{route("company.profile.update")}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Company Logo </label>
                                <input class="form-control" name="logo" type="file">
                                @if ($errors->has('logo'))
                                <div class="text-danger">{{ $errors->first('logo') }}</div>
                            @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Company Name </label>
                                <input class="form-control" name="name" type="text" value="{{ Auth()->user()->name }}" readonly>
                                  @if ($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">User Name </label>
                                <input class="form-control" name="username" type="text"
                                    value="{{ Auth()->user()->companyDetails->username }}">
                                    @if ($errors->has('username'))
                                    <div class="text-danger">{{ $errors->first('username') }}</div>
                                @endif
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="">Company Email Id </label>
                                <input class="form-control" name="email" type="email"
                                    value="{{ Auth()->user()->email }}" disabled>
                                    @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Contact Number </label>
                                <input class="form-control" name="contact_no" type="number"
                                    value="{{ Auth()->user()->companyDetails->contact_no }}">
                                    @if ($errors->has('leave_type_id'))
                                    <div class="text-danger">{{ $errors->first('leave_type_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-primary" type='submit'>Update</button>
                    </form>
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function($) {
        $("#chnge_pass_form").validate({
            rules: {
                old_password: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 30
                },
                confirm_password: {
                    required: true,
                    minlength: 8,
                    maxlength: 30,
                    equalTo: "#password"
                },
            },
            messages: {
                old_password: "Please enter a valid old password",
                password: {
                    required: "Please enter your password",
                    minlength: "Password must be at least 8 characters long",
                    maxlength: "Password must be no more than 30 characters long"
                },
                confirm_password: {
                    required: "Please enter your password",
                    minlength: "Password must be at least 8 characters long",
                    maxlength: "Password must be no more than 30 characters long",
                    equalTo: "Confirm password does not match"
                },
            },
            submitHandler: function(form, event) {
                var errorTimeout;
                event.preventDefault(); // Prevent default form submission
                var formData = new FormData(form);
                $.ajax({
                    url: "<?= route('user.update.password') ?>",
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            Swal.fire("Done!", response.message, "success");
                            $('#chnge_pass_form')[0].reset();
                            $('#change_password').hide();
                        }
                    },
                    error: function(error_messages) {
                        $('#change_password').show();
                        if (error_messages.responseJSON && error_messages.responseJSON
                            .errors) {
                            $.each(error_messages.responseJSON.errors, function(key,value) {
                                $(document).find('[name=' + key + ']').after(
                                    '<span class="text text-danger">' + value + '</span>');
                            });
                            if (errorTimeout) {
                                clearTimeout(errorTimeout);
                            }
                            errorTimeout = setTimeout(function() {
                                $('.text-danger').fadeOut();
                            }, 2000);
                        }
                    }
                });
            }
        });
    });
</script>
@endsection
