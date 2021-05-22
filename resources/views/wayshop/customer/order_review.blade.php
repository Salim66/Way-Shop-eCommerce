@extends('wayshop.layouts.master')

@section('title', 'Order Review')

@section('main-content')
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="contact-form-right">
                    <h2>Billing Address!</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $bill->name }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $bill->address }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $bill->city }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $bill->state }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $bill->country }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $bill->pincode }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $bill->mobile }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="contact-form-right">
                    <h2>Shipping Details!</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $shipp->name }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $shipp->address }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $shipp->city }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $shipp->state }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $shipp->country }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $shipp->pincode }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ $shipp->mobile }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total = 0;
                            @endphp
                            @foreach($customer_cart as $cart)
                            <tr>
                                <td class="thumbnail-img">
                                    <a href="#">
                                        <img class="img-fluid"
                                            src="{{ URL::to('') }}/uploads/products/{{ $cart->image }}" alt="" />
                                    </a>
                                </td>
                                <td class="name-pr">
                                    <a href="#">
                                        {{ $cart->product_name }}
                                    </a>
                                </td>
                                <td class="price-pr">
                                    <p>{{ $cart->price }}</p>
                                </td>
                                <td class="quantity-box">
                                    {{ $cart->quantity }}
                                </td>
                                <td class="total-pr">
                                    <p>{{ $cart->price * $cart->quantity }}</p>
                                </td>
                            </tr>
                            @php
                            $total += ($cart->price * $cart->quantity)
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-12 col-sm-6">
                <div class="order-box">
                    <h3>Order Total</h3>
                    <div class="d-flex">
                        <h4>Cart Sub Total</h4>
                        <div class="ml-auto font-weight-bold"> $ {{ $total }} </div>
                    </div>
                    <div class="d-flex">
                        <h4>Shipping Cost(+)</h4>
                        <div class="ml-auto font-weight-bold"> $ 0 </div>
                    </div>
                    <hr class="my-1">
                    <div class="d-flex">
                        <h4>Coupon Discount(-)</h4>
                        @if(!empty(Session::get('couponAmount')))
                        <div class="ml-auto font-weight-bold"> $ {{ Session::get('couponAmount') }} </div>
                        @else
                        <div class="ml-auto font-weight-bold"> $ 0 </div>
                        @endif
                    </div>
                    <hr>
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5"> $ {{ $grand_total = $total - Session::get('couponAmount') }} </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>

        <form action="" method="POST">
            @csrf
            <hr class="mb-4">
            <div class="title-left">
                <h3>Payments</h3>
            </div>
            <input type="hidden" name="grand_total" value="{{ $grand_total }}">
            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input type="radio" id="cod" name="payment_method" class="custom-control-input" value="cod">
                    <label for="cod" class="custom-control-label">Cash On Delivery</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="stripe" name="payment_method" class="custom-control-input" value="stripe">
                    <label for="stripe" class="custom-control-label">Stripe</label>
                </div>
                <div class="col-12 d-flex shopping-box">
                    <button type="submit" class="ml-auto btn hvr-hover" style="color: #fff;"
                        onclick="return selectPaymentMethod()">Place
                        Order</button>
                </div>
            </div>
        </form>


    </div>
</div>
<!-- End Cart -->
@endsection