<?php
namespace App\Service;

use Illuminate\Http\Request;
use App\Store\PhoneCodeStore;
use App\Store\UserStore;
use App\Tools\ValidateCode;
use App\Tools\SMS\SendTemplateSMS;
use App\Tools\MSGResutl;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Captcha;

class ValidateCodeService
{
	private static $validateCode;
    private static $userStore;
    private static $phoneCodeStore;
    private static $captcha;
	
	public function __construct(UserStore $userStore, PhoneCodeStore $phoneCodeStore)
	{
        self::$userStore = $userStore;
        self::$phoneCodeStore = $phoneCodeStore;
	}

	/**
	  * 获取验证码
	  */ 
	public function getCode()
	{
        return Captcha::create('default');
	}

	/**
	  * 获取手机短信验证码
	  */ 
	public function sendSMS($phone)
	{
        $Msg_resutl = new MSGResutl;

        // 判断手机号是否为空
        if (strlen($phone) !== 11) {
            $data = array('statusCode' => 501,
                          'resultInfo' => '必须是11位手机号');
            return $data;
        }

        // 判断手机号是否已注册
        $user = self::$userStore->getUsers('tel', $phone);
        
        // if (empty($user) || !isset($user)) { // 手机是否存在

            // $Msg_resutl = new MSGResutl;
            $send = new SendTemplateSMS;     // 实例信息发送接口
            $code = '';     // 初始化
            $charset = '1234567890';    // 随机数字
            $len = strlen($charset) - 1;    // 数字字符串长度
            // 生成六位数字验证码
            for ($i = 0; $i < 6; ++$i) {
                $code .= $charset[mt_rand(0, $len)];
            }

            // 发送手机验证码
            $Msg = $send->SendTemplateSMS($phone, array($code, 3), 1); 

            // 验证码发送正常(status==0),记录下发送信息
            if ($Msg_resutl->status == 0) {
 
                // 查询接收验证码手机是否已登记
                $user = self::$phoneCodeStore
                              ->query($phone);

                // 判断手机是否存在于手机短信表中
                if (!empty($user) || isset($user)) {
                    // 存在   直接更新
                    $result = self::$phoneCodeStore
                                    ->update($phone,$code);
                } else {
                    // 否则   写入
                    $result = self::$phoneCodeStore
                                    ->create($phone,$code);
                }  
                // 返回成功发送的验证码
                $data = array(
                    'statusCode' => 200,
                    'resultData' => (string)$Msg->message);
                return $data;                  
            } else {
                // 返回失败发送的状态
                $data = array(
                    'statusCode' => (string)$Msg->status,
                    'resultData' => (string)$Msg->message);
                return $data;

            }
            
        // } else {
        //     return response()->json(
        //         [
        //             'serverTime' => time(),
        //             'statusCode' => '100',
        //             'resultInfo' => '手机已注册',
        //             'resultData' => '' 
        //         ]
        //     );
        // }
        
	}

}