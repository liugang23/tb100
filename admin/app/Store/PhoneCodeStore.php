<?php
namespace App\Store;

use App\Model\PhoneCode;

class PhoneCodeStore
{
	/**
	 * 查询手机
	 */
    public static function query($phone)
    {
    	return PhoneCode::where('phone', $phone)
                          ->first();
    }

    /**
     * 更新手机验证码
     */
    public static function update($phone,$code)
    {
        $Code = PhoneCode::where('phone', $phone)
                           ->first();
    	$Code->code = $code;
        $Code->deadline = date('Y-m-d H:i:s', time() + 60*60); // 数字验证码有效时长 60*60 一个小时
        return $Code->save();
    }

    /**
     * 执行添加
     */
    public static function create($phone,$code)
    {	
    	$Code = new PhoneCode;
        // 写入
        $Code->phone = $phone;
        $Code->code = $code;
        $Code->deadline = date('Y-m-d H:i:s', time() + 60*60); // 数字验证码有效时长 60*60 一个小时
        return $Code->save();
    }

}