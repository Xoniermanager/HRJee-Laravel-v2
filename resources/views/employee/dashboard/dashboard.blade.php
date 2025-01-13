@extends('layouts.employee.main')
@section('title', Auth()->guard('employee')->user()->name)
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
                                <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
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
                                <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
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
                                <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
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
                                <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
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
                    <div class="card card-body bg-light-info col-md-12 mb-3">
                        <div class="">
                            <div class="card-body py-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>{{date('l')}}</h5>
                                        <span class="text-primary-400 fw-bold fs-7 d-block ">{{date('d-m-Y')}}</span>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <span data-kt-element="bullet"
                                            class="bullet bullet-vertical d-flex align-items-center h-40px bg-primary"
                                            style="width: 4px;height: 50px !important;"></span>
                                    </div>
                                    <div class="col-md-4 text-end">

                                        @if($existingAttendanceDetail==null)
                                        <h5 id="current-time"></h5>
                                        <button class="btn btn-sm btn-primary align-self-center" id="start-timer">
                                            Punch In
                                        </button>
                                        @endif
                                        @if($existingAttendanceDetail && $existingAttendanceDetail->punch_out=='')
                                        <h5 id="punchin-timer"></h5>
                                        <button class="btn btn-sm btn-primary align-self-center" id="stop-timer">
                                            Punch Out
                                        </button>
                                        @if($takenBreakDetails && !empty($takenBreakDetails))
                                        <a class="btn btn-sm btn-danger align-self-center"
                                            href="{{ route('employee_break_out',$takenBreakDetails->id) }}">
                                            Break Out
                                        </a>
                                        @else
                                        <button class="btn btn-sm btn-danger align-self-center" data-bs-toggle="modal"
                                            data-bs-target="#break" id="take_break">
                                            Take Break
                                        </button>
                                        <button class="btn btn-sm btn-danger align-self-center" id="break_out"
                                            style="display: none">
                                            Break Out
                                        </button>
                                        @endif
                                        @endif
                                        @if($existingAttendanceDetail && $existingAttendanceDetail->punch_out!='')
                                        <h5>Working hours</h5>
                                        <p>{{getTotalWorkingHour($existingAttendanceDetail->punch_in,$existingAttendanceDetail->punch_out)}}
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                <!--begin::Table container-->
                                <!--end::Table container-->
                            </div>
                            <!--begin::Body-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
</div>

<!-------------Modal----------------->
<div class="modal" id="break" tabindex="-1" aria-modal="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog p-9 w-550px">
        <!--begin::Modal content-->
        <div class="modal-content modal-rounded">
            <!--begin::Modal header-->
            <div class="modal-header border d-flex justify-content-between">
                <!--begin::Modal title-->
                <h2>Break Time</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fa fa-times fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y m-1">
                <form id="employee_break_history">
                    @csrf
                    <input type="hidden" name="employee_attendance_id"
                        value="{{ $existingAttendanceDetail->id ?? '' }}">
                    <div class="col-md-12 form-group">
                        <label class="required">Select Break Type</label>
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
                    <div class="col-md-12 form-group">
                        <label class="required">Comment </label>
                        <textarea type="text" class="form-control" name="comment"></textarea>
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="submit" class="btn btn-sm btn-primary align-self-center">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
            <!--begin::Modal body-->
        </div>
    </div>
</div>

<script>
    var employeeAttendanceUrl = "<?= route('employee.attendance') ?>";

    @if(!is_null($existingAttendanceDetail)) // Check if $existingAttendanceDetail is not null
    // Pass PHP values to JavaScript and ensure proper JSON encoding
    var punchIn = @json($existingAttendanceDetail->punch_in);
    var punchOut = @json($existingAttendanceDetail->punch_out);
    get_timer_clock(punchIn, punchOut);
    @endif
    var setCurrentInterval = '';
    @if(is_null($existingAttendanceDetail))
        // Update the time every second
        setCurrentInterval = setInterval(updateCurrentTime, 1000);
        // Call the function immediately to avoid 1-second delay
        updateCurrentTime();
    @endif

    function get_timer_clock(punch_in, punch_out) {
        var refreshIntervalId = '';
        if (punch_in != '' && punch_out == null) {
            clearInterval(setCurrentInterval);
            let timeLaps = '';
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
                $("#punchin-timer").text(timeLaps);
            }, 1);
        } else if (punch_out != '') {

            clearInterval(refreshIntervalId);
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
            }
        } else {
            console.log('hello');
        }
    }

    function updateCurrentTime() {
        // Get the current time
        const now = new Date();

        // Format the time as HH:MM:SS
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const currentTime = `${hours}:${minutes}:${seconds}`;

        // Update the element with the current time
        document.getElementById('current-time').innerText = currentTime;
    }

     jQuery("#employee_break_history").validate({
                rules: {
                    break_type_id: "required",
                    comment: "required",
                },
                messages: {
                    break_type_id: "Please select the Break Type",
                    comment: "Please enter the message",
                },
                submitHandler: function(form) {
                    var break_data = $(form).serialize();
                    $.ajax({
                        url: "<?= route('employee_break_in') ?>",
                        type: 'post',
                        data: break_data,
                        success: function(response) {
                            if(response.status)
                            {
                                jQuery('#take_break').hide();
                                jQuery('#break_out').show();
                                jQuery('#break').modal('hide');
                                swal.fire("Done!", response.message, "success");
                                jQuery('#employee_break_history')[0].reset();
                            }
                            else
                            {
                                jQuery('#break').modal('hide');
                                Swal.fire('Error!',response.message,'error','Cool')
                                jQuery('#employee_break_history')[0].reset();
                            }
                        },
                        error: function(error_messages) {
                            let errors = error_messages.responseJSON.error;
                            for (var error_key in errors) {
                                $(document).find('[name=' + error_key + ']').after(
                                    '<span id="' + error_key +
                                    '_error" class="text text-danger">' + errors[
                                        error_key] + '</span>');
                                setTimeout(function() {
                                    jQuery("#" + error_key + "_error").remove();
                                }, 5000);
                            }
                        }
                    });
                }
            });
</script>
@endsection
