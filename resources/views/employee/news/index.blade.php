@extends('layouts.employee.main')
@section('content')
@section('title')
    News
@endsection
<!--begin::Header-->
<!--end::Header-->
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header p-4">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0"> All News</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <div class="separator  mb-9"></div>

                <div class="row g-10">
                    <!--begin::Col-->
                    <div class="col-md-4">
                        <!--begin::Feature post-->
                        <div class="card-xl-stretch me-md-6">
                            <!--begin::Image-->
                            <img src="{{ asset('employee/assets/media/news/1.png') }}"
                                class="card-rounded min-h-175px mb-5">

                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <a href="{{route('employee.news.details')}}"
                                    class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">Scrum
                                    Meeting</a>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="fw-semibold fs-5 text-gray-600 text-dark my-4">
                                    <i class="fa fa-calendar-days"></i> March 27,2024
                                </div>
                                <!--end::Text-->

                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feature post-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-4">
                        <!--begin::Feature post-->
                        <div class="card-xl-stretch me-md-6">
                            <!--begin::Image-->
                            <img src="{{ asset('employee/assets/media/news/2.jpg') }}"
                                class="card-rounded min-h-175px mb-5">

                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <a href="{{route('employee.news.details')}}"
                                    class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">First news</a>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="fw-semibold fs-5 text-gray-600 text-dark my-4">
                                    <i class="fa fa-calendar-days"></i> March 27,2024
                                </div>
                                <!--end::Text-->

                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feature post-->
                    </div>
                    <!--end::Col-->

                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::Content-->
</div>
@endsection
