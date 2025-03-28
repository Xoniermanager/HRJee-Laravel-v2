@extends('layouts.company.main')
@section('content')
@section('title', 'Attendance Request Management')
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
                            <select name="status" class="form-control min-w-150px me-2" id="status">
                                <option value="">Status</option>
                                <option {{ old('status') == 'pending' || request()->get('status') == 'pending' ? 'selected' : '' }}
                                    value="pending">Pending</option>
                                <option {{ old('status') == 'approved' || request()->get('status') == 'approved' ? 'selected' : '' }}
                                    value="approved">Approved</option>
                                <option {{ old('status') == 'rejected' || request()->get('status') == 'rejected' ? 'selected' : '' }}
                                    value="rejected">Rejected</option>
                            </select>
                        </div>
                        <!--end::Card title-->
                    </div>

                    <div class="mb-5 mb-xl-10">
                        @include('company.attendance_request.list')
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>

        <script>
             function handleStatus(ele, requestId) {
                Swal.fire({
                        title: "Are you sure?",
                        text: "You are about to change the status.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, change it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('attendance.request.statusUpdate') }}",
                                type: 'get',
                                data: {
                                    'requestId': requestId,
                                    'status': ele.value,
                                },
                                success: function (res) {
                                    if (res.status) {
                                        Swal.fire("Done!", res.message, "success");
                                        $('#address_request_list').replaceWith(res.data);
                                    } else {
                                        Swal.fire("Oops!", res.message, "error");
                                    }
                                }
                            });
                        }
                    });
                }
            jQuery("#search").on('input', function () {
                search_filter_results();
            });
            jQuery("#status").on('change', function () {
                search_filter_results();
            });

            function search_filter_results() {
                $.ajax({
                    type: 'GET',
                    url: company_ajax_base_url + '/attendance-request/search/filter',
                    data: {
                        'status': $('#status').val(),
                        'search': $('#search').val()
                    },
                    success: function (response) {
                        $('#attendance_request_list').replaceWith(response.data);
                    }
                });
            }
        </script>
@endsection
