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
                                                <label for="exampleInput">Review Cycle<span
                                                        class="validateRq">*</span></label>
                                                <select name="cycle_id" class="form-control" id="review_cycle_id">
                                                    <option value="">--- Please Select ---</option>
                                                    @foreach ($performanceCycles as $cycle)
                                                        <option value="{{ $cycle->id.' - '.$cycle->start_date.' - '.$cycle->end_date }}">{{ $cycle->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group employee_id">
                                                <label for="exampleInput">Employee Name<span
                                                        class="validateRq">*</span></label>
                                                <select name="user_id" class="form-control" id="employee_id">
                                                    <option value="">--- Please Select ---</option>
                                                    @foreach ($allEmployeeDetails as $employee)
                                                        @if($employee->id != auth()->user()->id)
                                                        <option value="{{ $employee->id }}">{{ $employee->name }}
                                                        </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group employee_id">
                                                <label for="exampleInput">Date<span class="validateRq">*</span></label>
                                                <input type="text" id="daterange" name="daterange"
                                                    class="form-control min-w-250px ml-10" readonly>
                                            </div>
                                        </div> --}}
                                        <input type="hidden" id="daterange" name="daterange" class="form-control">
                                    </div>
                                    {{-- <h3 class="box-title">Criteria List</h3> --}}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group employee_id">
                                                <label for="exampleInput">Leave Ranking<span
                                                        class="validateRq">*</span></label>
                                                <select name="leave_ranking" class="form-control" id="leave_ranking" readonly>
                                                    <option value="">--- Please Select ---</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group employee_id">
                                                <label for="exampleInput">Attendance Ranking<span
                                                        class="validateRq">*</span></label>
                                                <select name="attendance_ranking" class="form-control" id="attendance_ranking" readonly>
                                                    <option value="">--- Please Select ---</option>
                                                </select>
                                            </div>
                                        </div>
                                        @foreach ($allCategories as $category)
                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="form-group employee_id">
                                                    <label for="exampleInput">{{$category->name}}</label>
                                                    <select name="categories[{{$category->id}}]" class="form-control">
                                                        <option value="">--- Please Select ---</option>
                                                        <option>UNSATISFACTORY</option>
                                                        <option>SATISFACTORY</option>
                                                        <option>GOOD</option>
                                                        <option>EXCELLENT</option>
                                                    </select>
                                                </div>
                                            </div> 
                                        @endforeach
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group employee_id">
                                                <label for="exampleInput">Review<span
                                                        class="validateRq">*</span></label>
                                                <textarea name="review" id="" cols="30" rows="5" class="form-control" {{auth()->user()->userRole->name != "HR" ? "" : "disabled"}} ></textarea>
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

            $('#review_cycle_id').on('change', function () {
                const values = $(this).val();
                const arr = values.split(" - ");
                const cycleId = arr[0];
                const startDate = arr[1];
                const endDate = arr[2];
                $("#daterange").val(`${startDate} - ${endDate}`);
                if (!cycleId) {
                    $('#employee_id').html('<option value="">--- Please Select ---</option>');
                    return;
                }

                $.ajax({
                    url: company_ajax_base_url + '/performance-review-cycles/employees/' + cycleId,
                    type: 'GET',
                    success: function (response) {
                        if (response.success) {
                            let options = '<option value="">--- Please Select ---</option>';
                            response.employees.forEach(emp => {
                                options += `<option value="${emp.id}">${emp.name}</option>`;
                            });
                            $('#employee_id').html(options);
                        } else {
                            alert(response.message || "Unable to fetch employees.");
                        }
                    },
                    error: function () {
                        alert("Error fetching employees.");
                    }
                });
            });


            $('#employee_id').on('change', function() {
                let dateRange = $("#daterange").val();
                const userID = $('#employee_id').val()

                $.ajax({
                    url: company_ajax_base_url + '/performance-management/filter',
                    method: 'GET',
                    data: { dateRange, userID },
                    success: function (response) {
                        if(response.success == false) {
                            alert(response.message)
                        } else {
                            $("#leave_ranking").val(response.leaveRank)
                            $("#attendance_ranking").val(response.attendanceRank)
                            $("#leave_ranking").html("<option selected>"+response.leaveRank+"</option>")
                            $("#attendance_ranking").html("<option selected>"+response.attendanceRank+"</option>")
                        }
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("AJAX Error:", textStatus);
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
                        if(response.success == false) {
                            alert(response.message)
                        } else {
                            $("#leave_ranking").val(response.leaveRank)
                            $("#attendance_ranking").val(response.attendanceRank)

                            $("#leave_ranking").html("<option selected>"+response.leaveRank+"</option>")
                            $("#attendance_ranking").html("<option selected>"+response.attendanceRank+"</option>")
                        }
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("AJAX Error:", textStatus);
                    }
                });
            });
        });
    </script>
@endsection
