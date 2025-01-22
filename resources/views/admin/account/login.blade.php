<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Xonier Employee Self Service">
    <meta name="keywords" content="Xonier Employee Self Service">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="admin/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="admin/assets/images/favicon.png" type="image/x-icon">
    <title>HRJEE Super Admin</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="admin/assets/css/font-awesome.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('/admin/assets/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/rating.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/vector-map.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('admin/assets/css/color-1.css" media="screen')}}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/responsive.css')}}">
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card login-dark">
                    <div>
                        <div><a class="logo" href="index.html"><img class="img-fluid for-light"
                                    src="{{asset('admin/assets/images/logo.png')}}" alt="looginpage" width="120px">
                                <img class="img-fluid for-dark" src="{{asset('admin/assets/images/logo-light.png')}}"
                                    alt="looginpage" width="120px"></a></div>
                        <div class="login-main">
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
                            <form class="theme-form" method="POST" action="{{route('super.admin.login')}}">
                                @csrf
                                <h4>Sign in to account</h4>
                                <p>Enter your email & password to login</p>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" name="email" placeholder="Test@gmail.com"
                                        autocomplete="off">
                                    @if($errors->has('email'))
                                    <span class="text-danger" id="email_error">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="password"
                                            placeholder="*********" autocomplete="off">
                                        <div class="show-hide"><span class="show"> </span></div>
                                    </div>
                                    @if($errors->has('password'))
                                    <span class="text-danger" id="email_error">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox">
                                        <label class="text-muted" for="checkbox1">Remember password</label>
                                    </div><a class="link" href="{{route('admin.forget.password')}}">Forgot password?</a>
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{asset('/admin/assets/js/jquery.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('/admin/assets/js/bootstrap.bundle.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('/admin/assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('/admin/assets/js/icons/feather-icon/feather-icon.js')}}"></script>

    <!-- Sidebar jquery-->
    <script src="{{asset('/admin/assets/js/config.js')}}"></script>
    <!-- Plugins JS start-->

    <!-- Theme js-->
    <script src="{{asset('/admin/assets/js/script.js')}}"></script>
    <script src="{{asset('/admin/assets/js/script1.js')}}"></script>

    <!-- Plugin used-->
</body>

</html>
