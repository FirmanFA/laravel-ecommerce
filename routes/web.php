<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');

Route::match(['get', 'post'], '/admin', 'AdminController@login');

Route::get('/products/{url}', 'ProductController@products');

Route::get('/products', 'ProductController@productsAll');

Route::get('/product/{id}', 'ProductController@product');

Route::post('/search','ProductController@searchProducts');

Route::match(['get', 'post'], '/add-cart', 'ProductController@addtocart');

Route::match(['get', 'post'], '/cart', 'ProductController@cart');

Route::get('/cart/delete-product/{id}', 'ProductController@deleteCartProduct');

Route::get('/cart/update-quantity/{id}/{quantity}', 'ProductController@updateCartQuantity');

Route::get('/get-product-price','ProductController@getProductPrice');

Route::get('/get-product-stock','ProductController@getProductStock');

Route::post('/cart/apply-coupon','ProductController@applyCoupon');

Route::get('/login-register','UserController@userLoginRegister');
Route::post('/user-register','UserController@register');
Route::get('/user-logout','UserController@logout');
Route::post('/user-login','UserController@login');
Route::match(['get', 'post'], '/login-register', 'UserController@register');


Route::group(['middleware' => ['frontLogin']], function () {
    Route::match(['get', 'post'], '/account', 'UserController@account');

    Route::post('/check-user-pwd','UserController@checkUserPassword');

    Route::post('/update-user-pwd','UserController@updatePassword');

    Route::match(['get', 'post'], '/checkout', 'ProductController@checkout');

    Route::match(['get', 'post'], '/order-review', 'ProductController@orderReview');

    Route::match(['get', 'post'], '/place-order', 'ProductController@placeOrder');

    Route::get('/thanks', 'ProductController@thanks');

    Route::get('/orders', 'ProductController@userOrders');

    Route::get('/orders/{id}', 'ProductController@userOrderDetails');

    
});



Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');   
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check-pwd', 'AdminController@chkPassword');
    Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword');
    
    //category
    Route::match(['get', 'post'], '/admin/add-category', 'CategoryController@addCategory');
    Route::get('/admin/view-categories', 'CategoryController@viewCategories');
    Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory');
    Route::match(['get', 'post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory');

    //products
    Route::match(['get', 'post'], '/admin/add-product', 'ProductController@addProduct');
    Route::match(['get', 'post'], '/admin/edit-product/{id}', 'ProductController@editProduct');
    Route::get('/admin/view-products', 'ProductController@viewProducts');
    Route::get('/admin/delete-product/{id}', 'ProductController@deleteProduct');
    Route::get('/admin/delete-product-image/{id}', 'ProductController@deleteProductImage');
    Route::get('/admin/delete-alt-image/{id}', 'ProductController@deleteAltImage');

    //Products Attribute
    Route::match(['get', 'post'], '/admin/add-attribute/{id}', 'ProductController@addAttribute');
    Route::match(['get', 'post'], '/admin/edit-attributes/{id}', 'ProductController@editAttributes');
    Route::match(['get', 'post'], '/admin/add-images/{id}', 'ProductController@addImages');
    Route::get('/admin/delete-attribute/{id}', 'ProductController@deleteAttribute');

    //coupon
    Route::match(['get', 'post'], '/admin/add-coupon', 'CouponController@addCoupon');
    Route::match(['get', 'post'], '/admin/edit-coupon/{id}', 'CouponController@editCoupon');
    Route::get('/admin/delete-coupon/{id}', 'CouponController@deleteCoupon');
    Route::get('/admin/view-coupons', 'CouponController@viewCoupons');

    //banner
    Route::match(['get', 'post'], '/admin/add-banner', 'BannerController@addBanner');
    Route::match(['get', 'post'], '/admin/edit-banner/{id}', 'BannerController@editBanner');
    Route::get('/admin/view-banners', 'BannerController@viewBanners');
    Route::get('/admin/delete-banner/{id}', 'BannerController@deleteBanner');


    Route::get('/admin/view-orders', 'ProductController@viewOrders');


    Route::get('/admin/view-order/{id}', 'ProductController@viewOrderDetails');

    Route::post('admin/update-order-status','ProductController@updateOrderStatus');


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', 'AdminController@logout');
