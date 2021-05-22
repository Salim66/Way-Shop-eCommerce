<?php

use Illuminate\Support\Facades\Route;


// Routes for frontend wayshop page
Route::get('/', 'App\Http\Controllers\IndexController@index')->name('index');
Route::get('/single-product/{slug}', 'App\Http\Controllers\IndexController@singleProduct')->name('single.product');
Route::post('/product/search', 'App\Http\Controllers\IndexController@productSearch')->name('product.search');
Route::get('/product/category/{slug}', 'App\Http\Controllers\IndexController@productCategoryWiseSearch')->name('category.wise.product.search');



//Customer login registation page
Route::get('/login-registation', 'App\Http\Controllers\CustomerController@loginRegistationPage')->name('login.registation.page');
Route::post('/registation', 'App\Http\Controllers\CustomerController@customerRegisterStore')->name('customers.register');
Route::post('/customer/login', 'App\Http\Controllers\CustomerController@customerLogin')->name('customer.login');

//Authenticate front end customer and importend link
Route::middleware(['auth', 'customer'])->group(function () {
    // Routes for single product select size wise price search
    Route::get('/products/size_attribute_to_price_search', 'App\Http\Controllers\ProductController@sizeSelectToPrice');

    // Routes for add to cart session and store cart
    Route::post('/cart/add', 'App\Http\Controllers\ProductController@addCartStore')->name('cart.add');
    //Routes for cart show page
    Route::get('/cart', 'App\Http\Controllers\ProductController@cart')->name('cart');
    //Routes for cart apply coupon code 
    Route::post('/cart/apply-coupon', 'App\Http\Controllers\ProductController@applyCoupon')->name('cart.apply_coupon');
    //Routes for cart product quantity update
    Route::get('/cart/product_quantity/update/{id}/{quantity}', 'App\Http\Controllers\ProductController@cartProductQuantityUpdate');
    //Routes for cart product delete
    Route::get('/cart/product/delete/{id}', 'App\Http\Controllers\ProductController@cartProductDelete')->name('cart.product.delete');

    // Routes for customer checkout billing and shipping information page
    Route::get('/customer/checkout', 'App\Http\Controllers\ProductController@cutomerbillingShippingPage')->name('customer.checkout');
    // Routes for customer checkout billing and shipping information store
    Route::post('/customer/checkout/store', 'App\Http\Controllers\ProductController@cutomerbillingShippingStore')->name('customer.checkout.store');
    // Routes for customer checkout billing and shipping information store
    Route::get('/order/review', 'App\Http\Controllers\ProductController@cutomerOrderReviewPage')->name('order.review.page');
    // Routes for customer order place
    Route::post('/order/place', 'App\Http\Controllers\ProductController@orderPlace')->name('place.order');
    // Routes for customer payment by cash on delivary 
    Route::get('/thanks', 'App\Http\Controllers\ProductController@thanks')->name('thanks');
    // Routes for customer payment by stripe
    Route::get('/stripe', 'App\Http\Controllers\ProductController@stripe')->name('stripe');
    // Route for customer stripe payment meethod store
    Route::post('/stripe/store', 'App\Http\Controllers\ProductController@stripeStore')->name('stripe.store');
    // Route for customer order list page
    Route::get('/orders/list', 'App\Http\Controllers\ProductController@customerOrderList')->name('customer.order.list');
    // Route for customer order product detials
    Route::get('/order/product/detials/{order_id}', 'App\Http\Controllers\ProductController@customerOrderProductDetails')->name('customer.order.detials');



    // Routes for customer account
    Route::get('/customer/confirm/account/{code}', 'App\Http\Controllers\CustomerController@customerRegistationEmailConfirm')->name('customer.email.confirm');
    Route::get('/customer/account', 'App\Http\Controllers\CustomerController@customerAccount')->name('customer.account');
    Route::get('/customer/address/edit', 'App\Http\Controllers\CustomerController@customerAddressEdit')->name('customer.address.edit');
    Route::post('/customer/address/update/{id}', 'App\Http\Controllers\CustomerController@customerAddressUpdate')->name('customer.address.update');
    Route::get('/customer/change/password', 'App\Http\Controllers\CustomerController@customerChangePassword')->name('customer.change.password');
    Route::post('/customer/password/update', 'App\Http\Controllers\CustomerController@customerPasswordUpdate')->name('customer.password.update');
});




Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//Admin login and register route
Route::get('/admin/register', 'App\Http\Controllers\AdminController@register')->name('admin.register');
Route::get('/admin/login', 'App\Http\Controllers\AdminController@login')->name('admin.login');

// Authenticate admin panel
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('admin.dashboard');

    // Route for admin user create
    Route::prefix('admin')->group(function () {
        // Admin users routes
        Route::get('/users', 'App\Http\Controllers\UserController@view')->name('admin.users');
        Route::get('/users/add', 'App\Http\Controllers\UserController@add')->name('admin.user.add');
        Route::post('/users/store', 'App\Http\Controllers\UserController@store')->name('admin.user.store');
        Route::post('/users/status-update', 'App\Http\Controllers\UserController@userStatusUpdate');
        Route::delete('/users/delete/{id}', 'App\Http\Controllers\UserController@userDelete')->name('admin.user.delete');
        Route::get('/users/edit/{id}', 'App\Http\Controllers\UserController@userEdit')->name('admin.user.edit');
        Route::patch('/users/update/{id}', 'App\Http\Controllers\UserController@userUpdate')->name('admin.user.update');
    });

    // Route for admin users profile update
    Route::prefix('/user')->group(function () {
        //user profile route
        Route::get('/profile/view', 'App\Http\Controllers\UserController@profileView')->name('user.profile.view');
        Route::get('/profile/edit/{id}', 'App\Http\Controllers\UserController@profileEdit')->name('user.profile.edit');
        Route::put('/profile/update/{id}', 'App\Http\Controllers\UserController@profileUpdate')->name('user.profile.update');
        Route::get('/change/password', 'App\Http\Controllers\UserController@userChangePassword')->name('user.change.password');
        Route::post('/change/password/update', 'App\Http\Controllers\UserController@userChangePasswordUpdate')->name('user.change.password.update');
    });

    // Route for category
    Route::prefix('categories')->group(function () {
        Route::get('/view', 'App\Http\Controllers\CategoryController@view')->name('categories.view');
        Route::get('/add', 'App\Http\Controllers\CategoryController@add')->name('categories.add');
        Route::post('/store', 'App\Http\Controllers\CategoryController@store')->name('categories.store');
        Route::post('/status-update', 'App\Http\Controllers\CategoryController@statusUpdate');
        Route::delete('/delete/{id}', 'App\Http\Controllers\CategoryController@delete')->name('categories.delete');
        Route::get('/edit/{id}', 'App\Http\Controllers\CategoryController@edit')->name('categories.edit');
        Route::patch('/update/{id}', 'App\Http\Controllers\CategoryController@update')->name('categories.update');
    });

    // Route for products
    Route::prefix('products')->group(function () {
        Route::get('/view', 'App\Http\Controllers\ProductController@view')->name('products.view');
        Route::get('/add', 'App\Http\Controllers\ProductController@add')->name('products.add');
        Route::post('/store', 'App\Http\Controllers\ProductController@store')->name('products.store');
        Route::post('/status-update', 'App\Http\Controllers\ProductController@statusUpdate');
        Route::post('/featured-product/status-update', 'App\Http\Controllers\ProductController@featuredProductStatusUpdate');
        Route::delete('/delete/{id}', 'App\Http\Controllers\ProductController@delete')->name('products.delete');
        Route::get('/edit/{id}', 'App\Http\Controllers\ProductController@edit')->name('products.edit');
        Route::put('/update/{id}', 'App\Http\Controllers\ProductController@update')->name('products.update');
        //Attributs
        Route::get('/attributes/{id}', 'App\Http\Controllers\ProductController@productAttributs')->name('products.attributes');
        Route::post('/attributes/store', 'App\Http\Controllers\ProductController@productAttributsStore')->name('products.attributs.store');
        Route::delete('/attributes/delete/{id}', 'App\Http\Controllers\ProductController@productAttributsDelete')->name('products.attributs.delete');
        Route::put('/attributes/update/{id}', 'App\Http\Controllers\ProductController@productAttributsUpdate')->name('products.attributes.update');
        Route::get('/attributes/images/{id}', 'App\Http\Controllers\ProductController@productAttributsImages')->name('products.attributes.images');
        Route::post('/attributes/images/store', 'App\Http\Controllers\ProductController@productAttributsImagesStore')->name('products.attributs.image.store');
        Route::get('/attributes/images/delete/{id}', 'App\Http\Controllers\ProductController@productAttributsImageDelete')->name('products.attributs.image.delete');
    });

    // Route for banners
    Route::prefix('banners')->group(function () {
        Route::get('/view', 'App\Http\Controllers\BannerController@view')->name('banners.view');
        Route::get('/add', 'App\Http\Controllers\BannerController@add')->name('banners.add');
        Route::post('/store', 'App\Http\Controllers\BannerController@store')->name('banners.store');
        Route::post('/status-update', 'App\Http\Controllers\BannerController@statusUpdate');
        Route::get('/delete/{id}', 'App\Http\Controllers\BannerController@delete')->name('banners.delete');
        Route::get('/edit/{id}', 'App\Http\Controllers\BannerController@edit')->name('banners.edit');
        Route::patch('/update/{id}', 'App\Http\Controllers\BannerController@update')->name('banners.update');
    });

    //Routes for coupon
    Route::prefix('coupons')->group(function () {
        Route::get('/view', 'App\Http\Controllers\CouponController@view')->name('coupons.view');
        Route::get('/add', 'App\Http\Controllers\CouponController@add')->name('coupons.add');
        Route::post('/store', 'App\Http\Controllers\CouponController@store')->name('coupons.store');
        Route::post('/status-update', 'App\Http\Controllers\CouponController@statusUpdate');
        Route::delete('/delete/{id}', 'App\Http\Controllers\CouponController@delete')->name('coupons.delete');
        Route::get('/edit/{id}', 'App\Http\Controllers\CouponController@edit')->name('coupons.edit');
        Route::put('/update/{id}', 'App\Http\Controllers\CouponController@update')->name('coupons.update');
    });

    //Routes for customer orders
    Route::prefix('orders')->group(function () {
        Route::get('/view', 'App\Http\Controllers\ProductController@adimnPanelOrdersView')->name('orders.view');
        Route::get('/view/detials/{order_id}', 'App\Http\Controllers\ProductController@adimnPanelOrdersViewDetails')->name('orders.details');
        Route::post('/status/update', 'App\Http\Controllers\ProductController@adimnPanelCustomerOrderStatusUpdate')->name('orders.status.update');
    });

    //Routes for CMS pages
    Route::prefix('pages')->group(function () {
        Route::get('/view', 'App\Http\Controllers\PagesController@view')->name('pages.view');
        Route::get('/add', 'App\Http\Controllers\PagesController@add')->name('pages.add');
        Route::post('/store', 'App\Http\Controllers\PagesController@store')->name('pages.store');
    });
});
