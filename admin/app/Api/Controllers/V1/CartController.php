<?php
namespace App\Api\Controllers\V1;

use App\Api\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Service\CartService;

class CartController extends BaseController
{
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
    public function index(Request $request)
    {
        $cartList = self::$cartService->apiGetCartList();

        if (empty($cartList)) {
            return $response->setStatusCode(401);
        } else {
            return $cartList;
        }
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
    public function store(Request $request, Response $response)
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
    public function show(Request $request, Response $response, $guid)
    {
        $result = self::$cartService->apiGetCartGoods($guid);

        if (empty($result)) {
            return $response->setStatusCode(401);
        } else {
            return $result;
        }
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