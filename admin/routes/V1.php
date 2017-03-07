<?php

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

// 获取 api 路由实例
$api = app('Dingo\Api\Routing\Router');
// 定义版本分组 且 路由50次请求限制和5分钟过期时间
$api->version('V1', ['namespace' => 'App\Api\Controller\V1'], function ($api) {
	// 注册
	$api->post('users', [
		'as' => 'users.register',
		'uses' => 'AuthenticateController@register',
	]);
	// 登录
	$api->post('login', [
		'as' => 'login.authenticate',
		'uses' => 'AuthenticateController@authenticate',
	]);
	// 商品列表首页
	$api->get('/goodslist', [
		'as' => 'goodslist.index',
		'uses' => 'GoodsController@index'
	]);
	// 商品列表分类
	$api->get('/goodslist', [
		'as' => 'goodslist.show',
		'uses' => 'GoodsController@show',
	]);
	// 商品详情
	$api->get('/goodsinfo', [
		'as' => 'goodsinfo.show',
		'uses' => 'GoodsinfoController@show',
	]);

	// 登录限制
	$api->group(['middleware' => 'jwt.api.auth'], function ($api) {
		// 购物车列表
		$api->get('/cart', [
			'as' => 'Cart.index',
			'uses' => 'CartController@index',
		]);
		// 订单列表
		$api->get('/order', [
			'as' => 'order.index',
			'uses' => 'OrderController@index',
		]);
		// 个人中心
		// $api->get('/me', [
		// 	'as' => 'me.index',
		// 	'uses' => ''
		// ]);
	});
});
