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
	  * @param $type    订单类型
	  * @return mixed
	  */
	public function apiGetOrderList($type)
	{
		$param = array([
            'guid' => 'E'.$type,
            'username' => 'name',
            'password' => 'password',
        ],[
            'guid' => 'E'.'789789',
            'username' => 'name',
            'password' => 'password',
        ]);
        return $param;
		$user = Session::get('user', '');
		// 判断用户是否登录
		if($user != '') {
			// 判断查询类型
			if($type == 0) {
				// 查询 where 条件
				$where = ['status', '>', 4];
				$orders = self::$orderStore
					  ->apiGetOrderList($user->uid, $where);

				if($orders) {
					return $orders;
				}
				return '';
			}else{
				$where = ['status', '=', $type];
				$orders = self::$orderStore
					  ->apiGetOrderList($user->uid, $where);

				if($orders) {
					return $orders;
				}
				return '';
			}
		}
		return '';
	}

	/**
	  * 创建订单
	  * @param $guids    商品id字串
	  * @return mixed
	  */
	public function apiAddOrder($guids)
	{
		// 结算时生成订单
		// 获取用户登录信息
		$user = Session::get('user_id');
		// 判断用户是否存在
		if($user != '') {
			// 对传进来的商品进行处理 
			$guids_arr = ($guids != '' ? explode(',', $guids) : array());
			$where = array(['uid' => $user->uid], ['status' => 0]);
			$whereIn = ['guid', $guids_arr];
			// 查询关联购物车表(状态为0)
			$cartItems = self::$cartStore
							 ->apiGetCartOrder($where, $whereIn);

			if(!empty($cartItems)) {
				// 初始化
				$cart_items_arr = array();
				$total_price = 0;
				$title= '';

				// 遍历购物车列表
				foreach ($cartItems as $cart) {
					$where = ['id', $cart->id];	// 购物车id
					$status = 1;
					// 修改购物车状态(状态为1)
					$result = self::$cartStore
								 ->apiUpdateCart($where,$status);
					// 这里需要对更新的情况进行判断

					// 查询商品表并添加商品信息
					$cart->goods = self::$goodsStore
									   ->apiGetGoods($cart->guid);
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
					'total_price' => $total_price,
					'order_id' => 'E'.time().''.rand(100,1000),
					'addtime' => time()
				];
				$order = self::$cartStore->apiAddOrder($data);


				if($order) {
					// 生成订单快照并保存
					foreach ($cart_items_arr as $cart_item) {
						$order_item = new OrderItem;
						$order_item->order_id = $order->id;
						$order_item->guid = $cart_item->guid;
						$order_item->count = $cart_item->count;
						$order_item->goods_snapshot = json_encode($cart_item->goods);
						$order_item->save();
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