<?php
namespace App\Api\Controllers\V1;

use Illuminate\Http\Request;
use App\Api\Controllers\BaseController;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\Service\UserService;
use Carbon\Carbon;
use Hash;

class AuthController extends BaseController
{
    private static $userService;
    // protected $username = 'email';

    public function __construct(UserService $userService)
    {
        self::$userService = $userService;
    }

    /**
     * 验证用户  获取token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        // $data = [
        //     'tel' => $request->get('phone'),
        //     'status' => 0
        // ];
        // // 查询用户是否存在
        // $user = self::$userService->apiGetUser($data);
        // $payload = $request->only('email', 'password');
        // if ($user) {
            $payload = [
                'phone' => $request->get('phone'),
                'password' => $request->get('passw'),
                'status' => 0
            ];

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
        // return response()->json(compact('token'));

        $result['data'] = [
            'token' => $token,
            'expired_at' => Carbon::now()->addMinutes(config('jwt.ttl'))->toDateTimeString(),
            'refresh_expired_at' => Carbon::now()->addMinutes(config('jwt.refresh_ttl'))->toDateTimeString(),
//            'uid' => $user['uid'],
            'type' => true,
        ];

        return $this->response->array($result)->setStatusCode(201);
        // }

        // return '用户不存在';
        
    }

    /**
     * Register user
     *
     * Register a new user with a `username` and `password`.
     *
     * @Post("/")
     * @Versions({"v1"})
     * @param Request $request
     * @Request({"username": "foo", "password": "bar"}, identifier="A")
     */
    public function register(Request $request)
    {
        $newUser = [
            'phone' => $request->get('phone'),
            'password' => Hash::make($request->get('passw'))
        ];
        // 添加注册用户
        $user = self::$usersService->apiAddUser($newUser);
        // 判断新注册用户
        if($user['statusCode'] == 200) {
            // fromUser 为用户添加 token
            $token = JWTAuth::fromUser($user['resultData']);

            return response()->json(compact('token'));
                             
        }
        return $user;
    }

    /***
     * Logout user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard($this->guard)->logout();
        return response()->json(['status' => 'ok']);
    }

    /**
     * 刷新 token
     * 
     * @return mixed
     */
    public function refershToken()
    {
//        $token = JWTAuth::refresh(),
//        return response()->json(compact('token'));
    }

    /**
     * 根据 token 获取用户信息
     * 
     */
    public function getAuthenticatedUser()
    {
        try {// parseToken 解析令牌请求来源
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        // token 有效，找到用户
        return response()->json(compact('user'));
    }

}
