@extends('layouts.admin.main')
@section('title', 'Company Type')
@section('content')
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
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="flex-grow-1 text-end">
                                <button class="btn btn-primary mx-auto mt-3" type="button" data-bs-toggle="modal"
                                    data-bs-target="#add_company_type">Add Company Type</button>
                            </div>
                        </div>
                    </div>
                    @include('admin.company_type.list')
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<div class="modal fade" id="edit_company_type" tabindex="-1" aria-labelledby="edit_company_type" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content dark-sign-up overflow-hidden">
            <div class="modal-body social-profile text-start">
                <div class="modal-toggle-wrapper">
                    <h4 class="text-dark">Edit Company Type</h4>
                    <p>
                        Fill in your information below to continue.</p>
                    <form class="row g-3" id="company_type_update_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-12">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" placeholder="Enter Your country Name" name="name"
                                id="name">
                            @error('name')
                            <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_company_type" tabindex="-1" aria-labelledby="add_company_type" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content dark-sign-up overflow-hidden">
            <div class="modal-body social-profile text-start">
                <div class="modal-toggle-wrapper">
                    <h4 class="text-dark">Add Company Type</h4>
                    <p>
                        Fill in your information below to continue.</p>
                    <form class="row g-3" id="company_type_add_form">
                        @csrf
                        <div class="col-md-12">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" name="name"
                                placeholder="Enter Your Company Type Name" id="name">
                            @error('name')
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
    $(document).on("input", "#search", function(e) {
        var key = $(this).val();
        searchCompanyType(key,status=null)
        });
        $('#filterByStatus').change(function(){
            var status= $(this).val();
            searchCompanyType(key=null,status)
        });
        function searchCompanyType(key=null,status=null)
        {
            $.ajax({
                    url: "{{ route('admin.company_type.search') }}",
                    type: 'get',
                    data: {
                        'search': key,
                        'status':status,
                    },
                    success: function(res) {
                        if (res) {
                            jQuery('#company_type_list').replaceWith(res.data);
                        }
                    }
                })
        }
        function edit_company_type_details(id, name) {
            $('#id').val(id);
            $('#name').val(name);
            jQuery('#edit_company_type').modal('show');
        }

        jQuery.noConflict();
        jQuery(document).ready(function($) {
            jQuery("#company_type_add_form").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Please enter name",
                },
                submitHandler: function(form) {
                    var companyTypeData = $(form).serialize();
                    $.ajax({
                        url: "{{ route('admin.company_type.store') }}",
                        type: 'POST',
                        data: companyTypeData,
                        success: function(response) {
                            jQuery('#add_company_type').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#company_type_list').replaceWith(response.data);
                            jQuery("#company_type_add_form")[0].reset();

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
                        url: "<?= route('admin.company_type.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#company_type_list').replaceWith(res.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }

        jQuery("#company_type_update_form").validate({
            rules: {
                name: "required"
            },
            messages: {
                name: "Please enter name",
            },
            submitHandler: function(form) {
                var companyTypeData = $(form).serialize();
                $.ajax({
                    url: "<?= route('admin.company_type.update') ?>",
                    type: 'post',
                    data: companyTypeData,
                    success: function(response) {
                        jQuery('#edit_company_type').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        jQuery('#company_type_list').replaceWith(response.data);
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
            $.ajax({
                url: "{{ route('admin.company_type.statusUpdate') }}",
                type: 'get',
                data: {
                    'id': id,
                    'status': status,
                },
                success: function(res) {
                    if (res) {
                        swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                        jQuery('#company_type_list').replaceWith(res.data);
                    } else {
                        swal.fire("Oops!", 'Something Went Wrong', "error");
                    }
                }
            })
        }

</script>
@endsection
