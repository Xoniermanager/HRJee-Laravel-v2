@extends('layouts.company.main')
@section('content')
@section('title')
Asset
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card custom-table p-0">
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <div class="d-flex align-items-center position-relative my-1">
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
                            <input class="form-control form-control-solid ps-14 min-w-150px me-2" placeholder="Search "
                                type="text" name="search" value="{{ request()->get('search') }}" id="search">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                        </div>
                        <select class="form-control min-w-100px me-2" id="status">
                            <option value="">Allocation Status</option>
                            <option {{ old('status')=='available' || request()->get('status') == 'available' ?
                                'selected' : '' }}
                                value="available">Available</option>
                            <option {{ old('status')=='allocated' || request()->get('status') == 'allocated' ?
                                'selected' : '' }}
                                value="allocated">Allocated</option>
                        </select>
                        <select class="form-control min-w-100px me-2" id="category_id">
                            <option value="">Category</option>
                            @foreach ($allAssetCategory as $assetCategory)
                            <option {{ old('category_id')==$assetCategory->id || request()->get('category_id') ==
                                $assetCategory->id
                                ? 'selected'
                                : '' }}
                                value="{{ $assetCategory->id }}">
                                {{ $assetCategory->name }}</option>
                            @endforeach
                        </select>
                        <select class="form-control min-w-100px me-2" id="manufacturer_id">
                            <option value="">Manufacturer</option>
                            @foreach ($allAssetManufacturer as $assetManufacturer)
                            <option {{ old('manufacturer_id')==$assetManufacturer->id ||
                                request()->get('manufacturer_id') == $assetManufacturer->id
                                ? 'selected'
                                : '' }}
                                value="{{ $assetManufacturer->id }}">
                                {{ $assetManufacturer->name }}</option>
                            @endforeach
                        </select>
                        <select class="form-control min-w-100px me-2" id="ownership">
                            <option value="">OwnerShip</option>
                            <option {{ old('ownership')=='rented' || request()->get('ownership') == 'rented' ?
                                'selected' : '' }}
                                value="rented">Rented</option>
                            <option {{ old('ownership')=='owned' || request()->get('ownership') == 'owned' ? 'selected'
                                : '' }}
                                value="owned">Owned</option>
                        </select>

                    </div>
                    <a href="#" class="btn btn-sm btn-dark ms-3 align-self-center" onclick="exportData()">Export</a>
                    <a href="{{ route('asset.add') }}" class="btn btn-sm btn-primary align-self-center"> Add Asset</a>
                </div>
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
                <div class="mb-5 mb-xl-10">
                    <div class="card-body py-3">
                        @include('company.asset.list')
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>

    <div class="modal" id="edit_user_details">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>User Details</h2>
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
                    <table class="table table-striped table-bordered">

                        <tbody>
                            <tr>
                                <th scope="row">User</th>
                                <td id="user">--</td>
                            </tr>
                            <tr>
                                <th>Assigned date</th>
                                <td id="assigned_date">--</td>
                            </tr>
                            <tr>
                                <th scope="row">Returned Date</th>
                                <td id="returned_date">--</td>
                            </tr>
                            <tr>
                                <th>Message</th>
                                <td id="message">--</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    {{-- <div class="modal fade" id="export_asset_details" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-900px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0">
                    <!--begin::Close-->
                    <h3 class="fw-bold m-0">Export</h3>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <i class="fa fa-close"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body scroll-y p-4">
                    <form id="asset_export_form">
                        @csrf
                        <div class="row w-100">
                            <h4>Asset Details</h4>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="serial_no"
                                        checked>
                                    <label for="model">Serial no</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="name" checked>
                                    <label for="gender">Asset</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="model" checked>
                                    <label for="model">Model</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="asset_category"
                                        checked>
                                    <label for="model">Asset Category</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox"
                                        name="asset_manu_facturer" checked>
                                    <label for="model">Asset Manufacturer</label>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="ownership"
                                        checked>
                                    <label for="model">Ownership</label>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="allocation_status"
                                        checked>
                                    <label for="model">Allocation status</label>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="invoice_no"
                                        checked>
                                    <label for="model">Invoice No</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="invoice_date"
                                        checked>
                                    <label for="model">Invoice Date</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" value="dnkfjgjkd"
                                        checked name="user_name" value="">
                                    <label for="gender">Employee Name</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="email" checked>
                                    <label for="gender">Employee Email</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="assigned_date"
                                        checked>
                                    <label for="model">Assigned Date</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="returned_date"
                                        checked>
                                    <label for="model">Returned Date</label>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="assets_status"
                                        checked>
                                    <label for="model">Asset Status</label>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="purchase_value"
                                        checked>
                                    <label for="model">Purchase Value</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox"
                                        name="depreciation_per_year" checked>
                                    <label for="model">Depreciation Per Year</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" name="validation_upto"
                                        checked>
                                    <label for="model">Validation upto</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <button class="btn btn-sm btn-danger ms-3 align-self-center" type="button"
                                    onclick="exportData('asset_export_form')">Export</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <script>
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
                        url: "<?= route('asset.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#asset_list').replaceWith(res.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }
        jQuery("#search").on('blur', function() {
            search_filter_results();
        });

        jQuery("#status").on('change', function() {
            search_filter_results();
        });
        jQuery("#category_id").on('change', function() {
            search_filter_results();
        });
        jQuery("#manufacturer_id").on('change', function() {
            search_filter_results();
        });
        jQuery("#ownership").on('change', function() {
            search_filter_results();
        });

        function search_filter_results() {
            $.ajax({
                type: 'GET',
                url: company_ajax_base_url + '/asset/search/filter',
                data: {
                    'status': $('#status').val(),
                    'search': $('#search').val(),
                    'category_id': $('#category_id').val(),
                    'manufacturer_id': $('#manufacturer_id').val(),
                    'ownership': $('#ownership').val()
                },
                success: function(response) {
                    $('#asset_list').replaceWith(response.data);
                }
            });
        }

        function queryStringToJSON(queryString) {
            // Remove leading '?' if it exists
            if (queryString.startsWith('?')) {
                queryString = queryString.substring(1);
            }

            // Split the query string into key-value pairs
            const pairs = queryString.split('&');
            const result = {};

            // Iterate over each pair
            pairs.forEach(pair => {
                const [key, value] = pair.split('=');
                result[key] = value || ''; // Use empty string if value is undefined
            });

            return result;
        }

        function exportData() {
            $.ajax({
                type: 'post',
                url: `{{ route('export.asset_details') }}`,
                data: {
                    'status': $('#status').val(),
                    'search': $('#search').val(),
                    'category_id': $('#category_id').val(),
                    'manufacturer_id': $('#manufacturer_id').val(),
                    'ownership': $('#ownership').val(),
                },
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`,
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == true) {
                            Swal.fire({
                                title: 'Sucess',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something Went Wrong! Please try Again!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                },
                error: function(jqXHR, errorThrown) {
                    Swal.fire({
                                title: 'Error!',
                                text: 'Something Went Wrong! Please try Again!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                }
            });
        };

        function view_user_details(userAssets) {
            var assetUser = JSON.parse(userAssets);
            $('#user').text(assetUser.user.name);
            $('#assigned_date').text(assetUser.assigned_date);
            $('#returned_date').text(assetUser.returned_date);
            $('#message').text(assetUser.comment);
            jQuery('#edit_user_details').modal('show');
        }
    </script>
    @endsection
