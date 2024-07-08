@extends('layouts.employee.main')
@section('content')
@section('title')
    HR Service
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">



                <div class=" ">
                    <!--begin::Body-->
                    <div class=" py-15">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center">
                            <!--begin::Items-->
                            <div class="d-flex justify-content-between mb-10 mx-auto w-xl-900px">
                                <!--begin::Item-->
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 gy-10">
                                    <div class="col text-center mb-9">
                                        <a href="{{ route('employee.attendance.service') }}"
                                            class="octagon d-flex flex-center bg-primary h-200px w-200px  mx-2">
                                            <!--begin::Content-->
                                            <div class="text-center">
                                                <!--begin::Symbol-->
                                                <i class="fa fa-calendar-days text-white fs-2qx lh-0"></i>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="mt-1">
                                                    <!--begin::Animation-->
                                                    <div
                                                        class="fs-lg-2hx fs-2x fw-bold text-white d-flex align-items-center">
                                                        <div class="min-w-50px fs-2x ">Attendance</div>
                                                    </div>
                                                    <!--end::Animation-->

                                                </div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Content-->
                                        </a>
                                    </div>

                                    <div class="col text-center mb-9">
                                        <!--begin::Item-->
                                        <a href="{{ route('employee.leave') }}"
                                            class="octagon d-flex flex-center bg-primary h-200px w-200px  mx-2">
                                            <!--begin::Content-->
                                            <div class="text-center">
                                                <!--begin::Symbol-->
                                                <i class="fa fa-calendar-times  text-white fs-2qx lh-0"></i>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="mt-1">
                                                    <!--begin::Animation-->
                                                    <div
                                                        class="fs-lg-2hx fs-2 fw-bold text-white d-flex align-items-center">
                                                        <div class="min-w-50px fs-2x ">Leave</div>
                                                    </div>
                                                    <!--end::Animation-->

                                                </div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Content-->
                                        </a>
                                        <!--end::Item-->
                                    </div>

                                    <div class="col text-center mb-9">
                                        <!--begin::Item-->
                                        <a href="{{ route('employee.holidays') }}"
                                            class="octagon d-flex flex-center bg-primary h-200px w-200px  mx-2">
                                            <!--begin::Content-->
                                            <div class="text-center">
                                                <!--begin::Symbol-->
                                                <i class="la la-calendar  text-white fs-2qx lh-0"></i>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="mt-1">
                                                    <!--begin::Animation-->
                                                    <div
                                                        class="fs-lg-2hx fs-2x fw-bold text-white d-flex align-items-center">
                                                        <div class="min-w-50px fs-2x ">Holidays</div>
                                                    </div>
                                                    <!--end::Animation-->

                                                </div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Content-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <div class="col text-center mb-9">
                                        <!--begin::Item-->
                                        <a href="{{ route('employee.payslips') }}"
                                            class="octagon d-flex flex-center bg-primary h-200px w-200px  mx-2">
                                            <!--begin::Content-->
                                            <div class="text-center">
                                                <!--begin::Symbol-->
                                                <i class="la la-money-bill text-white fs-2qx lh-0"></i>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="mt-1">
                                                    <!--begin::Animation-->
                                                    <div
                                                        class="fs-lg-2hx fs-2x fw-bold text-white d-flex align-items-center">
                                                        <div class="min-w-50px fs-2x ">Pay Slip</div>
                                                    </div>
                                                    <!--end::Animation-->

                                                </div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Content-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <div class="col text-center mb-9">
                                        <!--begin::Item-->
                                        <a href="{{ route('employee.resignation') }}"
                                            class="octagon d-flex flex-center bg-primary h-200px w-200px  mx-2">
                                            <!--begin::Content-->
                                            <div class="text-center">
                                                <!--begin::Symbol-->
                                                <i class="fa fa-file-contract  text-white fs-2qx lh-0"></i>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="mt-1">
                                                    <!--begin::Animation-->
                                                    <div
                                                        class="fs-lg-2hx fs-2x fw-bold text-white d-flex align-items-center">
                                                        <div class="min-w-50px fs-2x ">Resignation</div>
                                                    </div>
                                                    <!--end::Animation-->

                                                </div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Content-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                </div>

                                <!--end::Item-->

                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Wrapper-->

                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
@endsection
