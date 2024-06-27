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
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <link rel="icon" type="image/png" href="{{ asset('assets/media/logos/favicon.png') }}">
    <style>
        .input_wrapper {
            position: relative
        }

        .plastic_select,
        input[type=url],
        input[type=text],
        input[type=tel],
        input[type=number],
        input[type=email],
        input[type=password],
        select,
        textarea {
            font-size: 1.25rem;
            line-height: normal;
            padding: .75rem;
            border: 1px solid #C5C5C5;
            border-radius: .25rem;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            outline: 0;
            color: #555459;
            width: 100%;
            max-width: 100%;
            font-family: Slack-Lato, appleLogo, sans-serif;
            margin: 0 0 .5rem;
            -webkit-transition: box-shadow 70ms ease-out, border-color 70ms ease-out;
            -moz-transition: box-shadow 70ms ease-out, border-color 70ms ease-out;
            transition: box-shadow 70ms ease-out, border-color 70ms ease-out;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            box-shadow: none;
            height: auto;
        }

        .no_touch .plastic_select:hover,
        .no_touch input:hover,
        .no_touch select:hover,
        .no_touch textarea:hover {
            border-color: #2780f8
        }

        .focus,
        .plastic_select:active,
        .plastic_select:focus,
        input[type=url]:active,
        input[type=url]:focus,
        input[type=text]:active,
        input[type=text]:focus,
        input[type=number]:active,
        input[type=number]:focus,
        input[type=email]:active,
        input[type=email]:focus,
        input[type=password]:active,
        input[type=password]:focus,
        select:active,
        select:focus,
        textarea:active,
        textarea:focus {
            border-color: #2780f8;
            box-shadow: 0 0 7px rgba(39, 128, 248, .15);
            outline-offset: 0;
            outline: 0
        }

        .large_bottom_margin {
            margin-bottom: 2rem !important;
        }

        .split_input {
            display: table;
            border-spacing: 0
        }

        .split_input_item {
            display: table-cell;
            border: 1px solid #9e9ea6
        }

        .split_input_item:not(:first-child) {
            border-left: none
        }

        .split_input_item:first-child {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px
        }

        .split_input_item:last-child {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px
        }

        .split_input_item.focused {
            border: 1px double #2780f8;
            box-shadow: 0 0 7px rgba(39, 128, 248, .3)
        }

        .split_input_item input {
            height: 5rem;
            text-align: center;
            font-size: 2.5rem;
            border: none;
            background: 0 0;
            box-shadow: none
        }

        .split_input_item input:active,
        .split_input_item input:focus,
        .split_input_item input:hover {
            box-shadow: none
        }


        .fs_split {
            position: absolute;
            overflow: hidden;
            width: 100%;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #e8e8e8;
            -webkit-transition: background-color .2s ease-out 0s;
            -moz-transition: background-color .2s ease-out 0s;
            transition: background-color .2s ease-out 0s
        }

        .fs_split h1 {
            font-size: 2.625rem;
            line-height: 3rem;
            font-weight: 300;
            margin-bottom: 2rem
        }

        .fs_split label {
            margin-bottom: .5rem
        }

        .fs_split .desc {
            font-size: 1.25rem;
            color: #9e9ea6;
            margin-bottom: 2rem
        }

        .fs_split .email {
            color: #555459;
            font-weight: 700
        }

        .fs_split .header_error_message {
            margin: 0 11%;
            padding: 1rem 2rem;
            background: #fff1e1;
            border: none;
            border-left: .5rem solid #ffa940;
            border-radius: .25rem
        }

        .fs_split .header_error_message h3 {
            margin: 0
        }

        .fs_split .error_message {
            display: none;
            font-weight: 700;
            color: #ffa940
        }

        .fs_split .error input,
        .fs_split .error textarea {
            border: 1px solid #ffa940;
            background: #fff1e1
        }

        .fs_split .error input:focus,
        .fs_split .error textarea:focus {
            border-color: #fff1e1;
            box-shadow: 0 0 7px rgba(255, 185, 100, .15)
        }

        .fs_split .error .error_message {
            display: inline
        }

        .confirmation_code_span_cell {
            display: table-cell;
            font-weight: 700;
            font-size: 2rem;
            text-align: center;
            padding: 0 .5rem;
            width: 2rem
        }

        .confirmation_code_state_message {
            position: absolute;
            width: 100%;
            opacity: 0;
            -webkit-transition: opacity .2s;
            -moz-transition: opacity .2s;
            transition: opacity .2s
        }

        .confirmation_code_state_message.error,
        .confirmation_code_state_message.processing,
        .confirmation_code_state_message.ratelimited {
            font-size: 1.25rem;
            font-weight: 700;
            line-height: 2rem
        }

        .confirmation_code_state_message.processing {
            color: #3aa3e3
        }

        .confirmation_code_state_message.error,
        .confirmation_code_state_message.ratelimited {
            color: #ffa940
        }

        .confirmation_code_state_message ts-icon:before {
            font-size: 2.5rem
        }

        .confirmation_code_state_message svg.ts_icon_spinner {
            height: 2rem;
            width: 2rem
        }

        .confirmation_code_checker {
            position: relative;
            height: 12rem;
            text-align: center
        }

        .confirmation_code_checker[data-state=unchecked] .confirmation_code_state_message.unchecked,
        .confirmation_code_checker[data-state=error] .confirmation_code_state_message.error,
        .confirmation_code_checker[data-state=processing] .confirmation_code_state_message.processing,
        .confirmation_code_checker[data-state=ratelimited] .confirmation_code_state_message.ratelimited {
            opacity: 1
        }

        .large_bottom_margin {
            margin-bottom: 2rem !important;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="auth-bg">
    <!--begin::Theme mode setup on page load-->
    <!--begin::Main-->
    <!--begin::Root-->


    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-2"><!-- col -->
                <h2>
                    <h1>Check your email!
                    </h1>
                </h2>
                <p class="desc">We’ve sent a four-digit confirmation code to <strong></strong>.
                    Enter it below to
                    confirm your email address.</p>
                <br><br><br>
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
                @if ($errors->has('otp'))
                    <div class="error">{{ $errors->first('otp') }}</div>
                @endif

                <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework overflow-hidden" id="kt_sign_in_form"
                    action="{{ route('employee.verifyOtpCheck') }}" method="POST">

                    @csrf
                    <input type="hidden" name='otp' id='otp'>

                    <!--begin::Input group=-->
                    <label><span class="normal">Your </span>confirmation code</label>
                    <div class="confirmation_code split_input large_bottom_margin" data-multi-input-code="true">
                        <div class="confirmation_code_group">
                            <div class="split_input_item input_wrapper">
                                <input type="text" class="inline_input" id='first' maxlength="1">

                            </div>
                            <div class="split_input_item input_wrapper">
                                <input type="text" class="inline_input" id='second' maxlength="1">

                            </div>

                        </div>

                        <div class="confirmation_code_span_cell">—</div>

                        <div class="confirmation_code_group">
                            <div class="split_input_item input_wrapper">
                                <input type="text" class="inline_input" maxlength="1" id='third'>

                            </div>
                            <div class="split_input_item input_wrapper">
                                <input type="text" class="inline_input" maxlength="1" id='fourth'>
                            </div>

                        </div>
                    </div>
                    <!--end::Input group=-->

                    <!--begin::Submit button-->
                    <div class="text-center mt-10">
                        <button id="kt_sign_in_submit" class="btn btn-primary signin-btn" type="button">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">Verify</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>


                    </div>
                    <!--end::Submit button-->

                </form>
 <a href="{{ route('employee.resendOtp') }}">resendOtp</a> 


                    <!--end::Indicator progress-->
                


            </div><!-- endof col -->
        </div>
    </div>
    <script>
        var hostUrl = "assets/index.html";
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <!--end::Custom Javascript-->
    <!--end::Custom Javascript-->
    <script>
        $("#kt_sign_in_submit").on('click', function() {
            let first = $('#first').val();
            let second = $('#second').val();
            let third = $('#third').val();
            let fourth = $('#fourth').val();
            let otp = first + second + third + fourth;
            $('#otp').val(otp);
            $("#kt_sign_in_form").submit();
        })
    </script>
</body>
<!--end::Body-->

</html>
