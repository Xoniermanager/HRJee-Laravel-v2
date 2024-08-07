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
    function ajax_get_holiday_by_date(date){
        jQuery.ajax({
            type: "get",
            url: "{{ route('holiday.by.date') }}",
            data: {
                date: date,
            },
            success: function(response) {
                console.log(response.data);
                if (response.status == true) {
                    $('#holiday_list').replaceWith(response.data);
                }
            },
            error: function(error_data) {
                console.log(error_data);
            },
        });
    }
</script>
@endsection