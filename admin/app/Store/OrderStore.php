<?php
namespace App\Store;

use App\Model\User;
use App\Model\Order;

class OrderStore
{
	/**
	  * 创建订单
	  * @param $date   需要添加的数据
	  * @return mixed
	  */
	public function apiAddOrder($data)
	{
		$order = new Order;
		$order->uid = $data['uid'];
		$order->title = $data['title'];
		$order->order_id = $data['order_id'];
		$order->total_price = $data['total_price'];
		$order->save();
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
	public function apiGetOrderAll($uid)
	{
		return User::where(['uid'=>$uid])
				   ->first()->hasUserOrder()
				   ->where('status', '>', 5)
				   ->get();
	}

	/**
	  * 查询不同类型订单
	  * @param $uid     用户id
	  * @param $where   订单查询条件
	  * @return mixed
	  */
	public function apiGetOrderList($uid, $where)
	{
		return User::where(['uid'=>$uid])
				   ->first()->hasUserOrder
				   ->where($where)
				   ->get();
	}


	
}