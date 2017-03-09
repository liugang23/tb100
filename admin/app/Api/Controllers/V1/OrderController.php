<?php
namespace App\Api\Controllers\V1;

use App\Api\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Service\OrderService;
use App\Api\Transformers\OrderTransformer;


class OrderController extends BaseController
{
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
    public function index(Request $request)
    {   
        $order = self::$orderService
                         ->apiGetOrderAll();


        return $this->collection($order, new OrderTransformer);

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
     * 添加订单
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     * 获取指定类型订单
     * @param  int  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Response $response, $type)
    {
        $orderlist = self::$orderService->apiGetOrderList($type);

        if (empty($orderlist)) {
            return $response->setStatusCode(401);
        } else {
            return $orderlist;
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
     * 删除订单
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}