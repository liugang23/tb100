<?php
namespace App\Api\Transformers;

use App\Model\Cart;
use League\Fractal\TransformerAbstract;

class CartTransformer extends TransformerAbstract
{
	/***
	 * 分开为了解耦
	 * 数据字段选择
	 * @param $data
	 * @return array
	 */
	public function transform(Cart $cart)
	{
		// 返回指定字段
		// return [
		// 	'serverTime' => time(),
		// 	'statusCode' => 200,
		// 	'resultInfo' => '查询成功',
		// 	'resultData' => $cart
		// ];

		return $cart->attributesToArray();
	}

}