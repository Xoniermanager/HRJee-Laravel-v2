<div class="float-left position-colps sidemenu-scroll">
    <!--begin::Aside-->
    <a href="{{ route('company.dashboard') }}">
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
                            <div class="menu-item" data-url="{{ route('company.dashboard') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('company.dashboard') }}">
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
                            <div class="menu-item" data-url="{{ route('country.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('country.index') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Country</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item" data-url="{{ route('state.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('state.index') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">State</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item" data-url="{{ route('previous.company.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('previous.company.index') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Previous Company</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item" data-url="{{ route('department.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('department.index') }}">
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
                            <div class="menu-item" data-url="{{ route('designation.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('designation.index') }}">
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
                            <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-clock"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Office Timing Config</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item" data-url="{{ route('shifts.index') }}">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('shifts.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Shifts </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item" data-url="{{ route('office_time_config.index') }}">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('office_time_config.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Office Time Config</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item" data-url="{{ route('branch') }}">
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

                            <!--begin:Menu item-->
                            <div class="menu-item" data-url="{{ route('employee.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('employee.index') }}">
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
                                    <div class="menu-item" data-url="{{ route('roles') }}">
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
                                    {{-- <div class="menu-item" data-url="{{ route('permissions') }}">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('permissions') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Permission</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div> --}}
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('assign_permission') }}">
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
                                    <span class="menu-title">Assets Management</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item" data-url="{{ route('asset.manufacturer.index') }}">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('asset.manufacturer.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Asset Manufacturer </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item" data-url="{{ route('asset.status.index') }}">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('asset.status.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Asset Status</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item" data-url="{{ route('asset.category.index') }}">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('asset.category.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Asset Category</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <div class="menu-item" data-url="{{ route('asset.index') }}">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('asset.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Asset</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <div class="menu-item" data-url="{{ route('asset.dashboard') }}">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('asset.dashboard') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Asset Dashboard</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--begin:Menu item-->
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item" data-url="{{ route('attendance.status.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('attendance.status.index') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-calendar-days"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Attendance status</span>
                                </a>
                                <!--end:Menu link-->
                            </div>


                            <!--begin:Menu item-->
                            <div class="menu-item" data-url="{{ route('holiday.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('holiday.index') }}">
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
                            <div class="menu-item" data-url="{{ route('attendance.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('attendance.index') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-money-bill-wave-alt"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Attendance</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
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
                                    <span class="menu-title">Complain</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion"
                                    data-url="{{ route('complain.status.index') }}">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('complain.status.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Complain Status</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                </div>
                                <!--end:Menu sub-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion"
                                    data-url="{{ route('complain.category.index') }}">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('complain.category.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Complain Category</span>
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
                                <div class="menu-sub menu-sub-accordion" data-url="{{ route('leave.type.index') }}">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('leave.type.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Leave Types </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('leave.status.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Leave Status </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('leave.index') }}">
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
                            <div class="menu-item" data-url="{{ route('leave.credit.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('leave.credit.index') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-money-bill-wave-alt"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Leaves Credit Management</span>
                                </a>
                                <!--end:Menu link-->
                            </div>

                            <!--begin:Menu item-->
                            <div class="menu-item" data-url="{{ route('leave.status.log.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('leave.status.log.index') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-money-bill-wave-alt"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Leaves Management</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--begin:Menu item-->
                            <div class="menu-item " data-url="{{ route('announcement.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('announcement.index') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-file"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Announcements</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            {{-- <div class="menu-item " data-url="{{ route('announcement.assign.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('announcement.assign.index') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-file"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Announcement Assignments</span>
                                </a>
                                <!--end:Menu link-->
                            </div> --}}
                            <div class="menu-item " data-url="{{ route('getAllEmployeeLeaveAvailableList') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('getAllEmployeeLeaveAvailableList') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-file"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Employee Leave Available</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item " data-url="{{ route('break_type.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('break_type.index') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-file"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Break Type</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item " data-url="{{ route('resignation.status.index') }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('resignation.status.index') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-file"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Resignation Status</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
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
                                    <span class="menu-title">News</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion" data-url="{{ route('news.category.index') }}">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('news.category.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                News Category </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                </div>
                                <!--end:Menu sub-->
                                <div class="menu-sub menu-sub-accordion" data-url="{{ route('news.index') }}">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('news.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Add News</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                </div>
                                <!--end:Menu sub-->
                            </div>
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
                                    <span class="menu-title">Policy</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion"
                                    data-url="{{ route('policy.category.index') }}">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('policy.category.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Policy Category </span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                </div>
                                <!--end:Menu sub-->
                                <div class="menu-sub menu-sub-accordion" data-url="{{ route('policy.index') }}">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('policy.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">
                                                Add Policy</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                </div>
                                <!--end:Menu sub-->
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
                                            {{Auth::guard('company')->user()->name}}</a>
                                        <!--end::Name-->

                                        <!--begin::Major-->
                                        <span class="text-muted fw-semibold d-block fs-7 lh-1">
                                        </span>
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
                                                        {{Auth::guard('company')->user()->name}}
                                                    </div>

                                                    <a class="fw-semibold text-muted text-hover-primary fs-7">
                                                    </a>
                                                </div>
                                                <!--end::Username-->
                                            </div>
                                        </div>
                                        <div class="menu-item px-5">
                                            <a href="{{ route('company.profile') }}" class="menu-link px-5">
                                                My Profile
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <div class="menu-item px-5">
                                            <a href="{{ route('company.logout') }}" class="menu-link px-5">
                                                Sign Out
                                            </a>
                                        </div>
                                    </div>
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
    </div>
    <!--end::Aside-->
</div>
