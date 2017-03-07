<?php
namespace App\Service;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class RegisterService
{

	/**
	 *	添加新注册用户
	 */
	public function apiAddRegisterUser($data)
	{
		return $data;
		$phone = $data('phone', '');
		$password = $request->input('passw', '');
		$phoneCode = $request->input('phone_code', '');
		$validateCode = $request->input('validate_code', '');
		// 判断用户手机号是否已经注册
		$user = Member::where('phone', $phone)->first();
		if (empty($user) || !isset($user)) { // 手机是不存在
			// 获取手机原始验证码
			$PhoneCode = PhoneCode::where('phone', $phone)->first();

			// 检验手机格式是否正确
			if($data('phone') == '' || $data('phone') < 11) {
				return response()->json(
	                [
	                    'serverTime' => time(),
	                    'statusCode' => 400,
	                    'resultInfo' => '手机号不少于11位',
	                    'resultData' => '' 
	                ]
	            );
			}
			// 检验密码位数
			if($data('passw') == '' || strlen($data('passw')) < 6) {
				return response()->json(
	                [
	                    'serverTime' => time(),
	                    'statusCode' => 401,
	                    'resultInfo' => '密码不少于6位',
	                    'resultData' => '' 
	                ]
	            );
			}
			// 检验确认密码位数
			if($data('rpassw') == '' || strlen($data('rpassw')) < 6) {
				return response()->json(
	                [
	                    'serverTime' => time(),
	                    'statusCode' => 402,
	                    'resultInfo' => '确认密码不少于6位',
	                    'resultData' => '' 
	                ]
	            );
			}
			// 检验两次输入密码是否相符
			if($data('passw') != $data('rpassw')) {
				return response()->json(
	                [
	                    'serverTime' => time(),
	                    'statusCode' => 403,
	                    'resultInfo' => '两次密码不相符',
	                    'resultData' => '' 
	                ]
	            );
			}

			// 检验验证码位数
			if($data('validateCode') == '' || strlen($data('validateCode')) < 4) {
				return response()->json(
	                [
	                    'serverTime' => time(),
	                    'statusCode' => 405,
	                    'resultInfo' => '请输入四位验证码',
	                    'resultData' => '' 
	                ]
	            );
			}
			// 校验验证码输入是否正确

			// 检验手机验证码位数
			if($data('phoneCode') == '' || strlen($data('phoneCode')) < 6) {
				return response()->json(
	                [
	                    'serverTime' => time(),
	                    'statusCode' => 406,
	                    'resultInfo' => '手机验证码为6位',
	                    'resultData' => '' 
	                ]
	            );
			}

			if($PhoneCode->code == $phone_code) {
				if(time() > strtotime($PhoneCode->deadline)){
						$result->status = 7;
						$result->message = '手机验证码不正确';
						return $result->toJson();
				}

					$member = new Member;
					$member->phone = $phone;
					$member->password = Hash::make($password);
					$member->save();

					$result->status = 0;
					$result->message = '注册成功';
					return $result->toJson();

			} else {
					$result->status = 7;
					$result->message = '手机验证码不正确';
					return $result->toJson();
			}

		} else {
			$result->status = 100;
			$result->message = '手机已注册';
			return $result->toJson();
		}

		

	}



}