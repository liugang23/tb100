<?php
namespace App\Store;

use App\Model\User;
use App\Model\Order;
use App\Model\OrderItem;

class OrderStore
{
	/**
	  * 创建订单
	  * @param $date   需要添加的数据
	  * @return mixed
	  */
	public function apiAddOrder($data)
	{
		return Order::create($data);
	}

	/**
	  * 创建订单快照
	  * @param $date   需要添加的数据
	  * @return mixed
	  */
	public function apiAddOrderItem($data)
	{
		return OrderItem::create($data);
	}

	/**
	  * 删除订单
	  * @param $order_id
	  * @return mixed
	  */
	public function apiDeleteOrder($order_id)
	{
		return Order::where(['order_id'=>$order_id])
				    ->update(['status'=>5]);
	}

	/**
	  * 查询所有订单
	  * @param $uid
	  * @return mixed
	  */
	// public function apiGetOrderAll($uid)
	// {
	// 	return User::where(['uid'=>$uid])
	// 			   ->first()->hasUserOrder()
	// 			   ->where('status', '>', 5)
	// 			   ->get();
	// }

	/**
	  * 查询不同类型订单
	  * @param $uid     用户id
	  * @param $where   订单查询条件
	  * @return mixed
	  */
	public function apiGetOrderList($uid, $where)
	{
		return Order::where('uid', $uid)
					->where($where)
					->get();
	}


	
}