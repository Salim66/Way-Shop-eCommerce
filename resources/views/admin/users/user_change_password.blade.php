@extends('admin.layouts.master')

@section('title', 'User Change Password')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-key"></i>
        </div>
        <div class="header-title">
            <h1>User Change Password</h1>
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
                            <h4>Change Password</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('user.change.password.update') }}" method="POST" class="col-sm-12"
                            id="userChangePassword">
                            @csrf
                            <div class="form-group col-lg-6">
                                <label>Current Password</label>
                                <input type="password" class="form-control" name="current_password">
                                <span
                                    class="text-danger"><strong>{{ (@$errors->any('current_password')? $errors->first('current_password') : '') }}</strong></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="new_password">
                                <span
                                    class="text-danger"><strong>{{ (@$errors->any('new_password')? $errors->first('new_password') : '') }}</strong></span>
                            </div>
                            <div class="form-group col-sm-6" style="margin-top: 25px;">
                                <button type="submit" class="btn btn-success">Update</button>
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
        $("#userChangePassword").validate({
            rules: {
                current_password: {
                    required: true,
                    minlength: 6,
                },
                new_password: {
                    required: true,
                    minlength: 6,
                },
            },
            messages: {
                current_password: {
                    required: "Please enter your strong password",
                    minlength: "Password must be 6 length"
                },
                new_password: {
                    required: "Please enter your strong password",
                    minlength: "Password must be 6 length"
                },
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