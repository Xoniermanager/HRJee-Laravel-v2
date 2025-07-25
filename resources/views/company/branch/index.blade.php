@extends('layouts.company.main')
@section('content')
    @section('title')
        Company Branches
    @endsection
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="custom-table card p-0">
                    <div class="card-header cursor-pointer p-0">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <div class="min-w-200px me-2 d-flex align-items-center position-relative my-1">
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
                                <input class="form-control form-control-solid ps-14" placeholder="Search " type="text"
                                    value="{{ request()->get('search') }}" id="search_branch">
                            </div>
                            <select class="me-2 form-control min-w-200px" id="status">
                                <option value="">Status</option>
                                <option {{ request()->get('status') == '1' ? 'selected' : '' }} value="1">Active
                                </option>
                                <option {{ request()->get('status') == '2' ? 'selected' : '' }} value="2">Inactive
                                </option>
                            </select>
                            <select class="form-control min-w-200px me-2" id="filter_country">
                                <option value="">Please Select Country</option>
                                @forelse ($countries as $country)
                                    <option value="{{ $country->id }}" {{ request()->get('country_id') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @empty
                                    <option value="">No Country Found</option>
                                @endforelse
                            </select>
                            <select class="form-control min-w-200px me-2" id="filter_state_id" style="display: none">
                            </select>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Action-->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_company_branch"
                            class="btn btn-sm btn-primary align-self-center">
                            Add Branch</a>

                        <!--end::Action-->
                    </div>

                    <div class="card-body mb-5 mb-xl-10">
                        @include('company.branch.branches-list')
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <div class="modal" id="edit_company_branch">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-500px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Close-->
                        <h2>Edit branch</h2>
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
                        <!--begin::Wrapper-->
                        <form class="row g-3" id="edit_company_branch_form">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="col-md-6">
                                <label class="form-label required">Branch Name</label>
                                <input class="form-control" type="text" placeholder="Enter Your Branch Name" name="name"
                                    id="name">
                            </div>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-md-6">
                                <label class="form-label required">Branch Type</label>
                                <select class="form-select" name="type" id="type">
                                    <option value="">Select Type</option>
                                    <option value="primary">Primary</option>
                                    <option value="secondary">Secondary</option>
                                </select>
                                @error('type')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label required">Contact No</label>
                                <input class="form-control" type="number" placeholder="Enter Your Contact No"
                                    name="contact_no" id="contact_no">
                                @error('contact_no')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label class="form-label required">Email</label>
                                <input class="form-control" type="text" placeholder="Enter Your Email" name="email"
                                    id="email">
                                @error('email')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label required">Hr Email</label>
                                <input class="form-control" type="text" placeholder="Enter Your Hr Email" name="hr_email"
                                    id="hr_email">
                                <span class="text-warning">If no HR present then enter same email as branch email</span>
                                @error('hr_email')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label required">Address</label>
                                <input class="form-control" type="text" placeholder="Enter Your Address" name="address" oninput="initAutocomplete('edit_address')" id="edit_address">
                                @error('address')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">Country</label>
                                <select class="form-select" name="country_id" id="edit_country_id">
                                    <option value="">Please Select Country</option>
                                    @forelse ($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @empty
                                        <option value="">No Country Found</option>
                                    @endforelse
                                </select>
                                @error('country')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">State</label>
                                <select class="form-select" name="state_id" id="edit_state">
                                </select>
                                @error('state_id')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">City</label>
                                <input class="form-control" type="text" placeholder="Enter Your City" name="city" id="city">
                                @error('city')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label class="form-label required">Pincode</label>
                                <input class="form-control" type="text" placeholder="Enter Your Pincode" name="pincode"
                                    id="pincode">
                                @error('pincode')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Save</button>
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
        <div class="modal" id="add_company_branch">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-500px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Close-->
                        <h2>Add Branch</h2>
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
                        <form class="row g-3" id="branch_create_form">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="col-md-6">
                                <label class="form-label required">Branch Name</label>
                                <input class="form-control" type="text" placeholder="Enter Your Branch Name" name="name"
                                    id="name">
                                @error('name')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">Branch Type</label>
                                <select class="form-select" name="type">
                                    <option value="">Select Type</option>
                                    <option value="primary">Primary</option>
                                    <option value="secondary">Secondary</option>
                                </select>
                                @error('type')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label required">Contact No</label>
                                <input class="form-control" type="number" placeholder="Enter Your Contact No"
                                    name="contact_no" id="contact_no">
                                @error('contact_no')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label class="form-label required">Email</label>
                                <input class="form-control" type="text" placeholder="Enter Your Email" name="email"
                                    id="email">
                                @error('email')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label required">Hr Email</label>
                                <input class="form-control" type="text" placeholder="Enter Your Hr Email" name="hr_email"
                                    id="hr_email">
                                <span class="text-warning">If no HR present then enter same email as branch email</span>
                                @error('hr_email')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label required">Address</label>
                                <input type="text" id="address" class="form-control" placeholder="Enter an address" oninput="initAutocomplete('address')" name="address"/>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">Country</label>
                                <select class="form-select" name="country_id" id="country_id">
                                    <option value="">Please Select Country</option>
                                    @forelse ($countries as $country)
                                        <option value="{{ $country->id }}">
                                            {{ $country->name }}
                                        </option>
                                    @empty
                                        <option value="">No Country Found</option>
                                    @endforelse
                                </select>
                                @error('country_id')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">State</label>
                                <select class="form-select" name="state_id" id="state">
                                </select>
                                @error('state_id')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">City</label>
                                <input class="form-control" type="text" placeholder="Enter Your City" name="city" id="city">
                                @error('city')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">Pincode</label>
                                <input class="form-control" type="text" placeholder="Enter Your Pincode" name="pincode"
                                    id="pincode">
                                @error('pincode')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAdzVvYFPUpI3mfGWUTVXLDTerw1UWbdg&libraries=places&callback=initAutocomplete"></script>
        <script>
            /** Get All State From Country ID*/
            jQuery('#country_id').on('change', function () {
                var country_id = $(this).val();
                var div_id = 'state';
                get_all_state_using_country_id(country_id, div_id);
            });
            jQuery('#edit_country_id').on('change', function () {
                var country_id = $(this).val();
                var div_id = 'edit_state';
                get_all_state_using_country_id(country_id, div_id);
            });
            jQuery('#filter_country').on('change', function () {
                var country_id = $(this).val();
                var div_id = 'filter_state_id';
                get_all_state_using_country_id(country_id, div_id);
                $('#filter_state_id').show();
            });
            /**-------------End----------*/

            /** Filter By Search By Dropdown*/
            jQuery("#search_branch").on('input', function () {
                search_filter_results();
            });
            jQuery("#status").on('change', function () {
                search_filter_results();
            });
            jQuery("#filter_country").on('change', function () {
                $('#filter_state_id').val('')
                search_filter_results();
            });
            jQuery("#filter_state_id").on('change', function () {
                search_filter_results();
            });

            function search_filter_results() {
                //alert($('#search').val());
                $.ajax({
                    type: 'GET',
                    url: company_ajax_base_url + '/company/branch/search',
                    data: {
                        'status': $('#status').val(),
                        'search': $('#search_branch').val(),
                        'country_id': $('#filter_country').val(),
                        'state_id': $('#filter_state_id').val(),
                    },
                    success: function (response) {
                        $('#company_branch_list').replaceWith(response.data);
                    }
                });
            }
            /**-------------End----------*/

            /** Validation and Ajax Creation and Updated*/
            jQuery(document).ready(function ($) {
                const removeErrorsAfter = 5000;

                // Shared validation rules
                const validationRules = {
                    name: {
                        required: true,
                        pattern: /^[A-Za-z\s]+$/
                    },
                    type: "required",
                    contact_no: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 12
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    hr_email: {
                        required: true,
                        email: true
                    },
                    address: "required",
                    city: "required",
                    pincode: {
                        required: true,
                        digits: true,
                        maxlength: 8
                    },
                    state_id: "required",
                    country_id: "required",
                };

                const validationMessages = {
                    name: "Please enter a valid branch name (letters only)",
                    type: "Please select the branch type",
                    contact_no: "Please enter a valid contact number (10–12 digits)",
                    email: "Please enter a valid branch email",
                    hr_email: "Please enter a valid HR email",
                    address: "Please enter branch address",
                    city: "Please enter branch city",
                    pincode: "Please enter a valid pincode (up to 8 digits)",
                    state_id: "Please select branch state",
                    country_id: "Please select branch country",
                };

                // Custom validator for letters only
                $.validator.addMethod("pattern", function (value, element, param) {
                    return this.optional(element) || param.test(value);
                }, "Invalid format");

                function handleAjaxError(error_messages) {
                    let errors = error_messages.responseJSON.errors;
                    for (let error_key in errors) {
                        $(`[name="${error_key}"]`).next('.text-danger').remove(); // Remove previous
                        $(`[name="${error_key}"]`).after(`<span class="text-danger">${errors[error_key]}</span>`);
                    }
                    setTimeout(() => {
                        $('.text-danger').fadeOut('slow', function () { $(this).remove(); });
                    }, removeErrorsAfter);
                }

                // Edit form validation
                $("#edit_company_branch_form").validate({
                    rules: validationRules,
                    messages: validationMessages,
                    submitHandler: function (form) {
                        let data = $(form).serialize();
                        $.ajax({
                            url: "{{ route('company.branch.update') }}",
                            type: "POST",
                            data: data,
                            success: function (response) {
                                console.log(response);
                                jQuery('#edit_company_branch').modal('hide');
                                jQuery('#company_branch_list').replaceWith(response.data);
                                Swal.fire("Done!", response.message, "success");
                            },
                            error: handleAjaxError
                        });
                    }
                });

                // Create form validation
                $("#branch_create_form").validate({
                    rules: validationRules,
                    messages: validationMessages,
                    submitHandler: function (form) {
                        let data = $(form).serialize();
                        $.ajax({
                            url: "<?= route('company.branch.store') ?>",
                            type: "POST",
                            data: data,
                            success: function (response) {
                                jQuery('#add_company_branch').modal('hide');
                                jQuery('#company_branch_list').replaceWith(response.data);
                                jQuery("#branch_create_form")[0].reset();
                                Swal.fire("Done!", response.message, "success");
                            },
                            error: handleAjaxError
                        });
                    }
                });
            });


            function edit_company_branch_details(companyBranchDetails) {

                companyBranchDetails = JSON.parse(companyBranchDetails);
                $('#id').val(companyBranchDetails.id);
                $('#name').val(companyBranchDetails.name);
                $('#edit_address').val(companyBranchDetails.address);
                $('#type').val(companyBranchDetails.type);
                $('#contact_no').val(companyBranchDetails.contact_no);
                $('#email').val(companyBranchDetails.email);
                $('#hr_email').val(companyBranchDetails.hr_email);
                $('#address').val(companyBranchDetails.address);
                $('#city').val(companyBranchDetails.city);
                $('#pincode').val(companyBranchDetails.pincode);
                $('#edit_country_id').val(companyBranchDetails.country_id);
                get_all_state_using_country_id(companyBranchDetails.country_id, 'edit_state', companyBranchDetails.state_id);
                $('#description').val(companyBranchDetails.description);
                jQuery('#edit_company_branch').modal('show');
            }

            function initAutocomplete(inputId) {
                var input = document.getElementById(inputId); // Dynamically use the input ID
                var autocomplete = new google.maps.places.Autocomplete(input);
            }

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
                    url: "{{ route('company.branch.statusUpdate') }}",
                    type: 'get',
                    data: {
                        'id': id,
                        'status': status,
                    },
                    success: function (res) {
                        if (res) {
                            swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                            jQuery('#company_branch_list').replaceWith(res.data);
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
                            url: `{{ route('company.branch.delete') }}` + "/" + id,
                            type: "get",
                            success: function (res) {
                                Swal.fire("Done!", "It was succesfully deleted!", "success");
                                $('#company_branch_list').replaceWith(response.data);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                Swal.fire("Error deleting!", "Please try again", "error");
                            }
                        });
                    }
                });
            }
            /**-------------End----------*/
        </script>
@endsection
