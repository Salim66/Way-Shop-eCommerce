<!DOCTYPE html>
<html lang="en">

<head>
    <title>Confirmation Email</title>
</head>

<body>
    <div style="border-top-left-radius: 3px; border-top-right-radius: 3px; padding: 10px 15px; background-color: #428bca; border-color: #428bca; color: #fff"
        class="v1panel-heading">
        You Have Mail Recieved from Wayshop Website
    </div>

    <table>

        <tr>
            <td>Hello, {{ $order_info['name'] }}</td>
        </tr>
        <tr>
            <td>Thank you for shopping with us. Your Order Details are follows</td>
        </tr>
        <tr>
            <td>
                <h1>Order No : {{ $order_info['order_id'] }}</h1>
            </td>
        </tr>
    </table>
    <table width="100%" cellpadding="5" cellspacing="5" border="1px">

        <tr>
            <td>Product Name</td>
            <td>Product Code</td>
            <td>Size</td>
            <td>Color</td>
            <td>Quantity</td>
            <td>Unit Price</td>
            <td>Total Price</td>
        </tr>

        @foreach($order_info['order']->orders as $ord)
        <tr>
            <td>{{ $ord->product_name }}</td>
            <td>{{ $ord->product_code }}</td>
            <td>{{ $ord->product_size }}</td>
            <td>{{ $ord->product_color }}</td>
            <td>{{ $ord->product_qty }}</td>
            <td>{{ $ord->product_price }}</td>
            <td>
                @php
                $total_price = 0;
                $total_price += $ord->product_qty * $ord->product_price;
                @endphp
                {{ $total_price }}
            </td>
        </tr>
        @endforeach

        <tr>
            <td colspan="6" align="right"><strong>Shipping Charges (+)</strong></td>
            <td> $ {{ $order_info['order']->shipping_charges }}</td>
        </tr>
        <tr>
            <td colspan="6" align="right"><strong>Coupon Discount (-) </strong></td>
            <td> $ {{ $order_info['order']->coupon_amount }}</td>
        </tr>
        <tr>
            <td colspan="6" align="right"><strong>Grand Total</td> </strong>
            <td> {{ $order_info['order']->grand_total }}</td>
        </tr>
    </table>
    <h4>Yours Billing & Shipping Address are as follows</h4> <br>

    <div class="billto" style="width:50%;float:left">
        <b>Billing Address</b> <br><br>
        <strong>Name : </strong>{{ $order_info['order']->name }} <br>
        <strong>Address : </strong>{{ $order_info['order']->address }} <br>
        <strong>City : </strong>{{ $order_info['order']->city }} <br>
        <strong>Country : </strong>{{ $order_info['order']->country }} <br>
        <strong>Mobile : </strong>{{ $order_info['order']->mobile }} <br>
    </div>

    <div class="shipto" style="width:50%;float: right;">
        <b>Shipping Address</b> <br><br>
        <strong>Name : </strong>{{ $order_info['order']->name }} <br>
        <strong>Address : </strong>{{ $order_info['order']->address }} <br>
        <strong>City : </strong>{{ $order_info['order']->city }} <br>
        <strong>Country : </strong>{{ $order_info['order']->country }} <br>
        <strong>Mobile : </strong>{{ $order_info['order']->mobile }} <br>
    </div><br><br><br><br>

    <div>
        <p>Note : If you need any query regarding this email plz feel free to contact us <a
                href="mailto:info@wayshop.com">info@wayshop.com</a></p>
        <br>
        <b>Regards</b> <br>
        Wayshop Team
    </div>
</body>

</html>