<?php
namespace App\Api\Transformers;

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
		return $user->attributesToArray();
	}

}