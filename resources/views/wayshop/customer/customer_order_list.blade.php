@extends('wayshop.layouts.master')

@section('title', 'Order List')

@section('main-content')
<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <h1 style="text-align: center">My Orders!</h1><br><br>
        <div class="row">
            <div class="col-lg-12">
                <div style="text-align: center">
                    <table class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ordered Product</th>
                                <th>Payment Method</th>
                                <th>Grand Total</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>
                                    @foreach($order->orders as $product)
                                    <a href="{{ route('customer.order.detials', $product->order_id) }}">
                                        {{ $product->product_code }}
                                        ({{ $product->product_qty }})
                                    </a>
                                    @endforeach
                                </td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ $order->grand_total }}</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Cart -->
@endsection