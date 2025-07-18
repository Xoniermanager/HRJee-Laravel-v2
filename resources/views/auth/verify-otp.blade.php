<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HRJEE - OTP Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/global/plugins.bundle.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/media/logos/favicon.png') }}">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .disabled {
            pointer-events: none;
            color: gray !important;
            text-decoration: none;
            opacity: 0.6;
            cursor: not-allowed;
        }

        #codeExpiredMessage {
            display: none;
            background-color: #ffe8e6;
            border: 1px solid #f5c2c7;
            color: #842029;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
            font-size: 16px;
        }

        .otp-input {
            width: 60px;
            height: 60px;
            font-size: 2rem;
            text-align: center;
            margin: 5px;
        }

        .form-container {
            background: #ffffffcc;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="auth-bg">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid overflow-hidden">
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-lg-2 order-1"
                style="background-image: url('{{ asset('assets/media/misc/bg7.jpg') }}'); background-size: cover; height: 100vh;">
                <div class="d-flex flex-column flex-center w-100">
                    <div class="form-container w-100 bg-white" style="max-width: 450px">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" style="height: 60px;">
                        </div>

                        <form id="kt_sign_in_form" method="POST" action="{{ route('verifyOtpCheck') }}">
                            @csrf
                            <h2 class="text-center mb-3">Check Your Email</h2>
                            <p class="text-muted text-center mb-4">Please enter the 4-digit code sent to your email</p>

                            <input type="hidden" name="otp" id="otp">

                            <div class="d-flex justify-content-center rounded p-3">
                                <input type="text" maxlength="1" id="n0" data-next="1"
                                    class="form-control otp-input authInput border border-primary bg-white">
                                <input type="text" maxlength="1" id="n1" data-next="2"
                                    class="form-control otp-input authInput border border-primary bg-white">
                                <input type="text" maxlength="1" id="n2" data-next="3"
                                    class="form-control otp-input authInput border border-primary bg-white">
                                <input type="text" maxlength="1" id="n3" data-next="4"
                                    class="form-control otp-input authInput border border-primary bg-white">
                            </div>
                            <div class="text-center mt-5">
                                <button id="kt_sign_in_submit" type="button" class="btn btn-primary w-100">
                                    Verify
                                </button>
                            </div>

                            <div id="codeExpiredMessage" class="text-center mt-4">
                                <strong>Code Expired!</strong> Please click "Resend Code" to receive a new one.
                            </div>
                            @if ($errors->has('otp'))
                                <div class="alert alert-danger text-center mt-2" role="alert">
                                    {{ $errors->first('otp') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger text-center mt-2" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success text-center mt-2" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="text-center mt-3">
                                <a href="javascript:void(0)" id="resendLink" class="text-primary">Resend Code <span
                                        id="timer"></span></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const resendLink = document.getElementById("resendLink");
            const timerSpan = document.getElementById("timer");
            const codeExpiredMessage = document.getElementById("codeExpiredMessage");

            const COUNTDOWN_KEY = "otp_countdown_expiry";
            const RESEND_WAIT_TIME = 5 * 60; // 5 minutes

            function startTimer(duration) {
                let timer = duration;
                const interval = setInterval(() => {
                    const minutes = Math.floor(timer / 60);
                    const seconds = timer % 60;
                    timerSpan.textContent = ` (in ${minutes}:${seconds < 10 ? "0" + seconds : seconds})`;

                    if (--timer < 0) {
                        clearInterval(interval);
                        timerSpan.textContent = " - Code Expired";
                        resendLink.classList.remove("disabled");
                        resendLink.style.pointerEvents = "auto";
                        resendLink.style.opacity = "1";
                        codeExpiredMessage.style.display = "block";
                        localStorage.removeItem(COUNTDOWN_KEY);
                    }
                }, 1000);
            }

            const now = Math.floor(Date.now() / 1000);
            const savedExpiry = localStorage.getItem(COUNTDOWN_KEY);

            if (!savedExpiry) {
                // First load → start new timer
                const newExpiry = now + RESEND_WAIT_TIME;
                localStorage.setItem(COUNTDOWN_KEY, newExpiry);
                startTimer(RESEND_WAIT_TIME);
                resendLink.classList.add("disabled");
                resendLink.style.pointerEvents = "none";
                resendLink.style.opacity = "0.5";
            } else if (now < savedExpiry) {
                // Continue running timer
                const remaining = savedExpiry - now;
                startTimer(remaining);
                resendLink.classList.add("disabled");
                resendLink.style.pointerEvents = "none";
                resendLink.style.opacity = "0.5";
            } else {
                // Expired
                timerSpan.textContent = " - Code Expired";
                resendLink.classList.remove("disabled");
                resendLink.style.pointerEvents = "auto";
                resendLink.style.opacity = "1";
                codeExpiredMessage.style.display = "block";
                localStorage.removeItem(COUNTDOWN_KEY);
            }

            resendLink.addEventListener("click", function (e) {
                e.preventDefault();
                const newExpiry = Math.floor(Date.now() / 1000) + RESEND_WAIT_TIME;
                localStorage.setItem(COUNTDOWN_KEY, newExpiry);
                startTimer(RESEND_WAIT_TIME);
                resendLink.classList.add("disabled");
                resendLink.style.pointerEvents = "none";
                resendLink.style.opacity = "0.5";
                codeExpiredMessage.style.display = "none";

                // Redirect to resend route (triggers server to resend OTP)
                window.location.href = "{{ route('resendOtp') }}";
            });

            // Auto move to next input
            document.querySelectorAll('.authInput').forEach((el, idx) => {
                el.addEventListener("keyup", () => {
                    if (el.value.length === 1) {
                        let next = document.getElementById("n" + (idx + 1));
                        if (next) next.focus();
                    }
                });
            });

            // On submit, gather OTP and submit the form
            document.getElementById("kt_sign_in_submit").addEventListener("click", function () {
                let otp = '';
                for (let i = 0; i < 4; i++) {
                    otp += document.getElementById("n" + i).value;
                }
                document.getElementById("otp").value = otp;

                // ⚠️ Do NOT clear localStorage here; keep the timer running in case of error
                document.getElementById("kt_sign_in_form").submit();
            });
        });
    </script>

    <!-- Optional: fade out alerts after 5 seconds -->
    <script>
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.classList.add('fade-out');
                setTimeout(() => alert.remove(), 1000);
            });
        }, 5000);
    </script>
    @if(!Auth::check())
        <script>
            localStorage.removeItem("otp_countdown_expiry");
        </script>
    @endif
</body>

</html>
