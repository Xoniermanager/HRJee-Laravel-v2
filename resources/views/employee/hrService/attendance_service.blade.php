@extends('layouts.employee.main')
@section('content')
@section('title')
Attendance
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="py-15 cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="">From date</label>
                                <input type="date" class="form-control mb-3 date" id="from_date" value="{{ date("Y-m-01") ?? old('from_date') }}">
                            </div>
                            <div class="col-md-5">
                                <label for="">To date</label>
                                <input type="date" class="form-control mb-3 date" id="to_date" value="{{ date("Y-m-d") ?? old('to_date')}}">
                            </div>
                        </div>

                    </div>
                    <!--end::Card title-->
                </div>
                <div class="separator  mb-9"></div>

                <div class="mb-5 mb-xl-10">
                    <h1 class="d-flex flex-column text-dark fs-2 fw-bold title-text">
                        Attendance Details
                    </h1>
                    <div class="">
                        <div class="">
                            <!--begin::Body-->
                            <div class="">
                                <div class="card-body py-3">
                                    @include('employee.hrService.attendance_list')
                                </div>
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<script>
    jQuery(".date").on('change', function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date && to_date) {
            search_filter_results()
        } else {
            return false;
        }
    });
    $(document).on('click', '#attendance_list a', function(e) {
        e.preventDefault();
        var page_no = $(this).attr('href').split('page=')[1];
        search_filter_results(page_no);
    });
    function search_filter_results(page_no = 1) {
        $.ajax({
            type: 'GET',
            url: employee_ajax_base_url + "/search/filter/date?page=" + page_no,
            data: {
                'from_date': $('#from_date').val(),
                'to_date':$('#to_date').val()
            },
            success: function(response) {
                $('#attendance_list').replaceWith(response.data);
            }
        });
    }
</script>
@endsection
