<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

/*********  后台路由  *********/
// domain 子域名路由 namespace 命名空间
Route::group(['domain' => 'admin.tb.com','namespace' => 'admin'],function() {
	Route::resource('/login','LoginController');
	Route::group(['middleware' => 'AdminMiddleware'],function() {
		Route::resource('/','IndexController');
		Route::resource('/users','UsersController');
		Route::resource('/member','MemberController');
		Route::resource('/category','CategoryController');
		// 查询指定分类
		Route::get('/category/query/{id}', 'CategoryController@query');
		Route::resource('/goods','GoodsController');
		Route::resource('/order','OrderController');
		// 上传图片
		Route::post('/upload/{type}', 'UploadController@uploadFile');
	});
});


/*********  前端路由  *********/

// 获取 api 路由实例
$api = app('Dingo\Api\Routing\Router');
// 定义版本分组 且 路由50次请求限制和5分钟过期时间
$api->version('v1', function ($api) {
    // header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, PATCH, DELETE');
	$api->group(['namespace' => 'App\Api\Controllers\V1', 'middleware' => 'cors'], function ($api) {

		// 注册
		$api->POST('/register', [
			'limit' => 50, 
			'expires' => 5,
			'as' => 'register.register',
			'uses' => 'AuthController@register',
		]);
		// 登录
		$api->POST('/login', [
			'limit' => 50, 
			'expires' => 5,
			'as' => 'login.authenticate',
			'uses' => 'AuthController@authenticate',
		]);
		// 刷新 token

		// 验证码
		$api->GET('/validate', [
			'limit' => 50, 
			'expires' => 5,
			'as' => 'validate.index',
			'uses' => 'ValidateCodeController@index',
		]);
		// 手机短信
		$api->POST('/validate', [
			'limit' => 50,
			'expires' => 5,
			'as' => 'validate.store',
			'uses' => 'ValidateCodeController@store',
		]);
		// 商品列表首页
		$api->GET('/goodslist', [
			'as' => 'goodslist.index',
			'uses' => 'GoodsController@index'
		]);
		// 商品列表分类
		$api->GET('/goodslist/{id}', [
			'as' => 'goodslist.show',
			'uses' => 'GoodsController@show',
		]);
		// 商品详情
		$api->GET('/goodsinfo/{id}', [
			'as' => 'goodsinfo.show',
			'uses' => 'GoodsinfoController@show',
		]);

		// 通过 jwt.auth 中间件限制未登录权限
		$api->group(['middleware' => 'jwt.auth'], function ($api) {
			// 退出
			$api->POST('/logout', [
				'as' => 'logout.logout',
				'uses' => 'AuthController@logout',
			]);
			// // 购物车列表
			$api->GET('/cart', [
				'as' => 'cart.index',
				'uses' => 'CartController@index',
			]);
			// // 添加商品到购物车
			$api->POST('/cart', [
				'as' => 'cart.store',
				'uses' => 'CartController@store',
			]);
			// // 查询购物车里的商品
			$api->GET('/cart/{id}', [
				'as' => 'cart.show',
				'uses' => 'CartController@show',
			]);
			// 删除购物车商品
			// $api->DELETE('/cart/{id}', [
			// 	'as' => 'cart.destroy',
			// 	'uses' => 'Controllers@destroy',
			// ]);
			// 订单首页
			$api->GET('/order', [
				'as' => 'order.index',
				'uses' => 'OrderController@index',
			]);
			// // 其它订单
			$api->GET('/order/{id}', [
				'as' => 'order.show',
				'uses' => 'OrderController@show',
			]);
			// 个人中心
			// $api->get('/me', [
			// 	'as' => 'me.index',
			// 	'uses' => ''
			// ]);
		});

	});
	
});
