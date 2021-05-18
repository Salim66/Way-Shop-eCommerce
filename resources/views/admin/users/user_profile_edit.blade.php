@extends('admin.layouts.master')

@section('title', 'Users Profile Edit')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-pencil"></i>
        </div>
        <div class="header-title">
            <h1>Edit Users Profile</h1>
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
                            <a class="btn btn-add " href="{{ route('user.profile.view') }}">
                                <i class="fa fa-user-circle-o"></i> View user profile </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('user.profile.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data" class="col-sm-12" id="userProfileform">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-sm-6">
                                <label>User Name</label>
                                <input type="text" name="name" class="form-control" placeholder="User Name"
                                    value="{{ $data->name }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('name'))? @$errors->first('name') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email"
                                    value="{{ $data->email }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('email'))? @$errors->first('email') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter Address"
                                    value="{{ $data->address }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('address'))? @$errors->first('address') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" placeholder="Enter City"
                                    value="{{ $data->city }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('city'))? @$errors->first('city') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>State</label>
                                <input type="text" name="state" class="form-control" placeholder="Enter State"
                                    value="{{ $data->state }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('state'))? @$errors->first('state') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control" placeholder="Enter Country"
                                    value="{{ $data->country }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('country'))? @$errors->first('country') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Pincode</label>
                                <input type="text" name="pincode" class="form-control" placeholder="Enter Pincode"
                                    value="{{ $data->pincode }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('pincode'))? @$errors->first('pincode') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Mobile</label>
                                <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile"
                                    value="{{ $data->mobile }}">
                                <span
                                    class="text-danger">{{ (@$errors->has('mobile'))? @$errors->first('mobile') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="user_photo"><i class="fa fa-image fa-5x text-success"></i></label>
                                <input type="file" name="photo" class="form-control" style="display: none;"
                                    id="user_photo">
                                <img id="user_photo_load" src="{{ URL::to('/') }}/uploads/users/{{ $data->photo }}"
                                    alt="" style="width: 120px; margin-left: 60px;">
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
        $("#userProfileform").validate({
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true
                },
                mobile: "required",
                address: "required",
                city: "required",
                state: "required",
                country: "required",
                pincode: "required",
            },
            messages: {
                name: "Please enter your name",
                email: {
                    required: "Please enter your email",
                    email: "Your email address must be in the format of name@domain.com"
                },
                mobile: "Please enter your mobile number",
                address: "Please enter your adderess",
                city: "Please enter your city",
                state: "Please enter your state",
                country: "Please enter your country",
                pincode: "Please enter your pincode",
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