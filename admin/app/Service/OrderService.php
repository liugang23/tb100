<?php
namespace App\Service;

use Illuminate\Http\Request;
use App\Store\OrderStore;
use App\Store\CartStore;
use App\Store\GoodsStore;
use App\Model\Cart;
use App\Model\Order;
use App\Model\OrderItem;
use Illuminate\Support\Facades\Session;
use App\Tools\UUID;


class OrderService
{
	private static $orderStore;
	private static $cartStore;
	private static $goodsStore;
	
	public function __construct(OrderStore $orderStore, CartStore $cartStore, GoodsStore $goodsStore)
	{
		self::$orderStore = $orderStore;
		self::$cartStore = $cartStore;
		self::$goodsStore = $goodsStore;
	}

	/**
	  * 创建订单
	  * @param $user $guids   
	  * @return mixed
	  */
	public function apiAddOrder($user='', $guids)
	{
		// 判断用户是否存在
		if($user != '') {
			$guids_arr = [];
			// 对传进来的商品进行处理 
			foreach ($guids as $key => $val) {
				$guids_arr = $val;
			}
			$where = array('uid' => $user->uid, 'status' => 0);
			$cartItems = self::$cartStore
							 ->apiGetCartOrder($where, $guids_arr);

			// 判断是否为空
			if(count($cartItems) > 0) {
				// 初始化
				$cart_items_arr = array();
				$total_price = 0;
				$title= '';

				// 遍历购物车列表
				foreach ($cartItems as $cart) {
					$where = ['id'=>$cart->id];	// 购物车id
					// return $where;
					$status = 1;
					// 修改购物车状态(状态为1)
					$result = self::$cartStore
								 ->apiUpdateCart($where,$status);
					$param = [
						'status'=>0,
						'guid'=>$cart->guid
					];
					// 查询商品表并添加商品信息
					$cart->goods = self::$goodsStore
									   ->apiGetGoods($param);

					// 统计商品总价
					if(count($cart->goods) >= 1) {
						// 计算总价
						$total_price += $cart->goods->price * $cart->count;
						// 订单标题
						$title .= ('《'.$cart->goods->name.'》');
						// 写入订单信息
						array_push($cart_items_arr, $cart);
					}
				}

				// 生成订单号并保存相应信息
				$data = [
					'uid' => $user->uid,
					'title' => $title,
					'guid' => $cart->guid,
					'count' => $cart->count,
					'total_price' => $total_price,
					'order_id' => 'E'.time().''.rand(100,1000),
					'addtime' => time()
				];

				$order = self::$orderStore->apiAddOrder($data);

				// 判断添加订单是否成功
				if($order) {
					// 生成订单快照并保存
					foreach ($cart_items_arr as $cart_item) {
						$param = [
							'order_id' => $order->id,
							'guid' => $cart_item->guid,
							'count' => $cart_item->count,
							'goods_snapshot' => json_encode($cart_item->goods),
							'addtime' => time()
						];

						$orderItem = self::$orderStore->apiAddOrderItem($param);
					}

					return $result;
				}
				return '订单创建失败';
			}
			return '快点添加商品到购物车吧！';
		}
		
		return '请先登录';
		
	}

	/**
	  * 查询所有订单
	  * @param $uid
	  * @return mixed
	  */
	public function apiGetOrderAll($uid)
	{
		$user = Session::get('user', '');
		if($user != '') {
			$orders = self::$orderStore
					  ->apiGetOrderAll($user->uid);

			if($orders) {
				return $orders;
			}
			return '订单查询失败';
		}
		
		return '用户不存在';
		
	}

	/**
	  * 查询不同类型订单
	  * @param $user 	用户
	  * @param $type    订单类型
	  * @return mixed
	  */
	public function apiGetOrderList($user='', $type)
	{
		// 获取用户id   订单类型
		$uid = $user['uid'];

		// 判断用户是否登录
		if($uid != '') {
			// 判断查询类型
			if($type == 0) {
				// 查询 where 条件 gt 大于(>)
				$where['status'] = array('gt', 4);
				$orders = self::$orderStore
					  ->apiGetOrderList($uid, $where);

				if($orders) {
					foreach ($orders as $key) {
						$goods = self::$goodsStore
								->apiGetGoods($key->guid);
						$key->goods = $goods;
					}
					return $orders;
				}
				return '查询出错';
			}else{
				// eq 等于(=)
				$where['status'] = array('eq', $type);
				$orders = self::$orderStore
					  ->apiGetOrderList($uid, $where);

				if($orders) {
					foreach ($orders as $key) {
						$goods = self::$goodsStore
								->apiGetGoods($key->guid);
						$key->goods = $goods;
					}
					return $orders;
				}
				return '查询出错';
			}
		}
		return '';
	}

	/**
	  * 删除订单
	  * @param $guid
	  * @return mixed
	  */
	public function apiDeleteOrder($guid)
	{
		$result = self::$orderStore
					  ->apiDeleteOrder($guid);

		if($result) {
			return $result;
		}
		return '订单删除失败';
	}

}