@extends('layouts.company.main')
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
                    <a href="{{ route('leave.status.log.add') }}" class="btn btn-sm btn-primary align-self-center">
                        Update Leave Status</a>
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
                                        <th>Employee Name</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Final Status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="">
                                    @foreach ($leaveStatusLogDetails as $index => $leaveStatusLog)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><a href="#" data-bs-toggle="modal"
                                                    onClick="getEmployeeLeaveDetails('{{ date('F jS, Y  h:i:s a', strtotime($leaveStatusLog->leave->created_at)) }}','{{ $leaveStatusLog->leave->from }}',
                                                     '{{ $leaveStatusLog->leave->to }}','{{ $leaveStatusLog->leave->is_half_day }}',
                                                     '{{ $leaveStatusLog->leave->from_half_day }}','{{ $leaveStatusLog->leave->to_half_day }}',
                                                     '{{$leaveStatusLog->leaveStatus->name}}')">{{ $leaveStatusLog->leave->user->name }}</a></td>
                                            <td>{{ $leaveStatusLog->leave->from }}</td>
                                            <td>{{ $leaveStatusLog->leave->to }}</td>
                                            <td>{{ $leaveStatusLog->leave->leaveStatus->name }}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="leavetracking" data-id="{{ $leaveStatusLog->leave_id }}">
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
    <div class="modal" id="employee_leave_details">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Employee Leave Details</h2>
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
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y pt-0 pb-5 border-top">
                    <!--begin::Wrapper-->
                    <div class="panel panel-body table-responsive text-center border-radiusxl">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-2">
                            <tbody>
                                <tr>
                                    <th>Applied Date</th>
                                    <td id="applied_date"></td>
                                </tr>
                                <tr>
                                    <th>Leave Type</th>
                                    <td id="leave_type"></td>
                                </tr>
                                <tr>
                                    <th>From</th>
                                    <td id="from"></td>
                                </tr>
                                <tr>
                                    <th>To</th>
                                    <td id="to"></td>
                                </tr>
                                <tr>
                                    <th>Half Day</th>
                                    <td id="half_day"></td>
                                </tr>
                                <tr>
                                    <th>From Half Day</th>
                                    <td id="from_half_day"></td>
                                </tr>
                                <tr>
                                    <th>To Half Day</th>
                                    <td id="to_half_day"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
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

    <script>
        function getEmployeeLeaveDetails(appliedDate,from,to,halfDay,fromHalfDay,ToHalfday,leaveStatus) {
            var fromHalfDayValue = '';
            var toHalfDayValue = '';
            var isHalfDayValue = '';
             /** for  Half Day*/
             if(halfDay == '1')
            {
                isHalfDayValue = 'Yes';
            }
            else if(halfDay == '0')
            {
                isHalfDayValue = 'No';
            }
            else
            {
                isHalfDayValue;
            }

            /** for From Half Day*/
            if(fromHalfDay == 'single_half')
            {
                fromHalfDayValue = 'First Half';
            }
            else if(fromHalfDay == 'second_half')
            {
                fromHalfDayValue = 'Second Half';
            }
            else
            {
                fromHalfDayValue;
            }

            /** for To Half Day*/
            if(ToHalfday == 'single_half')
            {
                toHalfDayValue = 'First Half';
            }
            else if(ToHalfday == 'second_half')
            {
                toHalfDayValue = 'Second Half';
            }
            else
            {
                toHalfDayValue;
            }
            $('#applied_date').html(appliedDate);
            $('#leave_type').html(leaveStatus);
            $('#from').html(from);
            $('#to').html(to);
            $('#half_day').html(isHalfDayValue);
            $('#from_half_day').html(fromHalfDayValue);
            $('#to_half_day').html(toHalfDayValue);
            jQuery('#employee_leave_details').modal('show');

        }
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
@endsection
