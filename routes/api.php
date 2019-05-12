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
  Route::get('/products/{id}', 'Api\ProductController@show');
});

// Authenticated Routes
Route::group(['middleware' => ['auth:api', 'json_response']], function() {
  // Test Route to get current user session
  Route::get('/user', function (Request $request) {
    return $request->user();
  });
});
