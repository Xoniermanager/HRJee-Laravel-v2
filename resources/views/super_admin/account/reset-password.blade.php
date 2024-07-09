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
    <link rel="stylesheet" href="{{ asset('assets/css/mark-pro.css') }}" />
    <!--end::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <link rel="icon" type="image/png" href="{{ asset('assets/media/logos/favicon.png') }}">
    <!--end::Global Stylesheets Bundle-->

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
                {{-- /Users/xonier/Documents/HRJee-Laravel-v2/ --}}
                style="background-image: url({{ asset('assets/media/misc/bg7.jpg') }});background-size: cover;height: 100%;">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center w-100">

                    <!--end::Logo-->
                    <div class="w-450px">
                        <!--begin::Wrapper-->
                        <div class="card card-body p-10 zoom-out">
                            <!--begin::Logo-->
                            <a class="mb-0 mb-lg-12 text-center">
                                <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" class="h-75px" />

                            </a>
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            <!--begin::Form-->
                            <form action="{{ route('admin.reset.password.post') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <h4 class="mb-3"> Reset Password?</h4>
                                <p>Enter your email to reset your password.</p>
                                <div class="ad-auth-form">
                                    <div class="fv-row mb-8 fv-plugins-icon-container">
                                        <label for="">Email</label>
                                        <input type="email" id="email_address"
                                            class="form-control-signin animate-left" name="email" autocomplete="off"
                                            placeholder="enter your email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="fv-row mb-8 fv-plugins-icon-container">
                                        <label for="">Password</label>
                                        <input type="password" id="password" class="form-control-signin animate-left"
                                            name="password" autocomplete="off">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="fv-row mb-8 fv-plugins-icon-container">
                                        <label for="">Confirm Password</label>
                                        <input type="password" id="password-confirm"
                                            class="form-control-signin animate-left" name="password_confirmation"
                                            autocomplete="off">

                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="ad-auth-btn">
                                        <button type="submit" class="btn btn-primary signin-btn"> Reset
                                            Password</button>
                                    </div>
                                    @if (Session::has('message'))
                                        <h4 class="text-success mb-3">Congratulations!</h4>
                                        <h4 class="text-primary mb-3">Your password has been updated. </h4>
                                    @endif
                                    @if (Session::has('error'))
                                        <div class="text-danger">
                                            <p><span>Duhh!</span>{{ Session::get('error') }}</p>
                                        </div>
                                    @endif
                                    <p class="ad-register-text">Go to the login page <a
                                            href="{{ route('super_admin.login.form') }}">Click Here</a></p>
                                </div>
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
    <!--end::Root-->
    <!--end::Main-->
    <script>
        var hostUrl = "assets/index.html";
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
</body>
<!--end::Body-->

</html>
<script>
    $(document).ready(function() {
        $(".alert").delay(2000).slideUp(300);
    });
</script>
