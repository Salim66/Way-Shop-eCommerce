@extends('wayshop.layouts.master')

@section('title', 'Order Details')

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
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Product Size</th>
                                <th>Product Color</th>
                                <th>Product Price</th>
                                <th>Product Qty</th>
                                <th>Order Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderDetails->orders as $product)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $product->product_code }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_size }}</td>
                                <td>{{ $product->product_color }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td>{{ $product->product_qty }}</td>
                                <td>
                                    <span class="badge badge-success">{{ $orderDetails->order_status }}</span>
                                </td>
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