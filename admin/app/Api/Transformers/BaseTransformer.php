<?php

namespace App\Transformers;
// dingo api 提供
use League\Fractal\TransformerAbstract;
use Illuminate\Database\Eloquent\Model;

class BaseTransformer extends TransformerAbstract
{
	public function transform(Model $object)
	{
		return $object->attributesToArray();
	}
}