@extends('layouts.admin.main')

@section('title', 'Dashboard')

@section('content')
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid dashboard-3 default-dashboard dashboard-4">
            <div class="row">
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header card-no-border bg-dark">
                            <div class="header-top daily-revenue-card">
                                <h4>Total Companies</h4>
                            </div>
                        </div>
                        <div class="card-body pb-0 total-sells">
                            <div class="d-flex align-items-center gap-3">
                                <div class="flex-shrink-0"><i class="fa fa-building text-white"></i></div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <h2>{{ $dashboardData['all_company'] }}</h2>
                                    </div>
                                    <p class="text-truncate">Company</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header card-no-border bg-secondary">
                            <div class="header-top daily-revenue-card">
                                <h4>Total Active Companies</h4>
                            </div>
                        </div>
                        <div class="card-body pb-0 total-sells">
                            <div class="d-flex align-items-center gap-3">
                                <div class="flex-shrink-0"><i class="fa fa-building text-white"></i></div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <h2>{{ $dashboardData['total_active_company'] }}</h2>
                                    </div>
                                    <p class="text-truncate">Company</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header card-no-border bg-danger">
                            <div class="header-top daily-revenue-card">
                                <h4>Total Inactive Companies</h4>
                            </div>
                        </div>
                        <div class="card-body pb-0 total-sells">
                            <div class="d-flex align-items-center gap-3">
                                <div class="flex-shrink-0"><i class="fa fa-building text-white"></i></div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <h2>{{ $dashboardData['total_inactive_company'] }}</h2>
                                    </div>
                                    <p class="text-truncate">Company</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header card-no-border bg-dark">
                            <div class="header-top daily-revenue-card">
                                <h4>Total Employee</h4>
                            </div>
                        </div>
                        <div class="card-body pb-0 total-sells-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="flex-shrink-0"><i class="fa fa-users text-white"></i></div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <h2>{{ $dashboardData['all_employee'] }}</h2>
                                    </div>
                                    <p class="text-truncate">Employee</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header card-no-border bg-secondary">
                            <div class="header-top daily-revenue-card">
                                <h4>Total Active Employee</h4>
                            </div>
                        </div>
                        <div class="card-body pb-0 total-sells-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="flex-shrink-0"><i class="fa fa-users text-white"></i></div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <h2>{{ $dashboardData['total_active_employee'] }}</h2>
                                    </div>
                                    <p class="text-truncate">Employee</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header card-no-border bg-danger">
                            <div class="header-top daily-revenue-card">
                                <h4>Total Inactive Employee</h4>
                            </div>
                        </div>
                        <div class="card-body pb-0 total-sells-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="flex-shrink-0"><i class="fa fa-users text-white"></i></div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <h2>{{ $dashboardData['total_inactive_employee'] }}</h2>
                                    </div>
                                    <p class="text-truncate">Employee</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4 chart1">
                <h2 class="mt-4">All Companies and Employees Overview</h2>
                <div class="row mt-5">
                    <div class="col-xl-6 col-sm-6 mb-4">
                        <h3>Total Companies</h3>
                        <canvas id="companyChart" class="employee_chart"></canvas>
                    </div>
                    <div class="col-xl-6 col-sm-6 mb-4">
                        <h3>Total Employees </h3>
                        <canvas id="employeeChart" class="employee_chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="card">
                <h2 class="text-center mt-4">Active Punch-In Employee - {{ date('F Y') }}</h2>
                <div class="mt-4 mb-4">
                    <canvas id="attendanceChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="card card-body col-md-12 mb-3">
                <div class="card-header cursor-pointer p-0 align-items-center">
                    <!--begin::Card title-->
                    <h5>Subscription Expired Details</h5>

                </div>
                <div class="mb-5 mb-xl-10">
                    <div class="card-body py-3">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold">
                                        <th>Sr. No.</th>
                                        <th>Company Name</th>
                                        <th>Email</th>
                                        <th>Contact No.</th>
                                        <th>Subscription Expiry Date</th>
                                        <th>Subscription Plan</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="">
                                    @forelse ($subscriptionExpiredCompanies as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#"
                                                        class="text-dark fw-bold text-hover-primary fs-6">{{ $item->user->name }}</a>

                                                </div>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $item->user->email }}" title="{{ $item->user->email }}">
                                                    <span class="badge py-3 px-4 fs-7 badge-light-success"><i
                                                            class="fa fa-envelope-circle-check"></i>{{ $item->user->email }}</span>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="tel:{{ $item->contact_no }}" title="{{ $item->contact_no }}">
                                                    <span class="badge py-3 px-4 fs-7 badge-light-success"><i
                                                            class="fa fa-phone-flip"></i>{{ $item->contact_no }}</span>
                                                </a>

                                            </td>
                                            <td> <span class="badge py-3 px-4 fs-7 badge-light-danger">
                                                    {{ $item->subscription_expiry_date }}</span> </td>
                                            <td> <span class="badge py-3 px-4 fs-7 badge-light-danger">
                                                    {{ ucfirst($item->subscriptionPlan->title) }}</span> </td>

                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the data from the server-side Laravel variables
        var activeCompanies = @json($dashboardData['total_active_company']);
        var inactiveCompanies = @json($dashboardData['total_inactive_company']);
        var activeEmployees = @json($dashboardData['total_active_employee']);
        var inactiveEmployees = @json($dashboardData['total_inactive_employee']);

        // Create the Doughnut Chart for Companies
        var ctx1 = document.getElementById('companyChart').getContext('2d');
        var companyChart = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Active Companies', 'Inactive Companies'], // Labels for companies
                datasets: [{
                    label: 'Companies',
                    data: [activeCompanies, inactiveCompanies], // Data for Active and Inactive Companies
                    backgroundColor: ['#4CAF50', '#FF5733'], // Colors for Active and Inactive
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Create the Doughnut Chart for Employees
        var ctx2 = document.getElementById('employeeChart').getContext('2d');
        var employeeChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Active Employees', 'Inactive Employees'], // Labels for employees
                datasets: [{
                    label: 'Employees',
                    data: [activeEmployees, inactiveEmployees], // Data for Active and Inactive Employees
                    backgroundColor: ['#4CAF50', '#FF5733'], // Colors for Active and Inactive
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        const attendanceData =
            @json($allAttendanceDetails); // This will give an array of objects with 'date' and 'total_punch_in'
        const dates = attendanceData.map(item => item.date); // Extract the formatted dates (e.g., '11 Jan')
        const punches = attendanceData.map(item => item.total_punch_in); // Extract the punch counts
        // Create the chart
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const attendanceChart = new Chart(ctx, {
            type: 'line', // Line chart type
            data: {
                labels: dates, // X-axis: Dates
                datasets: [{
                    label: 'Active Punch-In',
                    data: punches, // Y-axis: Punch counts
                    borderColor: 'rgb(54, 162, 235)', // Line color
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Area color (under the line)
                    fill: true, // Fill area under the line
                    tension: 0.4 // Smooth the line (0 is a straight line)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Attendance Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Punch In'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
