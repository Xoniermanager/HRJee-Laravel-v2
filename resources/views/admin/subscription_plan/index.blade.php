@extends('layouts.admin.main')
@section('title', 'Subscription Plan')
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
                                        data-bs-target="#add_subscription_plan">Add Subscription Plan</button>
                                </div>
                            </div>
                        </div>
                        @include('admin.subscription_plan.list')
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
    <div class="modal fade" id="edit_subscription_plan" tabindex="-1" aria-labelledby="edit_subscription_plan"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content dark-sign-up overflow-hidden">
                <div class="modal-body social-profile text-start">
                    <div class="modal-toggle-wrapper">
                        <h4 class="text-dark">Edit Subscription Plan</h4>
                        <p>
                            Fill in your information below to continue.</p>
                        <form class="row g-3" id="subscription_plan_update_form">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="col-md-12">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" placeholder="Enter title" name="title"
                                    id="title">
                                @error('title')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Days</label>
                                <input class="form-control" type="text" placeholder="Enter days" name="days"
                                    id="days">
                                @error('days')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Amount (Per User)</label>
                                <input class="form-control" type="number" name="per_person_amount"
                                    placeholder="Enter the amount per user" id="per_person_amount">
                                @error('per_person_amount')
                                    <span class="text-denger">{{ $message }} </span>
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
    <div class="modal fade" id="add_subscription_plan" tabindex="-1" aria-labelledby="add_subscription_plan"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content dark-sign-up overflow-hidden">
                <div class="modal-body social-profile text-start">
                    <div class="modal-toggle-wrapper">
                        <h4 class="text-dark">Add Subscription Plan</h4>
                        <p>
                            Fill in your information below to continue.</p>
                        <form class="row g-3" id="subscription_plan_add_form">
                            @csrf
                            <div class="col-md-12">
                                <label class="form-label">Title</label>
                                <input class="form-control" type="text" name="title"
                                    placeholder="Enter Your Plan Name" id="title">
                                @error('title')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Days</label>
                                <input class="form-control" type="number" name="days"
                                    placeholder="Enter the days till plan would be active" id="days">
                                @error('days')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Amount (Per User)</label>
                                <input class="form-control" type="number" name="per_person_amount"
                                    placeholder="Enter the amount per user">
                                @error('per_person_amount')
                                    <span class="text-denger">{{ $message }} </span>
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
            searchCompanyType(key, status = null)
        });

        $('#filterByStatus').change(function() {
            var status = $(this).val();
            searchCompanyType(key = null, status)
        });

        function searchCompanyType(key = null, status = null) {
            $.ajax({
                url: "{{ route('admin.subscription_plan.search') }}",
                type: 'get',
                data: {
                    'search': key,
                    'status': status,
                },
                success: function(res) {
                    if (res) {
                        jQuery('#subscription_plan_list').replaceWith(res.data);
                    }
                }
            })
        }

        function edit_subscription_plan_details(id, title, days, per_person_amount) {
            $('#id').val(id);
            $('#title').val(title);
            $('#days').val(days);
            $('#per_person_amount').val(per_person_amount);
            jQuery('#edit_subscription_plan').modal('show');
        }

        jQuery.noConflict();
        jQuery(document).ready(function($) {
            jQuery("#subscription_plan_add_form").validate({
                rules: {
                    title: "required",
                },
                messages: {
                    title: "Please enter title",
                },
                submitHandler: function(form) {
                    var companyTypeData = $(form).serialize();
                    $.ajax({
                        url: "{{ route('admin.subscription_plan.store') }}",
                        type: 'POST',
                        data: companyTypeData,
                        success: function(response) {
                            jQuery('#add_subscription_plan').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#subscription_plan_list').replaceWith(response.data);
                            jQuery("#subscription_plan_add_form")[0].reset();

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
                        url: "<?= route('admin.subscription_plan.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#subscription_plan_list').replaceWith(res.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }

        jQuery("#subscription_plan_update_form").validate({
            rules: {
                title: "required"
            },
            messages: {
                title: "Please enter title",
            },
            submitHandler: function(form) {
                var companyTypeData = $(form).serialize();
                $.ajax({
                    url: "<?= route('admin.subscription_plan.update') ?>",
                    type: 'post',
                    data: companyTypeData,
                    success: function(response) {
                        jQuery('#edit_subscription_plan').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        jQuery('#subscription_plan_list').replaceWith(response.data);
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
                url: "{{ route('admin.subscription_plan.statusUpdate') }}",
                type: 'get',
                data: {
                    'id': id,
                    'status': status,
                },
                success: function(res) {
                    if (res) {
                        swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                        jQuery('#subscription_plan_list').replaceWith(res.data);
                    } else {
                        swal.fire("Oops!", 'Something Went Wrong', "error");
                    }
                }
            })
        }
    </script>
@endsection
