@extends('layouts.company.main')
@section('content')
@section('title')
    Performance Management
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
                <div class="mb-5 mb-xl-10">
                    <div class="mb-5 mb-xl-10">
                        <div class="card-body py-3">
                            <form method="POST" action="{{ route('performance-management.add') }}">
                                @csrf
                                <div class="form-body">

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group employee_id">
                                                <label for="exampleInput">Employee Name<span
                                                        class="validateRq">*</span></label>
                                                <select name="user_id" class="form-control" id="employee_id">
                                                    <option value="">--- Please Select ---</option>
                                                    @foreach ($allEmployeeDetails as $employee)
                                                        <option value="{{ $employee->id }}">{{ $employee->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group employee_id">
                                                <label for="exampleInput">Skills<span
                                                        class="validateRq">*</span></label>
                                                <select name="skills[]" id="skills" class="form-control" multiple
                                                    disabled>
                                                    <option value="">--- Please Select ---</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <label for="exampleInput">Date<span class="validateRq">*</span></label>
                                            <input type="text" id="daterange" name="daterange"
                                                class="form-control min-w-250px ml-10">
                                        </div>
                                    </div>
                                    {{-- <h3 class="box-title">Criteria List</h3> --}}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group employee_id">
                                                <label for="exampleInput">Leave Ranking<span
                                                        class="validateRq">*</span></label>
                                                <select name="leave_ranking" class="form-control" id="leave_ranking" disabled>
                                                    <option value="">--- Please Select ---</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group employee_id">
                                                <label for="exampleInput">Attendance Ranking<span
                                                        class="validateRq">*</span></label>
                                                <select name="atendance_ranking" class="form-control" id="atendance_ranking" disabled>
                                                    <option value="">--- Please Select ---</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group employee_id">
                                                <label for="exampleInput">Task Ranking<span
                                                        class="validateRq">*</span></label>
                                                <select name="employee_id" class="form-control" id="employee_id">
                                                    <option value="">--- Please Select ---</option>
                                                    @foreach ($allEmployeeDetails as $employee)
                                                        <option value="{{ $employee->id }}">{{ $employee->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group employee_id">
                                                <label for="exampleInput">Manager's Review<span
                                                        class="validateRq">*</span></label>
                                                <textarea name="manager_review" id="" cols="30" rows="5" class="form-control" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
                                                Save</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
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
        $(document).ready(function() {
            $('#daterange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                autoApply: true,
            });
            $('#skills').select2({
                placeholder: "--- Please Select ---",
                allowClear: true
            });

            $('#employee_id').on('change', function() {
                const userID = $('#employee_id').val()
                $.ajax({
                    method: 'GET',
                    url: company_ajax_base_url + '/performance-management/get-skills/' + userID,

                    success: function(response) {
                        // Clear existing options
                        $('#skills').empty();

                        // Append new options
                        $.each(response.data, function(index, skill) {
                            $('#skills').append(
                                `<option selected>${skill.name}</option>`);
                        });

                        // Refresh Select2
                        $('#skills').trigger('change');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                    }
                });
            });

            $('#daterange').on('change', function () {
                let dateRange = $(this).val();
                const userID = $('#employee_id').val()

                $.ajax({
                    url: company_ajax_base_url + '/performance-management/filter',
                    method: 'GET',
                    data: { dateRange, userID },
                    success: function (response) {
                        console.log("response => ", response)
                        $("#leave_ranking").html("<option selected>"+response.leaveRank+"</option>")
                        $("#atendance_ranking").html("<option selected>"+response.attendanceRank+"</option>")
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("AJAX Error:", textStatus);
                    }
                });
            });
        });
    </script>
@endsection
