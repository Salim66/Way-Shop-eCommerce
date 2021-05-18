<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thememinister.com/crm/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jun 2019 11:09:03 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Way Shop Admin Login Panel</title>

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/')}}/dist/img/ico/favicon.png" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="{{ asset('admin/assets/')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap rtl -->
    <!--<link href="{{ asset('admin/assets/')}}//bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Pe-icon-7-stroke -->
    <link href="{{ asset('admin/assets/')}}/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet"
        type="text/css" />
    <!-- style css -->
    <link href="{{ asset('admin/assets/')}}/dist/css/stylecrm.css" rel="stylesheet" type="text/css" />
    <!-- Theme style rtl -->
    <!--<link href="{{ asset('admin/assets/')}}//dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
    <!-- jQuery -->
    <link href="{{ asset('admin/assets/')}}/dist/js/jquery.min.js" rel="stylesheet" type="text/css" />
    <!-- Toastr CSS -->
    <link href="{{ asset('admin/assets/')}}/dist/css/toastr.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <!-- Content Wrapper -->
    <div class="login-wrapper">
        <div class="container-center">
            <div class="login-area">
                <div class="panel panel-bd panel-custom">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3>
                                <small><strong>Please enter your credentials to login.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('login') }}" method="POST" id="loginForm" novalidate>
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="email" placeholder="example@gmail.com" title="Please enter you username"
                                    required="" value="" name="email" id="username"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******"
                                    required="" value="" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-add">Login</button>
                                <a class="btn btn-warning" href="{{ route('admin.register') }}">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('admin/assets/')}}/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('admin/assets/')}}/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Toaster Js-->
    <script src="{{ asset('admin/assets/')}}/dist/js/toastr.min.js" type="text/javascript"></script>
    @include('validation')
</body>

<!-- Mirrored from thememinister.com/crm/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jun 2019 11:09:03 GMT -->

</html>