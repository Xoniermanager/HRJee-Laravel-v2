@extends('layouts.employee.main')
@section('content')
@section('title')
    Leave Tracking
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="mb-5 mb-xl-10">
                    <div class="card-body pt-5">
                        <div class="d-flex">
                            <div class="col-md-6 m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-3rem">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->

                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="fa fa-circle fs-2 text-success"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </div>
                                        <!--end::Timeline icon-->

                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Leave Applied
                                            </span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#"
                                                class="fs-7 text-gray-800 d-block text-hover-primary">{{ $leaveDetails->created_at->todatestring() }}</a>
                                            <!--end::Title-->

                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-3rem">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->

                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="fa fa-circle fs-2 text-info"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </div>
                                        <!--end::Timeline icon-->

                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Waiting</span>
                                            <!--begin::Label-->

                                            <!--begin::Title-->
                                            <a href="#"
                                                class="fs-7 text-gray-800 d-block text-hover-primary">{{ $leaveDetails->created_at->todatestring() }}</a>
                                            <!--end::Title-->

                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-3rem">
                                            <!--begin::Timeline line-->
                                            <div class="timeline-line"></div>
                                            <!--end::Timeline line-->

                                            <!--begin::Timeline icon-->
                                            <div class="timeline-icon">
                                                <i class="fa fa-circle fs-2 text-success"><span class="path1"></span><span
                                                        class="path2"></span></i>
                                            </div>
                                            <!--end::Timeline icon-->

                                            <!--begin::Timeline content-->
                                            <div class="timeline-content m-0">
                                                <!--begin::Label-->
                                                <span class="fs-8 fw-bolder text-success text-uppercase">Approved </span>
                                                <!--begin::Label-->

                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="fs-7 text-gray-800 d-block text-hover-primary">02-07-2024</a>
                                                <!--end::Title-->

                                            </div>
                                            <!--end::Timeline content-->
                                        </div>
                                        <!--end::Timeline item-->
                                        <!--begin::Timeline item-->
                                        <div class="timeline-item">
                                            <!--begin::Timeline line-->
                                            <div class="timeline-line"></div>
                                            <!--end::Timeline line-->

                                            <!--begin::Timeline icon-->
                                            <div class="timeline-icon">
                                                <i class="fa fa-circle fs-2 text-danger"><span class="path1"></span><span
                                                        class="path2"></span></i>
                                            </div>
                                            <!--end::Timeline icon-->

                                            <!--begin::Timeline content-->
                                            <div class="timeline-content m-0">
                                                <!--begin::Label-->
                                                <span class="fs-8 fw-bolder text-danger text-uppercase">Rejected</span>
                                                <!--begin::Label-->

                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="fs-7 text-gray-800 d-block text-hover-primary">03-07-2024</a>
                                                <!--end::Title-->
                                                <span class="fw-semibold text-gray-500">Rejected due to project
                                                    delivery.</span>
                                            </div>
                                            <!--end::Timeline content-->
                                        </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                        </div>
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
