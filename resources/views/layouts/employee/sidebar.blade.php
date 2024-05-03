<div class="float-left position-colps sidemenu-scroll">
    <!--begin::Aside-->
    <a href="{{ route('employee.dashboard') }}">
        <img src="{{ asset('employee/assets/media/logos/logo.png') }}" class="brand-logo">
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
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('employee.dashboard') }}">
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
                                <a class="menu-link" href="{{ route('employee.daily.attendance') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-calendar-days"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Daily Attendance</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('employee.news') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-newspaper"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> News</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('employee.policy') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-file-contract"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> Policy</span>
                                </a>
                                <!--end:Menu link-->
                            </div>

                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('employee.hr.service') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-users-gear"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title"> HR Service</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--begin:Menu item-->
                            <div class="menu-item ">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('employee.support') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-headphones"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Support</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--begin:Menu item-->
                            <div class="menu-item ">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('employee.notification') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-bell"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Notification</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--begin:Menu item-->
                            <div class="menu-item ">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('employee.account') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-file-contract"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Account</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--begin:Menu item-->
                            <div class="menu-item ">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('employee.contact.us') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-5">
                                            <i class="fa fa-phone-flip"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">Contact Us</span>
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
                                        <img src="{{ asset('employee/assets/media/user.jpg') }}" alt="photo">
                                    </div>
                                    <!--end::Avatar-->

                                    <!--begin::User info-->
                                    <div class="ms-2">
                                        <!--begin::Name-->
                                        <a class="text-gray-800 text-hover-primary fs-6 fw-bold lh-1">
                                            Shibli Sone</a>
                                        <!--end::Name-->

                                        <!--begin::Major-->
                                        <span class="text-muted fw-semibold d-block fs-7 lh-1">
                                            Project Manager</span>
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
                                                    <img alt="Logo"
                                                        src="{{ asset('employee/assets/media/user.jpg') }}">
                                                </div>
                                                <!--end::Avatar-->

                                                <!--begin::Username-->
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bold d-flex align-items-center fs-5">
                                                        Shibli Sone
                                                    </div>

                                                    <a class="fw-semibold text-muted text-hover-primary fs-7">
                                                        Project Manager </a>
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
                                            <a href="{{ route('employee.account') }}" class="menu-link px-5">
                                                My Profile
                                            </a>
                                        </div>
                                        <!--end::Menu item-->


                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="{{ route('logout') }}" class="menu-link px-5">
                                                Sign Out
                                            </a>
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
