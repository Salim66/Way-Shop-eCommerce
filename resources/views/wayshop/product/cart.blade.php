@extends('wayshop.layouts.master')

@section('main-content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Cart</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total_amount = 0;
                            @endphp
                            @foreach($carts as $cart)
                            <tr>
                                <td class="thumbnail-img">
                                    <a href="#">
                                        <img class="img-fluid"
                                            src="{{ URL::to('/') }}/uploads/products/{{ $cart->image }}" alt="" />
                                    </a>
                                </td>
                                <td class="name-pr">
                                    <a href="#">
                                        {{ $cart->product_name }}
                                    </a>
                                </td>
                                <td class="price-pr">
                                    <p>$ {{ $cart->price }}</p>
                                </td>
                                <td class="quantity-box">
                                    <a class="btn btn-sm btn-success"
                                        href="{{ url('/cart/product_quantity/update/'.$cart->id.'/1') }}"><i
                                            class="fa fa-plus"></i></a>
                                    <input type="text" size="4" value="{{ $cart->quantity }}" min="0" step="1"
                                        class="c-input-text qty text" style="width: 100px;">
                                    @if($cart->quantity > 1)
                                    <a class="btn btn-sm btn-danger"
                                        href="{{ url('/cart/product_quantity/update/'.$cart->id.'/-1') }}"><i
                                            class="fa fa-minus"></i></a>
                                    @endif
                                </td>
                                <td class="total-pr">
                                    <p>$ {{ $cart->price * $cart->quantity }}</p>
                                </td>
                                <td class="remove-pr">
                                    <a href="{{ route('cart.product.delete', $cart->id) }}">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                            @php
                            $total_amount += ($cart->price * $cart->quantity);
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-6 col-sm-6">
                <form action="{{ route('cart.apply_coupon') }}" method="POST">
                    @csrf
                    <div class="coupon-box">
                        <div class="input-group input-group-sm">
                            <input class="form-control" name="coupon_code" placeholder="Enter your coupon code"
                                aria-label="Coupon code" type="text">
                            <div class="input-group-append">
                                <button class="btn btn-theme" type="submit">Apply Coupon</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="update-box float-right">
                    <a href="{{ route('index') }}" class="btn hvr-hover text-white btn-lg">Update Cart</a>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-8 col-sm-12"></div>
            <div class="col-lg-4 col-sm-12">
                <div class="order-box">
                    <h3>Order summary</h3>
                    @if(!empty(Session::get('couponAmount')))
                    <div class="d-flex">
                        <h4>Sub Total</h4>
                        <div class="ml-auto font-weight-bold"> $ {{ $total_amount }} </div>
                    </div>
                    <hr class="my-1">
                    <div class="d-flex">
                        <h4>Coupon Amount(-)</h4>
                        <div class="ml-auto font-weight-bold"> $ {{ Session::get('couponAmount') }} </div>
                    </div>
                    <hr>
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5"> $ {{ $total_amount - Session::get('couponAmount') }} </div>
                    </div>
                    @else
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5"> $ {{ $total_amount }} </div>
                    </div>
                    @endif
                    <hr>
                </div>
            </div>
            <div class="col-12 d-flex shopping-box"><a href="{{ route('customer.checkout') }}"
                    class="ml-auto btn hvr-hover">Checkout</a>
            </div>
        </div>

    </div>
</div>
<!-- End Cart -->
@include('wayshop.layouts.instagram')
@endsection