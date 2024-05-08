@extends('layouts.main')

@section('title', 'main')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">

                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Stepper-->
                        <div class="stepper stepper-links d-flex flex-column pt-5" id="kt_create_account_stepper">
                            <!--begin::Nav-->
                            <div class="stepper-nav mb-5">
                                <!--begin::Step 1-->
                                <div class="stepper-item current" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Personal Details
                                    </h3>
                                </div>
                                <!--end::Step 1-->
                                <!--begin::Step 2-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Company Details</h3>
                                </div>
                                <!--end::Step 2-->
                                <!--begin::Step 3-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title"> Address</h3>
                                </div>
                                <!--end::Step 3-->
                                <!--begin::Step 4-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Bank Details </h3>
                                </div>
                                <!--end::Step 4-->
                                <!--begin::Step 5-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Upload Documents</h3>
                                </div>
                                <!--end::Step 5-->
                                <!--begin::Step 5-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Completed</h3>
                                </div>
                                <!--end::Step 5-->

                            </div>
                            <!--end::Nav-->
                            <!--begin::Form-->
                            <form class="mx-auto w-100 pb-10" id="kt_create_account_form" name="kt_create_account_form"
                                method="post">

                                <!--begin::Step 1-->
                                <div class="current" data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="mb-3">
                                        <div class="card-header p-4">
                                            <!--begin::Card title-->
                                            <div class="card-title m-0">
                                                <h3 class="fw-bold m-0"> Personal Details
                                                </h3>
                                            </div>
                                            <!--end::Card title-->
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="">Full Name <span
                                                            style="color: red;">*</span></label>
                                                    <input class="form-control" type="text" name="full_name"
                                                        id="full_name">

                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Email <span style="color: red;">*</span></label>
                                                    <input class="form-control" type="email" name="email"
                                                        id="email">

                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Password <span
                                                            style="color: red;">*</span></label>
                                                    <input class="form-control" type="password" name="password"
                                                        value="">
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="">Gaurdian's Name </label>
                                                    <input class="form-control" type="text" name="father_name"
                                                        value="">

                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Gender <span style="color: red;">*</span></label>
                                                    <select class="form-control" name="gender">
                                                        <option value="">Select Gender</option>
                                                        <option value="male"
                                                            {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                                        <option value="female"
                                                            {{ old('gender') === 'female' ? 'selected' : '' }}>Female
                                                        </option>
                                                        <option value="other"
                                                            {{ old('gender') === 'other' ? 'selected' : '' }}>Other</option>
                                                    </select>
                                                    @error('gender')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Date of Birth </label>
                                                    <input class="form-control" name="date_of_birth" type="date"
                                                        value="">

                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Phone Number <span
                                                            style="color: red;">*</span></label>
                                                    <input class="form-control" name="phone" type="number"
                                                        value="{{ old('phone') }}">

                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Photo </label>
                                                    <input class="form-control" type="file" name="profile_image"
                                                        value="{{ old('profile_image') }}">

                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Family Contact Number </label>
                                                    <input class="form-control" type="text" name="family_contact_number"
                                                        value="{{ old('family_contact_number') }}">

                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 1-->
                                <!--begin::Step 2-->
                                <div data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="mb-3">
                                        <div class="card-header p-4">
                                            <!--begin::Card title-->
                                            <div class="card-title m-0">
                                                <h3 class="fw-bold m-0"> Company Details
                                                </h3>
                                            </div>
                                            <!--end::Card title-->
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="">Branch *</label>
                                                    <select class="form-control">
                                                        <option value="">Delhi</option>
                                                        <option value="">Noida</option>
                                                        <option value="">Punjab</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Department *</label>
                                                    <select class="form-control">
                                                        <option value="">Development</option>
                                                        <option value="">Management</option>
                                                        <option value="">Marketing</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Designation *</label>
                                                    <select class="form-control">
                                                        <option value="">Laravel Developer</option>
                                                        <option value="">Angular Developer</option>
                                                        <option value="">React Developer</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Employee ID*</label>
                                                    <input class="form-control" name="" type="text">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Manager ID *</label>
                                                    <input class="form-control" name="" type="text">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Joining Date *</label>
                                                    <input class="form-control" type="date" name="">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Basic Pay *</label>
                                                    <input class="form-control" type="text" name="">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Rent Allowance *</label>
                                                    <input class="form-control" type="text" name="">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Medical Allowance *</label>
                                                    <input class="form-control" type="text" name="">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Travel Allowance *</label>
                                                    <input class="form-control" type="text" name="">
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 2-->
                                <!--begin::Step 3-->
                                <div data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="w-100">
                                        <div class="mb-3">
                                            <div class="card-header p-4">
                                                <!--begin::Card title-->
                                                <div class="card-title m-0">
                                                    <h3 class="fw-bold m-0"> Permanent Address
                                                    </h3>
                                                </div>
                                                <!--end::Card title-->
                                            </div>

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label for="">Address *</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="">City *</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="">State *</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="">Pincode *</label>
                                                        <input class="form-control" type="text">
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="mb-3 border-top">
                                            <div class="card-header p-4">
                                                <!--begin::Card title-->
                                                <div class="card-title m-0">
                                                    <h4>
                                                        <input type="checkbox">
                                                        Temporary Address is same as Permanent Address
                                                    </h4>
                                                    <h3 class="fw-bold m-0">
                                                        Temporary Address
                                                    </h3>
                                                </div>
                                                <!--end::Card title-->
                                            </div>

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label for="">Address *</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="">City *</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="">State *</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="">Pincode *</label>
                                                        <input class="form-control" type="text">
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 3-->
                                <!--begin::Step 5-->
                                <div data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="mb-3">
                                        <div class="card-header p-4">
                                            <!--begin::Card title-->
                                            <div class="card-title m-0">
                                                <h3 class="fw-bold m-0"> Bank Account Details
                                                </h3>
                                            </div>
                                            <!--end::Card title-->
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="">Account Holder Name *</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Account Number *</label>
                                                    <input class="form-control" type="number">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Bank Name *</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">IFSC Code *</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">PAN Number *</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Branch *</label>
                                                    <input class="form-control" type="text">
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 5-->

                                <!--begin::Step 5-->
                                <div data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="mb-3">
                                        <div class="card-header p-4">
                                            <!--begin::Card title-->
                                            <div class="card-title m-0">
                                                <h3 class="fw-bold m-0"> Upload Documents </h3>
                                            </div>
                                            <!--end::Card title-->
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="">Resume *</label>
                                                    <input class="form-control" type="file">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Offer Letter *</label>
                                                    <input class="form-control" type="file">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Joining Letter *</label>
                                                    <input class="form-control" type="file">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Other Document (Upload Multiple) </label>
                                                    <input class="form-control" type="file">
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 5-->
                                <!--begin::Step 5-->
                                <div data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="mb-3 w-100">
                                        <div class="card-body">
                                            <div class="col-md-5 m-auto text-center">
                                                <h2 class="fw-bold text-dark">Your Are Done!</h2>
                                                <img src="{{ asset('assets/media/completed.png') }}" class="img-fluid"
                                                    alt="">
                                            </div>

                                        </div>

                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 5-->
                                <!--begin::Actions-->
                                <div class="d-flex flex-stack pt-15">
                                    <!--begin::Wrapper-->
                                    <div class="mr-2">
                                        <button type="button" class="btn btn-lg btn-light-primary me-3"
                                            data-kt-stepper-action="previous">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                            {{-- <span class="svg-icon svg-icon-4 me-1">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor" />
															<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor" />
														</svg>
													</span> --}}
                                            <!--end::Svg Icon-->Back</button>
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Wrapper-->
                                    <div>
                                        {{-- <button type="button" class="btn btn-lg btn-primary me-3"
                                            data-kt-stepper-action="submit">
                                            <span class="indicator-label">Submit
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-3 ms-2 me-0">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2"
                                                            rx="1" transform="rotate(-180 18 13)"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon--></span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button> --}}
                                        {{-- <button type="button" class="btn btn-lg btn-primary"
                                            data-kt-stepper-action="next" id="submit-form">Next</button> --}}
                                        <input type="submit" class="btn btn-lg btn-primary" id="submit-form"
                                            value="Save">

                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Stepper-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Row-->
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
        $("#kt_create_account_form").validate({
            rules: {
                full_name: "required",
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                gender: "required",
                phone: {
                    required: true,
                    maxlength: 12,
                    minlength: 10
                }
            },
            messages: {
                full_name: "Please enter your firstname",
                email: "Please enter a valid email address",
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                gender: "Please select your gender"
            },
            submitHandler: function(form) {

                var user = $(form).serialize();
                $.ajax({
                    url: "{{ route('add.employee') }}",
                    type: 'PATCH',
                    data: {
                        user: user,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {

                        console.error(xhr.responseText);
                    }
                });
            }
        });

    });
</script>
