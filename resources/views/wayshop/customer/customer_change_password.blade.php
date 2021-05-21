@extends('wayshop.layouts.master')

@section('title', 'Customer change password')

@section('main-content')
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="contact-form-right">
                    <h2>Customer Change Password !</h2>
                    <form action="" method="POST" id="registationForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" placeholder="Your Old Password" id="old_password"
                                        class="form-control" name="old_password" required
                                        data-error="Please enter your your old password">
                                    <div class="help-block with-errors"></div>
                                    <span
                                        style="color: red;">{{ ($errors->has('old_password'))? $errors->first('old_password') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="new_password" name="new_password"
                                        placeholder="Your New Password" required
                                        data-error="Please enter your new password">
                                    <div class="help-block with-errors"></div>
                                    <span
                                        style="color: red;">{{ ($errors->has('new_password'))? $errors->first('new_password') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" id="submit" type="submit">Update Password</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>
@endsection