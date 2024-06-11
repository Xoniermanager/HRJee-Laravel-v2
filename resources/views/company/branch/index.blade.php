@extends('layouts.company.main')
@section('content')
@section('title')
    Country
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
                                placeholder="Search " type="text" id="search" name="search"
                                value="">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                        </div>

                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_company_branch"
                        class="btn btn-sm btn-primary align-self-center">
                        Add Branch</a>

                    <!--end::Action-->
                </div>

                <div class="mb-5 mb-xl-10">
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
                    <form class="row g-3" id="edit_company_branch_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-6">
                            <label class="form-label" >Branch Name</label>
                            <input class="form-control" type="text" placeholder="Enter Your Branch Name" name="name" id="name">
                        </div>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-md-6"> 
                            <label class="form-label" >Select Branch</label>
                            <select class="form-select" name="branch_type" id="branch_type">
                                <option value="">Select Branch</option>
                                <option value="primary">primary</option>
                                <option value="secondary">secondary</option>
                            </select> 
                            @error('branch_type')
                            <span  class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" >Contact No</label>
                            <input class="form-control" type="number" placeholder="Enter Your Contact No" name="contact_no" id="contact_no">
                                @error('contact_no')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>


                        <div class="col-md-6">
                            <label class="form-label" >Email</label>
                            <input class="form-control" type="text" placeholder="Enter Your Email" name="email" id="email">
                                @error('email')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>
        
                        <div class="col-md-6">
                            <label class="form-label" >Hr Email</label>
                            <input class="form-control" type="text" placeholder="Enter Your Hr Email" name="hr_email" id="hr_email">
                                @error('hr_email')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" >Address</label>
                            <input class="form-control" type="text" placeholder="Enter Your Address" name="address" id="address">
                                @error('address')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" >City</label>
                            <input class="form-control" type="text" placeholder="Enter Your City" name="city" id="city">
                                @error('city')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>


                        <div class="col-md-6">
                            <label class="form-label" >Pincode</label>
                            <input class="form-control" type="text" placeholder="Enter Your Pincode" name="pincode" id="pincode">
                                @error('pincode')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>
        

                        <div class="col-md-6">
                            <label class="form-label" >State</label>
                            <select class="form-select" name="state" id="state">
                            <option value="">Please Select state</option>
                            @forelse ($states as $state)
                                <option value="{{ $state->id }}"> {{ $state->name }}</option>
                            @empty
                                <option value="">No state Found</option>
                            @endforelse
                            </select>
                                @error('state')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>
        
                        
                        <div class="col-md-6">
                            <label class="form-label" >Country</label>
                            <select class="form-select" name="country_id" id="country_id">
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
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>
{{--         
                        <div class="col-md-12">
                            <label class="form-label" >Description</label>
                            <textarea class="form-control" id="text-area" row="2" name="description" placeholder="Enter Your description" id="description"></textarea>
                                @error('description')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div> --}}
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" >Save</button>
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
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" >
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
                    <form class="row g-3" id="company_branch_update_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-6">
                            <label class="form-label" >Branch Name</label>
                            <input class="form-control" type="text" placeholder="Enter Your Branch Name" name="name" id="name">
                                @error('name')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>
                        <div class="col-md-6"> 
                            <label class="form-label" >Select Branch</label>
                            <select class="form-select" name="branch_type" id="branch_type">
                                <option value="">Select Branch</option>
                                <option value="primary">primary</option>
                                <option value="secondary">secondary</option>
                            </select> 
                            @error('branch_type')
                            <span  class="text-denger">{{ $message}} </span>
                        @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" >Contact No</label>
                            <input class="form-control" type="number" placeholder="Enter Your Contact No" name="contact_no" id="contact_no">
                                @error('contact_no')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>


                        <div class="col-md-6">
                            <label class="form-label" >Email</label>
                            <input class="form-control" type="text" placeholder="Enter Your Email" name="email" id="email">
                                @error('email')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>
        
                        <div class="col-md-6">
                            <label class="form-label" >Hr Email</label>
                            <input class="form-control" type="text" placeholder="Enter Your Hr Email" name="hr_email" id="hr_email">
                                @error('hr_email')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" >Address</label>
                            <input class="form-control" type="text" placeholder="Enter Your Address" name="address" id="address">
                                @error('address')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" >City</label>
                            <input class="form-control" type="text" placeholder="Enter Your City" name="city" id="city">
                                @error('city')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>


                        <div class="col-md-6">
                            <label class="form-label" >Pincode</label>
                            <input class="form-control" type="text" placeholder="Enter Your Pincode" name="pincode" id="pincode">
                                @error('pincode')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" >State</label>
                            <select class="form-select" name="state" id="state">
                            <option value="">Please Select State</option>
                            @forelse ($states as $state)
                                <option value="{{ $state->id }}"> {{ $state->name }}</option>
                            @empty
                                <option value="">No state Found</option>
                            @endforelse
                        </select>
                                @error('state')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>
        
                        <div class="col-md-6">
                            <label class="form-label" >Country</label>
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
                                @error('country')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div>
        
                        {{-- <div class="col-md-12">
                            <label class="form-label" >Description</label>
                            <textarea class="form-control" id="text-area" row="2" name="description" placeholder="Enter Your description" id="description"></textarea>
                                @error('description')
                                    <span  class="text-denger">{{ $message}} </span>
                                @enderror
                        </div> --}}
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" >Save</button>
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
       
    $(document).on("input", "#search", function(e) {
        var key = $(this).val();
        search_company_branchs(key,status= null)
        });

        $('#filterByStatus').change(function(){
            var status= $(this).val();
            search_company_branchs(key=null,status)
        });

        function search_company_branchs(key,status)
        {
            $.ajax({
                    url: "{{ route('company.branch.search') }}",
                    type: 'get',
                    data: {
                        'key': key,
                        'status': status,
                    },
                    success: function(res) {
                        if (res) {
                            jQuery('#company_branch_list').replaceWith(res.data);
                        } 
                    }
                })
        }

        function edit_company_branch_details(companyBranchDetails) {

            companyBranchDetails= JSON.parse(companyBranchDetails);
            $('#id').val(companyBranchDetails.id);
            $('#name').val(companyBranchDetails.name);
            $('#address').val(companyBranchDetails.address);
            $('#branch_type').val(companyBranchDetails.branch_type);
            $('#contact_no').val(companyBranchDetails.contact_no);
            $('#email').val(companyBranchDetails.email);
            $('#hr_email').val(companyBranchDetails.hr_email);
            $('#address').val(companyBranchDetails.address);
            $('#city').val(companyBranchDetails.city);
            $('#pincode').val(companyBranchDetails.pincode);
            $('#state').val(companyBranchDetails.state);
            $('#country_id').val(companyBranchDetails.country_id);
            $('#description').val(companyBranchDetails.description);
            jQuery('#edit_company_branch').modal('show');
        }

        jQuery.noConflict();
        jQuery(document).ready(function($) {
            jQuery("#edit_company_branch_form").validate({
                rules: {
                    name: "required",
                    branch_type:"required",
                    contact_no: "required",
                    email:"required",
                    hr_email: "required",
                    address: "required",
                    city:"required",
                    pincode:"required",
                    state:"required",
                    country_id: "required",
                },
                messages: {
                    name: "Please enter branch branch name",
                    branch_type: "Please enter branch branch type",
                    contact_no: "Please enter contract number",
                    email: "Please enter branch email ",
                    hr_email: "Please enter branch hr email ",
                    address: "Please enter branch address",
                    city: "Please enter branch city",
                    pincode: "Please enter branch pincode",
                    state: "Please enter branch state",
                    country_id: "Please enter branch country",
                },
                submitHandler: function(form) {
                    var company_branch_data = $(form).serialize();
                    $.ajax({
                        url: "{{ route('company.branch.update') }}",
                        type: 'POST',
                        data: company_branch_data,
                        success: function(response) {
                            jQuery('#edit_company_branch').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#company_branch_list').replaceWith(response.data);


                        },
                        error: function(error_messages) {
                            let errors = error_messages.responseJSON.errors;
                            for (var error_key in errors) {
                                $(document).find('[name=' + error_key + ']').after(
                                    '<span class="' + error_key + '_error text text-danger">' + errors[error_key] + '</span>'
                                );
                            }
                            setTimeout(function() {
                                for (var error_key in errors) {
                                    $("." + error_key + "_error").remove();
                                }
                            }, 2000);

                        }
                    });
                }
            });
        });



        jQuery("#company_branch_update_form").validate({
            rules: {
                    name: "required",
                    branch_type:"required",
                    contact_no: "required",
                    email:"required",
                    hr_email: "required",
                    address: "required",
                    city:"required",
                    pincode:"required",
                    state:"required",
                    country_id: "required",
                },
                messages: {
                    name: "Please enter branch branch name",
                    branch_type: "Please enter branch branch type",
                    contact_no: "Please enter contract number",
                    email: "Please enter branch email ",
                    hr_email: "Please enter branch hr email ",
                    address: "Please enter branch address",
                    city: "Please enter branch city",
                    pincode: "Please enter branch pincode",
                    state: "Please enter branch state",
                    country_id: "Please enter branch country",
                },
            submitHandler: function(form) {
                var company_branch_data = $(form).serialize();
                $.ajax({
                    url: "<?= route('company.branch.store') ?>",
                    type: 'post',
                    data: company_branch_data,
                    success: function(response) {
                        jQuery('#add_company_branch').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        jQuery('#company_branch_list').replaceWith(response.data);
                        jQuery("#add_company_branch")[0].reset();
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
                        url: "<?= route('company.branch.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#company_branch_list').replaceWith(res.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }
        function handleStatus(id) {
            var checked_value = $('#checked_value_'+id).prop('checked');
            let status;

            let status_name;
            if (checked_value == true) {
                status = 1;
                status_name = 'Active';
            } else {
                status = 0;
                status_name = 'Inactive';
            }
            console.log(status);
            $.ajax({
                url: "{{ route('company.branch.statusUpdate') }}",
                type: 'get',
                data: {
                    'id': id,
                    'status': status,
                },
                success: function(res) {
                    if (res) {
                        swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                        jQuery('#company_branch_list').replaceWith(res.data);
                    } else {
                        swal.fire("Oops!", 'Something Went Wrong', "error");
                    }
                }
            })
        }

    </script>
@endsection
