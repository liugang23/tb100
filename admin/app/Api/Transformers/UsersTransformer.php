<?php
namespace App\Api\Transformers;

/*** 该类为 dingo api 封装好 ***/
use League\Fractal\TransformerAbstract;

class UsersTransformer extends TransformerAbstract
{
	/***
	 * 分开为了解耦
	 * 数据字段选择
	 * @param $data
	 * @return array
	 */
	public function transform($data)
	{
		return [
			'phone' => $data['phone']
		];
	}

}