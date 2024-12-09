@extends('layouts.admin.main')

@section('title', 'Dashboard')

@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-3 default-dashboard dashboard-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header card-no-border bg-blue ">
                        <div class="header-top daily-revenue-card">
                            <h4>Total Companies</h4>

                        </div>
                    </div>
                    <div class="card-body pb-0 total-sells">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0"><i class="fa fa-building text-white"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h2>12,463</h2>

                                </div>
                                <p class="text-truncate">Company</p>
                            </div>
                        </div>
                        <div id="admissionRatio"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header card-no-border bg-blue">
                        <div class="header-top daily-revenue-card">
                            <h4>Total Users</h4>

                        </div>
                    </div>
                    <div class="card-body pb-0 total-sells-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0"><i class="fa fa-users text-white"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h2>78,596</h2>

                                </div>
                                <p class="text-truncate">Users</p>
                            </div>
                        </div>
                        <div id="order-value"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header card-no-border bg-blue">
                        <div class="header-top daily-revenue-card">
                            <h4>Monthly Revenue </h4>

                        </div>
                    </div>
                    <div class="card-body pb-0 total-sells-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0"><i class="fa fa-money text-white"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h2>$95,789</h2>

                                </div>
                                <p class="text-truncate">Revenue</p>
                            </div>
                        </div>
                        <div id="daily-value"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header card-no-border bg-blue">
                        <div class="header-top daily-revenue-card">
                            <h4>Total Revenue </h4>

                        </div>
                    </div>
                    <div class="card-body pb-0 total-sells-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0"><i class="fa fa-money text-white"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h2>$91,954</h2>

                                </div>
                                <p class="text-truncate">Revenue</p>
                            </div>
                        </div>
                        <div id="daily-revenue"></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-7 col-xl-6 col-sm-12">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                      <div class="header-top">
                        <h4>Notifications</h4>

                      </div>
                    </div>
                    <div class="card-body">
                      <ul class="notification-box">
                        <li class="d-flex">
                          <div class="flex-shrink-0 bg-light-primary"><img src="{{ asset('admin/assets/images/avatar.png')}}" alt="xonier" width="20px"></div>
                          <div class="flex-grow-1"> <a href="#">
                              <h5>xonier Technologies</h5></a>
                            <p class="text-truncate">Subcription expire soon</p>
                          </div><span>10 Sep,2024</span>
                        </li>
                        <li class="d-flex">
                          <div class="flex-shrink-0 bg-light-info"><img src="{{ asset('admin/assets/images/favicon.png')}}" alt="paywho" width="20px"></div>
                          <div class="flex-grow-1"> <a href="#">
                              <h5>Paywho</h5></a>
                            <p class="text-truncate">Subcription expire soon</p>
                          </div><span>12 Oct,2024</span>
                        </li>
                        <li class="d-flex">
                            <div class="flex-shrink-0 bg-light-warning"><img src="{{ asset('admin/assets/images/icon/profit.png')}}" alt="paywho" width="20px"></div>
                            <div class="flex-grow-1"> <a href="#">
                                <h5>Paywho</h5></a>
                              <p class="text-truncate">Payment Due</p>
                            </div><span>12 Oct,2024</span>
                          </li>

                      </ul>
                    </div>
                  </div>
            </div>

            <div class="col-xl-6 col-md-6 proorder-md-2">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top">
                            <h4>User Onboarding graph</h4>
                            <div class="dropdown icon-dropdown">
                                <button class="btn dropdown-toggle" id="userdropdown" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="fa fa-ellipsis-h"></i></button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown">
                                    <a class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                        href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="studay-statistics">
                            <ul class="d-flex align-item-center gap-2">
                                <li> <span class="bg-primary"> </span>Revenue</li>
                                <li> <span class="bg-secondary"> </span>Illustrations</li>
                            </ul>
                        </div>
                        <div id="study-statistics" style="min-height: 205px;">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-7 col-xl-12 box-col-12 proorder-md-8">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top">
                            <h4>Monthly Revenue Of the Organization(May)</h4>

                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="monthly-report">
                            <ul class="d-flex align-item-center gap-2">
                                <li> <span class="bg-primary"> </span>User</li>
                                <li> <span class="bg-secondary"> </span>Company</li>
                            </ul>
                        </div>
                        <div id="monthly-reportchart" style="min-height: 330px;">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-7 col-xl-12 box-col-12 proorder-xl-8 proorder-md-9">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top">
                            <h4>Total revenue of the organization.
                            </h4>
                            <div class="dropdown icon-dropdown">
                                <button class="btn dropdown-toggle" id="userdropdown14" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="fa fa-ellipsis-h"></i></button>
                                <div class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="userdropdown14"><a class="dropdown-item"
                                        href="#">Weekly</a><a class="dropdown-item" href="#">Monthly</a><a
                                        class="dropdown-item" href="#">Yearly</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body sale-statistic">
                        <div class="row">
                            <div class="col-3 statistic-icon">
                                <div class="light-card balance-card widget-hover">
                                    <div class="icon-box"><img src="{{ asset('admin/assets/images/icon/customers.png')}}"
                                            alt=""></div>
                                    <div> <span class="f-w-500 f-light">Company</span>
                                        <h5 class="mt-1 mb-0">1.736</h5>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <div class="dropdown icon-dropdown">
                                            <button class="btn dropdown-toggle" id="incomedropdown"
                                                type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="icon-more-alt"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="incomedropdown"><a class="dropdown-item"
                                                    href="#">Today</a><a class="dropdown-item"
                                                    href="#">Tomorrow</a><a class="dropdown-item"
                                                    href="#">Yesterday </a></div>
                                        </div><span class="f-w-600 font-success">+3,7%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 statistic-icon">
                                <div class="light-card balance-card widget-hover">
                                    <div class="icon-box"><img src="{{ asset('admin/assets/images/icon/revenue.png')}}" alt="">
                                    </div>
                                    <div> <span class="f-w-500 f-light">Revenue</span>
                                        <h5 class="mt-1 mb-0">$9.247 </h5>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <div class="dropdown icon-dropdown">
                                            <button class="btn dropdown-toggle" id="expensedropdown"
                                                type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="icon-more-alt"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="expensedropdown"><a class="dropdown-item"
                                                    href="#">Today</a><a class="dropdown-item"
                                                    href="#">Tomorrow</a><a class="dropdown-item"
                                                    href="#">Yesterday </a></div>
                                        </div><span class="f-w-600 font-danger">-0,10%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 statistic-icon">
                                <div class="light-card balance-card widget-hover">
                                    <div class="icon-box"><img src="{{ asset('admin/assets/images/icon/profit.png')}}" alt="">
                                    </div>
                                    <div> <span class="f-w-500 f-light">Profit</span>
                                        <h5 class="mt-1 mb-0">80%</h5>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <div class="dropdown icon-dropdown">
                                            <button class="btn dropdown-toggle" id="cashbackdropdown"
                                                type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="icon-more-alt"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="cashbackdropdown"><a class="dropdown-item"
                                                    href="#">Today</a><a class="dropdown-item"
                                                    href="#">Tomorrow</a><a class="dropdown-item"
                                                    href="#">Yesterday </a></div>
                                        </div><span class="f-w-600 font-success">+11,6%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="chart-dash-2-line" style="min-height: 285px;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

@endsection
