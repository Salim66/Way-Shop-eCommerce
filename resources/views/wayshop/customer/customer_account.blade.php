@extends('wayshop.layouts.master')

@section('title', 'Customer Account')

@section('main-content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>My Account</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">My Account</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start My Account  -->
<div class="my-account-box-main">
    <div class="container">
        <div class="my-account-page">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{ route('customer.change.password') }}"><i class="fa fa-lock"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Change Password</h4>
                                <p>Change Password</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{ route('customer.order.list') }}"> <i class="fa fa-gift"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Your Orders</h4>
                                <p>Track & View Your Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{ route('customer.address.edit') }}"> <i class="fa fa-location-arrow"></i>
                                </a>
                            </div>
                            <div class="service-desc">
                                <h4>Change Address</h4>
                                <p>Edit address for orders and gifts</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-box">
                <div class="row">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End My Account -->
@endsection