<?php
namespace App\Api\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
// use App\Http\Controllers\Controller;

class BaseController extends Controller
{
	// 接口帮助调用
	use Helpers;

	/**
	 * 返回错误的请求
	 */
	protected function errorBadRequest($validator)
	{
		
	}

}