@extends('layouts.employee.main')

@section('title', 'Hello Shibli Sone')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-md-12">
                    <div class="mb-5 mb-xl-10">
                        <div class="row g-5 g-xl-10 mb-3">
                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <a href="#"
                                    class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                    style="background-color: #1642b3;background-image:url('assets/media/wave-bg-purple.svg')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 mb-3">
                                        <!--begin::Icon-->
                                        <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                            style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                            <i class="fa fa-calendar-days text-white fs-2qx lh-0"></i>
                                        </div>
                                        <!--end::Icon-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer"
                                        style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
border-bottom-right-radius: 30px;">
                                        <!--begin::Progress-->
                                        <div class="fw-bold text-white py-2">

                                            <span class="fs-2 opacity-50">Total Attendance
                                            </span>
                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Card footer-->
                                </a>
                                <!--end::Card widget 3-->
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <a href="#"
                                    class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                    style="background-color: #1642b3;background-image:url('assets/media/wave-bg-purple.svg')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 mb-3">
                                        <!--begin::Icon-->
                                        <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                            style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                            <i class="fa fa-newspaper text-white fs-2qx lh-0"></i>
                                        </div>
                                        <!--end::Icon-->
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Card footer-->
                                    <div class="card-footer"
                                        style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
                                    border-bottom-right-radius: 30px;">
                                        <!--begin::Progress-->
                                        <div class="fw-bold text-white py-2">

                                            <span class="fs-2 opacity-50">Monthly News</span>
                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Card footer-->
                                </a>
                                <!--end::Card widget 3-->
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <a href="#"
                                    class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                    style="background-color: #1642b3;background-image:url('assets/media/wave-bg-purple.svg')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 mb-3">
                                        <!--begin::Icon-->
                                        <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                            style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                            <i class="fa fa-users-gear text-white fs-2qx lh-0"></i>
                                        </div>
                                        <!--end::Icon-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer"
                                        style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
border-bottom-right-radius: 30px;">
                                        <!--begin::Progress-->
                                        <div class="fw-bold text-white py-2">

                                            <span class="fs-2 opacity-50">HR Service </span>
                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Card footer-->
                                </a>
                                <!--end::Card widget 3-->
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <a href="#"
                                    class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                    style="background-color: #1642b3;background-image:url('assets/media/wave-bg-purple.svg')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 mb-3">
                                        <!--begin::Icon-->
                                        <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                            style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                            <i class="fa fa-headphones text-white fs-2qx lh-0"></i>
                                        </div>
                                        <!--end::Icon-->
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Card footer-->
                                    <div class="card-footer"
                                        style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
                                    border-bottom-right-radius: 30px;">
                                        <!--begin::Progress-->
                                        <div class="fw-bold text-white py-2">

                                            <span class="fs-2 opacity-50"> Support
                                            </span>
                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Card footer-->
                                </a>
                                <!--end::Card widget 3-->
                            </div>
                        </div>

                        <div class="card card-body bg-light-info col-md-12 mb-3">


                            <div class="">
                                <div class="card-body py-3">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <span data-kt-element="bullet"
                                                            class="bullet bullet-vertical d-flex align-items-center h-40px bg-primary"></span>
                                                    </td>

                                                    <td>
                                                        <div id="clock"></div>

                                                        <span class="text-primary-400 fw-bold fs-7 d-block ">Working
                                                            Hours</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <!--begin::Icon-->
                                                        <div class="d-flex justify-content-end flex-shrink-0">


                                                            <!--begin::Attach-->
                                                            <button class="btn btn-sm fs-4 btn-primary align-self-center">
                                                                Punch In
                                                            </button>
                                                            <!--end::Attach-->
                                                        </div>
                                                        <!--end::Icon-->
                                                    </td>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->

                                </div>

                                <!--begin::Body-->
                            </div>
                        </div>


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
                                            <img src="/assets/media/news/1.png" class="card-rounded min-h-175px mb-5">

                                            <!--end::Image-->
                                            <!--begin::Body-->
                                            <div class="m-0">
                                                <!--begin::Title-->
                                                <a href="news_details.html"
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
                                            <img src="/assets/media/news/2.jpg" class="card-rounded min-h-175px mb-5">

                                            <!--end::Image-->
                                            <!--begin::Body-->
                                            <div class="m-0">
                                                <!--begin::Title-->
                                                <a href="news_details.html"
                                                    class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">First
                                                    news</a>
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


                        <!--begin::Body-->
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
@endsection
<script>
    // CLOCK FUNCTION

    setInterval(showTime, 1000);

    function showTime() {

        let clock_time = new Date();
        let clock_hour = clock_time.getHours();
        let clock_min = clock_time.getMinutes();
        let clock_sec = clock_time.getSeconds();
        am_pm = "AM";

        if (clock_hour >= 12) {
            if (clock_hour > 12) clock_hour -= 12;
            am_pm = " pm";
        } else if (clock_hour == 0) {
            hr = 12;
            am_pm = " am";
        }

        clock_hour =
            clock_hour < 10 ? "0" + clock_hour : clock_hour;
        clock_min = clock_min < 10 ? "0" + clock_min : clock_min;
        clock_sec = clock_sec < 10 ? "0" + clock_sec : clock_sec;

        let currentTime =
            clock_hour +
            ":" +
            clock_min +
            ":" +
            clock_sec +
            am_pm;

        document.getElementById("clock").innerHTML = currentTime;
    }
    showTime();
</script>
