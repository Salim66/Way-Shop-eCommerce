@extends('wayshop.layouts.master')

@section('title', 'Whayshop Team Thansk')

@section('main-content')
<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <h1 style="text-align: center">Thanks For Purchasing With Us!</h1><br><br>
        <div class="row">
            <div class="col-lg-12">
                <div style="text-align: center">
                    <h2>YOUR COD ORDER HAS BEEN PLACED</h2>
                    <P>Your order number is {{ Session::get('order_id') }} and total payment amount is
                        {{ Session::get('grand_total') }}</P>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Cart -->
@endsection

@php
Session::forget('order_id');
Session::forget('grand_total');
@endphp