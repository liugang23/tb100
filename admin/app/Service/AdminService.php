<?php
namespace App\Service;

use App\Store\AdminStore;
use App\Tools\UUID;
use Session;
use Hash;

class AdminService 
{
	private static $adminStore;

	public function __construct(AdminStore $adminStore)
	{
		self::$adminStore = $adminStore;
	}

	/*
	 * 执行后台管理员登录操作
	 */
	public function login($data)
	{
		$password = $data['password'];	// 密码加密
		$where = [
			'username' => $data['username'],
			// 'password' => $password,
			'status' => 1,				// 查询状态为1的正常用户
		];
		// 查询用户
		$result = self::$adminStore->getAdminLogin($where); 

		if (!empty($result) || isset($result)) {
			// 用户存在 较验密码
			if (Hash::check($password, $result->password)) {
				Session::put('admin',$result);
				return $result;
			}
		}

		return null;
	}	

	/*
	 * 添加管理员操作
	 */
	public function create($data)
	{
		$password = Hash::make($data['password']);	// 密码加密
		$where = [
			'username' => $data['username'],
			'password' => $password,
			'level' => $data['level'],  // 管理员级别
			'status' => 1,				// 查询状态为1的正常用户
			'addtime' => time(),		// 当前时间戳
		];

		$result = self::$adminStore->addAdmin($where); 

		return $result;
	}
}