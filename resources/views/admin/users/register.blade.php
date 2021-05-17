<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CRM Admin Register Panel</title>
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
</head>

<body>
    <!-- Content Wrapper -->
    <div class="login-wrapper">
        <div class="container-center lg">
            <div class="login-area">
                <div class="panel panel-bd panel-custom">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Register</h3>
                                <small><strong>Please enter your data to register.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('register') }}" method="POST" id="loginForm" novalidate>
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Name</label>
                                    <input type="text" value="" id="username"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Email Address</label>
                                    <input type="text" value="" id="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Password</label>
                                    <input type="password" value="" id="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                    <span
                                        class="text-danger"><strong>{{ (@$errors->any('password_confirmation')? $errors->first('password_confirmation') : '') }}</strong></span>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-warning">Register</button>
                                <a class="btn btn-add" href="{{ route('admin.login') }}">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <!-- /.content-wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('admin/assets/')}}/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('admin/assets/')}}/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>
