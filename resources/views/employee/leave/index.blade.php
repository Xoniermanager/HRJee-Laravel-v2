@extends('layouts.employee.main')
@section('content')
@section('title')
    Leave Management
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
                                placeholder="Search " type="text" id="SearchByPatientName" name="SearchByPatientName"
                                value="">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                        </div>

                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="{{ route('employee.apply.leave') }}" class="btn btn-sm btn-primary align-self-center">
                        Apply Leave</a>
                    <!--end::Action-->
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
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold">
                                        <th>Sr. No.</th>
                                        <th>Leave Type</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Half Day</th>
                                        <th>From Half Day</th>
                                        <th>To Half Day</th>
                                        <th>Leave Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="">
                                    @foreach ($allLeavesDetails as $index => $leavesDetails)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $leavesDetails->leaveTypeName }}</td>
                                            <td>{{ $leavesDetails->from }}</td>
                                            <td>{{ $leavesDetails->to }}</td>
                                            @if ($leavesDetails->is_half_day == '1')
                                                <td>Yes</td>
                                            @else
                                                <td>No</td>
                                            @endif
                                            @php
                                                $leaveFromDay = '';
                                                if ($leavesDetails->from_half_day == 'first_half') {
                                                    $leaveFromDay = 'First Half';
                                                } elseif ($leavesDetails->from_half_day == 'second_half') {
                                                    $leaveFromDay = 'Second Half';
                                                } else {
                                                    $leaveFromDay;
                                                }
                                            @endphp
                                            <td>{{ $leaveFromDay }}</td>
                                            @php
                                                $leaveToDay = '';
                                                if ($leavesDetails->from_half_day == 'first_half') {
                                                    $leaveToDay = 'First Half';
                                                } elseif ($leavesDetails->from_half_day == 'second_half') {
                                                    $leaveToDay = 'Second Half';
                                                } else {
                                                    $leaveToDay;
                                                }
                                            @endphp
                                            <td>{{ $leaveToDay }}</td>
                                            <td>{{ $leavesDetails->leaveStatus->name }}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="leavetracking" data-id="{{ $leavesDetails->id }}">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/3273/3273365.png" class="h-35px" alt="Leave Tracking">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                </div>
                <!--begin::Body-->
            </div>
            <!--begin::Body-->
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
</div>

<!-- Modal for Edit  form-->
<div class="modal" id="leaveTrackingModal" tabindex="-1" aria-modal="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0">
                <h2>Leave Tracking</h2>
                <!--begin::Close-->
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
                </div>
            </div>
            <div class="modal-body scroll-y pb-5 border-top">
                <!-- Dynamic content will be loaded here -->
                <div id="modalContent">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    jQuery.noConflict();
    jQuery(document).ready(function($) {
        $('.leavetracking').on('click', function () {
            const leaveId = $(this).data('id');
            $('#modalContent').html('<p>Loading...</p>'); // Show loading state
            jQuery('#leaveTrackingModal').modal('show'); // Show modal

            // Fetch data using AJAX
            $.ajax({
                url: '/employee/leave-tracking/'+leaveId, // Update to the correct route
                method: 'GET',
                success: function (response) {
                    $('#modalContent').html(response);
                },
                error: function () {
                    $('#modalContent').html('<p class="text-danger">An error occurred. Please try again.</p>');
                }
            });
        });
    });
</script>
