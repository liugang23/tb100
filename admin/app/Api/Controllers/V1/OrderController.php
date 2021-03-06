<?php
namespace App\Api\Controllers\V1;

use App\Api\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Service\OrderService;
use App\Api\Transformers\OrderTransformer;
use Dingo\Api\Routing\Helpers;
use JWTAuth;


class OrderController extends BaseController
{
    // 接口帮助调用
    use Helpers;
	private static $orderService;

    public function __construct(OrderService $orderService)
    {
        self::$orderService = $orderService;
    }

	/**
     * Display a listing of the resource.
     * 获取所有订单
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     * 显示添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     * 添加\创建 订单
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param = $request->all();
        $user = JWTAuth::parseToken()->authenticate();
        $order = self::$orderService->apiAddOrder($user, $param);
        return $order;
    }

    /**
     * Display the specified resource.
     * 获取指定类型订单
     * @param  int  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $type)
    {   
        // $user = $this->user();
        $user = JWTAuth::parseToken()->authenticate();

        $order = self::$orderService
                     ->apiGetOrderList($user, $type);

        // 不存在 调用dingo 的 response 方法返回错误信息
        if(!$order) {
            return $this->response->errorNotFound('order not found');
        }
        // return $order;
        return $this->response->item($order, new OrderTransformer());
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
     * 删除订单
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}