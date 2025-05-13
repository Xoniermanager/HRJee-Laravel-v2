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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="{{ asset('assets/media/logos/favicon.png') }}">

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
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-lg-2 order-1" style="background-image: url(assets/media/misc/bg7.jpg);background-size: cover;height: 100%;">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center w-100">

                    <!--end::Logo-->
                    <div class="w-450px">
                        <!--begin::Wrapper-->
                        <div class="card card-body zoom-out p-10">
                            <!--begin::Logo-->
                            <a href="#" class="mb-lg-12 mb-0 text-center">
                                <img alt="Logo" src="assets/media/logos/logo.png" class="h-75px" />
                            </a>
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
                            <!--begin::Form-->
                            <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework overflow-hidden" id="kt_sign_in_form" action="{{ route('login') }}" method="POST">
                                @csrf

                                <!--begin::Email input-->
                                <div class="fv-row fv-plugins-icon-container mb-8">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ old('email') }}" autocomplete="off" class="form-control-signin animate-left">
                                    @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <!--begin::Password input-->
                                <div class="fv-row fv-plugins-icon-container mb-3">
                                    <label class="w-100">
                                        Password
                                        <a href="{{ route('forget.password') }}" class="text-primary float-right">Forgot Password ?</a>
                                    </label>
                                    <div style="position: relative;">
                                        <input type="password" name="password" autocomplete="off" class="form-control-signin animate-left" id="passwordInput" value="{{ old('password') }}">
                                        <span toggle="#passwordInput" class="toggle-password" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer;">
                                            <i class="fa fa-eye-slash" id="toggleIcon"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                    @endif
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <!--begin::Remember me-->
                                <div class="fv-row mb-3">
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="form-check-label">Remember me</span>
                                    </label>
                                </div>

                                <!--begin::Submit button-->
                                <div class="mt-10 text-center">
                                    <button id="kt_sign_in_submit" class="btn btn-primary signin-btn">
                                        <span class="indicator-label">Sign In</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm ms-2 align-middle"></span>
                                        </span>
                                    </button>
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
    <script>
        var hostUrl = "assets/index.html";

    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <!--end::Custom Javascript-->
    <!--end::Custom Javascript-->
    <script>
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 4000);

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector('.toggle-password').addEventListener('click', function() {
                const passwordInput = document.querySelector('#passwordInput');
                const icon = document.querySelector('#toggleIcon');

                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        });

    </script>

</body>
<!--end::Body-->

</html>

