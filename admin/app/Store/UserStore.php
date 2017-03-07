<?php
namespace App\Store;

use App\Model\User;

class UserStore
{
	private static $user = 'data_users';


	/**
	 * 用户查询  admin
	 */
	public static function adminGetUser($id, $val)
	{
		return \DB::table('data_users')
			   ->where($id, $val)->first();
	}

	/**
	 * 添加用户  admin
	 * 
	 */
	public static function adminAddUser($data)
	{
		return \DB::table('data_users')->insert($data);
	}

	/**
	 * 获取指定用户 Api
	 * @param $phone
	 * @return mixed
	 */
	public static function apiGetUser($phone)
	{	
		return User::where('tel', $phone)->first();
	}

	/**
	 * 添加注册用户 Api
	 * @param $phone $possword
	 * @return mixed
	 */
	public static function apiAddUser($data)
	{   
		return User::create($data);
	}

}