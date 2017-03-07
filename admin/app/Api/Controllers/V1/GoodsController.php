<?php
namespace App\Api\Controllers\V1;

use App\Api\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Service\GoodsService;
// use Symfony\Component\HttpFoundation\Response;

class GoodsController extends BaseController
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
    public function index(Request $request)
    {
        //return 'this is goodslist for v1';

        $goodslist = self::$goodsService
                          ->apiGetGoodsList($id=1, 1);

        if (empty($goodslist)) {
            return $response->setStatusCode(401);
        } else {
            return $goodslist;
        }
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
     * 执行添加操作
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $goodslist = self::$goodsService->apiGetGoodsList($id, 1);

        if (empty($goodslist)) {
            return $response->setStatusCode(401);
        } else {
            return $goodslist;
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}