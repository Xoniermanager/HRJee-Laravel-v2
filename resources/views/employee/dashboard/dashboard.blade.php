@extends('layouts.employee.main')

@section('title', 'Hello Shibli Sone')

@section('content')
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
                                                    <td class="w-10px">
                                                        <span data-kt-element="bullet"
                                                            class="bullet bullet-vertical d-flex align-items-center h-40px bg-primary"></span>
                                                    </td>

                                                    <td class="min-w-300px">
                                                        <div class="timer-display-id">
                                                            <h4 id="timer" class="m-0" style="display: none">00:00:00
                                                            </h4>
                                                        </div>

                                                        <span class="text-primary-400 fw-bold fs-7 d-block ">Working
                                                            Hours</span>
                                                    </td>
                                                    <td>
                                                        <a href="#" data-bs-toggle="modal" class=""
                                                            modal-target="#employee_break_history">
                                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                            <span class="btn btn-primary fs-3 py-2 "> Take a Break</span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    </td>
                                                    <td class="text-end">
                                                        <!--begin::Icon-->
                                                        <div class="d-flex justify-content-end flex-shrink-0">
                                                            <form action="{{ route('employee.attendance') }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="time_date"
                                                                    value="{{ date('Y/m/d H:i:s') }}">
                                                                <!--begin::Attach-->
                                                                <button class="btn btn-primary fs-3 py-2 " id="start-timer"
                                                                    onclick="start()" style="display:none">
                                                                    Punch In
                                                                </button>
                                                                <button class="btn btn-primary fs-3 py-2 " id="stop-timer"
                                                                    onclick="stop()" style="display:none">
                                                                    Punch Out
                                                                </button>
                                                            </form>
                                                            <!--end::Attach-->
                                                        </div>

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
                        {{-- <div class="row gy-5 g-xl-10">
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
                        </div> --}}
                        <!--end::Row-->
                        <form id="employee_break_history">
                            @csrf
                            <input type="hidden" name="employee_attendance_id" value="{{ $existingDetails->id ?? '' }}">
                            <!--begin::Wrapper-->
                            <div class="mw-lg-600px mx-auto p-4">
                                <!--begin::Input group-->
                                <div class="mt-3 mb-3">
                                    <label class="required">Break Type</label>
                                    <select class="form-control mb-3" name="break_type_id">
                                        <option value="">Select Break Type</option>
                                        @forelse ($allBreakTypeDetails as $breakTypeDetails)
                                            <option value="{{ $breakTypeDetails->id }}">{{ $breakTypeDetails->name }}
                                            </option>
                                        @empty
                                            <option value="">No Break Type Available</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mt-3 mb-3">
                                    <label class="">Comment</label>
                                    <input type="text" name="comment" class="form-control">
                                </div>
                            </div>
                            <!--end::Wrapper-->
                            <div class="d-flex flex-end flex-row-fluid pt-2 border-top">
                                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" id="kt_modal_upgrade_plan_btn">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Submit</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                        </form>

                        <!--begin::Body-->
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
    </div>
    {{-- <div class="modal" id="employee_break_history">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Take Break</h2>
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
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div> --}}
    <script>
        function stop() {
            let punch_in = "{{ $existingDetails->punch_in ?? '' }}";
            let punch_out = "{{ $existingDetails->punch_out ?? '' }}";
            $("#start-timer").hide();
            $("#stop-timer").hide();
            if (punch_out != 'NULL') {
                var StartedTime = new Date(punch_in).getTime();
                var EndedTime = new Date(punch_out).getTime();

                var diff = EndedTime - StartedTime;
                var hours = Math.floor(diff / 3.6e6);
                var minutes = Math.floor((diff % 3.6e6) / 6e4);
                var seconds = Math.floor((diff % 6e4) / 1000);
                let h = hours < 10 ? '0' + hours : hours;
                let m = minutes < 10 ? '0' + minutes : minutes;
                let s = seconds < 10 ? '0' + seconds : seconds;
                var duration = h + ":" + m + ":" + s;
                timeLaps = duration;
                $("#timer").text(timeLaps);
            }
        }
        jQuery(document).ready(function() {
            let punch_in = '{{ $existingDetails->punch_in ?? '' }}';
            let punch_out = '{{ $existingDetails->punch_out ?? '' }}';
            var refreshIntervalId = '';
            if (punch_in != '' && punch_out == '') {
                $("#start-timer").hide();
                $("#stop-timer").show();
                let timeLaps = '';
                $("#timer").show();
                var StartedTime = new Date(punch_in).getTime();
                refreshIntervalId = setInterval(() => {
                    var EndedTime = new Date().getTime();
                    var diff = EndedTime - StartedTime;
                    var hours = Math.floor(diff / 3.6e6);
                    var minutes = Math.floor((diff % 3.6e6) / 6e4);
                    var seconds = Math.floor((diff % 6e4) / 1000);
                    let h = hours < 10 ? '0' + hours : hours;
                    let m = minutes < 10 ? '0' + minutes : minutes;
                    let s = seconds < 10 ? '0' + seconds : seconds;
                    var duration = h + ":" + m + ":" + s;
                    timeLaps = duration;
                    $("#timer").text(timeLaps);

                }, 1);
            } 
            else if (punch_out != '') {
                $("#start-timer").hide();
                $("#stop-timer").hide();
                clearInterval(refreshIntervalId);
                $("#timer").show();
                if (punch_out) {
                    var StartedTime = new Date(punch_in).getTime();
                    var EndedTime = new Date(punch_out).getTime();

                    var diff = EndedTime - StartedTime;
                    var hours = Math.floor(diff / 3.6e6);
                    var minutes = Math.floor((diff % 3.6e6) / 6e4);
                    var seconds = Math.floor((diff % 6e4) / 1000);
                    let h = hours < 10 ? '0' + hours : hours;
                    let m = minutes < 10 ? '0' + minutes : minutes;
                    let s = seconds < 10 ? '0' + seconds : seconds;
                    var duration = h + ":" + m + ":" + s;
                    timeLaps = duration;
                    $("#timer").text(timeLaps);
                }
            } else {
                $("#start-timer").show();
                $("#stop-timer").hide();
                $("#timer").hide();
            }
        });

        jQuery(document).ready(function() {
            $("#employee_break_history").validate({
                rules: {
                    break_type_id: "required"
                },
                messages: {
                    break_type_id: "Please Select the Break Type"
                },
                submitHandler: function(form) {
                    var break_history_details = $(form).serialize();
                    $.ajax({
                        url: "{{ route('employee_break_history') }}",
                        type: 'POST',
                        data: break_history_details,
                        success: function(response) {
                            jQuery('#employee_break_history').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            jQuery("#employee_break_history")[0].reset();
                        },
                        error: function(error_messages) {
                            let errors = error_messages.responseJSON.error;
                            for (var error_key in errors) {
                                $(document).find('[name=' + error_key + ']').after(
                                    '<span class="' + error_key +
                                    '_error text text-danger">' + errors[
                                        error_key] + '</span>');
                                setTimeout(function() {
                                    jQuery("." + error_key + "_error").remove();
                                }, 4000);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
