<?php

use Illuminate\Support\Facades\Route;


// Routes for frontend wayshop page
Route::get('/', 'App\Http\Controllers\IndexController@index')->name('index');
Route::get('/single-product/{slug}', 'App\Http\Controllers\IndexController@singleProduct')->name('single.product');

// Routes for add to cart session and store cart
Route::post('/cart/add', 'App\Http\Controllers\ProductController@addCartStore')->name('cart.add');
//Routes for cart show page
Route::get('/cart', 'App\Http\Controllers\ProductController@cart')->name('cart');
//Routes for cart product quantity update
Route::get('/cart/product_quantity/update/{id}/{quantity}', 'App\Http\Controllers\ProductController@cartProductQuantityUpdate');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





// Dashboard route
Route::get('/dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('admin.dashboard');

// Route for admin user create
Route::prefix('admin')->group(function () {
    //Admin login and register route
    Route::get('/register', 'App\Http\Controllers\AdminController@register')->name('admin.register');
    Route::get('/login', 'App\Http\Controllers\AdminController@login')->name('admin.login');


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
    Route::get('/size_attribute_to_price_search', 'App\Http\Controllers\ProductController@sizeSelectToPrice');
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
