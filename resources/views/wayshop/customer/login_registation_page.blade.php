@extends('wayshop.layouts.master')


@section('main-content')
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-12">
                <div class="contact-form-right">
                    <h2>New User SignUp !</h2>
                    <form action="{{ route('customers.register') }}" method="POST" id="registationForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Your Name" required data-error="Please enter your name">
                                    <span
                                        style="color: red;">{{ ($errors->has('name'))? $errors->first('name') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" placeholder="Your Email" id="email" class="form-control"
                                        name="email" required data-error="Please enter your email">
                                    <span
                                        style="color: red;">{{ ($errors->has('email'))? $errors->first('email') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Your Password" required data-error="Please enter your password">
                                    <div class="help-block with-errors"></div>
                                    <span
                                        style="color: red;">{{ ($errors->has('password'))? $errors->first('password') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" id="submit" type="submit">Signup</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-1 col-sm-12 shadow" id="or">
                OR
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="contact-form-right">
                    <h2>Already a Member? Please SignIn !</h2>
                    <form action="" method="POST" id="loginForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Your Email" id="email" class="form-control"
                                        name="email" required data-error="Please enter your email">
                                    <span
                                        style="color: red;">{{ ($errors->has('email'))? $errors->first('email') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Your Password" required data-error="Please enter your password">
                                    <span
                                        style="color: red;">{{ ($errors->has('password'))? $errors->first('password') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" id="submit" type="submit">Login</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $("#registationForm").validate({
            rules: {
                name: "required",
                email:{
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6,
                },
            },
            messages: {
               name: 'Please enter your full name',
               email: {
                   required: "Please enter your email",
                   email: "Please enter your valid email"
               },
               password: {
                   required: "Please enter your password",
                   minlength: "Password minimum length is 6"
               }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
<style type="text/css">
    .error {
        color: red;
        font-weight: bold;
    }

    #or {
        height: 20px;
        background-color: rgb(255, 63, 15);
        color: #fff;
        padding: 20px;
        line-height: 6px;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        border-radius: 40%;
        margin-top: 80px;
    }

    #or:hover {
        background: rgb(170, 13, 13);
    }
</style>
@endsection