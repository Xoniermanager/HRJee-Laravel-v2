@extends('layouts.company.main')
@section('content')
@section('title')
    Company Connectors
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
                    <div class="card-title">
                        <div class="min-w-200px me-2 d-flex align-items-center position-relative my-1">
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
                            <input class="form-control form-control-solid ps-16" placeholder="Search " type="text"
                                value="{{ request()->get('search') }}" id="search_connector">
                        </div>

                        <select class="form-control min-w-200px me-2" id="filter_state_id" style="display: none">
                        </select>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="{{ route('connector.add') }}"
                        class="col-md-2 btn btn-sm ms-3 btn-primary align-self-center wt-space">
                        Add Connector</a>

                    <!--end::Action-->
                </div>
                <!--begin::Row-->
                <div class="row gy-5 g-xl-10">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif (session('danger'))
                        <div class="alert alert-danger">
                            {{ session('danger') }}
                        </div>
                    @endif
                    <div class="mb-5 mb-xl-10">
                        @include('company.connector.connectors-list')
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <script>
            jQuery("#search_connector").on('input', function() {
                search_filter_results();
            });

            function search_filter_results() {
                $.ajax({
                    type: 'GET',
                    url: "<?= route('connector.search') ?>",
                    data: {
                        'search': $('#search_connector').val(),
                    },
                    success: function(response) {
                        console.log(response);
                        $('#company_connector_list').replaceWith(response.data);
                    }
                });
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
                            url: company_ajax_base_url + '/connector/delete/' + id,
                            type: "get",
                            success: function(response) {
                                console.log(response);

                                Swal.fire("Done!", "It was succesfully deleted!", "success");
                                $('#company_connector_list').replaceWith(response.data);
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                Swal.fire("Error deleting!", "Please try again", "error");
                            }
                        });
                    }
                });
            }
        </script>
        <script>
            $(document).ready(function() {
                $('#connector-tabs a[data-bs-toggle="tab"]').on('click', function(e) {
                    e.preventDefault();

                    let $this = $(this);
                    let status = $this.data('status');

                    // Activate clicked tab
                    $('#connector-tabs a').removeClass('active');
                    $this.addClass('active');

                    $.ajax({
                        url: '{{ route('connector.filter') }}',
                        method: 'GET',
                        data: {
                            status: status
                        },
                        beforeSend: function() {
                            $('#connector-table-body').html(
                                '<tr><td colspan="9">Loading...</td></tr>');
                        },
                        success: function(response) {
                            $('#connector-table-body').html(response.html);
                        },
                        error: function() {
                            $('#connector-table-body').html(
                                '<tr><td colspan="9">Error loading connectors.</td></tr>');
                        }
                    });
                });
            });
        </script>
    @endsection
