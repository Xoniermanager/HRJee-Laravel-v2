@extends('layouts.admin.main')

@section('title', 'Edit Company')

@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Company</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-xl-5 g-3 gy-5">
                            <div class="col-xxl-3 col-xl-4 box-col-4e sidebar-left-wrapper">
                                <ul class="sidebar-left-icons nav nav-pills" id="add-product-pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation"> <a class="nav-link active"
                                            id="detail-product-tab" data-bs-toggle="pill" href="#detail-product"
                                            role="tab" aria-controls="detail-product" aria-selected="true"
                                            tabindex="-1">
                                            <div class="nav-rounded">
                                                <div class="product-icons">
                                                    <svg fill="#ffffff" viewBox="0 0 50 50"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" stroke="#ffffff">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M8 2L8 6L4 6L4 48L46 48L46 14L30 14L30 6L26 6L26 2 Z M 10 4L24 4L24 8L28 8L28 46L19 46L19 39L15 39L15 46L6 46L6 8L10 8 Z M 10 10L10 12L12 12L12 10 Z M 14 10L14 12L16 12L16 10 Z M 18 10L18 12L20 12L20 10 Z M 22 10L22 12L24 12L24 10 Z M 10 15L10 19L12 19L12 15 Z M 14 15L14 19L16 19L16 15 Z M 18 15L18 19L20 19L20 15 Z M 22 15L22 19L24 19L24 15 Z M 30 16L44 16L44 46L30 46 Z M 32 18L32 20L34 20L34 18 Z M 36 18L36 20L38 20L38 18 Z M 40 18L40 20L42 20L42 18 Z M 10 21L10 25L12 25L12 21 Z M 14 21L14 25L16 25L16 21 Z M 18 21L18 25L20 25L20 21 Z M 22 21L22 25L24 25L24 21 Z M 32 22L32 24L34 24L34 22 Z M 36 22L36 24L38 24L38 22 Z M 40 22L40 24L42 24L42 22 Z M 32 26L32 28L34 28L34 26 Z M 36 26L36 28L38 28L38 26 Z M 40 26L40 28L42 28L42 26 Z M 10 27L10 31L12 31L12 27 Z M 14 27L14 31L16 31L16 27 Z M 18 27L18 31L20 31L20 27 Z M 22 27L22 31L24 31L24 27 Z M 32 30L32 32L34 32L34 30 Z M 36 30L36 32L38 32L38 30 Z M 40 30L40 32L42 32L42 30 Z M 10 33L10 37L12 37L12 33 Z M 14 33L14 37L16 37L16 33 Z M 18 33L18 37L20 37L20 33 Z M 22 33L22 37L24 37L24 33 Z M 32 34L32 36L34 36L34 34 Z M 36 34L36 36L38 36L38 34 Z M 40 34L40 36L42 36L42 34 Z M 32 38L32 40L34 40L34 38 Z M 36 38L36 40L38 40L38 38 Z M 40 38L40 40L42 40L42 38 Z M 10 39L10 44L12 44L12 39 Z M 22 39L22 44L24 44L24 39 Z M 32 42L32 44L34 44L34 42 Z M 36 42L36 44L38 44L38 42 Z M 40 42L40 44L42 44L42 42Z">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="product-tab-content">
                                                <h5>Add Account</h5>
                                                <p>Add Company Account Detail </p>
                                            </div>
                                        </a></li>
                                    {{-- <li class="nav-item" role="presentation"> <a class="nav-link "
                                                id="gallery-product-tab" data-bs-toggle="pill" href="#gallery-product"
                                                role="tab" aria-controls="gallery-product" aria-selected="true">
                                                <div class="nav-rounded">
                                                    <div class="product-icons">
                                                        <svg viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="10"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path
                                                                    d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                                                    stroke="#ddd" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                                <path
                                                                    d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                                                    stroke="#ddd" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="product-tab-content">
                                                    <h5> Contact Person Information</h5>
                                                    <p> Add company contact person detail</p>
                                                </div>
                                            </a></li> --}}
                                    <li class="nav-item" role="presentation"> <a class="nav-link"
                                            id="category-product-tab" data-bs-toggle="pill" href="#category-product"
                                            role="tab" aria-controls="category-product" aria-selected="false"
                                            tabindex="-1">
                                            <div class="nav-rounded">
                                                <div class="product-icons">
                                                    <svg viewBox="-4 0 32 32" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"
                                                        fill="#ddd" stroke="#ddd">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="10"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <title>location</title>
                                                            <desc>Created with Sketch Beta.</desc>
                                                            <defs> </defs>
                                                            <g id="Page-1" stroke="none" stroke-width="1"
                                                                fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                                                <g id="Icon-Set-Filled" sketch:type="MSLayerGroup"
                                                                    transform="translate(-106.000000, -413.000000)"
                                                                    fill="#ddd">
                                                                    <path
                                                                        d="M118,422 C116.343,422 115,423.343 115,425 C115,426.657 116.343,428 118,428 C119.657,428 121,426.657 121,425 C121,423.343 119.657,422 118,422 L118,422 Z M118,430 C115.239,430 113,427.762 113,425 C113,422.238 115.239,420 118,420 C120.761,420 123,422.238 123,425 C123,427.762 120.761,430 118,430 L118,430 Z M118,413 C111.373,413 106,418.373 106,425 C106,430.018 116.005,445.011 118,445 C119.964,445.011 130,429.95 130,425 C130,418.373 124.627,413 118,413 L118,413 Z"
                                                                        id="location" sketch:type="MSShapeGroup">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="product-tab-content">
                                                <h5>Company Details</h5>
                                                <p>Add Company Details</p>
                                            </div>
                                        </a></li>

                                </ul>
                            </div>
                            <div class="col-xxl-9 col-xl-8 box-col-8 position-relative">
                                <div class="tab-content" id="add-product-pills-tabContent">
                                    <div class="tab-pane fade active show" id="detail-product" role="tabpanel"
                                        aria-labelledby="detail-product-tab">
                                        <div class="meta-body">
                                            <form id="companyAccountform">
                                                @csrf
                                                <input type="hidden" id="id" name="id" value="{{$companyDetails->id}}">
                                                <div class="row g-3 custom-input pb-5">
                                                    <div class="col-12">
                                                        <div class="row gx-xl-3 gx-md-2 gy-md-0 g-2">
                                                            <div class="col-12">
                                                                <label class="form-label"
                                                                    for="exampleFormControlInput1">Company
                                                                    Detail</label>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input class="form-control" id="name" name="name"
                                                                    type="text" placeholder="Company Name" value="{{$companyDetails->name}}">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input class="form-control" id="contact_no" name="contact_no"
                                                                    type="number" placeholder="Contact No." value="{{$companyDetails->companyDetails->contact_no}}">
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row gx-xl-3 gx-md-2 gy-md-0 g-2">

                                                            <div class="col-md-6 col-sm-6">
                                                                <input class="form-control" id="username" name="username" value="{{$companyDetails->companyDetails->username}}"
                                                                    type="text" placeholder="UsernName">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input class="form-control" id="email" name="email" value="{{$companyDetails->email}}"
                                                                    type="email" placeholder="Company Email" disabled>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <input class="form-control" id="username" name="username" value="{{$companyDetails->companyDetails->username}}"
                                                            type="text" placeholder="UsernName">
                                                    </div>
                                                    <!-- Face Recognition Dropdown -->
                                                    <div class="col-md-6 col-sm-6">
                                                        <select class="form-control" id="face_recognition" name="allow_face_recognition" onchange="toggleUserLimit()">
                                                            <option value="" disabled>Allow Face Recognition</option>
                                                            <option value="0">No</option>
                                                            <option value="1" {{$companyDetails->companyDetails->allow_face_recognition == 1 ? "selected" : ""}}>Yes</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <!-- User Limit (Hidden by Default) -->
                                                    <div class="col-md-6 col-sm-6" id="face_recognition_user_limit_container" style="display: {{$companyDetails->companyDetails->allow_face_recognition == 1 ? "block" : "none"}};">
                                                        <input class="form-control" id="face_recognition_user_limit" name="face_recognition_user_limit" type="number" placeholder="Enter User Limit for Face Recgnition" value="{{$companyDetails->companyDetails->face_recognition_user_limit}}">
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="image-input">
                                                                    <input type="file" id="logo" name="logo"
                                                                        class="form-control">
                                                                    <p for="imageInput" class="image-button"> Choose
                                                                        Logo</p>
                                                                    <img src="" class="image-preview">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="product-buttons">
                                                    <a class="companyAccountBtn btn" href="#">
                                                        <div class="d-flex align-items-center gap-sm-2 gap-1">Next
                                                            <svg viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path d="M5 12H19M19 12L13 6M19 12L13 18"
                                                                        stroke="#000000" stroke-width="2"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade pb-5" id="category-product" role="tabpanel"
                                        aria-labelledby="category-product-tab">
                                        <div class="meta-body">
                                            <form id="companyDetailForm">
                                                @csrf
                                                <input type="hidden" class="id" name="id" value="{{$companyDetails->id}}">
                                                <div class="row g-3 custom-input">
                                                    <div class="col-12">
                                                        <div class="row gx-xl-3 gx-md-2 gy-md-0 g-2">
                                                            <div class="col-12">
                                                                <label class="form-label"
                                                                    for="exampleFormControlInput1">Company
                                                                    Address</label>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input class="form-control" id="company_url" name="company_url" value="{{$companyDetails->companyDetails->company_url}}"
                                                                    type="url" placeholder="Company Website">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <input class="form-control" value="{{$companyDetails->companyDetails->companyType->name}}" type="text" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input class="form-control" id="company_size" name="company_size"
                                                                    type="number"
                                                                    placeholder="No of User/Licence required." value="{{$companyDetails->companyDetails->company_size}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row bottomspace">
                                                            <div class="col-md-12 col-sm-12">
                                                                <textarea class="form-control" id="company_address" name="company_address" rows="2" placeholder="Enter Your Company Address">{{ $companyDetails->companyDetails->company_address }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="product-buttons">
                                                    <a class="previousPersonDetailBtn btn" href="#">
                                                        <div class="d-flex align-items-center gap-sm-2 gap-1">
                                                            <svg viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M11.7071 4.29289C12.0976 4.68342 12.0976 5.31658 11.7071 5.70711L6.41421 11H20C20.5523 11 21 11.4477 21 12C21 12.5523 20.5523 13 20 13H6.41421L11.7071 18.2929C12.0976 18.6834 12.0976 19.3166 11.7071 19.7071C11.3166 20.0976 10.6834 20.0976 10.2929 19.7071L3.29289 12.7071C3.10536 12.5196 3 12.2652 3 12C3 11.7348 3.10536 11.4804 3.29289 11.2929L10.2929 4.29289C10.6834 3.90237 11.3166 3.90237 11.7071 4.29289Z"
                                                                        fill="#000000"></path>
                                                                </g>
                                                            </svg>Previous
                                                        </div>
                                                    </a>
                                                    <a class="companyDetailbtn btn btn-primary" href="#">
                                                        <div class="d-flex align-items-center gap-sm-2 gap-1 text-white">
                                                            Submit
                                                            <svg viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path d="M5 12H19M19 12L13 6M19 12L13 18"
                                                                        stroke="#ffffff" stroke-width="2"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </a>

                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function toggleUserLimit() {
        var dropdown = document.getElementById("face_recognition");
        var userLimitField = document.getElementById("face_recognition_user_limit_container");
        
        if (dropdown.value === "1") {
            userLimitField.style.display = "block";
        } else {
            userLimitField.style.display = "none";
        }
    }
    // next button script
    $(document).ready(function() {

        let formData = new FormData();

        // On company account button click
        $('.companyAccountBtn').click(function(e) {
            e.preventDefault();

            $("#companyAccountform").validate({
                rules: {
                    name: "required",
                    username: "required",
                    // email: {
                    //     required: true,
                    //     email: true
                    // },
                    password: {
                        required: true,
                        minlength: 8,
                        maxlength: 20
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 8,
                        maxlength: 20,
                        equalTo: "#password"
                    },
                    contact_no: {
                        required: true,
                        minlength: 10,
                        maxlength: 12
                    },
                },
                messages: {
                    name: "Please enter your name",
                    username: "Please enter your username",
                    // email: "Please enter a valid email address",
                    password: {
                        required: "Please enter your password",
                        minlength: "Password must be at least 8 characters long",
                        maxlength: "Password must be no more than 20 characters long"
                    },
                    password_confirmation: {
                        required: "Please confirm your password",
                        minlength: "Password confirmation must be at least 8 characters long",
                        maxlength: "Password confirmation must be no more than 20 characters long",
                        equalTo: "Passwords do not match"
                    },
                    contact_no: {
                        required: "Please enter your contact number",
                        minlength: "Contact number must be at least 10 characters",
                        maxlength: "Contact number must not be more than 12 characters"
                    },
                },
            });

            if ($("#companyAccountform").valid()) {
                // Append form data
                let form = $('#companyAccountform')[0];
                $.each(form.elements, function(i, element) {
                    var fieldName = element.name;
                    var fieldValue = element.value;
                    if (fieldName && fieldValue && element.type !== 'button') {
                        formData.append(fieldName, fieldValue);
                    }
                });

                console.log('formData', formData);

                // Enable the category-product tab and show it
                var element = document.getElementById("category-product-tab");
                element.classList.remove("disable");
                $('#add-product-pills-tab a[href="#category-product"]').tab('show');
            }
        });

        // On company detail button click
        $('.companyDetailbtn').click(function(e) {
            e.preventDefault();

            $("#companyDetailForm").validate({
                rules: {
                    company_url: {
                        required: true,
                        url: true
                    },
                    company_size: {
                        required: true,
                        digits: true,
                        maxlength: 6
                    },
                    // industry_type: "required",
                    company_address: "required",
                },
                messages: {
                    company_url: {
                        required: "Please enter your company URL",
                        url: "Please enter a valid URL (e.g., http://www.example.com)"
                    },
                    company_size: {
                        required: "Please enter your company size",
                        digits: "Please enter only digits",
                        maxlength: "Company size must not exceed 6 digits"
                    },
                    // industry_type: "Please Enter Industry Type",
                    company_address: "Please Enter Company Address",
                },
            });

            if ($("#companyDetailForm").valid()) {
                var companyDetail = $('#companyDetailForm').serialize();
                companyDetail = decodeURIComponent(companyDetail); // Decoding to prevent issues with special characters

                // Append company detail data to formData
                var companyDetailArray = companyDetail.split('&');
                companyDetailArray.forEach(function(pair) {
                    var field = pair.split('=');
                    formData.append(field[0], field[1]);
                });

                console.log('companyDetail', companyDetail);
                console.log('formData', formData);

                // Perform the AJAX submission
                $.ajax({
                    url: "<?= route('admin.company.update') ?>", // Ensure this route is correct
                    type: 'POST',
                    data: formData,
                    processData: false, // Don't process the data
                    contentType: false, // Let FormData handle the content type
                    success: function(response) {
                        Swal.fire("Done!", "It was successfully added!", "success");
                        window.location.href = "{{ route('admin.company') }}"; // Redirect on success
                    },
                    error: function(error_messages) {
                        let errors = error_messages.responseJSON.errors;
                        for (var error_key in errors) {

                            if (error_key == 'email' || error_key == 'name' || error_key == 'password' || error_key == 'username' || error_key == 'contact_no' || error_key == 'logo') {
                                $('#add-product-pills-tab a[href="#detail-product"]').tab('show');
                            } else {
                                $('#add-product-pills-tab a[href="#category-product"]').tab('show');
                            }
                            // Clear any previous errors before appending
                            $('#' + error_key + '_error').remove();

                            // Display the new error message
                            $(document).find('[name=' + error_key + ']').after(
                                '<span id="' + error_key + '_error" class="text text-danger">' + errors[error_key] + '</span>'
                            );

                            // Remove the error message after 5 seconds
                            setTimeout(function() {
                                $("#" + error_key + "_error").remove();
                            }, 10000);
                        }
                    }
                });
            }
        });

        // Previous button scripts
        $('.previouscompanyDetailBtn').click(function(e) {
            e.preventDefault();
            $('#add-product-pills-tab a[href="#category-product"]').tab('show');
        });

        $('.previousPersonDetailBtn').click(function(e) {
            e.preventDefault();
            $('#add-product-pills-tab a[href="#detail-product"]').tab('show');
        });

        
    });
</script>
<style>
    .bottomspace {
        margin-bottom: 40px;
    }

    a.companyAddressbtn.d-flex.align-items-center.gap-sm-2.gap-1 {
        color: white;
    }
</style>
@endsection
