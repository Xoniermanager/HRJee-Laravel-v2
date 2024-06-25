<div class="tab-pane fade" id="asset_tab">
    <div class="row">
        <div class="col-md-12 mb-1" data-bs-toggle="modal" data-bs-target="#allocated_popup">
            <a href="#" class="btn btn-primary align-self-center btn-sm">Allocated Asset</a>
        </div>
    </div>

    <!--begin::Wrapper-->
    @include('company.employee.asset_management.list')
    <button onclick="show_next_tab('family_details_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    <button onclick="show_next_tab('document_tab')" class="btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i>
    </button>
</div>
<!-- Start: POP HTML For Assign Asset to User -->
<div class="modal fade" id="allocated_popup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog mw-400px modal-dialog-centered">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-bottom">
                <!--begin::Close-->
                <h3 class="fw-bold m-0">Allocated Asset</h3>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
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
            <div class="modal-body scroll-y p-5">
                <form id="allocated_from">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Request::segment(3) ?? '' }}">
                    <div class="col-md-12">
                        <label>Asset Type *</label>
                        <select name="asset_category_id" class="form-control" onchange="get_all_asset_by_category_id()"
                            id="asset_category_id">
                            <option value="">Select the Asset Category</option>
                            @foreach ($allAssetCategory as $singleAssetCategory)
                                <option value="{{ $singleAssetCategory->id }}">{{ $singleAssetCategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label>Asset *</label>
                        <select name="asset_id" class="form-control" id="all_asset">
                        </select>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label>Assigned Date *</label>
                        <input type="date" name="assigned_date" id="" class="form-control">
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-primary btn-sm" type="submit">Allocated</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End : POP HTML For Assign Asset to User -->

<!-- Start: POP HTML For un assign Asset to User -->
<div class="modal fade" id="deallocated_popup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog mw-400px modal-dialog-centered">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-bottom">
                <!--begin::Close-->
                <h3 class="fw-bold m-0">Deallocate Asset</h3>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
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
            <div class="modal-body scroll-y p-5">
                <form id="deallocated_from">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Request::segment(3) ?? '' }}">
                    <input type="hidden" name="id" id="user_asset_id">
                    <div class="col-md-12">
                        <label>Asset Type *</label>
                        <select class="form-control" onchange="get_all_asset_by_category_id()"
                            id="edit_asset_category_id" disabled>
                            <option value="">Select the Asset Category</option>
                            @foreach ($allAssetCategory as $singleAssetCategory)
                                <option value="{{ $singleAssetCategory->id }}">{{ $singleAssetCategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label>Asset *</label>
                        <input type="text" class="form-control" id="edit_asset" disabled>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label>Assigned Date *</label>
                        <input type="date" class="form-control" id="edit_assigned_date" disabled>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label>Returned Date *</label>
                        <input type="date" name="returned_date" class="form-control" id="edit_returned_date">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label>Comment</label>
                        <input type="text" name="comment" class="form-control">
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-primary btn-sm" type="submit">DeAllocate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End: POP HTML For un assign Asset to User -->
<script>
    /** Get All Asset By Category ID*/
    function get_all_asset_by_category_id() {
        let asset_category_id = $('#asset_category_id').val();
        if (asset_category_id) {
            $.ajax({
                url: company_ajax_base_url + '/asset/get/all/asset/' + asset_category_id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var select = $('#all_asset');
                    select.html('');
                    if (response.status == true) {
                        $('#all_asset').append(
                            '<option value="">Select the Asset</option>');
                        $.each(response.data, function(key, value) {
                            select.append('<option value=' + value.id + ' >' + value.name +
                                '</option>');
                        });
                    } else {
                        select.append('<option value="">' + response.error +
                            '</option>');
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Somethiong went Wrong!! Please try again"
                    });
                    return false;
                }
            });
        } else {
            $('#all_asset').empty();
        }
    }
    /** Advance Details Validation */
    jQuery(document).ready(function() {

        /** Allocate asset*/
        jQuery("#allocated_from").validate({
            rules: {
                asset_category_id: "required",
                asset_id: "required",
                assigned_date: "required",
            },
            messages: {
                asset_category_id: "Please Select the Asset Category",
                asset_id: "Please Select the Asset",
                assigned_date: "Please Select the Assigned Date",
            },
            submitHandler: function(form) {
                var asset_detail_data = $(form).serialize();
                $.ajax({
                    url: "{{ route('employee.asset.details') }}",
                    type: 'POST',
                    data: asset_detail_data,
                    success: function(response) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        jQuery('#user_asset_list').replaceWith(response.data);
                        jQuery('#allocated_popup').modal('hide');
                        jQuery('.nav-pills a[href="#document_tab"]').tab('show');
                    },
                    error: function(error_messages) {
                        jQuery('#allocated_popup').modal('show');
                        jQuery('.nav-pills a[href="#asset_tab"]').tab('show');
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

        /** DeAllocate asset*/
        jQuery("#deallocated_from").validate({
            rules: {
                returned_date: "required",
            },
            messages: {
                returned_date: "Please Select the Returned Date",
            },
            submitHandler: function(form) {
                var update_asset_detail_data = $(form).serialize();
                $.ajax({
                    url: "{{ route('employee.asset.details.update') }}",
                    type: 'POST',
                    data: update_asset_detail_data,
                    success: function(response) {
                        jQuery('#deallocated_popup').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        jQuery('#user_asset_list').replaceWith(response.data);
                        // jQuery('#allocated_popup').modal('hide');
                        // jQuery('.nav-pills a[href="#document_tab"]').tab('show');
                        // This variable is used on save all records button
                    },
                    error: function(error_messages) {
                        jQuery('#deallocated_popup').modal('show');
                        jQuery('.nav-pills a[href="#asset_tab"]').tab('show');
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

    function get_details_for_deallocate_asset(asset_name, asset_category_id, assigned_date, id) {
        $('#user_asset_id').val(id);
        $('#edit_asset_category_id').val(asset_category_id);
        $('#edit_asset').val(asset_name);
        $('#edit_assigned_date').val(assigned_date);
        $("#edit_returned_date").attr('min', assigned_date);
        $('#deallocated_popup').modal('show');
    }
</script>
