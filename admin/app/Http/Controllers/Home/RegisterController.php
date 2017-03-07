<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Home\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Service\RegisterService;

class RegisterController extends Controller
{
	private static $registerService;

	public function __construct(RegisterService $registerService)
    {
        self::$registerService = $registerService;
    }

	/**
	 * 
	 */    
    public function index()
    {

    }

    /**
	 * 执行注册操作
     */
	public function store(RegisterRequest $request, Response $response)
	{	
		$data = $request->all();
		return $data;

		$result = self::$registerService->apiAddRegisterUser($data);

		if (empty($result)) {
            return $response->setStatusCode(401);
        } else {
            return $result;
        }

	}

}