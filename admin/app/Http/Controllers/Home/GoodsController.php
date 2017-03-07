<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\GoodsService;
use Symfony\Component\HttpFoundation\Response;

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
    public function index(Request $request, Response $response)
    {
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
    public function show(Request $request, Response $response, $id)
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