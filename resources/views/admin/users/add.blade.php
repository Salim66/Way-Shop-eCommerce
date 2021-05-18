@extends('admin.layouts.master')

@section('title', 'Users Add')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-users"></i>
        </div>
        <div class="header-title">
            <h1>Add Users</h1>
            <small>Customer list</small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Form controls -->
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonlist">
                            <a class="btn btn-add " href="{{ route('admin.users') }}">
                                <i class="fa fa-list"></i> Customer List </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.user.store') }}" method="POST" class="col-sm-12" id="userAddform">
                            @csrf
                            <div class="form-group col-sm-6">
                                <label>User Name</label>
                                <input type="text" name="name" class="form-control" placeholder="User Name">
                                <span
                                    class="text-danger">{{ (@$errors->has('name'))? @$errors->first('name') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email">
                                <span
                                    class="text-danger">{{ (@$errors->has('email'))? @$errors->first('email') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>User Type</label>
                                <select name="user_type" class="form-control">
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="Super Admin">Super Admin</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Author">Author</option>
                                </select>
                                <span
                                    class="text-danger">{{ (@$errors->has('user_type'))? @$errors->first('user_type') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="******">
                                <span
                                    class="text-danger">{{ (@$errors->has('password'))? @$errors->first('password') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Password Confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="******">
                            </div>
                            <div class="form-group col-sm-6" style="margin-top: 25px;">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<script>
    $(function(){
        $("#userAddform").validate({
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true
                },
                user_type: 'required',
                password: {
                    required: true,
                    minlength: 6,
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                name: "Please enter your name",
                email: {
                    required: "Please enter your email",
                    email: "Your email address must be in the format of name@domain.com"
                },
                user_type: "Select any user type",
                password: {
                    required: "Please enter your strong password",
                    minlength: "Password must be 6 length"
                },
                password_confirmation: {
                    required: "Please enter your confirmation password",
                    equalTo: "Password do not match!"
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
<style>
    .error {
        color: red;
        font-weight: bold;
    }
</style>
@endsection