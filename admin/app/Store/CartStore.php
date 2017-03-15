<?php
namespace App\Store;

use App\Model\Cart;
use App\Model\User;

class CartStore
{
	/**
	 * 查询购物车
	 * @param $where    指定查询条件
	 * @return mixed
	 */
	public static function apiGetCartAll($where)
	{
		return Cart::where($where)
				   ->get();
	}

	/**
	 * 添加商品到购物车
	 */
	public static function apiAddCart($data)
	{
		return Cart::create($data);
	}

	/**
 	 * 更新购物车状态
 	 * @param $where   更新条件
 	 * @param $status  更新范围
 	 * @return mixed
	 */
	public static function apiUpdateCart($where, $status)
	{
		$cart =  Cart::where($where)->first();
		$cart->status = $status;
		$cart->save();
		return $cart;
	}


	// 从购物车删除商品
	public static function apiDeleteCart($uid, $guid)
	{
		return Cart::where('uid', $uid)
					->whereIn('guid', $guid)
					->update(array('status'=>1));
	}

	/**
	 * 查询购物车 订单
	 * @param $where    指定查询条件
	 * @param $whereIn  数组查询条件
	 * @return mixed
	 */
	public static function apiGetCartOrder($where, $whereIn)
	{
		return Cart::where($where)
				   ->whereIn('guid',$whereIn)
				   ->get();
	}

}