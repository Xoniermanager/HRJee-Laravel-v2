@extends('layouts.employee.main')
@section('content')
@section('title')
    Attendance
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="col-md-6">
                <div class="card card-flush flex-row-fluid h-100 p-6 pb-5 mw-100"
                    style="background-color: #1642b3;background-image:url({{ asset('assets/media/wave-bg-purple.svg') }})">
                    <!--begin::Body-->
                    <div class="card-body text-center m-auto">
                        <!--begin::Food img-->
                        <img src="{{ asset('assets/media/user.jpg') }}"
                            class="rounded-3 mb-4 w-150px h-150px w-xxl-200px h-xxl-200px" alt="">
                        <!--end::Food img-->
                        <!--begin::Info-->
                        <div class="mb-2">
                            <!--begin::Title-->
                            <div class="text-center">
                                <span class="text-white text-end fw-bold fs-1">Shibli Sone</span>

                                <span class="text-white fw-semibold d-block fs-6 mt-n1"><i
                                        class="fa fa-calendar-days"></i>
                                    Thursday March 28, 2024</span>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Info-->

                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Col-->
            <div class="col-md-6">
                <div class="card card-flush flex-row-fluid h-100 p-6 pb-5 mw-100">
                    <!--begin::Body-->
                    <div class="card-body text-center m-auto">

                        <!--begin::Title-->
                        <div class="text-center">
                            <span class="text-primary text-end fw-bold fs-1">Activity in Progress</span>
                            <span class="text-gray-400 fw-semibold d-block fs-6 mt-n1">Sector 63 Workwings</span>
                        </div>
                        <!--end::Title-->

                        <!--begin::Food img-->
                        <img src="{{ asset('assets/media/clock.jpg') }}"
                            class="rounded-3 mb-4 w-150px h-150px w-xxl-200px h-xxl-200px m-auto" alt="">
                        <!--end::Food img-->
                        <!--begin::Info-->
                        <div class="mb-2">

                        </div>
                        <!--end::Info-->

                        <div id="clock"></div>
                        <!--begin::Total-->
                        <span class="text-danger text-end fw-bold fs-1">Time Elapsad</span>
                        <!--end::Total-->

                        <button class="btn btn-primary fs-1 w-100 py-4">Punch Out</button>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
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
