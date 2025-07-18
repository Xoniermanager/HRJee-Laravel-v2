@extends('layouts.company.main')

@section('title', 'Dashboard')

@section('content')
    <style>
        .event-date-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            position: sticky;
            top: 0;
            background: #ccdcfb;
            align-items: center;
            padding: 4px 9px;
        }
        .event-date-header h5 {
            font-size: 14px;
            margin: 0;
        }

        .badge-counts .badge {
            /* margin-left: 8px; */
            /* padding: 5px 10px; */
            border-radius: 20px;
            font-size: 12px;
        }

        .event-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 8px 12px;
            background: #f8f9fa;
            border-left: 4px solid #0d6efd;
            border-radius: 6px;
            transition: 0.3s;
        }

        .event-item:hover {
            background-color: #e9f5ff;
        }

        .event-icon {
            font-size: 20px;
            margin-right: 10px;
        }

        .event-title {
            font-weight: 500;
        }

        .no-events {
            color: #999;
            font-style: italic;
            margin-top: 10px;
        }

        .stat-box {
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            min-width: 150px;
            justify-content: center;
        }

        .stat-box i {
            font-size: 18px;
        }
    </style>
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <div class="col-md-8">
                    <div class="mycard_lightblue">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <p>{{ \Carbon\Carbon::now()->format('l, d F Y') }}</p>
                                <h2>Hello {{ explode(' ', Auth()->user()->name)[0] }}! 👋</h2>
                                <p>Track & manage your team progress here</p>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-body">
                                    <div class="icondiv">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <h1>{{ $dashboardData['total_employee'] }}</h1>
                                    <p>Total Emoloyees</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-body">
                                    <div class="icondiv">
                                        <i class="fa fa-users-viewfinder"></i>
                                    </div>
                                    <h1>{{ $dashboardData['total_active_employee'] }}</h1>
                                    <p>Active Emoloyees</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-body">
                                    <div class="icondiv">
                                        <i class="fa fa-user-minus"></i>
                                    </div>
                                    <h1>{{ $dashboardData['total_inactive_employee']}}</h1>
                                    <p>Inactive Emoloyees</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mycard_lightblue1">
                        <div class="sidebox"></div>
                        <div class="p-5">
                            <h4>Unloack New Features</h4>
                            <p>Dive into our advance analytics and customized reports. Designed to
                                streamline your HR tasks.</p>
                            <button class="btn btn-primary">Upgrade Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-5 g-xl-10">
                <div class="col-md-8">
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="card-box">
                                <div class="d-flex justify-content-between">
                                    <h5 class="section-title">Average Team KPI</h5>
                                    {{-- <select class="form-select w-auto">
                                        <option selected>Monthly</option>
                                    </select> --}}
                                </div>
                                <canvas id="kpiChart" height="210"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-box">
                                <div class="d-flex justify-content-between">
                                    <h4 class="section-title">Attendance Overview (Last 7 Days)</h4>
                                    {{-- <select class="form-select w-auto">
                                        <option selected>7 - 15 June</option>
                                    </select> --}}
                                </div>
                                <canvas id="attendanceChart" height="210"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 mb-5">
                        <!-- Tasks -->
                        <div class="col-md-4">
                            <div class="card p-4">
                                <h5>Tasks</h5>
                                <div class="task-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <div>Update Employee Details</div>
                                        <div class="title-small">Policy Development • Jun 15, 2027</div>
                                    </div>
                                    <div class="progress-circle" id="circle1">
                                        <canvas width="40" height="40"></canvas>
                                        <div class="progress-label">45%</div>
                                    </div>
                                </div>

                                <div class="task-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <div>Finalize Quarterly Budget Review</div>
                                        <div class="title-small">Financial Analysis • May 30, 2027</div>
                                    </div>
                                    <div class="progress-circle" id="circle2">
                                        <canvas width="40" height="40"></canvas>
                                        <div class="progress-label">68%</div>
                                    </div>
                                </div>

                                <div class="task-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <div>Launch New Product Line</div>
                                        <div class="title-small">Product Launch • Jul 1, 2027</div>
                                    </div>
                                    <div class="progress-circle" id="circle3">
                                        <canvas width="40" height="40"></canvas>
                                        <div class="progress-label">0%</div>
                                    </div>
                                </div>

                                <div class="task-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <div>Upgrade Server Infrastructure</div>
                                        <div class="title-small">Technical Infrastructure • Aug 20, 2027
                                        </div>
                                    </div>
                                    <div class="progress-circle" id="circle4">
                                        <canvas width="40" height="40"></canvas>
                                        <div class="progress-label">12%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Employee Satisfaction -->
                        <div class="col-md-4">
                            <div class="card p-4 position-relative">
                                <h5>Employee Satisfaction</h5>
                                <canvas id="npsGauge" height="100"></canvas>
                                <div class="wdcdc">
                                    <div class="text-center nps-score">84</div>
                                    <div class="text-center text-muted">NPS Score<br><small>2,849
                                            responses</small></div>
                                </div>
                                <div class="mt-4">
                                    <div class="bar-label">Work Environment</div>
                                    <div class="progress mb-2" style="height: 6px;">
                                        <div class="progress-bar bg-primary" style="width: 70%"></div>
                                    </div>
                                    <div class="bar-label">Professional Development</div>
                                    <div class="progress mb-2" style="height: 6px;">
                                        <div class="progress-bar bg-primary" style="width: 65%"></div>
                                    </div>
                                    <div class="bar-label">Management & Leadership</div>
                                    <div class="progress mb-2" style="height: 6px;">
                                        <div class="progress-bar bg-primary" style="width: 60%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Employment Status -->
                        <div class="col-md-4">
                            <div class="card p-4 position-relative">
                                <h5>Employment Type</h5>
                                <canvas id="employeePie" height="100"></canvas>

                                <div class="wdcdc">
                                    <div class="text-center employee-count">{{ $dashboardData['total_employee_type'] }}
                                    </div>
                                    <div class="text-center text-muted">Total Employee</div>
                                </div>
                                <!-- Scrollable list container -->
                                <div style="max-height: 110px; overflow-y: auto;">
                                    <ul class="mt-3 list-unstyled pe-2">
                                        @foreach($dashboardData['employee_type_chart'] as $data)
                                            <li class="mb-2 d-flex align-items-center">
                                                <span class="legend-dot me-2"
                                                    style="background-color: {{ $data['color'] }}; width: 12px; height: 12px; border-radius: 50%; display: inline-block;"></span>
                                                <span class="legend-text">
                                                    {{ $data['label'] }} ({{ $data['percentage'] }}%) - {{ $data['count'] }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="calendar-container mb-5">
                        <div class="calendar-header">
                            <button onclick="prevMonth()">&lt;</button>
                            <span id="monthYear">June 2025</span>
                            <button onclick="nextMonth()">&gt;</button>
                        </div>

                        <div class="calendar-grid" id="calendar-days">
                            <!-- Weekdays -->
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                            <!-- Days will be injected here -->
                        </div>

                        <div class="schedule" id="schedule">
                            <!-- Dynamic schedule will be injected here -->
                        </div>
                    </div>
                </div>

            </div>
            <div class="row gy-5 g-xl-10">
                <div class="custom-table card p-0">
                    <div class="card-header cursor-pointer p-0 align-items-center d-block">
                            <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-top: 10px;"
                                class="mb-4">
                                <div class="stat-box" style="background-color: #cfe2ff; color: #084298;">
                                    <i class="fa fa-users"></i> Total Active: <strong id="stat-total">0</strong>
                                </div>

                                <div class="stat-box" style="background-color: #d1e7dd; color: #0f5132;">
                                    <i class="fa fa-user-check"></i> Present: <strong id="stat-present">0</strong>
                                </div>

                                <div class="stat-box" style="background-color: #f8d7da; color: #842029;">
                                    <i class="fa fa-user-times"></i> Absent: <strong id="stat-absent">0</strong>
                                </div>

                                <div class="stat-box" style="background-color: #fff3cd; color: #664d03;">
                                    <i class="fa fa-bed"></i> Leave: <strong id="stat-leave">0</strong>
                                </div>
                            </div>

                            <div class="row align-items-center nospacing">
                                <div class="col-md-2">
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                                <path
                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                    fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <input class="form-control form-control-solid ps-14 min-w-150px me-2"
                                            placeholder="Search by name" type="text" name="search" value=""
                                            id="SearchByPatientName">
                                        <button style="opacity: 0; display: none !important" id="table-search-btn"></button>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="branch">
                                        <option value="">Branch</option>
                                        @foreach ($dashboardData['allCompanyBranch'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select class="form-control" id="department_id">
                                        <option value="">Department</option>
                                        @foreach ($dashboardData['allDepartment'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="designation_id">
                                        <option value="">Designation</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select class="form-control" id="status">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="check_attendance">
                                        <option value="">Attendance</option>
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                        <option value="leave">Leave</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Employee Table -->
                            <div class="card-body" id="employee-table">
                                @include('company.dashboard.list', ['employees' => $dashboardData['all_users_details']])
                            </div>
                    </div>
                </div>
            </div>
            <div class="row gy-5 g-xl-10 mt-5">
                <!--begin::Col-->
                <div class="col-md-12">
                    <div class="mb-5 mb-xl-10">
                        @if ($daysLeft && $daysLeft <= 7) @if ($daysLeft < 0)
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <p class="font-bold text-danger">❌ Subscription Expired {{ abs($daysLeft) }} day(s) ago.
                                        <button class="btn btn-primary mx-auto mt-3" type="button" data-bs-toggle="modal"
                                            data-bs-target="#contactUsModal">Contact Us</button>
                                    </p>
                                </div>
                            @elseif ($daysLeft == 0)
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <p class="font-bold">⚠️ Subscription Expiring <strong>Today</strong>!
                                        <button class="btn btn-primary mx-auto mt-3" type="button" data-bs-toggle="modal"
                                            data-bs-target="#contactUsModal">Contact Us</button>
                                    </p>
                                </div>
                            @else
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <p class="font-bold">⚠️ Subscription Expiring Soon! Your subscription will expire in
                                        <strong>{{ $daysLeft }} day(s)</strong>.
                                        <button class="btn btn-primary mx-auto mt-3" type="button" data-bs-toggle="modal"
                                            data-bs-target="#contactUsModal">Contact Us</button>
                                    </p>
                                </div>
                            @endif
                        @endif
                        {{-- <div class="row g-5 g-xl-10 mb-3">
                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <a href="{{ route('branch') }}">
                                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                        style="background-color: #1642b3; background-image:url('assets/media/wave-bg-purple.svg')">
                                        <!--begin::Header-->
                                        <div class="card-header pt-5 mb-3">
                                            <!--begin::Icon-->
                                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                                style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                                <i class="fa fa-globe-asia text-white fs-2qx lh-0"></i>
                                            </div>
                                            <!--end::Icon-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Card footer-->
                                        <div class="card-footer"
                                            style="border-top: 1px solid rgba(255, 255, 255, 0.3); background: rgba(0, 0, 0, 0.15); border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
                                            <div class="fw-bold text-white py-2">
                                                <span class="fs-1 d-block">{{ $dashboardData['allCompanyBranch']->count()
                                                    }}</span>
                                                <span class="opacity-50">Total Offices</span>
                                            </div>
                                        </div>
                                        <!--end::Card footer-->
                                    </div>
                                </a>

                                <!--end::Card widget 3-->
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <a href="{{ route('employee.index') }}">
                                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                        style="background-color: #1642b3; background-image:url('assets/media/wave-bg-purple.svg')">
                                        <!--begin::Header-->
                                        <div class="card-header pt-5 mb-3">
                                            <!--begin::Icon-->
                                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                                style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                                <i class="fa fa-users text-white fs-2qx lh-0"></i>
                                                <!-- Changed icon to represent active employees -->
                                            </div>
                                            <!--end::Icon-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Card footer-->
                                        <div class="card-footer"
                                            style="border-top: 1px solid rgba(255, 255, 255, 0.3); background: rgba(0, 0, 0, 0.15); border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
                                            <div class="fw-bold text-white py-2">
                                                <span class="fs-1 d-block">{{ $dashboardData['total_active_employee']
                                                    }}</span>
                                                <span class="opacity-50">Total Employees</span>
                                            </div>
                                        </div>
                                        <!--end::Card footer-->
                                    </div>
                                </a>
                                <!--end::Card widget 3-->
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <a href="{{ route('attendance.index') }}">
                                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                        style="background-color: #1642b3; background-image:url('assets/media/wave-bg-purple.svg')">
                                        <!--begin::Header-->
                                        <div class="card-header pt-5 mb-3">
                                            <!--begin::Icon-->
                                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                                style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                                <i class="fa fa-user-check text-white fs-2qx lh-0"></i>
                                                <!-- Kept as is for "Total Present" -->
                                            </div>
                                            <!--end::Icon-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Card footer-->
                                        <div class="card-footer"
                                            style="border-top: 1px solid rgba(255, 255, 255, 0.3); background: rgba(0, 0, 0, 0.15); border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
                                            <div class="fw-bold text-white py-2">
                                                <span class="fs-1 d-block">{{ $dashboardData['total_attendance_request']
                                                    }}</span>
                                                <span class="opacity-50">Total Attendance Request</span>
                                            </div>
                                        </div>
                                        <!--end::Card footer-->
                                    </div>
                                </a>
                                <!--end::Card widget 3-->
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <a href="{{ route('leave.status.log.index') }}">
                                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                        style="background-color: #1642b3; background-image:url('assets/media/wave-bg-purple.svg')">
                                        <!--begin::Header-->
                                        <div class="card-header pt-5 mb-3">
                                            <!--begin::Icon-->
                                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                                style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                                <i class="fa fa-calendar-times text-white fs-2qx lh-0"></i>
                                            </div>
                                            <!--end::Icon-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Card footer-->
                                        <div class="card-footer"
                                            style="border-top: 1px solid rgba(255, 255, 255, 0.3); background: rgba(0, 0, 0, 0.15); border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
                                            <div class="fw-bold text-white py-2">
                                                <span class="fs-1 d-block">{{ $dashboardData['total_request_leave']
                                                    }}</span>
                                                <span class="opacity-50">Leave Request</span>
                                            </div>
                                        </div>
                                        <!--end::Card footer-->
                                    </div>
                                </a>
                                <!--end::Card widget 3-->
                            </div>
                        </div> --}}
                        <style>
                            .nospacing .col-md-2 {
                                padding: 0 3px !important;
                            }

                            ` .nospacing {
                                padding: 0 10px 10px;
                                border-bottom: 1px solid var(--kt-card-border-color);
                            }
                        </style>
                        {{-- <div class="custom-table card card-body col-md-12 mb-3">

                        </div> --}}
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <div class="modal fade" id="contactUsModal" tabindex="-1" aria-labelledby="contactUsModal" aria-hidden="true"
            style="display: none;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content dark-sign-up overflow-hidden">
                    <div class="modal-body social-profile text-start">
                        <div class="modal-toggle-wrapper">
                            <h4 class="text-dark">Contact Us</h4>
                            <p>
                                Fill in your information below to continue.</p>
                            <form class="row g-3" id="contact_us_form">
                                @csrf
                                <div class="col-md-12">
                                    <label class="form-label">Subject</label>
                                    <input class="form-control" type="text" name="subject" placeholder="Enter Subject"
                                        id="subject">
                                    @error('subject')
                                        <span class="text-denger">{{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" placeholder="Enter Message" name="message" id=""
                                        cols="30" rows="10"></textarea>
                                    @error('message')
                                        <span class="text-denger">{{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const ctxKPI = document.getElementById('kpiChart').getContext('2d');
            const kpiData = @json($dashboardData['kpiData']); // ← From backend

            new Chart(ctxKPI, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: 'KPI',
                        data: kpiData, // ← Use backend data here
                        borderColor: '#ff6633',
                        backgroundColor: 'rgba(255, 102, 51, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#000'
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }
                }
            });
        </script>
        <script>
            const ctx = document.getElementById('attendanceChart').getContext('2d');

            const chartLabels = @json($dashboardData['attendance_chart_labels']);
            const chartData = @json($dashboardData['attendance_chart_data']);

            const onTimeData = chartLabels.map(label => chartData[label]?.on_time || 0);
            const lateData = chartLabels.map(label => chartData[label]?.late || 0);
            const absentData = chartLabels.map(label => chartData[label]?.absent || 0);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [
                        {
                            label: 'Present (%)',
                            data: onTimeData,
                            backgroundColor: 'rgba(40, 167, 69, 0.7)', // Green
                        },
                        {
                            label: 'Late (%)',
                            data: lateData,
                            backgroundColor: 'rgba(255, 193, 7, 0.7)', // Yellow
                        },
                        {
                            label: 'Absent (%)',
                            data: absentData,
                            backgroundColor: 'rgba(220, 53, 69, 0.7)', // Red
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: value => value + '%'
                            },
                            title: {
                                display: true,
                                text: 'Percentage'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: ctx => `${ctx.dataset.label}: ${ctx.raw}%`
                            }
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        </script>

        <script>
            // Mini circle charts for tasks
            const circleProgress = (canvasId, percent, color = '#ff5e57') => {
                const canvas = document.querySelector(`#${canvasId} canvas`);
                const ctx = canvas.getContext("2d");
                const radius = 20;
                const lineWidth = 4;
                const startAngle = -0.5 * Math.PI;
                const endAngle = startAngle + (2 * Math.PI * (percent / 100));
                ctx.lineWidth = lineWidth;
                ctx.strokeStyle = "#eee";
                ctx.beginPath();
                ctx.arc(radius, radius, radius - lineWidth, 0, 2 * Math.PI);
                ctx.stroke();

                ctx.strokeStyle = color;
                ctx.beginPath();
                ctx.arc(radius, radius, radius - lineWidth, startAngle, endAngle);
                ctx.stroke();
            };

            circleProgress("circle1", 45);
            circleProgress("circle2", 68);
            circleProgress("circle3", 0);
            circleProgress("circle4", 12);

            // NPS Gauge Chart
            new Chart(document.getElementById("npsGauge"), {
                type: "doughnut",
                data: {
                    labels: ["NPS Score", "Remaining"],
                    datasets: [{
                        data: [84, 16],
                        backgroundColor: ["#1642b3", "#f5f6fa"],
                        borderWidth: 0,
                        cutout: "80%",
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    rotation: -90,
                    circumference: 180,
                }
            });

            // // Pie Chart for Employment Status
            // new Chart(document.getElementById("employeePie"), {
            //     type: "doughnut",
            //     data: {
            //         labels: ["Permanent", "Contract", "Probation", "Internship"],
            //         datasets: [{
            //             data: [584, 323, 211, 124],
            //             backgroundColor: ["#1642b3", "#ffa502", "#1e90ff", "#70a1ff"],
            //             borderWidth: 0,
            //             cutout: "75%",
            //         }]
            //     },
            //     options: {
            //         plugins: { legend: { display: false } }
            //     }
            // });
        </script>
        <script>
            /** get all Designation Using Department Id*/
            jQuery('#department_id').on('change', function () {
                var department_id = $(this).val();
                const all_department_id = [department_id];
                get_all_designation_using_department_id(all_department_id);
            });

            function get_all_designation_using_department_id(all_department_id, designationId = '') {
                if (all_department_id) {
                    $.ajax({
                        url: "{{ route('get.all.designation') }}"
                        , type: "GET"
                        , dataType: "json"
                        , data: {
                            'department_id': all_department_id
                        }
                        , success: function (response) {
                            var select = $('#designation_id');
                            select.empty();
                            if (response.status == true) {
                                $('#designation_id').append(
                                    '<option>Select The Designation</option>');
                                $.each(response.data, function (key, value) {
                                    select.append('<option ' + ((designationId == value.id) ? "selected" :
                                        "") + ' value=' + value.id + '>' + value.name + '</option>');
                                });
                            } else {
                                select.append('<option value="">' + response.error +
                                    '</option>');
                            }
                        }
                        , error: function () {
                            Swal.fire({
                                icon: "error"
                                , title: "Oops..."
                                , text: "Something Went Wrong!! Please try Again"
                            });
                            return false;
                        }
                    });
                } else {
                    $('#designation_id').empty();
                }

            }

        </script>
        <script>
            $(document).ready(function () {
                function fetchEmployees(url = "{{ route('company.dashboard') }}") {
                    $.ajax({
                        url: url
                        , type: "GET"
                        , data: {
                            branch: $('#branch').val()
                            , department: $('#department_id').val()
                            , designation: $('#designation_id').val()
                            , status: $('#status').val()
                            , name: $('#SearchByPatientName').val()
                            , attendance_check: $('#check_attendance').val()
                            ,
                        }
                        , beforeSend: function () {
                            $('#employee-table').html('<div class="text-center">Loading...</div>');
                        }
                        , success: function (data) {
                            totalTodayStatus();
                            $('#employee-table').html(data);
                        }
                    });
                }

                $('#branch, #department_id, #designation_id, #status, #SearchByPatientName, #check_attendance')
                    .on('change keyup', function () {
                        fetchEmployees();
                    });

                $(document).on('click', '#employee-table .pagination a', function (e) {
                    e.preventDefault();
                    fetchEmployees($(this).attr('href'));
                });
            });



            jQuery(document).ready(function ($) {
                jQuery("#contact_us_form").validate({
                    rules: {
                        subject: "required"
                        , message: "required"
                        ,
                    }
                    , messages: {
                        subject: "Please enter subject"
                        , message: "Please enter message"
                        ,
                    }
                    , submitHandler: function (form) {
                        var companyTypeData = $(form).serialize();
                        $.ajax({
                            url: "{{ route('company.send-enquiry') }}"
                            , type: 'POST'
                            , data: companyTypeData
                            , success: function (response) {
                                jQuery('#contactUsModal').modal('hide');
                                swal.fire("Done!", response.message, "success");
                                jQuery("#contact_us_form")[0].reset();

                            }
                            , error: function (error_messages) {
                                let errors = error_messages.responseJSON.error;
                                for (var error_key in errors) {
                                    $(document).find('[name=' + error_key + ']').after(
                                        '<span class="' + error_key +
                                        '_error text text-danger">' + errors[
                                        error_key] + '</span>');
                                    setTimeout(function () {
                                        jQuery("." + error_key + "_error").remove();
                                    }, 5000);
                                }
                            }
                        });
                    }
                });

            });

        </script>
        <script>
            $(document).ready(function () {
                totalTodayStatus();
            });

            function totalTodayStatus() {
                $.ajax({
                    url: "{{route('today.status')}}", // 🔁 Update with your actual route
                    type: 'GET'
                    , dataType: 'json'
                    , success: function (response) {
                        $('#stat-total').text(response.total);
                        $('#stat-present').text(response.present);
                        $('#stat-absent').text(response.absent);
                        $('#stat-leave').text(response.leave);
                    }
                    , error: function () {
                        console.log('Failed to fetch today\'s attendance stats.');
                    }
                });
            }

        </script>
        <script>
            const chartEmployeeLabels = {!! json_encode(collect($dashboardData['employee_type_chart'])->pluck('label')) !!};
            const chartEmployeeData = {!! json_encode(collect($dashboardData['employee_type_chart'])->pluck('count')) !!};
            const chartEmployeeColors = {!! json_encode(collect($dashboardData['employee_type_chart'])->pluck('color')) !!};

            new Chart(document.getElementById("employeePie"), {
                type: "doughnut",
                data: {
                    labels: chartEmployeeLabels,
                    datasets: [{
                        data: chartEmployeeData,
                        backgroundColor: chartEmployeeColors,
                        borderWidth: 0,
                        cutout: "75%",
                    }]
                },
                options: {
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        </script>
        <script>
            const calendarDays = document.getElementById('calendar-days');
            const monthYear = document.getElementById('monthYear');
            const schedule = document.getElementById('schedule');

            let selectedDate = new Date(); // current date
            const today = new Date();

            function renderCalendar(year, month) {
                calendarDays.innerHTML = `
                    <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                `;

                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                for (let i = 0; i < firstDay; i++) {
                    const empty = document.createElement('div');
                    empty.className = 'inactive';
                    calendarDays.appendChild(empty);
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    const dateBtn = document.createElement('div');
                    dateBtn.textContent = day;

                    const thisDate = new Date(year, month, day);

                    const isToday =
                        thisDate.getDate() === today.getDate() &&
                        thisDate.getMonth() === today.getMonth() &&
                        thisDate.getFullYear() === today.getFullYear();

                    const isSelected =
                        thisDate.getDate() === selectedDate.getDate() &&
                        thisDate.getMonth() === selectedDate.getMonth() &&
                        thisDate.getFullYear() === selectedDate.getFullYear();

                    if (isToday) dateBtn.classList.add('today');
                    if (isSelected) dateBtn.classList.add('selected');

                    dateBtn.addEventListener('click', () => {
                        selectedDate = new Date(year, month, day);
                        renderCalendar(year, month);
                        updateSchedule();
                    });

                    calendarDays.appendChild(dateBtn);
                }

                monthYear.textContent = `${selectedDate.toLocaleString('default', { month: 'long' })} ${year}`;
            }

            function updateSchedule() {
                const formattedDate = selectedDate.toLocaleDateString('en-CA'); // always returns yyyy-mm-dd correctly
                const displayDate = `${selectedDate.getDate()} ${selectedDate.toLocaleString('default', { month: 'short' })} ${selectedDate.getFullYear()}`;

                fetch(`/company/calendar/events?date=${formattedDate}`)
                    .then(res => res.json())
                    .then(data => {
                        const events = data.events || [];
                        const birthdayCount = data.birthday_count || 0;
                        const anniversaryCount = data.anniversary_count || 0;

                        let html = `
                    <div class="event-date-header">
                        <h5>${displayDate}</h5>
                        <div class="badge-counts">
                            <span class="badge bg-info">🎂 ${birthdayCount} Birthday${birthdayCount !== 1 ? 's' : ''}</span>
                            <span class="badge bg-success">🎉 ${anniversaryCount} Anniversary${anniversaryCount !== 1 ? 'ies' : 'y'}</span>
                        </div>
                    </div>
                `;

                        if (events.length > 0) {
                            html += events.map(event => {
                                let icon = '';
                                switch (event.type) {
                                    case 'birthday':
                                        icon = '🎂';
                                        break;
                                    case 'anniversary':
                                        icon = '🎉';
                                        break;
                                    case 'announcement':
                                        icon = '📢';
                                        break;
                                    case 'news':
                                        icon = '📰';
                                        break;
                                    case 'policy':
                                        icon = '📋';
                                        break;
                                    default:
                                        icon = '📌';
                                }

                                return `
                            <div class="event-item">
                                <div class="event-icon">${icon}</div>
                                <div class="event-details">
                                    <div class="event-title">${event.title}</div>
                                </div>
                            </div>
                        `;
                            }).join('');
                        } else {
                            html += `<p class="no-events">No events scheduled for this day.</p>`;
                        }

                        document.getElementById('schedule').innerHTML = html;
                    })
                    .catch(() => {
                        document.getElementById('schedule').innerHTML = `<h4>${displayDate}</h4><p>Unable to load events.</p>`;
                    });
            }


            function prevMonth() {
                selectedDate.setMonth(selectedDate.getMonth() - 1);
                renderCalendar(selectedDate.getFullYear(), selectedDate.getMonth());
                updateSchedule();
            }

            function nextMonth() {
                selectedDate.setMonth(selectedDate.getMonth() + 1);
                renderCalendar(selectedDate.getFullYear(), selectedDate.getMonth());
                updateSchedule();
            }

            // Init
            renderCalendar(selectedDate.getFullYear(), selectedDate.getMonth());
            updateSchedule();
        </script>

@endsection
