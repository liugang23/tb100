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

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');


// Route::group(['namespace' => 'Home', 'middleware' => ['cors', 'api']], function (){
// 	// 获取验证码
// 	Route::resource('/validate', 'ValidateCodeController');

// 	Route::group(['middleware' => ['response']], function (){

// 		// 获取验证码
// 		// Route::resource('/validate', 'ValidateCodeController');
// 		// 注册
// 		Route::resource('/register', 'RegisterController');
// 		// 登录
// 		Route::resource('/login', 'LoginController');
// 		// 获取商品列表
// 		Route::resource('/goodslist', 'GoodsController');
// 		// 获取商品详情
// 		Route::resource('/goodsinfo', 'GoodsInfoController');
// 		// Route::group(['middleware' => 'jwt.api.auth'], function() {
// 			// 购物车列表
// 			Route::resource('/cart', 'CartController');
// 			// 订单列表
// 			Route::resource('/order', 'OrderController');
// 		// });

// 	});

// });

