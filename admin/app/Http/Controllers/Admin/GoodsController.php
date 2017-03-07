<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\GoodsService;

class GoodsController extends Controller
{
    private static $goodsService;

    public function __construct(GoodsService $goodsService)
    {
        self::$goodsService = $goodsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods = self::$goodsService->adminGetGoodsAll();

        return view('admin.goods.goods_list')
                ->with('goods', $goods);
    }

    /**
     * Show the form for creating a new resource.
     * 显示添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = self::$goodsService->adminAddGoodsShow();

        return view('admin.goods.goods_add')
                ->with('class', $class);
    }

    /**
     * Store a newly created resource in storage.
     * 执行添加操作
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $result = self::$goodsService->adminAddGoods($data);

        if($result === true) {
            return response()->json(array(
                    'status' => 0,
                    'message' => '添加成功！'));
        }else{
            return response()->json(array(
                    'status' => 1,
                    'message' => '添加失败！'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $goods = self::$goodsService->adminGetGoods($id);

        return view('admin.goods.goods_list')
                ->with('goods', $goods);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goods = self::$goodsService->adminEditGoods($id);

        return view('admin.goods.goods_edit')
                ->with('goods', $goods);
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
        $data = $request->all();
        $result = self::$goodsService->adminUpdateGoods($data);

        if($result) {
            return response()->json(array(
                    'status' => 0,
                    'message' => '更新成功！'));
        }else{
            return response()->json(array(
                    'status' => 1,
                    'message' => '更新失败！'));
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = self::$goodsService->adminDeleteGoods($id);

        if($result) {
            return response()->json(array(
                    'status' => 0,
                    'message' => '删除成功！'));
        }else{
            return response()->json(array(
                    'status' => 1,
                    'message' => '删除失败！'));
        }
    }

    /*
     * 显示支付页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function aliPay($id)
    // {
    //     // 根据id 查询商品
    //     $result = self::$goodsService->adminGetGoods($id);
    //     // 判断商品是否存在
    //     if (empty($result)) return '商品不存在！';
    //     // 订单号
    //     $orderId = '';
    //     // 创建支付订单
    //     $aliPay = app('alipay.web');
    //     $alipay->setOutTradeNo($orderId);
    //     $alipay->setTotalFee($orderPrice);
    //     $alipay->setSubject($goodsName);
    //     $alipay->setBody($goodsDescription);
    //     // 跳转到支付页面
    //     return redirect()->to($alipay->getPayLink());
    // }

    // 支付回调页面
    // public function backPay(Request $request)
    // {
    //     $result = $request->all();
    //     // 订单状态

    //     // 订单完成
    //     if ($result['trade_status'] == 'TRADE_SUCCESS' || $result['trade_status'] == 'TRADE_FINISHED') {
    //         // 1、查看订单状态

    //         // 2、修改订单状态


    //         // 3、商品关联用户

    //         return view('admin.paly.app')->withErrors('交易完成！');
    //     }
    //     return view('admin.paly.app')->withErrors('交易失败！');

    // }


    // 跳转页面
    // public function backView()
    // {

    // }
}
