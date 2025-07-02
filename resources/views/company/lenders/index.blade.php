@extends('layouts.company.main')
@section('content')
@section('title')
    Lenders
@endsection
@php
    $userRole = Auth()->user()->userRole;
@endphp
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
                            <input class="form-control form-control-solid ps-14 min-w-150px me-2" placeholder="Search "
                                type="text" name="search" value="{{ request()->get('search') }}" id="search">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>

                        </div>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    @if ($userRole->name != 'Banker')
                        <a href="{{ route('lender.add') }}" class="btn btn-sm btn-primary align-self-center">
                            Add Lender</a>
                    @endif
                    <!--end::Action-->
                </div>
                <div class="mb-5 mb-xl-10">
                    @include('company.lenders.list')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>

    <script>
        $(document).ready(function() {

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
                    url: "{{ route('lender.statusUpdate') }}",
                    type: 'get',
                    data: {
                        'id': id,
                        'status': status,
                    },
                    success: function(res) {
                        if (res) {
                            swal.fire("Done!", 'Status ' + status_name + ' Update Successfully',
                                "success");
                        } else {
                            swal.fire("Oops!", 'Something Went Wrong', "error");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error in handleStatus:", xhr, status, error);
                        swal.fire("Oops!", 'Something Went Wrong. Check the console.', "error");
                    }
                })
            }

            $(document).on('change', '[id^="checked_value_"]', function() {
                var id = this.id.split('_')[2];
                handleStatus(id);
            });

            jQuery("#search").on('keyup', function() {
                search_filter_results();
            });
            jQuery("#status").on('change', function() {
                search_filter_results();
            });

            function search_filter_results() {
                $.ajax({
                    type: 'GET',
                    url: company_ajax_base_url + '/lender/search/filter',
                    data: {
                        'status': $('#status').val(),
                        'search': $('#search').val()
                    },
                    success: function(response) {
                        $('#lender_list').replaceWith(response.data);
                    }
                });
            }

        });
    </script>
@endsection
