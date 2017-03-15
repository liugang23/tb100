<?php
namespace App\Service;

use Illuminate\Http\Request;
use App\Tools\UUID;
use App\Tools\uploadFile;
use App\Store\GoodsStore;
use App\Store\CartStore;
use App\Service\OssService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class GoodsService
{
	private static $goodsStore;
	private static $cartStore;
	
	public function __construct(GoodsStore $goodsStore,CartStore $cartStore)
	{
		self::$goodsStore = $goodsStore;
		self::$cartStore = $cartStore;
	}

	/**
	 * 添加商品
	 */
	public function adminAddGoods($data)
	{
		$uuid = UUID::create();	// 生成唯一 id

		$data_img = array($data['pic_id1'],$data['pic_id2'],$data['pic_id3'],$data['pic_id4'],$data['pic_id5']);

		// 获取uuid及相应的图片
		for($i=0; $i<count($data_img); $i++) {
			if($data_img[$i] != null) {
				$goods_img[] = ['img_path'=>$data_img[$i], 'guid'=>$uuid, 'addtime' => time()];
			}
		}
		// 判断商品图片是否存在
		if(isset($goods_img)) {
			// 将商品图片信息写入 goods_img 表中
			$result = \DB::table('data_goods_img')
						->insert($goods_img);
			// 判断商品图片写入是否成功
			if($result === false) {
				return $result;
			}
		}

		$param = [
			'guid' => $uuid,
			'name' => $data['name'],
			'subtitle' => $data['subtitle'],
			'stock' => $data['stock'],
			'price' => $data['price'],
			'spec' => $data['spec'],
			'class_id' => $data['class_id'],
			'pic' => $data['pic_id'],
			'describe' => $data['content'],
			'sales' => 9,
			'addtime' => time()
		];

		return self::$goodsStore->adminAddGoods($param);
	}

	/**
	 * 查询所有商品
	 */
	public function adminGetGoodsAll()
	{
		return self::$goodsStore->adminGetGoodsAll();
	}

	/**
	 * 查询指定商品
	 */
	public function adminGetGoods($id)
	{
		return self::$goodsStore->adminGetGoods($id);
	}

	/**
	 * 更新商品上下架状态
	 */
	public function adminUpdateGoods($data)
	{
		if (strcmp($data['param'], 'edit') == 0) {	// 获取商品信息数据
			$data_img = array(
					$data['pic_id1'],
					$data['pic_id2'],
					$data['pic_id3'],
					$data['pic_id4'],
					$data['pic_id5']
				);
			// 获取uuid及相应的图片
			for($i=0; $i<count($data_img); $i++) {
				if($data_img[$i] != null) {
					$goods_img[] = [
							'img_path'=>$data_img[$i], 
							'guid'=>$data['guid'], 
							'addtime' => time()
						];
				}
			}

			// 判断商品图片是否存在
			if(isset($goods_img)) {
				// 将商品图片信息写入 goods_img 表中
				$result = \DB::table('data_goods_img')
							->insert($goods_img);
				// 判断商品图片写入是否成功
				if($result === false) {
					return $result;
				}
			}

			return self::$goodsStore->adminUpdateGoods($data);
		}else{
			return self::$goodsStore->adminUpdateGoods($data);
		}
		
	}

	/**
	 * 编辑商品信息
	 */ 
	public function adminEditGoods($id)
	{
		return self::$goodsStore->adminEditGoods($id);
	}

	/**
     * 删除商品
	 */
	public function adminDeleteGoods($id)
	{
		$id = mb_substr($id, 2);
		return self::$goodsStore->adminDeleteGoods($id);
	}

	/**
	 * 显示商品添加页面
	 */
	public function adminAddGoodsShow()
	{
		$sql = "SELECT `id`,`class_name`,`path`,CONCAT(`path`,`id`,',') AS bpath FROM data_class order by bpath";
		
		return self::$goodsStore->adminAddGoodsShow($sql);
	}


	/**
	 * 获取商品列表 Api
	 * @param $id $num
	 * @return mixed
	 */
	public function apiGetGoodsList($id, $num=1)
	{
		return self::$goodsStore->apiGetGoodsList($id, $num);
	}

	/**
	 * 获取商品详情
	 * @param $id
	 * @return mixed
	 */
	public function apiGetGoodsInfo($guid)
	{
		$count = 0;     // 初始化商品数量
		// 获取用户登录信息 
		$user_id = Session::get('user_id');

		// 判断用户是否登录
		// 如果登录 根据用户id 查询数据库购物车列表
		if($user_id) {
			$param = array(
					['uid', '=', $user_id],
					['guid', '=', $guid],
					['status', '=', 0]
				);

			$cartItem = self::$cartStore
							->apiGetCart($param);

			// 如果购物车列表存在 返回商品数量
			if($cartItem) {
				foreach ($cartItem as $key => $val) {
					$count = $val->count;
				}
			}

		}else{
			// 读取购物车信息
			// $cart = $request->cookie('cart');
			$cart = Cookie::get('cart');
            $cart_arr = ($cart!=null ? explode(',', $cart) : array());

            // 首先判断商品guid是否在购物车里，如商品guid在购物车里则返回商品数量信息
            foreach ($cart_arr as $val) {
                $index = strpos($val, ':');
                if(substr($val, 0, $index) == $guid) {
                    $count = (int) substr($val, $index+1);
                    break;
                }
            }
		}

		// return self::$goodsStore->apiGoodsInfo($id);

		$info = self::$goodsStore->apiGoodsInfo($guid);
		if($info) { 
			$data = [
				'count' => $count,
				'info' => $info
			];

			return $data;
		}

		return null;
		
	}



	/*
	 * 文件上传
	 */
	// public function uploadFile($file)
	// {
	// 	// 检验上传文件是否有效
	// 	if($file->isValid()) {
	// 		// 取得上传文件的原始文件名：
	// 		$clientName = $file->getClientOriginalName();
	// 		// 获取缓存文件夹中的文件名
	// 		$tmpName = $file->getFileName();
	// 		// 获取缓存文件夹下的绝对路径
	// 		$realPath = $file->getRealPath();
	// 		// 获取上传文件后缀(扩展名)
	// 		$ext = $file->getClientOriginalExtension();
	// 		// 根据上传时间生成文件夹
	// 		// 生成文件名
	// 		$fileName = time().rand(10000,99999).'.'.$ext;
	// 		// 上传至阿里云 oss
	// 		$result = OssService::upload($fileName, $realPath);
		
	// 		// 判断上传是否成功
	// 		if (empty($result)) {
	// 			return false;
	// 		}
	// 		return $fileName;
	// 	}
	// }


}