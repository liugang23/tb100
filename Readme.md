# 项目说明
> 获取商品列表，每页显示10条

* 请求方式：get
* 请求地址：http://www.test.com/api/goodslist

### 路由说明
	/login        // 登录，不需要登录可以访问，登录后不可以访问
	/register     // 注册，不需要登录可以访问，登录后不可以访问
	/logout       // 退出登录，需要登录后才可以访问
	/home         // 首页，不需要登录可以访问
	/info		  // 商品详情，不需要登录可以访问
	/order		  // 订单页，需要登录后可以访问
	/me           // 个人中心，需要登录后可以访问
	/cart		  // 购物车，需要登录后可以访问
	/pay		  // 支付，需要登录后可以访问
	

### 请求参数说明

| 参数名称 | 类型 | 必填 | 说明 |
|---|---|----|
| page | int | 否 |当前页 |
| num | int | 否 | 每页显示多少条 |


### 返回参数的说明

| 参数名称 | 类型 | 说明 |
| --- | --- | ---- |
| servetTime| int | 服务器时间 |
| statusCode | int | 状态码 |
| resultInfo | string | 每页显示多少条 |
| resultData | obj | 返回的数据 |


### 返回示例


	{
	serverTime: 1487299443,
	statusCode: "0",
	resultInfo: "请求成功",
	resultData: "[{"id":1,"guid":"be21da973837bf3919f73a7392fb0082","name":"\u975e\u6d32\u6843\u5b50","subtitle":"\u975e\u6d32\u6843\u5b5010\u4e2a15\u5143","stock":"100 \u65a4","price":15,"spec":"10\u4e2a","class_id":1,"pic":"http:\/\/liugang23.oss-cn-shenzhen.aliyuncs.com\/148690659697083.jpg","describe":"\u975e\u5e38\u597d\u5403\u7684\u975e\u6d32\u6843\u5b50\uff0c\u4e2a\u5927\uff0c\u5947\u7279\uff01","sales":9,"new":1,"addtime":"1486708641","status":0,"class_name":"\u6c34\u679c","pater":0,"path":"0,","level":1}]"
	}


### 运行程序

	npm install

	npm run dev
	http://localhost:8088/
	
### 项目问题说明
项目api请求方式改为 dingo + jWT 方式后，用户认证报错

	<?php
	namespace App\Api\Controllers\V1;

	use Illuminate\Http\Request;
	use App\Api\Controllers\BaseController;

	use Tymon\JWTAuth\Facades\JWTAuth;
	use Tymon\JWTAuth\Exceptions\JWTException;
	use Illuminate\Support\Facades\Hash;
	use App\Service\UsersService;


	class AuthenticateController extends BaseController
	{
	     private static $usersService;

	     public function __construct(UsersService $usersService)
	     {
		 self::$usersService = $usersService;
	     }

	    /**
	     * 验证用户 创建 token
	     * @param Request $request
	     * @return \Illuminate\Http\JsonResponse
	     */
	    public function authenticate(Request $request)
	    {
		 // $data = [
		 //    'phone' => $request->get('phone'),
		 //    'password' => $request->get('passw')
		 // ];

		 // $user = self::$usersService->apiValidateUser($data);
		 // $token = JWTAuth::fromUser($user);

	       //  从请求获取凭据
		 $payload = $request->only('phone', 'passw');

		try {
		     // attempt 尝试验证凭据并为用户创建令牌
		     if (! $token = JWTAuth::attempt($payload)) {
			 // 返回无效令牌
			 return response()->json(['error' => 'invalid_credentials'], 401);
		     }
		 } catch (JWTException $e) {
		     // 尝试创建 token 令牌时出错
		     return response()->json(['error' => 'could_not_create_token'], 500);
		 }

		// 返回 token 令牌  compact函数创建一个由参数所带变量组成的数组
		return response()->json(compact('token'))
				 ->header('Content-Type', 'text/html;charset=utf-8');
	    }


	}
	
以上代码在 app\Api\Controller\V1 目录下可以找到，
根据laravel 文档说明 attempt 方法应该是执行用户验证及创建令牌的方法，但这里却找不到验证过程。
换成自定义验证：

	$data = [
           	'phone' => $request->get('phone'),
          	 'password' => $request->get('passw')
       	];

       $user = self::$usersService->apiValidateUser($data);
       $token = JWTAuth::fromUser($user);
       
 虽然登录成功了，但却不知道前端向后端发起请求时如何带上token。
 
 前端通过 store 获取token到，前端向后端请求时，带上token 报错，控制台错误如下：
 
 	XMLHttpRequest cannot load http://www.tb.com/api/cart?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzd…U3YTlmNzY3MzUxMzAzNzYyZDNkZSJ9.d6A0b1k5QMErjmoYRXFQNOpEVGJUxJN1I1PDQzF0HNM. No 'Access-Control-Allow-Origin' header is present on the requested resource. Origin 'http://localhost:8088' is therefore not allowed access. The response had HTTP status code 500.
	
通过浏览器以get请求，报错如下：

	{"message":"SQLSTATE[42S22]: Column not found: 1054 Unknown column 'data_users.id' in 'where clause' (SQL: select * from `data_users` where `data_users`.`id` is null limit 1)","code":"42S22","status_code":500,"debug":
 
 浏览器返回的报错大概说明是从数据库取数据时的问题，因为没有 id 这个字段，问题就来了，JWT是如何实现对数据的操作呢？
 
 这里 app\config\app.php  和 app\config\jwt.php  这两个文件相关model 的内容均修改为 app\model
 
 在这里向各位高手、技术大侠请教。项目有很多漏洞，如可以，请一并指出！谢谢！
