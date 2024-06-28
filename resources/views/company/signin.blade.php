<!DOCTYPE html>
<html dir="ltr" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HRJEE |Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Explore HRJee for innovative HR solutions. Efficiently manage your payroll with automated HR processes using our advanced payroll management software and system.">
    <!-- Favicon -->
    <link rel="icon" href="assets/images/favicon.webp">

    <!-- CSS
      ============================================ -->

    <!-- Font Family CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from avobe) -->

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/plugins.min.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


</head>
<style>
    body {
        background-color: aliceblue;

        .form {
            display: flex;
            flex-direction: column;
            max-width: 625px;
            margin: 20px auto;
            gap: 20px;
            justify-content: center;
        }

        .form-item {
            display: flex;
            flex-direction: column;
        }

        .form-item.has-error .form-label {
            color: red;
        }

        .form-item.has-error .form-input {
            border-color: red;
            background-color: aliceblue;
        }

        .form-label {
            font-size: 16px;
            color: #161616;
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            border: 0px solid transparent;
            border-radius: 0;
            font-size: 16px;
            font-weight: 500;
            border-bottom: 1px solid #dfe1ea;
            box-shadow: 0 1px 0 0 #dfe1ea;
            padding: 1em 0.5em 0.5em;

            outline: none;
            /* margin: 1em auto; */
            transition: all .5s ease;
        }

        .form-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .form-content {
            display: none;
            flex-direction: column;
            gap: 20px;
        }

        .form-content.active {
            display: flex;
        }


        .btn[disabled] {
            cursor: not-allowed;
        }

        .radio-buttons {
            width: 100%;
            margin: 0 auto;
            text-align: center;
        }

        .custom-radio input {
            display: none;
        }



    }
</style>

<body class="">
    <div id="wrapper" class="clearfix">
        <!-- preloader -->
        <div id="preloader">
            <div id="spinner">
                <div class="preloader-dot-loading">
                    <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
                </div>
            </div>

        </div>


        <!-- Main Content -->
        <div class="main-contents section-space--pb_30 section-space--pt_60">
            <div class="container">
                <div class="row ">
                    <div class="col-md-6 ">
                        <div class="text-center">
                            <a href="">
                                <img class="logo-default" src="{{ asset('assets/images/logo/logo.png') }}" alt="logo"
                                    width="150px">
                            </a>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-5 ">
                                <div class="testimonial-slider text-center">
                                    <div class="swiper-container testimonial-slider__container">
                                        <div class="swiper-wrapper testimonial-slider__wrapper">
                                            <div class="swiper-slide">
                                                <div class="sign_img">
                                                    <img class="logo-default" src="{{ asset('assets/images/features/screen.png') }}"
                                                        alt="logo">
                                                </div>
                                                <div class="author-info mt-3">
                                                    <h6 class="name">India's quickest Payroll management with<br>
                                                        unlimited salary payout &amp; payslip generation for employees.
                                                    </h6>

                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="sign_img">
                                                    <img class="logo-default" src="{{ asset('assets/images/features/dashboard.png') }}"
                                                        alt="logo">
                                                </div>
                                                <div class="author-infom mt-3">
                                                    <h6 class="name">Boost productivity &amp; Performance with<br> our
                                                        unmatched HRJee features</h6>

                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="sign_img">
                                                    <img class="logo-default" src="{{ asset('assets/images/features/4.png') }}"
                                                        alt="logo">
                                                </div>
                                                <div class="author-info mt-3">
                                                    <h6 class="name">
                                                        <p>India's quickest Payroll management with<br> unlimited salary
                                                            payout &amp; payslip generation for employees.</p>
                                                    </h6>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="swiper-pagination swiper-pagination-t01 section-space--mt_30"></div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-12 ">
                        <div class="container">


                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="main-form-wrapper mt-5">
                                        <form class="form" action="{{ route('company.login') }}" method="POST">
                                            @csrf
                                            <div class="form-content ms-4 me-3" data-form-tab>
                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <h6>Sign In</h6>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <p class="account">Don't have an account? <a
                                                                href="{{ route('signup') }}"
                                                                class="text-color-secondary">Sign Up</a></p>
                                                    </div>
                                                </div>
                                                <div class="form-item" data-form-item>
                                                    <div class="floating-label-group">
                                                        <input type="email" id="email" name="email"
                                                            class="form-input" data-form-input required />
                                                        <label class="floating-label">Email Address/UserName</label>
                                                    </div>
                                                    @error('email')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-item" data-form-item>
                                                    <div class="floating-label-group">
                                                        <input type="password" id="password" name="password"
                                                            class="form-input" data-form-input required />
                                                        <label class="floating-label">Password</label>
                                                    </div>
                                                    @error('password')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <p><input type="checkbox" id="vehicle1" name="vehicle1"
                                                                value="Bike"> Remember me</p>
                                                    </div>
                                                    <div class="col-lg-6 text-end">
                                                        <p> <a href="forgot_password.html"
                                                                class="text-color-secondary ">Forgot Password?</a></p>
                                                    </div>
                                                </div>


                                                {{-- <div class="form-buttons">
                          <button class="ht-btn ht-btn-md mt-3 ps-5 pe-5" type="button" >Sign In</button>
                        </div> --}}
                                                <div class="form-buttons">
                                                    {{-- <button class="ht-btn ht-btn-md ht-btn--outline ps-5 pe-5 mt-3 mb-3" type="button"
                            data-btn-previous="true">Return</button> --}}
                                                    <button class="ht-btn ht-btn-md mt-3 mb-3 ps-5 pe-5"
                                                        type="submit">Submit</button>
                                                    <!-- <a href="../hrjee_admin/add_branch.html" class="ht-btn ht-btn-md mt-3 mb-3 ps-5 pe-5" type="button"
                          data-btn-next="true">Submit</a> -->
                                                </div>
                                            </div>

                                    </div>


                                    </form>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="login_footer  text-center">

                                                <span class="copyright-text mt-3">© 2024 HRJEE by <a
                                                        href="https://xoniertechnologies.com/"
                                                        class="text-color-secondary">Xonier Technologies </a> All
                                                    Rights
                                                    Reserved.</span>


                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>







    <!-- Footer Scripts -->
    <!-- JS | Custom script for all pages -->
    <!-- JS
    ============================================ -->
    <!-- Modernizer JS -->
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <!-- jQuery JS -->
    <script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>

    <!-- Plugins JS (Please remove the comment from below plugins.min.js for better website load performance and remove plugin js files from avobe) -->

    <script src="{{ asset('assets/js/plugins/plugins.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- <script>
    
      $("#js-contcheckbox").change(function () {
        if (this.checked) {
          $(".js-montlypricing").css("display", "none");
          $(".js-yearlypricing").css("display", "flex");
          $(".afterinput").addClass("text-success");
          $(".beforeinput").removeClass("text-success");
        } else {
          $(".js-montlypricing").css("display", "flex");
          $(".js-yearlypricing").css("display", "none");
          $(".afterinput").removeClass("text-success");
          $(".beforeinput").addClass("text-success");
        }
      });

    </script> --}}


    <script>
        let wizardBar = document.querySelector('[data-wizard-bar]')
        let btnPrevious = document.querySelector('[data-btn-previous]')
        let currentTab = 0;
        showTab(currentTab);

        function showTab(n) {
            let formTabs = document.querySelectorAll('[data-form-tab]');
            let wizardItem = document.querySelectorAll('[data-wizard-item]')
            formTabs[n].classList.add('active')
            wizardItem[n].classList.add('active')

            if (n == 0) {
                btnPrevious.style.display = "none";
            } else {
                btnPrevious.style.display = "block";
            }
        }

        // function nextPrev(n) {
        //   let formTabs = document.querySelectorAll('[data-form-tab]');

        //   if (n == 1 && !validateForm()) return false;

        //   formTabs[currentTab].classList.remove('active')
        //   currentTab = currentTab + n;
        //   showTab(currentTab);
        // }

        // function validateForm() {
        //   let formTabs, formInputs, i, valid = true;
        //   formTabs = document.querySelectorAll('[data-form-tab]');
        //   formInputs = formTabs[currentTab].querySelectorAll('[data-form-input]');
        //   let formItem = formTabs[currentTab].querySelectorAll('[data-form-item]');

        //   for (i = 0; i < formInputs.length; i++) {
        //     if (formInputs[i].value == "") {
        //       formItem[i].className += " has-error";
        //       valid = false;
        //     }
        //   }
        //   return valid;
        // }

        // function updateWizardBarWidth() {
        //   const activeWizards = document.querySelectorAll(".wizard-item.active");
        //   let wizardItem = document.querySelectorAll('[data-wizard-item]')
        //   const currentWidth = ((activeWizards.length - 1) / (wizardItem.length - 1)) * 100;

        //   wizardBar.style.width = currentWidth + "%";
        // }

        // document.querySelector('*').addEventListener('click', function (event) {
        //   if (event.target.dataset.btnPrevious) {
        //     let wizardItem = document.querySelectorAll('[data-wizard-item]')
        //     wizardItem[currentTab].classList.remove('active')
        //     nextPrev(-1)
        //     updateWizardBarWidth()
        //   }
        //   if (event.target.dataset.btnNext) {
        //     nextPrev(1)
        //     updateWizardBarWidth()
        //   }
        // })
    </script>

</body>



</html>
