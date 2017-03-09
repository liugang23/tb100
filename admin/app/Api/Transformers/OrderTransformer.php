<?php
namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;
use App\Model\Order;

class OrderTransformer extends TransformerAbstract
{
	/***
	 * 分开为了解耦  数据字段选择
	 * @param $data
	 * @return array
	 */
	public function transform(Order $order)
	{
		// 返回指定字段
		// return [
		// 	'uid' => $order['uid'],
		// 	'title' => $order['title'],
		// 	'order_id' => $order['order_id'],
		// 	'total_price' => $order['total_price']
		// ];

		// 调用 model 里的方法 将属性转换为数组
		return $order->attributesToArray();
	}

}