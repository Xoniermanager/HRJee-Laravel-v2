@extends('layouts.employee.main')
@section('content')
@section('title')
    Holidays Management
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card-body">
                <!--begin::Card title-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            @include('employee.holidays.calendar')
                        </div>
                    </div>
                    <div class="col-md-6">
                        @include('employee.holidays.allholiday_list')
                    </div>
                    <div class="col-md-6 pt-4">
                        <div class="card p-5 pt-4" id="highlight_holiday">
                            <h4 class="holiday_header">{{ date('F') }} Holiday List</h4>
                            <div class="row">
                                @foreach ($monthHolidayDetails as $holdaysDetails)
                                    <div class="col-md-4">
                                        <div class="holiday_list">
                                            <h2>{{ $holdaysDetails->name }}</h2>
                                            <span>{{ getFormattedDate($holdaysDetails->date) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!--end::Col-->
    </div>
    <!--end::Container-->
</div>
<script>
    function ajax_update_calendar(month, year) {
        jQuery.ajax({
            type: "get",
            url: "{{ route('update.calendar') }}",
            data: {
                month: month,
                year: year,
            },
            success: function(response) {
                if (response.status == true) {
                    $('#calendar').replaceWith(response.data);
                }
            },
            error: function(error_data) {
                console.log(error_data);
            },
        });
    }

    function ajax_get_holiday_by_date(date) {
        jQuery.ajax({
            type: "get",
            url: "{{ route('holiday.by.date') }}",
            data: {
                date: date,
            },
            success: function(response) {
                if (response.status == true) {
                    $('#highlight_holiday').replaceWith(response.data);
                }
            },
            error: function(error_data) {
                console.log(error_data);
            },
        });
    }
</script>
@endsection
