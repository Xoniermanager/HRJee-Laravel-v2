@extends('layouts.company.main')
@section('title', 'Attendance Management')
@section('content')
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
                            <div class="d-flex align-items-center position-relative my-1  min-w-150px me-2">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                            transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input class="form-control form-control-solid ps-14" placeholder="Name & EMPId"
                                    type="text" name="search" id="search">
                            </div>
                            <select name="branch" class="form-control min-w-150px" id="branch">
                                <option value="">All Branches</option>
                                @foreach ($branches as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <select name="department" class="form-control min-w-150px ml-10" id="department"
                                onchange="getManagerByDept()">
                                <option value="">All Departments</option>
                                @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                            <select name="manager" class="form-control min-w-150px ml-10" id="manager">
                                <option value="">All Managers</option>
                                @foreach ($managers as $manager)
                                <option value="{{$manager->id}}">{{$manager->name}}</option>
                                @endforeach
                            </select>
                            <select name="year" class="form-control min-w-150px ml-10" id="year">
                                <option value="">Select Year</option>
                                @for ($i = date('Y', strtotime('-5 year')); $i <= date('Y'); $i++) <option value="{{ $i }}"
                                    {{ $i == date('Y') ? 'selected' : '' }}>
                                    {{ $i }}</option>
                                    @endfor
                            </select>
                            <select name="month" class="form-control min-w-150px ml-10" id="month">
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
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-2 gap-2">
                        <button onclick="exportAllAttendance()" class="btn btn-sm btn-primary">Download</button>
                        <a href="{{ route('attendance.add.bulk') }}" class="btn btn-sm btn-primary">Add Bulk Attendance</a>
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
                        @include('company.attendance.list')
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <script>
            function getManagerByDept() {
                const deptId = $("#department").val();
                $('#manager').empty();

                $.ajax({
                    url: "{{ route('get.all.manager') }}",
                    type: "GET",
                    dataType: "json",
                    data: { department_id: deptId },
                    success: function (response) {
                        var select = $('#manager');
                        select.empty();

                        if (response.status === true) {
                            select.append('<option value="">Select The Manager</option>');
                            $.each(response.data, function (key, value) {
                                select.append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        } else {
                            select.append('<option value="">' + response.error + '</option>');
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something Went Wrong!! Please try Again"
                        });
                    }
                });

                searchFilter();
            }

            const months = @json(fullMonthList());

            $('#year').on('change', function () {
                const yearValue = this.value;
                const currentYear = {{ date('Y') }};
                const currentMonth = {{ date('m') }};
                let options = '';

                if (yearValue != currentYear) {
                    $.each(months, function (key, month) {
                        options += `<option value="${key}">${month}</option>`;
                    });
                } else {
                    for (let i = 1; i <= currentMonth; i++) {
                        const monthStr = i.toString();
                        options += `<option value="${monthStr}" ${monthStr == currentMonth ? 'selected' : ''}>${months[monthStr]}</option>`;
                    }
                }

                $('#month').html(options);
                searchFilter();
            });

            $('#month, #branch, #manager').on('change', searchFilter);

            $('#search').on('input', function () {
                searchFilter();
            });

            jQuery(document).on('click', '#attendance_list a', function(e) {
            e.preventDefault();
            var page_no = $(this).attr('href').split('page=')[1];
            searchFilter(page_no);
            });
            function searchFilter(page_no = 1) {
                $.ajax({
                    method: 'GET',
                    url: company_ajax_base_url + '/attendance/search/filter?page=' + page_no,
                    data: {
                        branch: $('#branch').val(),
                        department: $('#department').val(),
                        manager: $('#manager').val(),
                        year: $('#year').val(),
                        month: $('#month').val(),
                        search: $('#search').val()
                    },
                    success: function (response) {
                        $('#attendance_list').replaceWith(response.data);
                    },
                    error: function (jqXHR) {
                        console.log(jqXHR);
                    }
                });
            }

            function exportAllAttendance() {
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait while we generate your report.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    method: 'GET',
                    url: company_ajax_base_url + '/attendance/search/filter',
                    data: {
                        branch: $('#branch').val(),
                        department: $('#department').val(),
                        manager: $('#manager').val(),
                        year: $('#year').val(),
                        month: $('#month').val(),
                        search: $('#search').val(),
                        export: true
                    },
                    success: function () {
                        Swal.fire({
                            title: 'Request Sent',
                            text: 'Attendance report will be sent to your email shortly.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function (jqXHR) {
                        console.log(jqXHR);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again.'
                        });
                    }
                });
            }


            function getExportData(empId) {
                exportAttendanceByUserId(empId, $('#year').val(), $('#month').val());
            }
        </script>
@endsection
