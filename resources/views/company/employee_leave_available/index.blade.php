@extends('layouts.company.main')
@section('content')
@section('title')
    Employee Leave Available
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
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                        </div>

                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                </div>
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
                                        <th class="">Leave Type & Available</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach ($getAllEmployeeLeaveAvailableDetails as $userDetailsLeaveDetails)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $userDetailsLeaveDetails[0]->user->name }}</td>
                                            <td>
                                                @foreach ($userDetailsLeaveDetails as $leaveDetails)
                                                    <span class="btn btn-sm btn-success m-1">
                                                        {{ $leaveDetails->leaveType->name }} :
                                                        {{ $leaveDetails->available }}
                                                    </span>
                                                @endforeach
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
@endsection
