<?php
namespace App\Service;

use App\Tools\UUID;
use App\Store\UserStore;
use Illuminate\Support\Facades\Hash;

class UserService
{
	private static $userStore;

	public function __construct(UserStore $userStore)
	{
		self::$userStore = $userStore;
	}

	public function adminAddUser($data)
	{
		$password = Hash::make($data['password']);	// 密码加密
		$uuid = UUID::create();	// 生成唯一 id

		$param = [
			'guid' => $uuid,
			'username' => $data['name'],
			'password' => $password,
			'tel' => $data['tel'],
			'pic' => $data['pic'],
			'addtime' => time()
		];

		return self::$userStore->adminAddUser($param);
	}

	/**
	 * 添加新注册用户 Api
	 * @param $phone
	 * @param $password
	 * @return mixed
	 */
	public function apiAddUser($data)
	{	
		// 判断用户是否已经注册
		$user = self::$userStore->apiGetUser($data['phone']);

		if(!$user) {
			$uuid = UUID::create();	// 生成唯一 id

			$param = [
				'uid' => $uuid,
				'username' => '',
				'password' => $data['password'],
				'tel' => $data['phone'],
				'pic' => '',
				'addtime' => time()
			];
			$result = self::$userStore->apiAddUser($param);
			if($result) {
				$data = [
					'serverTime' => time(),
                    'statusCode' => 200,
                    'resultInfo' => '注册成功',
                    'resultData' => $result 
				];
				return $data;
			}

			return '注册异常';
		}
		return '用户已注册';
	}

	/**
	 * 执行用户登录 Api
	 * @param $phone
	 * @return mixed
	 */
	public function apiValidateUser($data)
	{
        $param = [
             'tel' => $data['phone'],
             'status' => 0
        ];
        $password = $data['passw'];
		// $validateCode = $data['ValidateCode'];

		// 获取session 中的验证码
		// $validateCode_session = Session::get('ValidateCode');
		// if (!empty($validateCode_session)) {
		// 	return $validateCode_session;
		// }else{
		// 	return 133;
		// }
		// 校验验证码
//		if($validateCode !== $validateCode_session) {
//            return '验证码不正确';
//		}
		// 查询用户是否存在
		$user = self::$userStore->apiGetUser($param);

		if(empty($user) || !isset($user)) {
           return '';
		} else {
			if(Hash::check($password, $user->password)) {
				// 写入session
				// Session::put('user',$user);

           		return $user;
			} else {
           		return '';
			}
		}

		return '';
	}

	/**
	 * 执行用户登录 Api
	 * @param $phone
	 * @return mixed
	 */
	public function apiGetUser($data)
	{
		return self::$userStore->apiGetUser($data);
	}

}