<?php
namespace App\Tools;

class MSGResutl {
	public $status;
	public $message;

	public function toJson()
	{	
		// 对变量进行JSON编码
		return json_encode($this, JSON_UNESCAPED_UNICODE );
	}

}