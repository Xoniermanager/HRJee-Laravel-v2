@extends('layouts.employee.main')
@section('content')
@section('title')
    Leave Available
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="col-md-12">
                        <div class="card-body mb-5 mb-xl-10">
                            <div class="row g-5 g-xl-10 mb-3">
                                @foreach ($getEmployeeLeaveAvailableDetails as $leaveAvailableDetails)
                                    @foreach ($leaveAvailableDetails as $leaveDetails)
                                <div class="col-xl-3 col-sm-6">
                                    <!--begin::Card widget 3-->
                                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                        style="background-color: #1642b3;background-image:url('/employee/assets/media/wave-bg-purple.svg')">
                                        <!--begin::Header-->
                                        <div class="card-header pt-5 mb-3">
                                            <!--begin::Icon-->
                                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                                style="font-size: 60px;
color: #fff;font-weight: 500;border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642B3">
                                                {{ $leaveDetails->available }}
                                            </div>
                                            <!--end::Icon-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Card footer-->
                                        <div class="card-footer"
                                            style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
border-bottom-right-radius: 30px;">
                                            <!--begin::Progress-->
                                            <div class="fw-bold text-white py-2 fs-1">
                                                <span class="opacity-50">{{ $leaveDetails->leaveType->name }}</span>
                                            </div>
                                            <!--end::Progress-->
                                        </div>
                                        <!--end::Card footer-->
                                    </div>
                                    <!--end::Card widget 3-->
                                </div>

                                @endforeach
                                @endforeach

                            </div>
                        </div>
                    </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
@endsection
