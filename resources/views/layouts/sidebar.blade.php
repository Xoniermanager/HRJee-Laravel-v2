<div class="float-left position-colps sidemenu-scroll">
    <!--begin::Aside-->
    <a href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('assets/media/logos/logo.png') }}" class="brand-logo">
    </a>
    <div id="kt_aside" class="aside py-5" data-kt-drawer="true" data-kt-drawer-name="aside"
        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
        data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
        data-kt-drawer-toggle="#kt_aside_toggle">

        <!--begin::Aside menu-->
        <div class="aside-menu flex-column-fluid ps-5 pe-3" id="kt_aside_menu">
            <!--begin::Aside Menu-->
            <div class="w-100 hover-scroll-overlay-y d-flex pe-2" id="kt_aside_menu_wrapper">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention menu-active-bg fw-semibold my-auto"
                    id="#kt_aside_menu" data-kt-menu="true">
                    <div class="menudesign">
                        <div class="menubox">
                            <!--begin:Menu item-->
                            <div class="menu-item active">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('admin.dashboard') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-dashboard"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Dashboard</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('branch') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-globe-americas"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Branch</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('department') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Departments</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('designation') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-file-contract"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Designation</span>
                                </a>
                                <!--end:Menu link-->
                            </div>

                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('employee') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-users-gear"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Employee</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-key"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Role Management</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('roles') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Roles </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('permissions') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Permission</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="salary.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Permission Role</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!-- <div class="menu-item ">
         
           <a class="menu-link" href="role_management.html">
            <span class="menu-icon">
             <span class="svg-icon svg-icon-5">
              <i class="fa fa-key"></i>
             </span>
           
            </span>
            <span class="menu-title"> Role Management</span>
           </a>
           
          </div> -->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-list-check"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Employee Request</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="business_card.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Business Cards </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="custody.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Custody Receiving </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="clearance.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Clearance Letter </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="disposal.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Disposal Report </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="expense.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Employee Expenses </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="effective_date.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Effective Date Notice </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="entitlement.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                End of Service Payments </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="equipment_request.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                IT Services or Equipment Request </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="moving_assests.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Moving assets approval </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="purchase_request.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Purchase Request </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="visa_renewal.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Renewal of visa </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="travel_allowance.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Travel Allowance </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>


                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="maintenance_request.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Maintenance Request </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="vacation_request.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Vacation request </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>

                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="attendance.html">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-calendar-days"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Attendance</span>
                                </a>
                                <!--end:Menu link-->
                            </div>


                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="holiday.html">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-money-bill-wave-alt"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Holiday</span>
                                </a>
                                <!--end:Menu link-->
                            </div>

                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-money-check"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Salary</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="salary_structures.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Salary Structure </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="salary.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Employee Salary</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-calendar-times"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Leave</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="leave_type.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Leave Types </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="leave.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Applied Leaves</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->


                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-newspaper"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">News</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="announcements.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Announcement</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="news.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                News</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="hr_complain.html">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-bullhorn"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> HR Complaint</span>
                                </a>
                                <!--end:Menu link-->
                            </div>

                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-newspaper"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Policies</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="policy_category.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Policy Category </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="policy.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Policies</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="training.html">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-trailer"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Training </span>
                                </a>
                                <!--end:Menu link-->
                            </div>

                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="asset.html">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-laptop"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Company Assets</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--begin:Menu item-->
                            <div class="menu-item ">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="resignation_management.html">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-file"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Resignation Management</span>
                                </a>
                                <!--end:Menu link-->
                            </div>

                        </div>
                        <!--end:Menu item-->
                        <div class="aside-footer flex-column-auto" id="kt_aside_footer">
                            <!--begin::User panel-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-circle symbol-40px">
                                        <img src="{{ asset('assets/media/user.jpg') }}" alt="photo">
                                    </div>
                                    <!--end::Avatar-->

                                    <!--begin::User info-->
                                    <div class="ms-2">
                                        <!--begin::Name-->
                                        <a class="text-gray-800 text-hover-primary fs-6 fw-bold lh-1">
                                            Garima Kaushik</a>
                                        <!--end::Name-->

                                        <!--begin::Major-->
                                        <span class="text-muted fw-semibold d-block fs-7 lh-1">
                                            HR Manager</span>
                                        <!--end::Major-->
                                    </div>
                                    <!--end::User info-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::User menu-->
                                <div class="ms-1">
                                    <div class="btn btn-sm btn-icon btn-active-color-primary position-relative me-n2"
                                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                        data-kt-menu-overflow="true" data-kt-menu-placement="top-end">
                                        <i class="fa fa-cog fs-1"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </div>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                                        data-kt-menu="true" style="">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo" src="{{ asset('assets/media/user.jpg') }}">
                                                </div>
                                                <!--end::Avatar-->

                                                <!--begin::Username-->
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bold d-flex align-items-center fs-5">
                                                        Garima Kaushik
                                                    </div>

                                                    <a class="fw-semibold text-muted text-hover-primary fs-7">
                                                        HR Manager </a>
                                                </div>
                                                <!--end::Username-->
                                            </div>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="#" class="menu-link px-5">
                                                My Profile
                                            </a>
                                        </div>
                                        <!--end::Menu item-->


                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <!-- <a href="signin.html" class="menu-link px-5">
               Sign Out
              </a> -->
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="menu-link px-5"
                                                    style="background: none; border: none; cursor: pointer;">
                                                    Sign Out
                                                </button>
                                            </form>

                                        </div>
                                        <!--end::Menu item-->
                                    </div>

                                    <!--begin::User account menu-->

                                    <!--end::User account menu-->
                                </div>
                                <!--end::User menu-->
                            </div>
                            <!--end::User panel-->
                        </div>


                    </div>




                </div>
                <!--end::Menu-->
            </div>
            <!--end::Aside Menu-->
        </div>
        <!--end::Aside menu-->

    </div>
    <!--end::Aside-->
</div>
