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
|---|---|----|---|
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
项目api请求方式改为 dingo + jWT 方式后，虽然没有报错，但返回token 有误：	

	<?php
	namespace App\Api\Controllers\V1;

	use Illuminate\Http\Request;
	use App\Api\Controllers\BaseController;

	use \JWTAuth;
	use App\Service\UsersService;
	use Carbon\Carbon;
	use Auth;


	class AuthenticateController extends BaseController
	{
	     private static $usersService;

	     public function __construct(UsersService $usersService)
	     {
		 self::$usersService = $usersService;
	     }

	    /**
	     * 验证用户  获取token
	     * @param Request $request
	     * @return \Illuminate\Http\JsonResponse
	     */
	    public function authenticate(Request $request)
	    {
		$payload = [
		    'tel' => $request->get('phone'),
		    'password' => $request->get('passw'),
		    'status' => 0,
		];

		try {
		    // attempt 尝试验证凭据并为用户创建令牌
		    if (! $token = Auth::attempt($payload)) {
			// 返回无效令牌
			return response()->json(['error' => 'invalid_credentials'], 401);
		     }
		} catch (JWTException $e) {
		    // 尝试创建 token 令牌时出错
		    return response()->json(['error' => 'could_not_create_token'], 500);
		}

		// 返回 token 令牌  compact函数创建一个由参数所带变量组成的数组
		// return response()->json(compact('token'));

		$result['data'] = [
		    'token' => $token,
		    'expired_at' => Carbon::now()->addMinutes(config('jwt.ttl'))->toDateTimeString(),
		    'refresh_expired_at' => Carbon::now()->addMinutes(config('jwt.refresh_ttl'))->toDateTimeString(),
		];

		return $this->response->array($result)->setStatusCode(201);
	    }

	}

	
以上代码在 app\Api\Controller\V1 目录下可以找到，
       
通过 Auth::attempt($payload) 获得token 为 true 并不是一个字符串。求解！
	 {token: true, expired_at: "2017-03-08 15:12:42", refresh_expired_at: "2017-03-22 14:12:42"}
通过 JWTAuth::attempt($payload) 获得 token 为一个字符串，但是始终 Token Signature could not be verified （无法验证）
 
 在这里向各位高手、技术大侠请教。项目有很多漏洞，如可以，请一并指出！谢谢！
