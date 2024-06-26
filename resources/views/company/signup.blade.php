<!DOCTYPE html>
<html dir="ltr" lang="en">


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRJEE |SignIn</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Explore HRJee for innovative HR solutions. Efficiently manage your payroll with automated HR processes using our advanced payroll management software and system.">
  <!-- Favicon -->
  <link rel="icon" href="assets/images/favicon.webp">

  <!-- CSS
      ============================================ -->

  <!-- Font Family CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
    rel="stylesheet">

  <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from avobe) -->

  <link rel="stylesheet" href="{{asset('assets/css/vendor/vendor.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/plugins/plugins.min.css')}}">

  <!-- Main Style CSS -->
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

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

    .radio-btn {
      margin: 10px;
      width: 185px;
      height: 220px;
      border: 3px solid transparent;
      display: inline-block;
      border-radius: 10px;
      position: relative;
      text-align: center;
      box-shadow: 0 0 20px #c3c3c367;
      cursor: pointer;
    }

    .radio-btn>i {
      color: #ffffff;
      background-color: rgb(255, 96, 88);
      font-size: 20px;
      position: absolute;
      top: -15px;
      left: 50%;
      transform: translateX(-50%) scale(2);
      border-radius: 50px;
      padding: 3px;
      transition: 0.5s;
      pointer-events: none;
      opacity: 0;
    }

    .radio-btn .hobbies-icon {
      width: 150px;
      height: 150px;
      position: absolute;
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .radio-btn .hobbies-icon img {
      display: block;
      width: 100%;
      margin-bottom: 20px;

    }

    .radio-btn .hobbies-icon i {
      color: rgb(255, 96, 88)E9;
      line-height: 80px;
      font-size: 60px;
    }

    .radio-btn .hobbies-icon h3 {
      color: #555;
      font-size: 18px;
      font-weight: 300;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .custom-radio input:checked+.radio-btn {
      border: 2px solid rgb(255, 96, 88);
    }

    .custom-radio input:checked+.radio-btn>i {
      opacity: 1;
      transform: translateX(-50%) scale(1);
    }

    .Dglow {
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
          <div class="col-md-5 ">
            <div class="text-center">
              <a href="index.html">
                <img class="logo-default" src="{{asset('/assets/images/logo/logo.png')}}" alt="logo" width="150px">
              </a>
            </div>

            <div class="row">
              <div class="col-md-12 mt-5 ">
                <div class="testimonial-slider text-center">
                  <div class="swiper-container testimonial-slider__container">
                    <div class="swiper-wrapper testimonial-slider__wrapper">
                      <div class="swiper-slide">
                        <div class="sign_img">
                          <img class="logo-default" src="{{asset('/assets/images/features/screen.png')}}" alt="logo">
                        </div>
                        <div class="author-info mt-3">
                          <h6 class="name">India's quickest Payroll management with<br> unlimited salary payout &amp;
                            payslip generation for employees.</h6>

                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="sign_img">
                          <img class="logo-default" src="{{asset('/assets/images/features/dashboard.png')}}" alt="logo">
                        </div>
                        <div class="author-infom mt-3">
                          <h6 class="name">Boost productivity &amp; Performance with<br> our unmatched HRJee features
                          </h6>

                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="sign_img">
                          <img class="logo-default" src="{{asset('/assets/images/features/4.png')}}" alt="logo">
                        </div>
                        <div class="author-info mt-3">
                          <h6 class="name">
                            <p>India's quickest Payroll management with<br> unlimited salary payout &amp; payslip
                              generation for employees.</p>
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
          <div class="col-md-7 col-xs-12 col-sm-12 ">
            <div class="container">
              <div class="wizard">
                <div class="wizard-bar" style="width: 0;" data-wizard-bar></div>
                <ul class="wizard-list">
                  <li class="wizard-item" data-wizard-item><i class="fas fa-user"></i></li>
                  <li class="wizard-item" data-wizard-item><i class="fas fa-home"></i></li>
                  <li class="wizard-item " data-wizard-item><i class="fas fa-lock"></i></li>
                </ul>
              </div>

              <div class="row">
                <div class="col-lg-12 ">
                  <div class="main-form-wrapper mt-5">
                    <form class="form" method="POST" action="">
                      @csrf
                      <div class="form-content ms-4 me-3" data-form-tab>
                        <div class="row">
                          <div class="col-lg-6">
                            <h6>Create an Account</h6>
                          </div>
                          <div class="col-lg-6">
                            <p class="account">Already have an account? <a href="{{ route('signin') }}"
                                class="text-color-secondary">Sign In</a></p>
                          </div>
                        </div>

                        <div class="form-item " data-form-item>
                          <div class="floating-label-group">
                            <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" data-form-input required />
                            <label class="floating-label">Your Name</label>
                            @error('name')
                                  <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-item " data-form-item>
                          <div class="floating-label-group">
                            <input type="text" id="username" name="username" class="form-input" value="{{ old('username') }}" data-form-input required />
                            <label class="floating-label">Username</label>
                            @error('username')
                                  <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="form-item position-relative" data-form-item>
                          <div class="floating-label-group" id="emailDiv">
                            <input type="email" name="email"  id="emailId" class="form-input" value="{{ old('email') }}" data-form-input required />
                            <label class="floating-label">Business Email</label>
                            @error('email')
                                  <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div id="getOtpButton" class="get-otp-button" onclick="getOtp()">Get OTP</div>
                        </div>

                        <div class="Dglow  " id="Dglow">
                          <div class="form-item" data-form-item>
                            <div class="floating-label-group" id="otpDiv">
                              <input type="text" id="getOtp" name="otp" oninput="verifyOtp()" class="form-input" value="{{ old('otp') }}" data-form-input required />
                              <label class="floating-label">OTP</label>
                              @error('otp')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            </div>
                            <a href="#" onclick="getOtp()" class="text-color-secondary text-end">Resend otp</a>
                          </div>
                        </div>

                        <div class="form-item" data-form-item>
                          <div class="floating-label-group">
                            <input type="number" id="number" name="contact_no" class="form-input" value="{{ old('contact_no') }}" data-form-input required />
                            <label class="floating-label">Contact Number</label>
                            @error('contact_no')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-12">
                            <p>
                              <input type="checkbox" id="vehicle1" name="privacy_policy"  {{ old('privacy_policy') ? 'checked' : '' }} value="1">
                              I agree to HRJee terms of service, privacy policy, and receive communication via whatsapp,
                              sms, phone calls and emails through third party platform.
                            </p>
                            @error('privacy_policy')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-buttons ">
                          <button class="ht-btn ht-btn-md ht-btn--outline mt-3 mb-5" type="button"
                            data-btn-previous="true">Return</button>
                          <button class="ht-btn ht-btn-md mt-3 mb-5 ps-5 pe-5" type="button"
                            data-btn-next="true">Next</button>
                        </div>
                      </div>



                      <div class="form-content ms-4 me-3" data-form-tab>
                        <div class="row">
                          <div class="col-lg-6">
                            <h6>Company Information</h6>
                          </div>

                        </div>

                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-item" data-form-item>
                              <div class="floating-label-group">
                                <select class="form-input" aria-label="Default select example"  name="company_size"  data-form-input required >
                                  <option selected></option>
                                  <option value="10" {{ old('company_size') == 10 ? 'selected' : '' }}>1-10</option>
                                  <option value="20" {{ old('company_size') == 20 ? 'selected' : '' }}>11-20</option>
                                  <option value="50" {{ old('company_size') == 50 ? 'selected' : '' }}>21-50</option>
                                  <option value="100" {{ old('company_size') == 100 ? 'selected' : '' }}>51-100</option>
                                </select>
                                <label class="floating-label">Company size</label>
                                @error('company_size')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                              </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                          <div class="form-item" data-form-item>
                            <div class="floating-label-group">
                              <input type="text" id="branchSize" name="branch_size" class="form-input" value="{{ old('branch_size') }}"  required />
                              <label class="floating-label">Branch Size</label>
                              @error('branch_size')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>
                        </div> --}}
                        </div>
                      

                        <div class="form-item" data-form-item>
                          <div class="floating-label-group">
                            <input type="text" id="companyUrl" name="company_url" class="form-input" value="{{ old('company_url') }}" data-form-input required />
                            <label class="floating-label">Company Url</label>
                          </div>
                        </div>

                        
                        <!-- <div class="form-item" data-form-item>

                          <div class="floating-label-group">

                            <select class="form-input" aria-label="Default select example" required>
                              <option selected></option>
                              <option value="1">HR Team</option>
                              <option value="2">Finance Team</option>
                              <option value="3">Management Team</option>
                              <option value="4">Employee Team</option>
                              <option value="5">Other</option>
                            </select>
                            <label class="floating-label">Your Role</label>
                          </div>
                        </div> -->

                        <div class="form-item" data-form-item>

                          <div class="floating-label-group">

                            <select class="form-input" aria-label="Default select example" name="industry_type"  value="{{ old('industry_type') }}"   data-form-input required >
                              <option selected></option>
                              <option value="1" {{ old('industry_type') == 1 ? 'selected' : '' }}>Automobile</option>
                              <option value="2" {{ old('industry_type') == 2 ? 'selected' : '' }}>Telecommunications</option>
                              <option value="3" {{ old('industry_type') == 3 ? 'selected' : '' }}>Education</option>
                              <option value="4" {{ old('industry_type') == 4 ? 'selected' : '' }}>Healthcare</option>
                              <option value="5" {{ old('industry_type') == 5 ? 'selected' : '' }}>Information Technology(IT)</option>
                              <option value="6" {{ old('industry_type') == 6 ? 'selected' : '' }}>Others</option>
                            </select>
                            <label class="floating-label">Company Industry</label>
                            @error('industry_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="form-item" data-form-item>
                          <div class="floating-label-group">
                            <input type="text" id="companyAddress" name="company_address" class="form-input" value="{{ old('company_address') }}"  data-form-input required>
                            <label class="floating-label">Company Address</label>
                            @error('company_address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="form-buttons ">
                          <button class="ht-btn ht-btn-md ht-btn--outline ps-5 pe-5 mt-3 mb-5" type="button"
                            data-btn-previous="true">Return</button>
                          <button class="ht-btn ht-btn-md mt-3 mb-5 ps-5 pe-5" type="button"
                            data-btn-next="true">Next</button>
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class=" text-end ">

                              <button class="skip mt-3 mb-5 ps-3 pe-3" type="button" data-btn-next="true">Skip</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-content ms-4 me-3" data-form-tab>
                        <div class="row">
                          <div class="col-lg-6">
                            <h6>Just One step Away...</h6>
                          </div>
                        </div>

                        <div class="form-item" data-form-item>
                          <div class="floating-label-group">

                            <input id="password-field" type="password" class="form-input" name="password" value="{{ old('password') }}"  data-form-input required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <label class="floating-label">Password</label>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="form-item" data-form-item>
                          <div class="floating-label-group">

                            <input id="confirmPassword" type="password" class="form-input" name="password_confirmation" value="{{ old('confirm_password') }}" data-form-input required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <label class="floating-label">Confirm Password</label>
                            @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="form-buttons">
                          <button class="ht-btn ht-btn-md ht-btn--outline ps-5 pe-5 mt-3 mb-3" type="button"
                            data-btn-previous="true">Return</button>
                            <button class="ht-btn ht-btn-md mt-3 mb-3 ps-5 pe-5" type="submit">Submit</button>
                          <!-- <a href="../hrjee_admin/add_branch.html" class="ht-btn ht-btn-md mt-3 mb-3 ps-5 pe-5" type="button"
                          data-btn-next="true">Submit</a> -->
                        </div>
                      </div>


                      <div class="form-content ms-4 me-3" data-form-tab>
                        <div class="row">
                          <div class="col-lg-12 ">
                            <div class="submit_message text-center">

                              <span class="fas fa-check"></span>


                              <h6>Thank You</h6>
                              <p>Your Submission has been sent.</p>
                            </div>

                          </div>
                        </div>

                      </div>

                    </form>
                  </div>



                </div>
              </div>
            </div>



          </div>
        </div>
      </div>
    </div>


    <script>
function getOtp() {
    var emailId = $('#emailId').val();
    $.ajax({
        url: "",
        method: "POST",
        data: {
            email: emailId,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            var newContent = '<small>Email sent please check your mail </small>';
            $('#emailDiv').append(newContent);
            document.getElementById("Dglow").style.display = 'block';
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            var response = xhr.responseJSON;
            if (response && response.errors && response.errors.email) {
    var errorMessage = '<small class="error-message">' + response.errors.email[0] + '</small>';
    $('#emailDiv').append(errorMessage);
    setTimeout(function() {
        $('.error-message').fadeOut('slow'); // Hide the error message after 2 seconds
    }, 2000);
} else if (response && response.message) {
    var errorMessage = '<small class="error-message">' + response.message + '</small>';
    $('#emailDiv').append(errorMessage);
    setTimeout(function() {
        $('.error-message').fadeOut('slow'); // Hide the error message after 2 seconds
    }, 2000);
} else {
    var errorMessage = '<small class="error-message">Failed to send OTP. Please try again later.</small>';
    $('#emailDiv').append(errorMessage);
    setTimeout(function() {
        $('.error-message').fadeOut('slow'); // Hide the error message after 2 seconds
    }, 2000);
}

        }
    });
}

      function verifyOtp() {
        var getOtp = $('#getOtp').val();
        var emailId = $('#emailId').val();
        otpLength = getOtp.length;
        if(otpLength == 6){
          $.ajax({
               url: "",
               method: "POST",
               data: {
                  otp: getOtp,
                  email: emailId,
                  _token: '{{ csrf_token() }}'
               },
               success: function(response) {
                console.log(response)
                $('#checkOtp').remove();
                var newContent = '<small id="checkOtp" data-check-otp="'+response.status+'" >'+response.message+'</small>';
                $('#otpDiv').append(newContent);
               },
               error: function(xhr, status, error) {
                  console.error(xhr.responseText);
               }
         });
        }

      }
    </script>


    <script>
      function myFunction() {
        document.getElementById("Dglow").style.display = 'block';
      }
    </script>


    <!-- Footer Scripts -->
    <!-- JS | Custom script for all pages -->
    <!-- JS
    ============================================ -->
    <!-- Modernizer JS -->
    <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>

    <!-- jQuery JS -->
    <script src="{{asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>

    <!-- Bootstrap JS -->
    <script src="{{asset('assets/js/vendor/bootstrap.min.js')}}"></script>

    <!-- Plugins JS (Please remove the comment from below plugins.min.js for better website load performance and remove plugin js files from avobe) -->

    <script src="{{asset('assets/js/plugins/plugins.min.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <script>
     $(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    input = $(this).parent().find("input");
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
      </script>

    <script>

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

    </script>


    <script>
      let wizardBar   = document.querySelector('[data-wizard-bar]')
      let btnPrevious = document.querySelector('[data-btn-previous]')
      let currentTab  = 0;
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

      function nextPrev(n) {
        let formTabs = document.querySelectorAll('[data-form-tab]');

        if (n == 1 && !validateForm()) return false;

        formTabs[currentTab].classList.remove('active')
        currentTab = currentTab + n;
        showTab(currentTab);
      }

      function validateForm() {
        let formTabs, formInputs, i, valid = true;
        formTabs = document.querySelectorAll('[data-form-tab]');
        formInputs = formTabs[currentTab].querySelectorAll('[data-form-input]');
        let formItem = formTabs[currentTab].querySelectorAll('[data-form-item]');

        for (i = 0; i < formInputs.length; i++) {
          if (formInputs[i].value == "") {
            formItem[i].className += " has-error";
            valid = false;
          }
        }

        if (currentTab == 1) { // Replace YOUR_OTP_STEP_INDEX with the index of the step where OTP verification is required
        if (!verifyOtp()) {
            valid = false;
        }
    }
        return valid;
      }

      function updateWizardBarWidth() {
        const activeWizards = document.querySelectorAll(".wizard-item.active");
        let wizardItem = document.querySelectorAll('[data-wizard-item]')
        const currentWidth = ((activeWizards.length - 1) / (wizardItem.length - 1)) * 100;

        wizardBar.style.width = currentWidth + "%";
      }

      document.querySelector('*').addEventListener('click', function (event) {
        if (event.target.dataset.btnPrevious) {
          let wizardItem = document.querySelectorAll('[data-wizard-item]')
          wizardItem[currentTab].classList.remove('active')
          nextPrev(-1)
          updateWizardBarWidth()
        }
        if (event.target.dataset.btnNext) {
          nextPrev(1)
          updateWizardBarWidth()
        }
      })

    </script>

</body>



</html>