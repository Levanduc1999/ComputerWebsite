<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LoginController;
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

Route::get('/', 'HomeController@index');

Route::resource('home', 'HomeController')->only([
    'index', 
]);
Route::get('/search', 'HomeController@search');
//slider home
Route::get('/slider', 'HomeController@slider');
Route::group(['middleware' => 'checkCustomer'], function() {
    //customer account
    Route::get('/account', 'HomeController@account');
    Route::post('/account', 'HomeController@updateAccount');
    Route::get('/account/order/{id}', 'HomeController@accountOrder');
    Route::resource('order', 'OrderController')->only([
        'index', 'show', 'create', 'store', 'update',  'edit', 'destroy'
    ]);

    //order-fontend
    Route::get('/ordertotal', 'OrderController@orderTotal');
    Route::post('/ajaxfee-cart', 'OrderController@ajaxFee');
    Route::post('/chargefee', 'OrderController@chargeFee');
    Route::get('/ordercheckout', 'OrderController@orderCheckout');
    Route::get('/orderhascoupon', 'OrderController@orderCoupon');
    Route::get('/payment', 'OrderController@payment');
    Route::post('/paymentatm', 'OrderController@paymentAtm');
    Route::post('/mail-feedback-product', 'HomeController@mailFeedback');
});

Route::get('/home/category/{id}', 'HomeController@homeCategory');
Route::get('/home/brand/{id}', 'HomeController@homeBrand');
Route::get('/home/product/detail/{id}', 'HomeController@homeDetail');
Route::get('/home/topic/{id}', 'HomeController@topic');
Route::get('/home/showpost/{id}', 'HomeController@showPost');
Route::get('/producthot', 'HomeController@homeProductHot');
Route::get('/productnew', 'HomeController@homeProductNew');

Route::post('/rating', 'HomeController@rating');

Route::get('/admin', 'AdminController@index');

Route::get('/register', 'AdminController@register');
Route::post('/register_admin', 'AdminController@checkregister');
Route::get('/login_checkout', [LoginController::class, 'loginCheckout']);
Route::post('/register', 'LoginController@registerCheckout');
Route::post('/login', 'LoginController@login');
Route::get('/forgetpass', 'LoginController@forgetpass');
Route::post('/checkaccountforget', 'LoginController@checkAccountForget');
Route::get('/update-new-pass-customer', 'LoginController@updatePass');
Route::post('/new-pass', 'LoginController@newPass');



// Route::get('/admin-dash', 'AdminController@dash');
Route::post('/adminlogin', 'AdminController@login');
Route::get('/admin_home', 'AdminController@home');
Route::get('/adminlogout', 'AdminController@logout');
Route::group(['middleware' => 'checkAdmin'], function() {
   
    //Topic
    Route::resource('topic', 'TopicController')->only([
        'index', 'show', 'create', 'store',  'edit', 
    ]);
    Route::post('/search-topic', 'TopicController@searchTopic');
    Route::post('/topic/{topic}', 'TopicController@update');
    Route::get('/topic/{topic}', 'TopicController@destroy')->name('topic.destroy');

    //Post
    Route::resource('post', 'PostController')->only([
        'index', 'show', 'create', 'store',  'edit', 
    ]);
    Route::post('/post/{post}', 'PostController@update');
    Route::post('/search-post', 'PostController@searchPost');
    Route::get('/post/{post}', 'PostController@destroy')->name('post.destroy');
    //User
    Route::resource('user', 'UserController')->only([
        'index', 'show', 'create', 'store',  'edit', 'destroy'
    ]);
    Route::get('/user/{user}', 'UserController@destroy')->name('user.destroy');
    Route::post('/search-user', 'UserController@searchUser');

    //Slider
    Route::resource('slider', 'SliderController')->only([
        'index', 'show', 'create', 'store',  'edit', 
    ]);
    Route::post('/slider/{slider}', 'SliderController@update');
    Route::post('/search-slider', 'SliderController@searchSlider');
    Route::get('/slider/{slider}', 'SliderController@destroy')->name('slider.destroy');

    //Category
    Route::resource('categoryproducts', 'CategoryProductController')->only([
        'index', 'show', 'create', 'store', 'update',  'edit'
    ]);
    Route::post('/categoryproducts/{categoryproduct}', 'CategoryProductController@update');
    Route::get('/categoryproducts/{categoryproduct}', 'CategoryProductController@destroy')->name('categoryproducts.destroy');
    Route::post('/search-category', 'CategoryProductController@searchCategory');

    //Categorychildren
    Route::get('/categorychildren', 'CategoryProductController@indexChildren');
    Route::get('/categorychildren/{id}/edit', 'CategoryProductController@editChildren')->name('categorychildren.edit');
    Route::post('/categorychildren/{id}', 'CategoryProductController@updateChildren');
    Route::get('/categorychildren/create', 'CategoryProductController@createChildren')->name('categorychildren.create');
    Route::get('/categorychildrendestroy/{categorychildren}', 'CategoryProductController@destroyChildren');
    Route::post('/categorychildren', 'CategoryProductController@storeChildren');
    Route::post('/search-categorychil', 'CategoryProductController@searchCategoryChil');
    //Brand
    Route::resource('brand', 'BrandController')->only([
        'index', 'show', 'create', 'store', 'update',  'edit'
    ]);
    Route::post('/brand/{brand}', 'BrandController@update');
    Route::get('/brand/{brand}', 'BrandController@destroy')->name('brand.destroy');
    Route::post('/search-brand', 'BrandController@searchBrand');

    //coupon
    Route::resource('coupon', 'CouponController')->only([
        'index', 'show', 'create', 'store',  'edit'
    ]);
    Route::post('/coupon/{coupon}', 'CouponController@update');
    Route::get('/coupon/{coupon}', 'CouponController@destroy')->name('coupon.destroy');
    Route::post('/search-coupon', 'CouponController@searchCoupon');
    //Product
    Route::resource('product', 'ProductController')->only([
        'index', 'show', 'create', 'store', 'update',  'edit'
    ]);
    Route::post('/product/{product}', 'ProductController@update');
    Route::post('/ajaxload', 'ProductController@ajaxLoadCategory');
    Route::get('/product/{product}', 'ProductController@destroy')->name('product.destroy');
    Route::post('/search-product', 'ProductController@searchProduct');

    //Fee
    Route::get('/fee', 'FeeController@index')->name('fee.index');
    Route::post('/ajaxfee', 'FeeController@ajaxFee');
    Route::post('/addfee', 'FeeController@addFee');
    Route::post('/loadfee', 'FeeController@loadFee');
    Route::post('/updatefee', 'FeeController@updateFee');

    //PDF
    Route::get('/pdf/{order_id}','AdminorderController@pdf');

    //order
    Route::get('/ordershow/{orderShowId}', 'AdminorderController@show')->name('ordershow.show');
    Route::get('/admin-order', 'AdminOrderController@index')->name('adminorder.index');
    Route::get('/order/{order}', 'AdminOrderController@destroy')->name('order.destroy');
    Route::post('/search-order', 'AdminOrderController@searchOrder');

});