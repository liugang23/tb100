<?php
namespace App\Http\Controllers\Home;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\ValidateCodeService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;


class ValidateCodeController extends Controller
{
	private static $validateCodeService;

	public function __construct(ValidateCodeService $validateCodeService)
    {
        self::$validateCodeService = $validateCodeService;
    }

	/**
	 * 创建验证码
	 */
	public function index(Request $request)
	{ 
		$ValidateCode =  self::$validateCodeService->getCode();
		return $ValidateCode;
	}

	/**
	 * 发送手机短信
	 */
	public function store(Request $request)
    {
    	$tel = $request->input('phone');
    	$phoneCode = self::$validateCodeService->sendSMS($tel);

    	if (empty($phoneCode)) {
    		// return $response->setStatusCode(401);
            return response()->json(
                [
                    'serverTime' => time(),
                    'statusCode' => 401,
                    'resultInfo' => '请求失败',
                    'resultData' => '' 
                ]
            );

    	} elseif ($phoneCode['statusCode'] == 200) {
            return response()->json(
                [
                    'serverTime' => time(),
                    'statusCode' => 200,
                    'resultInfo' => '短信已发送',
                    'resultData' => '' 
                ]
            );
    	}

    }

}