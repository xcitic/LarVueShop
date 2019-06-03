<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Unauthenticated Routes
Route::group(['middleware' => ['json_response']], function() {
  Route::post('/login', 'Api\AuthController@login');
  Route::post('/register', 'Api\AuthController@register');
  Route::get('/products', 'Api\ProductController@index');
  Route::get('/product/{id}', 'Api\ProductController@show');
  Route::post('/product/like/{id}', 'Api\ProductController@like');
  Route::post('/product/dislike/{id}', 'Api\ProductController@dislike');

  // Guest Ordering
  Route::post('/cart/order/guest', 'Api\OrderController@guestOrder');
  Route::post('/cart/payment/guest', 'Api\PaymentController@guestPayment');

});

// Authenticated Routes
Route::group(['middleware' => ['auth:api', 'json_response']], function() {


  Route::get('/cart', 'Api\CartController@getCart');
  Route::get('/cart/products', 'Api\OrderController@getProducts');
  Route::post('/product/cart/add/{id}/{quantity}', 'Api\CartController@addToCart');
  Route::post('/product/cart/remove/{id}', 'Api\CartController@removeFromCart');
  Route::post('/product/cart/empty', 'Api\CartController@emptyCart');

  Route::post('/cart/order', 'Api\OrderController@createOrder');

  Route::post('/cart/payment', 'Api\OrderController@payment');


  Route::get('/dashboard/orders', 'Api\DashboardController@getOrders');
});

// Admin Routes
Route::group(['middleware' => ['auth:api', 'admin_auth', 'json_response']], function() {
    Route::get('/admin/dashboard', 'Api\AdminController@dashboard');
    Route::post('/admin/createProduct', 'Api\AdminController@createProduct');

  });
