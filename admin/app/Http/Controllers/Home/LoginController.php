<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Service\UsersService;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
	private static $usersService;

	public function __construct(UsersService $usersService)
    {
        self::$usersService = $usersService;
    }

	/**
	 * 
	 */    
    public function index()
    {

    }

    /**
	 * 执行登录操作
     */
	public function store(Request $request, Response $response)
	{	
		$data = $request->all();
		$result = self::$usersService->apiLogin($data);

		if (empty($result)) {
    		return $result->setStatusCode(401);
    	} else {
    		return $result;
    	}
	}

}