<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title> HRJEE </title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="robots" content="noindex,nofollow">
	<meta name="title" property='og:title' content='Xonier HRJEE' />
	<meta name="type" property='og:type' content='website' />
	<meta name="image" property='og:image' content="" />
	<meta name="url" property='og:url' content='' />
	<meta name="description" property='og:description' content='' />
	<meta name="author" content="Jyoti Mishra Web Designer at Xonier">
	<!--begin::Fonts(mandatory for all pages)-->
	<link rel="stylesheet" href="assets/css/mark-pro.css" />
	<!--end::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Vendor Stylesheets(used for this page only)-->
	<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Vendor Stylesheets-->
	<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
	<link rel="icon" type="image/png" href="assets/media/logos/favicon.png">

</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="auth-bg">
    <!--begin::Theme mode setup on page load-->
    <!--begin::Main-->
    <!--begin::Root-->
    
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid overflow-hidden">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
                style="background-image: url(assets/media/misc/bg7.jpg);background-size: cover;height: 100%;">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center w-100">
                 
                    <!--end::Logo-->
                    <div class="w-450px">
                        <!--begin::Wrapper-->
                        <div class="card card-body p-10 zoom-out">
                               <!--begin::Logo-->
                    <a href="#" class="mb-0 mb-lg-12 text-center">
                        <img alt="Logo" src="assets/media/logos/logo.png" class="h-75px" />
                      
                    </a>
                            <!--begin::Form-->
                            <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework overflow-hidden"
                                id="kt_sign_in_form" data-kt-redirect-url="/metronic8/demo3/../demo3/index.html"
                                action="{{ route('login') }}" method="POST">
                     
                                @csrf
                                <!--begin::Input group=-->
                                <div class="fv-row mb-8 fv-plugins-icon-container">
                                    <!--begin::Email-->
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ old('email') }}" autocomplete="off"
                                        class="form-control-signin animate-left">
                                        @error('email')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
                                    <!--end::Email-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Input group=-->
                                <div class="fv-row mb-3 fv-plugins-icon-container">
                                    <!--begin::Password-->
                                    <label class="w-100">Password <a href="forget_pass.html" class="float-right text-primary">Forgot
                                            Password ?</a></label>
                                    <input type="password" name="password" autocomplete="off"
                                        class="form-control-signin animate-left" value="{{ old('password') }}">
                                        @error('password')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
                                    
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Input group=-->

                                <!--begin::Submit button-->
                                <div class="text-center mt-10">
                                    <button id="kt_sign_in_submit" class="btn btn-primary signin-btn">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Sign In</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                </div>
                                <!--end::Submit button-->

                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Wrapper-->
                    </div>

                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
	<script>var hostUrl = "assets/index.html";</script>
	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Vendors Javascript(used for this page only)-->
	<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
	<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
	<!--end::Vendors Javascript-->
	<!--begin::Custom Javascript(used for this page only)-->
	<script src="assets/js/widgets.bundle.js"></script>
	<!--end::Custom Javascript-->

</body>
<!--end::Body-->

</html>