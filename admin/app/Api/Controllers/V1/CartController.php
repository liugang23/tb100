<?php
namespace App\Api\Controllers\V1;

use App\Api\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Service\CartService;
use App\Api\Transformers\CartTransformer;
use Dingo\Api\Routing\Helpers;
use JWTAuth;

class CartController extends BaseController
{
    use Helpers;
	private static $cartService;

    public function __construct(CartService $cartService)
    {
        self::$cartService = $cartService;
    }

	/**
     * 显示购物车
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $cart)
    {
        // 获取用户 uid
        $user = JWTAuth::parseToken()->authenticate();
        $uid = $user['uid'];

        $cart = self::$cartService
                    ->apiGetCartList($user, $cart);

        // 不存在 调用dingo 的 response 方法返回错误信息
        if(empty($cart)) {
            return $this->response->errorNotFound('cart not found');
        }
        return $cart;
        // return $this->response->item($cart, new CartTransformer());
        // return $this->response->collection($cart, new CartTransformer());
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     * 执行添加操作
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guid = $request->all();    // 获取商品id
        $result = self::$cartService->apiAddCart($guid);

        if (empty($result)) {
            return $response->setStatusCode(401);
        } else {
            return $result;
        }
    }

    /**
     * Display the specified resource.
     * 查询指定商品在购物车中的数量
     * @param  int  $guid
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $guid)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        
    }

    /**
     * Remove the specified resource from storage.
     * 删除购物车商品
     * @param  $guids  购物车商品id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response, $guids)
    {
        $result = self::$cartService->apiDeleteCart($guids);

        if ($result->statusCode !== 200) {
            // return $response->setStatusCode(401);
            return $response->setResultInfo($result->resultInfo);
        } else {
            return $result;
        }
        
    }
}