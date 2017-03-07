<?php
namespace App\Store;

class AdminStore
{
	// 查询
	public static function getAdminLogin($where)
	{
		return \DB::table('data_admin')->where($where)->first();
	}

	// 添加
	public static function addAdmin($data)
	{
		return \DB::table('data_admin')->insert($data);
	}
}