@extends('wayshop.layouts.master')

@section('title', 'Customer Edit')

@section('main-content')
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="contact-form-right">
                    <h2>Edit Address !</h2>
                    <form action="" method="POST" id="registationForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Your Name" id="name" class="form-control"
                                        name="name" required data-error="Please enter your name"
                                        value="{{ @$data->name }}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Your Address" id="address" class="form-control"
                                        name="address" required data-error="Please enter your address"
                                        value="{{ @$data->address }}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Your City" id="city" class="form-control"
                                        name="city" required data-error="Please enter your city"
                                        value="{{ @$data->city }}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="State" id="state" class="form-control" name="state"
                                        required data-error="Please enter your state" value="{{ @$data->state }}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="country" id="country" class="form-control" required
                                        data-error="Please enter your country">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->country_name }}" @if($country->country_name ==
                                            $data->country) selected @endif>{{ $country->country_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Pincode" id="pincode" class="form-control"
                                        name="pincode" required data-error="Please enter your pincode"
                                        value="{{ @$data->pincode }}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Mobile" id="mobile" class="form-control"
                                        name="mobile" required data-error="Please enter your mobile"
                                        value="{{ @$data->mobile }}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" id="submit" type="submit">Update Address</button>
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