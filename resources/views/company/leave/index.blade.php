@extends('layouts.company.main')
@section('content')
@section('title')
    Leave list
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="custom-table card p-0">
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
                    <a href="{{ route('leave.add') }}" class="btn btn-sm btn-primary align-self-center">
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
                                        <th>Employee Name</th>
                                        <th>Leave Type</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Half Day</th>
                                        <th>From Half Day</th>
                                        <th>To Half Day</th>
                                        <th>Leave Status</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="">
                                    @foreach ($allLeavesDetails as $index => $leavesDetails)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $leavesDetails->user->name }}</td>
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
                                                <td>{{$leaveToDay}}</td>
                                            <td>{{ $leavesDetails->leaveStatus->name }}</td>
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
@endsection
