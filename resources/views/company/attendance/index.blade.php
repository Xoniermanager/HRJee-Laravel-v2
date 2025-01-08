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
                        <div class="d-flex align-items-center position-relative my-1  min-w-250px me-2">
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
                            <input class="form-control form-control-solid ps-14" placeholder="Search By Name & Emp ID"
                                type="text" name="search" id="search">
                        </div>
                        <select name="year" class="form-control min-w-250px" id="year">
                            <option value="">Select Year</option>
                            @for ($i = date('Y', strtotime('-5 year')); $i <= date('Y'); $i++) <option value="{{ $i }}"
                                {{ $i==date('Y') ? 'selected' : '' }}>
                                {{ $i }}</option>
                                @endfor
                        </select>
                        <select name="month" class="form-control min-w-250px ml-10" id="month">
                            <option value="">Select Month</option>
                            @php
                            $currentMonth = date('m');
                            $months = fullMonthList();
                            @endphp
                            @foreach (range(1, $currentMonth) as $month)
                            <option value="{{ $month }}" {{ $month==$currentMonth ? 'selected' : '' }}>
                                {{ $months[$month] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <a href="{{ route('attendance.add.bulk') }}" class="btn btn-sm btn-primary align-self-center">Add
                        Bulk Attendance</a>
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
        var months = @json(fullMonthList());
        $('#year').on('change', function() {
            var yearValue = this.value;
            var currentYear = {{ date('Y') }};
            var currentMonth = {{ date('m') }};
            var options = '';
            if (yearValue != currentYear) {
                $.each(months, function(key, month) {
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
        $('#month').on('change', function() {
            searchFilter();
        });
        $('#search').on('input', function() {
            searchFilter(this.value);
        });

        function searchFilter() {
            $.ajax({
                method: 'GET',
                url: company_ajax_base_url + '/attendance/search/filter',
                data: {
                    'year': $('#year').val(),
                    'month': $('#month').val(),
                    'search': $('#search').val()
                },
                success: function(response) {
                    $('#attendance_list').replaceWith(response.data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });
        }
    </script>
    @endsection
