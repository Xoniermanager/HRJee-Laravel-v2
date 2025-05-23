@extends('layouts.admin.main')

@section('title', 'States')

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
                                <select class="form-select h-50px" id="filter_country">
                                    <option value="">Select County</option>
                                    @forelse ($allcountryDetails as $countryDetail)
                                    <option value="{{$countryDetail->id }}" {{request()->get('country_id') ==
                                        $countryDetail->id ? 'selected' : '' }}>{{ $countryDetail->name }}</option>
                                    @empty
                                    <option value="">No Country Available</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="ml-10px" style="margin-left: 10px;">
                                <select class="form-select h-50px" name="filterByStatus" id="filterByStatus">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                            </div>
                            <div class="flex-grow-1 text-end">
                                <button class="btn btn-primary mx-auto mt-3" type="button" data-bs-toggle="modal"
                                    data-bs-target="#add_state">Add</button>
                            </div>
                        </div>
                    </div>
                    @include('admin.state.state_list')
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<div class="modal fade" id="edit_state" tabindex="-1" aria-labelledby="edit_state" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content dark-sign-up overflow-hidden">
            <div class="modal-body social-profile text-start">
                <div class="modal-toggle-wrapper">
                    <h4 class="text-dark">Edit state</h4>
                    <p>
                        Fill in your information below to continue.</p>
                    <form class="row g-3" id="state_update_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-12">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" placeholder="Enter Your state Name" name="name"
                                id="name">
                            @error('name')
                            <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>
                        <div class="mt-3 mb-3">
                            <label>Country*</label>
                            <select class="form-control mb-3" name="country_id" id="country_id">
                                <option value="">Select Country</option>
                                @forelse ($allcountryDetails as $countryDetails)
                                <option value="{{ $countryDetails->id }}">{{ $countryDetails->name }}</option>
                                @empty
                                <option value="">No Country Available</option>
                                @endforelse
                            </select>
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
<div class="modal fade" id="add_state" tabindex="-1" aria-labelledby="add_state" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content dark-sign-up overflow-hidden">
            <div class="modal-body social-profile text-start">
                <div class="modal-toggle-wrapper">
                    <h4 class="text-dark">Add state</h4>
                    <p>
                        Fill in your information below to continue.</p>
                    <form class="row g-3" id="state_form">
                        @csrf
                        <div class="col-md-12">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter Your state Name"
                                id="name">
                            @error('name')
                            <span class="text-denger">{{ $message}} </span>
                            @enderror
                        </div>
                        <div class="mt-3 mb-3">
                            <label>Country*</label>
                            <select class="form-control mb-3" name="country_id" id="">
                                <option value="">Select Country</option>
                                @forelse ($allcountryDetails as $countryDetails)
                                <option value="{{ $countryDetails->id }}">{{ $countryDetails->name }}</option>
                                @empty
                                <option value="">No Country Available</option>
                                @endforelse
                            </select>
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
        search_states(key,status=null)
        });
        $('#filterByStatus').change(function(){
            var status= $(this).val();
            search_states(key=null,status)
        });
        jQuery("#filter_country").on('change', function() {
            search_states();
    });
        function search_states()
        {
            $.ajax({
                    url: "{{ route('admin.state.search') }}",
                    type: 'get',
                    data: {
                        'status': $('#filterByStatus').val(),
                'search': $('#search').val(),
                'country_id': $('#filter_country').val(),
                    },
                    success: function(res) {
                        if (res) {
                            jQuery('#state_list').replaceWith(res.data);
                        }
                    }
                })
        }


        function edit_state_details(id,name,countryId) {
            $('#id').val(id);
            $('#name').val(name);
            $('#country_id').val(countryId);
            jQuery('#edit_state').modal('show');
        }

        jQuery.noConflict();
        jQuery(document).ready(function($) {
            jQuery("#state_form").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Please enter name",
                },
                submitHandler: function(form) {
                    var state_data = $(form).serialize();
                    $.ajax({
                        url: "{{ route('admin.state.store') }}",
                        type: 'POST',
                        data: state_data,
                        success: function(response) {
                            jQuery('#add_state').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#state_list').replaceWith(response.data);
                            jQuery("#state_form")[0].reset();

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
                        url: "<?= route('admin.state.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#state_list').replaceWith(res.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }

        jQuery("#state_update_form").validate({
            rules: {
                name: "required"
            },
            messages: {
                name: "Please enter name",

            },
            submitHandler: function(form) {
                var state_data = $(form).serialize();
                $.ajax({
                    url: "<?= route('admin.state.update') ?>",
                    type: 'post',
                    data: state_data,
                    success: function(response) {
                        jQuery('#edit_state').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        jQuery('#state_list').replaceWith(response.data);
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
            console.log(checked_value);
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
                url: "{{ route('admin.state.statusUpdate') }}",
                type: 'get',
                data: {
                    'id': id,
                    'status': status,
                },
                success: function(res) {
                    if (res) {
                        swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                        jQuery('#state_list').replaceWith(res.data);
                    } else {
                        swal.fire("Oops!", 'Something Went Wrong', "error");
                    }
                }
            })
        }

</script>
@endsection
