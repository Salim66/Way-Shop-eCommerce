<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use App\Models\DelivaryAddress;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\ProductAttributeImage;
use Intervention\Image\Facades\Image;
use App\Mail\CustomerOrderDetailsMail;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Products view
     */
    public function view()
    {
        $all_data = Product::latest()->get();
        return  view('admin.product.view_product', compact('all_data'));
    }

    /**
     * Product add 
     */
    public function add()
    {
        $categories = Category::where('status', 1)->where('parent_id', '!=', null)->latest()->get();
        return view('admin.product.add_product', compact('categories'));
    }

    /**
     * Product Store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name'        => 'required | unique:users,name',
            'code'        => 'required',
            'color'       => 'required',
            'description' => 'required',
            'price'       => 'required',
        ]);

        // product image upload directory and resize photo
        $image_unique_name = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_unique_name = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(260, 420)->save('uploads/products/' . $image_unique_name);
            $image->move(public_path('uploads/products/'), $image_unique_name);
        }

        Product::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'code'        => $request->code,
            'color'       => $request->color,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $image_unique_name,
        ]);

        return redirect()->route('products.view')->with('success', 'Product added successfully ): ');
    }

    /**
     * Product status update
     */
    public function statusUpdate(Request $request)
    {
        Product::where('id', $request->id)->update([
            'status' => $request->status,
        ]);
        return redirect()->back();
    }

    /**
     * Featured product status update
     */
    public function featuredProductStatusUpdate(Request $request)
    {
        Product::where('id', $request->id)->update([
            'featured_product' => $request->status
        ]);
        return redirect()->back();
    }

    /**
     * Porudct delete
     */
    public function delete($id)
    {
        $data = Product::find($id);
        if ($data != NULL) {
            $data->delete();
            if (file_exists('uploads/products/' . $data->image) && !empty($data->image)) {
                unlink('uploads/products/' . $data->image);
            }
        } else {
            return redirect()->back()->with('error', 'Sorry! does not found any data.');
        }
        return redirect()->back()->with('success', 'Product deleted successfully ): ');
    }

    /**
     * Product edit
     */
    public function edit($id)
    {
        $data = Product::find($id);
        $categories = Category::all();
        return view('admin.product.edit_product', compact('data', 'categories'));
    }

    /**
     * Product update
     */
    public function update(Request $request, $id)
    {
        $data = Product::find($id);
        if ($data != NULL) {
            $this->validate($request, [
                'category_id' => 'required',
                'name'        => 'required | unique:users,name,' . $data->id,
                'code'        => 'required',
                'color'       => 'required',
                'description' => 'required',
                'price'       => 'required',
            ]);

            // Product upload directory and photo resize by imageintervention
            $image_unique_name = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_unique_name = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(260, 420)->save('uploads/products/' . $image_unique_name);
                $image->move(public_path('uploads/products/'), $image_unique_name);
                if (file_exists('uploads/products/' . $data->image) && !empty($data->image)) {
                    unlink('uploads/products/' . $data->image);
                }
            } else {
                $image_unique_name = $data->image;
            }

            $data->category_id = $request->category_id;
            $data->name = $request->name;
            $data->slug = Str::slug($request->name);
            $data->code = $request->code;
            $data->color = $request->color;
            $data->description = $request->description;
            $data->price = $request->price;
            $data->image = $image_unique_name;
            $data->update();

            return redirect()->route('products.view')->with('success', 'Product updated successfully ): ');
        }
    }

    /**
     * Product attributes page
     */
    public function productAttributs($id)
    {
        $product = Product::find($id);
        $pro_attr = ProductAttribute::where('product_id', $product->id)->get();
        return view('admin.product.product_attribute', compact('product', 'pro_attr'));
    }

    /**
     * Product attributes store
     */
    public function productAttributsStore(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'sku'        => 'required',
            'size'       => 'required',
            'price'      => 'required',
            'stock'      => 'required',
        ]);

        $size_count = count($request->size);

        for ($i = 0; $i < $size_count; $i++) {
            if ($request->sku != NULL) {
                //check sku already exists or not
                $attrProSku = ProductAttribute::where('product_id', $request->product_id)->where('sku', $request->sku[$i])->count();
                if ($attrProSku > 0) {
                    return redirect()->back()->with('error', 'Sorry! ' . $request->sku[$i] . ' This product sku already has been taken, please insert another sku.');
                }

                //check size already exists or not
                $attrProSize = ProductAttribute::where('product_id', $request->product_id)->where('size', $request->size[$i])->count();
                if ($attrProSize > 0) {
                    return redirect()->back()->with('error', 'Sorry! ' . $request->size[$i] . ' This product size already has been taken, please insert another size.');
                }

                ProductAttribute::create([
                    'product_id' => $request->product_id,
                    'sku'        => $request->sku[$i],
                    'size'       => $request->size[$i],
                    'price'      => $request->price[$i],
                    'stock'      => $request->stock[$i],
                ]);
            }
        }
        return redirect()->back()->with('success', 'Product attributes added successfully ): ');
    }

    /**
     * Product attributes delete
     */
    public function productAttributsDelete($id)
    {
        $data = ProductAttribute::find($id);
        if ($data != NULL) {
            $data->delete();
            return redirect()->back()->with('success', 'Product attributes deleted successfully ): ');
        } else {
            return redirect()->back()->with('error', 'Sorry! does not found any data');
        }
    }

    /**
     * Product attributes update
     */
    public function productAttributsUpdate(Request $request, $id)
    {
        $productAttr = ProductAttribute::where('product_id', $request->product_id)->get();
        if ($productAttr != NULL) {
            $count = count($request->sku);
            foreach ($productAttr as $key => $attr) {
                $attr->sku = $request->sku[$key];
                $attr->size = $request->size[$key];
                $attr->price = $request->price[$key];
                $attr->stock = $request->stock[$key];
                $attr->update();
            }
            return redirect()->back()->with('success', 'Product attributes updated successfully ): ');
        } else {
            return redirect()->back()->with('error', 'Sorry! does not found any data');
        }
    }

    /**
     * Product attributes images page
     */
    public function productAttributsImages($id)
    {
        $product = Product::find($id);
        $pro_attr_img = ProductAttributeImage::where('product_id', $product->id)->get();
        return view('admin.product.product_attribute_images', compact('product', 'pro_attr_img'));
    }

    /**
     * Product attributes images store
     */
    public function productAttributsImagesStore(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $key => $image) {
                $image_unique_name = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(260, 420)->save('uploads/products/attributes/' . $image_unique_name);
                $image->move(public_path('uploads/products/attributes/'), $image_unique_name);

                ProductAttributeImage::create([
                    'product_id' => $request->product_id,
                    'image' => $image_unique_name,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Product attribute images added successfully ): ');
    }

    /**
     * Product attributes image delete
     */
    public function productAttributsImageDelete($id)
    {
        $data = ProductAttributeImage::find($id);
        if ($data != NULL) {
            $data->delete();
            if (file_exists('uploads/products/attributes/' . $data->image) && !empty($data->image)) {
                unlink('uploads/products/attributes/' . $data->image);
            }
            return redirect()->back()->with('success', 'Delete proudct attribute image!');
        }
    }

    /**
     * Size select to price
     */
    public function sizeSelectToPrice(Request $request)
    {
        $pro_size = $request->size;
        $data = explode('-', $pro_size);
        $size = ProductAttribute::where('product_id', $data[0])->where('size', $data[1])->first();
        return $size->price;
    }

    /**
     * Product add cart store
     */
    public function addCartStore(Request $request)
    {
        // session forget when customer again added to cart another product or same product diffrent size
        Session::forget('couponAmount');
        Session::forget('coupon_code');

        //check user email id has or not
        $user_email = '';
        if (empty(Auth::user()->email)) {
            $user_email = '';
        } else {
            $user_email = Auth::user()->email;
        }

        //check user session id has or not
        $session_id = Session::get('session_id');
        if (empty($session_id)) {
            $session_id = Str::random(40);
            Session::put('session_id', $session_id);
        }

        // product size get
        $size_get = explode('-', $request->size);

        //check duplicate product size has or not // we do not permit same size allowed in the cart same email or session id
        $productCount = DB::table('cart')->where([
            'product_id' => $request->product_id,
            'product_color' => $request->product_color,
            'size' => $size_get[1],
            'session_id' => $session_id
        ])->count();


        if ($productCount > 0) {
            return redirect()->back()->with('error', 'Product size has been already taken! plese another size select');
        } else {
            DB::table('cart')->insert([
                'product_id' => $request->product_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'product_color' => $request->product_color,
                'size' => $request->size,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'user_email' => $user_email,
                'session_id' => $session_id,
            ]);

            return redirect()->route('cart')->with('success', 'Product added to cart');
        }
    }

    /**
     * Cart page 
     */
    public function cart()
    {
        // get cart all dta fetch
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $carts = DB::table('cart')->where('user_email', $user_email)->get();
        } else {
            $session_id = Session::get('session_id');
            $carts = DB::table('cart')->where('session_id', $session_id)->get();
        }

        //image added into cart
        foreach ($carts as $key => $cart) {
            $product = Product::where('id', $cart->product_id)->first();
            $carts[$key]->image = $product->image;
        }

        return view('wayshop.product.cart', compact('carts'));
    }

    /**
     * Cart product quantity update
     */
    public function cartProductQuantityUpdate($id, $quantity)
    {
        // session forget when customer again added to cart another product or same product diffrent size
        Session::forget('couponAmount');
        Session::forget('coupon_code');

        DB::table('cart')->where('id', $id)->increment('quantity', $quantity);
        return redirect()->back()->with('success', 'Cart proudct quantity updated successfully ): ');
    }

    /**
     * Cart product delete
     */
    public function cartProductDelete($id)
    {
        // session forget when customer again added to cart another product or same product diffrent size
        Session::forget('couponAmount');
        Session::forget('coupon_code');

        DB::table('cart')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product delete from cart successfully ):');
    }

    /**
     * Cart apply coupon 
     * ===mendatory check before coupon apply===
     * 1. first coupon code valid or not
     * 2. check coupon code status active or inactive
     * 3.expiry date check has or not
     * ==coupon is ready for discount==
     * 4. check user auth has or not
     * 5. count total amount
     * 6. check amount type is fixed or percentage
     * 7. add session couponAmount
     * 8. add session coupon code
     */
    public function applyCoupon(Request $request)
    {
        // session forget when customer again added to cart another product or same product diffrent size
        Session::forget('couponAmount');
        Session::forget('coupon_code');

        // Check coupon check or not form input field / check valid coupon or not
        $countCoupon = Coupon::where('coupon_code', $request->coupon_code)->count();
        if ($countCoupon == 0) {
            return redirect()->back()->with('error', 'Sorry! coupon code does not exists!');
        } else {
            $couponDetails = Coupon::where('coupon_code', $request->coupon_code)->first();
            // Check coupon code statsu active or inactive
            if ($couponDetails->status == 0) {
                return redirect()->back()->with('error', 'Sorry! coupon  code status not active!');
            } else {
                // check expiry date has or not
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if ($expiry_date < $current_date) {
                    return redirect()->back()->with('error', 'Sorry! coupon code is expired!');
                } else {
                    // Coupon is ready for discount
                    // check auth has or not
                    if (Auth::check()) {
                        $user_email = Auth::user()->email;
                        $carts = DB::table('cart')->where('user_email', $user_email)->get();
                    } else {
                        $session_id = Session::get('session_id');
                        $carts = DB::table('cart')->where('session_id', $session_id)->get();
                    }

                    // Count total amount
                    $total_amount = 0;
                    foreach ($carts as $cart) {
                        $total_amount += ($cart->quantity * $cart->price);
                    }

                    // check , if amount type fixed or percentage
                    if ($couponDetails->amount_type == 'Fixed') {
                        $couponAmount = $couponDetails->amount;
                    } elseif ($couponDetails->amount_type == "Percentange") {
                        $totalA = ($total_amount * $couponDetails->amount) / 100;
                        $couponAmount = round($totalA);
                    }

                    Session::put('couponAmount', $couponAmount);
                    Session::put('coupon_code', $request->coupon_code);
                    return redirect()->back()->with('success', 'Coupon code is successfully applied! you are now availing discount ): ');
                }
            }
        }
    }

    /**
     * Cutomer billing and shipping information page
     */
    public function cutomerbillingShippingPage()
    {
        $bill = User::find(Auth::id());
        $countries = Country::all();
        $shipp = DelivaryAddress::where('user_email', $bill->email)->where('user_id', $bill->id)->first();
        return view('wayshop.customer.billing_shipping_information', compact('bill', 'countries', 'shipp'));
    }

    /**
     * Customer billing and shipping information store
     */
    public function cutomerbillingShippingStore(Request $request)
    {
        $customer_info = User::find(Auth::id());
        //check shipping addres is exists or not
        $shippingCount = DelivaryAddress::where('user_id', $customer_info->id)->count();


        //find customer and update customer billing info
        $customer = User::find($customer_info->id);
        $customer->name     = $request->billing_name;
        $customer->address  = $request->billing_address;
        $customer->city     = $request->billing_city;
        $customer->state    = $request->billing_state;
        $customer->country  = $request->billing_country;
        $customer->pincode  = $request->billing_pincode;
        $customer->mobile   = $request->billing_mobile;
        $customer->update();

        //if customer shipping address is exists then update shipping address
        if ($shippingCount > 0) {
            $customer_delivary = DelivaryAddress::where('user_id', $customer_info->id)->first();
            $customer_delivary->user_id    = $customer_info->id;
            $customer_delivary->user_email = $customer_info->email;
            $customer_delivary->name       = $request->shipping_name;
            $customer_delivary->address    = $request->shipping_address;
            $customer_delivary->city       = $request->shipping_city;
            $customer_delivary->state      = $request->shipping_state;
            $customer_delivary->country    = $request->shipping_country;
            $customer_delivary->pincode    = $request->shipping_pincode;
            $customer_delivary->mobile     = $request->shipping_mobile;
            $customer_delivary->update();
        } else {
            DelivaryAddress::create([
                'user_id'    => $customer_info->id,
                'user_email' => $customer_info->email,
                'name'       => $request->shipping_name,
                'address'    => $request->shipping_address,
                'city'       => $request->shipping_city,
                'state'      => $request->shipping_state,
                'country'    => $request->shipping_country,
                'pincode'    => $request->shipping_pincode,
                'mobile'     => $request->shipping_mobile,
            ]);
        }

        return redirect()->route('order.review.page')->with('success', 'Billing information added successfully ): ');
    }

    /**
     * Customer order review page
     */
    public function cutomerOrderReviewPage()
    {
        $bill = User::where('id', Auth::id())->first();
        $shipp = DelivaryAddress::where('user_id', Auth::id())->first();
        $countries = Country::all();
        $customer_cart = DB::table('cart')->where('user_email', Auth::user()->email)->get();
        // Add image into cart last column
        foreach ($customer_cart as $key => $cart) {
            $product = Product::where('id', $cart->product_id)->first();
            $customer_cart[$key]->image = $product->image;
        }
        return view('wayshop.customer.order_review', compact('bill', 'shipp', 'countries', 'customer_cart'));
    }

    /**
     * Custome order place cash on delivary or stripe
     */
    public function orderPlace(Request $request)
    {
        $customer_id = Auth::id();
        $customer_email = Auth::user()->email;

        //find customer delivary address
        $delivary_address = DelivaryAddress::where('user_email', $customer_email)->first();

        //check coupon code has or not
        if (empty(Session::get('coupon_code'))) {
            $coupon_code = 'Not use';
        } else {
            $coupon_code = Session::get('coupon_code');
        }
        //check coupon amount has or not
        if (empty(Session::get('couponAmount'))) {
            $coupon_amount = '0';
        } else {
            $coupon_amount = Session::get('couponAmount');
        }

        $order = Order::create([
            'user_id'        => $customer_id,
            'user_email'     => $customer_email,
            'name'           => $delivary_address->name,
            'address'        => $delivary_address->address,
            'city'           => $delivary_address->city,
            'state'          => $delivary_address->state,
            'country'        => $delivary_address->country,
            'pincode'        => $delivary_address->pincode,
            'mobile'         => $delivary_address->mobile,
            'coupon_code'    => $coupon_code,
            'coupon_amount'  => $coupon_amount,
            'order_status'   => "New",
            'payment_method' => $request->payment_method,
            'grand_total'    => $request->grand_total,
        ]);

        $order_id = DB::getPdo()->lastinsertID();
        $carts = DB::table('cart')->where('user_email', $customer_email)->get();

        foreach ($carts as $cart) {
            OrderProduct::create([
                'order_id'      => $order_id,
                'user_id'       => $customer_id,
                'product_id'    => $cart->product_id,
                'product_name'  => $cart->product_name,
                'product_code'  => $cart->product_code,
                'product_color' => $cart->product_color,
                'product_size'  => $cart->size,
                'product_price' => $cart->price,
                'product_qty'   => $cart->quantity,
            ]);
        }

        // Session put order_id and grand_total
        Session::put('order_id', $order_id);
        Session::put('grand_total', $request->grand_total);

        //check payment method
        if ($request->payment_method == 'cod') {
            // User order details information send to customer email
            $order_info = [
                'name' => $delivary_address->name,
                'email' => $customer_email,
                'order_id' => $order_id,
                'order' => $order,
                'order' => $order,
                'delivary_address' => $delivary_address,
            ];

            Mail::to($customer_email)->send(new CustomerOrderDetailsMail($order_info));
            return redirect()->route('thanks');
        } elseif ($request->payment_method == 'stripe') {
            return redirect()->route('stripe');
        } else {
            return redirect()->back()->with('error', 'Please choose any payment method!');
        }
    }

    /**
     * Customer payment cash on delivary and customer redirect ot thanks page
     */
    public function thanks()
    {
        // Destroy Session couponAmount and coupon Code
        Session::forget('couponAmount');
        Session::forget('coupon_code');

        // Delete cart data auth customer wise
        $customer_email = Auth::user()->email;
        DB::table('cart')->where('user_email', $customer_email)->delete();
        return view('wayshop.customer.thanks');
    }

    /**
     * Customer payment by stripe . this is stripe page
     */
    public function stripe()
    {
        // Destroy Session couponAmount and coupon Code
        Session::forget('couponAmount');
        Session::forget('coupon_code');

        // Delete cart data auth customer wise
        $customer_email = Auth::user()->email;
        DB::table('cart')->where('user_email', $customer_email)->delete();
        return  view('wayshop.customer.stripe');
    }

    /**
     * Customer stripe payment store
     */
    public function stripeStore(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51IqXv3EoWX3oGO2nRobu2UmZMPhYjZEAms1dRVCiwa3JaQjd9ycDoQpFM1JL9icOZ0yiZZ80JZ2R4763p0j1DjoG00q2vtwV1l');

        $token = $request->stripeToken;
        $charge = \Stripe\Charge::Create([
            'amount' => $request->total_amount * 100,
            'currency' => 'usd',
            'description' => $request->name,
            'source' => $token,
        ]);

        return redirect()->back()->with('success', 'Payment successfully done ): ');
    }

    /**
     * Customer order list page
     */
    public function customerOrderList()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('wayshop.customer.customer_order_list', compact('orders'));
    }

    /**
     * Customer product order detials
     */
    public function customerOrderProductDetails($order_id)
    {
        return $order_id;
    }
}
