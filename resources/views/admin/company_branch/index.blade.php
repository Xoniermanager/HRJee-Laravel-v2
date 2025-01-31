@extends('layouts.admin.main')

@section('title', 'Company Branch')

@section('content')

<style>
    .searchable-select-holder {
        border: 1px dashed #ccc !important;
        min-height: 38px !important;
    }

    .searchable-select {
        min-width: 100% !important;
    }
</style>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header file-content border-0 pb-0">
                        <div class="d-md-flex d-sm-block">
                            <form class="form-inline" action="#" method="get">
                                <div class="form-group d-flex align-items-center mb-0"> <i class="fa fa-search"></i>
                                    <input class="form-control-plaintext" type="text" placeholder="Search..."
                                        id="search">
                                </div>
                            </form>
                            <div class="ml-10px" style="margin-left: 10px;">
                                <select class="form-select h-50px" name="filterByStatus" id="filterByStatus">
                                    <option value="">Select Status</option>
                                    <option value="0">Non Active</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                            <div class="flex-grow-1 text-end">
                                <button class="btn btn-primary mx-auto mt-3" type="button" data-bs-toggle="modal"
                                    data-bs-target="#add_company_branch">Add</button>
                            </div>
                        </div>
                    </div>
                    @include('admin.company_branch.company_branch_list')
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<div class="modal fade" id="edit_company_branch" tabindex="-1" aria-labelledby="edit_company_branch" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content dark-sign-up overflow-hidden">
            <div class="modal-body social-profile text-start">
                <div class="modal-toggle-wrapper">
                    <h4 class="text-dark">Edit Company Branch</h4>
                    <p>
                        Fill in your information below to continue.</p>
                    <form class="row g-3" id="company_branch_update_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-6">
                            <label class="form-label">Branch Name</label>
                            <input class="form-control" type="text" placeholder="Enter Your Branch Name" name="name"
                                id="name">
                            @error('name')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Select Branch</label>
                            <select class="form-select" name="branch_type" id="branch_type">
                                <option value="">Select Branch</option>
                                <option value="primary">primary</option>
                                <option value="secondary">secondary</option>
                            </select>
                            @error('branch_type')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Contact No</label>
                            <input class="form-control" type="number" placeholder="Enter Your Contact No"
                                name="contact_no" id="contact_no">
                            @error('contact_no')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="text" placeholder="Enter Your Email" name="email"
                                id="email">
                            @error('email')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Hr Email</label>
                            <input class="form-control" type="text" placeholder="Enter Your Hr Email" name="hr_email"
                                id="hr_email">
                            @error('hr_email')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <input class="form-control" type="text" placeholder="Enter Your Address" name="address"
                                id="address">
                            @error('address')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input class="form-control" type="text" placeholder="Enter Your City" name="city" id="city">
                            @error('city')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label class="form-label">Pincode</label>
                            <input class="form-control" type="text" placeholder="Enter Your Pincode" name="pincode"
                                id="pincode">
                            @error('pincode')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">State</label>
                            <select class="form-select" name="state" id="state">
                                <option value="">Please Select State</option>
                                @forelse ($states as $state)
                                    <option value="{{ $state->id }}"> {{ $state->name }}</option>
                                @empty
                                    <option value="">No state Found</option>
                                @endforelse
                            </select>
                            @error('state')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Country</label>
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
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="text-area" row="2" name="description"
                                placeholder="Enter Your description" id="description"></textarea>
                            @error('description')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_company_branch" tabindex="-1" aria-labelledby="add_company_branch" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content dark-sign-up overflow-hidden">
            <div class="modal-body social-profile text-start">
                <div class="modal-toggle-wrapper">
                    <h4 class="text-dark">Add Company Branch</h4>
                    <p>
                        Fill in your information below to continue.</p>
                    <form class="row g-3" id="company_branch_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-6">
                            <label class="form-label">Company Name</label>
                            <select class="form-control" name="company_id" id="company_id">
                                <option value="">Select Company</option>
                                @foreach ($allCompaniesDetails as $cmp)
                                    <option value="{{ $cmp->id }}">{{ $cmp->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('company_id'))
                                <div class="text-danger">{{ $errors->first('company_id') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Branch Name</label>
                            <input class="form-control" type="text" placeholder="Enter Your Branch Name" name="name"
                                id="name">
                        </div>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-md-6">
                            <label class="form-label">Select Branch</label>
                            <select class="form-select" name="type">
                                <option value="">Select Branch</option>
                                <option value="primary">primary</option>
                                <option value="secondary">secondary</option>
                            </select>
                            @error('type')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Contact No</label>
                            <input class="form-control" type="number" placeholder="Enter Your Contact No"
                                name="contact_no" id="contact_no">
                            @error('contact_no')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="text" placeholder="Enter Your Email" name="email"
                                id="email">
                            @error('email')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Hr Email</label>
                            <input class="form-control" type="text" placeholder="Enter Your Hr Email" name="hr_email"
                                id="hr_email">
                            @error('hr_email')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <input class="form-control" type="text" placeholder="Enter Your Address" name="address"
                                id="address">
                            @error('address')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input class="form-control" type="text" placeholder="Enter Your City" name="city" id="city">
                            @error('city')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label class="form-label">Pincode</label>
                            <input class="form-control" type="text" placeholder="Enter Your Pincode" name="pincode"
                                id="pincode">
                            @error('pincode')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Country</label>
                            <select class="form-select" name="country_id" id="new_country_id">
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
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">State</label>
                            <select class="form-select" name="state_id" id="new_state">

                            </select>
                            @error('state')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>


                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="text-area" row="2" name="description"
                                placeholder="Enter Your description" id="description"></textarea>
                            @error('description')
                                <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).on("input", "#search", function (e) {
        var key = $(this).val();
        search_company_branchs(key, status = null)
    });

    $('#filterByStatus').change(function () {
        var status = $(this).val();
        search_company_branchs(key = null, status)
    });



    function search_company_branchs(key, status) {
        $.ajax({
            url: "{{ route('admin.company.branch.search') }}",
            type: 'get',
            data: {
                'search': key,
                'status': status,
            },
            success: function (res) {
                if (res) {
                    jQuery('#company_branch_list').replaceWith(res.data);
                }
            }
        })
    }

    function edit_company_branch_details(companyBranchDetails) {

        companyBranchDetails = JSON.parse(companyBranchDetails);
        $('#id').val(companyBranchDetails.id);
        $('#name').val(companyBranchDetails.name);
        $('#address').val(companyBranchDetails.address);
        $('#branch_type').val(companyBranchDetails.type);
        $('#contact_no').val(companyBranchDetails.contact_no);
        $('#email').val(companyBranchDetails.email);
        $('#hr_email').val(companyBranchDetails.hr_email);
        $('#address').val(companyBranchDetails.address);
        $('#city').val(companyBranchDetails.city);
        $('#pincode').val(companyBranchDetails.pincode);
        $('#state').val(companyBranchDetails.state_id);
        $('#country_id').val(companyBranchDetails.country_id);
        $('#text-area').text(companyBranchDetails.description);
        jQuery('#edit_company_branch').modal('show');
    }

    jQuery.noConflict();
    jQuery(document).ready(function ($) {
       
        jQuery('#company_id').searchableSelect({});

        $('#new_country_id').on('change', function () {
            var country_id = $(this).val();
            var div_id = 'new_state';
            get_all_state_using_country_id(country_id, div_id);
        });

        jQuery("#company_branch_form").validate({
            rules: {
                company_id: "required",
                name: "required",
                branch_type: "required",
                contact_no: "required",
                email: "required",
                hr_email: "required",
                address: "required",
                city: "required",
                pincode: "required",
                country_id: "required",
                state: "required",
            },
            messages: {
                company_id: "Please enter company name",
                name: "Please enter branch  name",
                branch_type: "Please enter branch  type",
                contact_no: "Please enter contract number",
                email: "Please enter branch email ",
                hr_email: "Please enter branch hr email ",
                address: "Please enter branch address",
                city: "Please enter branch city",
                pincode: "Please enter branch pincode",
                state: "Please enter branch state",
                country_id: "Please enter branch country",
            },
            submitHandler: function (form) {
                var company_branch_data = $(form).serialize();
                $.ajax({
                    url: "{{ route('admin.company.branch.store') }}",
                    type: 'POST',
                    data: company_branch_data,
                    success: function (response) {
                        jQuery('#add_company_branch').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        $('#company_branch_list').replaceWith(response.data);
                        jQuery("#company_branch_form")[0].reset();

                    },
                    error: function (error_messages) {
                        let errors = error_messages.responseJSON.errors;
                        for (var error_key in errors) {
                            $(document).find('[name=' + error_key + ']').after(
                                '<span class="' + error_key + '_error text text-danger">' + errors[error_key] + '</span>'
                            );
                        }
                        setTimeout(function () {
                            for (var error_key in errors) {
                                $("." + error_key + "_error").remove();
                            }
                        }, 2000);

                    }
                });
            }
        });
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
                    url: "<?= route('admin.company.branch.delete') ?>",
                    type: "get",
                    data: {
                        id: id
                    },
                    success: function (res) {
                        Swal.fire("Done!", "It was succesfully deleted!", "success");
                        $('#company_branch_list').replaceWith(res.data);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        Swal.fire("Error deleting!", "Please try again", "error");
                    }
                });
            }
        });
    }

    jQuery("#company_branch_update_form").validate({
        rules: {
            name: "required"
        },
        messages: {
            name: "Please enter name",

        },
        submitHandler: function (form) {
            var company_branch_data = $(form).serialize();
            $.ajax({
                url: "<?= route('admin.company.branch.update') ?>",
                type: 'post',
                data: company_branch_data,
                success: function (response) {
                    jQuery('#edit_company_branch').modal('hide');
                    swal.fire("Done!", response.message, "success");
                    jQuery('#company_branch_list').replaceWith(response.data);
                },
                error: function (error_messages) {
                    let errors = error_messages.responseJSON.error;
                    for (var error_key in errors) {
                        $(document).find('[name=' + error_key + ']').after(
                            '<span id="' + error_key +
                            '_error" class="text text-danger">' + errors[
                            error_key] + '</span>');
                        setTimeout(function () {
                            jQuery("#" + error_key + "_error").remove();
                        }, 5000);
                    }
                }
            });
        }
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
        console.log(status);
        $.ajax({
            url: "{{ route('admin.company.branch.statusUpdate') }}",
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

</script>
@endsection