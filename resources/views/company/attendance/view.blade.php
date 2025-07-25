@extends('layouts.company.main')
@section('content')
    @section('title')
        Attendance Management
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
                            <select name="month" class="form-control min-w-150px ml-10" id="filter-type">
                                <option value="Monthly">Monthly</option>
                                <option value="Custom">Custom</option>
                            </select>
                            <select name="year" class="form-control min-w-150px ml-10 monthly" id="year">
                                <option value="">Select Year</option>
                                @for ($i = date('Y', strtotime('-5 year')); $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <select name="month" class="form-control min-w-150px ml-10 monthly" id="month">
                                <option value="">Select Month</option>
                                @php
                                    $currentMonth = date('m');
                                    $months = fullMonthList();
                                @endphp
                                @foreach (range(1, $currentMonth) as $month)
                                    <option value="{{ $month }}" {{ $month == $currentMonth ? 'selected' : '' }}>
                                        {{ $months[$month] }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="date" name="start_date" id="start_date" value=""
                                class="form-control ml-10 custom-date" style="display: none;">
                            <input type="date" name="end_date" id="end_date" value="" class="form-control ml-10 custom-date"
                                style="display: none;" disabled>

                        </div>
                        <button class="btn btn-sm btn-primary align-self-center" id="export_button">Export
                            Attendance</button>
                    </div>
                    @include('company.attendance.view_list')
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <div class="modal" id="edit_attendance_modal">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-500px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Close-->
                        <h2>Edit Attendance</h2>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                        fill="currentColor"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y pt-0 pb-5 border-top">
                        <form id="edit_attendance_form">
                            @csrf
                            <input type="hidden" name="attendance_id" id="attendance_id">
                            <input type="hidden" name="user_id" id="user_id" value="{{ $employeeDetail['emp_id'] }}">
                            <!--begin::Wrapper-->
                            <div class="mw-lg-600px mx-auto p-4">
                                <div class="col-md-12">
                                    <label class="required">Date</label>
                                    <input class="form-control mb-5 mt-3" type="text" name="date" id="date" readonly>
                                </div>
                                <div class="col-md-12 selectpermission mt-4">
                                    <label class="required">Punch In</label>
                                    <input class="form-control mb-5 mt-3" type="time" name="punch_in" id="punch_in">
                                </div>
                                <div class="col-md-12 selectpermission mt-4">
                                    <label class="">Punch Out</label>
                                    <input class="form-control mb-5 mt-3" type="time" name="punch_out" id="punch_out">
                                </div>
                                <div class="col-md-12 selectpermission mt-4">
                                    <label class="required">Remark</label>
                                    <textarea class="form-control mb-5 mt-3" name="remark" id="remark"></textarea>
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
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <script>
            var months = @json(fullMonthList());
            let empId = {{ $employeeDetail['emp_id'] }}

                function edit_attendance(attendanceId, punchIn, punchOut, date, remark = "") {
                    $('#date').val(date);
                    $('#attendance_id').val(attendanceId);
                    $('#punch_in').val(punchIn);
                    $('#punch_out').val(punchOut);
                    $('#remark').val(remark);
                }

            $(document.body).ready(function () {
                $('#filter-type').on('change', function () {
                    var filterType = this.value;
                    $("#start_date").val("")
                    $("#end_date").val("")
                    $("#year").val("")
                    $("#month").val("")
                    $("#end_date").prop('disabled', true)
                    if (filterType == "Monthly") {
                        $(".monthly").show()
                        $(".custom-date").hide()
                    } else {
                        $(".monthly").hide()
                        $(".custom-date").show()
                    }
                });

                $('#year').on('change', function () {
                    var yearValue = this.value;
                    var currentYear = {{ date('Y') }};
                    var currentMonth = {{ date('m') }};
                    var options = '';
                    if (yearValue != currentYear) {
                        $.each(months, function (key, month) {
                            options += `<option value="${key}">${month}</option>`;
                        });
                    } else {
                        for (var i = 1; i <= currentMonth; i++) {
                            var monthStr = i.toString();
                            options +=
                                `<option value="${monthStr}" ${monthStr == currentMonth ? 'selected' : ''}>${months[monthStr]}</option>`;
                        }
                    }
                    $('#month').html(options);
                    searchFilter();
                });
                $('#month').on('change', function () {
                    searchFilter();
                });

                $('#start_date').on('change', function () {
                    $("#end_date").prop('disabled', false)
                    searchFilter();
                });

                $('#end_date').on('change', function () {
                    searchFilter();
                });

                $('#search').on('input', function () {
                    searchFilter(this.value);
                });
                $('#export_button').on('click', function () {
                    var today = new Date();
                    var formattedDate = today.getFullYear() + '-' +
                        String(today.getMonth() + 1).padStart(2, '0') + '-' +
                        String(today.getDate()).padStart(2, '0');

                    if ($('#end_date').val() != "") {
                        formattedDate = $('#end_date').val()
                    }

                    exportAttendanceByUserId({{ $employeeDetail['emp_id'] }}, $('#year').val(), $('#month').val(), $('#start_date').val(), formattedDate)
                });

                function searchFilter() {
                    $.ajax({
                        method: 'GET',
                        url: company_ajax_base_url + '/attendance/view/search/filter/' + empId,
                        data: {
                            'year': $('#year').val(),
                            'month': $('#month').val(),
                            'start_date': $('#start_date').val(),
                            'end_date': $('#end_date').val(),
                        },
                        success: function (response) {
                            $('#view_list').replaceWith(response.data);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR);
                        }
                    });
                }

                jQuery("#edit_attendance_form").validate({
                    rules: {
                        punch_in: "required",
                        punch_out: {
                            required: {
                                depends: function (element) {
                                    var selectedDate = $('#date').val();
                                    var today = new Date().toISOString().slice(0, 10); // YYYY-MM-DD
                                    return selectedDate !== today;
                                }
                            }
                        }
                    },
                    messages: {
                        punch_in: "Please select the Punch In time",
                        punch_out: "Please select the Punch Out time (required for past dates)"
                    },
                    submitHandler: function (form) {
                        var attendance_data = $(form).serialize();
                        $.ajax({
                            url: company_ajax_base_url + '/attendance/edit_manual/',
                            type: 'POST',
                            data: attendance_data,
                            success: function (response) {
                                $('#edit_attendance_modal').modal('hide');
                                if (response.status == true) {
                                    Swal.fire("Done!", response.message, "success");
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: response.message,
                                        icon: "error",
                                        confirmButtonText: 'Ok'
                                    });
                                }
                                searchFilter();
                            },
                            error: function (error_messages) {
                                console.log(error_messages);
                            }
                        });
                    }
                });

            })
        </script>
@endsection
