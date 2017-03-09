<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{

	public function responseNotFound($message = 'Not Found')
	{
		return $this->responseError($message);
	}

	private function responseError($message)
	{
		return $this->response([
            'serverTime' => time(),
//            'statusCode' => $code,
            'resultInfo' => '请求失败',
            'resultData' => '' 
		]);
	}

	private function response($data)
	{


	}


}