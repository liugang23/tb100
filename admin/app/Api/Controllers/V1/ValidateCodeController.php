<?php
namespace App\Api\Controllers\V1;

use App\Api\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Service\ValidateCodeService;
//use Symfony\Component\HttpFoundation\Response;
//use Illuminate\Support\Facades\Session;


class ValidateCodeController extends BaseController
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
            $data = [
                        'serverTime' => time(),
                        'statusCode' => 401,
                        'resultInfo' => '请求失败',
                        'resultData' => '' 
                    ];

            return response()->json($data);

    	} else {

            $data = [
                        'serverTime' => time(),
                        'statusCode' => 200,
                        'resultInfo' => '短信已发送',
                        'resultData' => ''
                    ];

            return response()->json($data);
    	}

    }

}