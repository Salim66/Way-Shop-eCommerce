@extends('wayshop.layouts.master')

@section('title', 'Customer Billing And Shipping Information')

@section('main-content')
<div class="contact-box-main">
    <div class="container">
        <form action="{{ route('customer.checkout.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Bill To!</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="billing_name" name="billing_name"
                                        placeholder="Billing Name" required data-error="Please enter your billing name"
                                        @if(!empty($bill->name))
                                    value="{{ $bill->name }}" @endif>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="billing_address" name="billing_address"
                                        placeholder="Billing Address" required
                                        data-error="Please enter your billing address" @if(!empty($bill->address))
                                    value="{{ $bill->address }}" @endif>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="billing_city" name="billing_city"
                                        placeholder="Billing City" required data-error="Please enter your billing city"
                                        @if(!empty($bill->city))
                                    value="{{ $bill->city }}" @endif>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="billing_state" name="billing_state"
                                        placeholder="Billing State" required
                                        data-error="Please enter your billing state" @if(!empty($bill->state))
                                    value="{{ $bill->state }}" @endif>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="billing_country" id="billing_country" class="form-control">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->country_name }}" @if($country->country_name ==
                                            $bill->country)? selected @endif>{{ $country->country_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="billing_pincode" name="billing_pincode"
                                        placeholder="Billing Pincode" required
                                        data-error="Please enter your billing pincode" @if(!empty($bill->pincode))
                                    value="{{ $bill->pincode }}" @endif>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="billing_mobile" name="billing_mobile"
                                        placeholder="Billing Mobile" required
                                        data-error="Please enter your billing mobile" @if(!empty($bill->mobile))
                                    value="{{ $bill->mobile }}" @endif>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" style="margin-left: 30px;">
                                    <input type="checkbox" class="form-check-input" id="billtoship">
                                    <label class="form-check-label" for="billtoship">Shipping address same as billing
                                        address</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Ship To !</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="shipping_name" name="shipping_name"
                                        placeholder="Shipping Name" required
                                        data-error="Please enter your shipping name" @if(!empty($shipp->name))
                                    value="{{ $shipp->name }}" @endif>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="shipping_address"
                                        name="shipping_address" placeholder="Shipping Address" required
                                        data-error="Please enter your shipping address" @if(!empty($shipp->address))
                                    value="{{ $shipp->address }}" @endif>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="shipping_city" name="shipping_city"
                                        placeholder="Shipping City" required
                                        data-error="Please enter your shipping city" @if(!empty($shipp->city))
                                    value="{{ $shipp->city }}" @endif>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="shipping_state" name="shipping_state"
                                        placeholder="Shipping State" required
                                        data-error="Please enter your billing state" @if(!empty($shipp->state))
                                    value="{{ $shipp->state }}" @endif>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="shipping_country" id="shipping_country" class="form-control">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->country_name }}" @if(@$shipp->country ==
                                            $country->country_name) selected @endif>{{ $country->country_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="shipping_pincode"
                                        name="shipping_pincode" placeholder="Shipping Pincode" required
                                        data-error="Please enter your shipping pincode" @if(!empty($shipp->pincode))
                                    value="{{ $shipp->pincode }}" @endif>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="shipping_mobile" name="shipping_mobile"
                                        placeholder="Shipping Mobile" required
                                        data-error="Please enter your shipping mobile" @if(!empty($shipp->mobile))
                                    value="{{ $shipp->mobile }}" @endif>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" type="submit">Checkout</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection