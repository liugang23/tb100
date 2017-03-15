<?php
namespace App\Store;

use App\Model\Goods;
use Redis;
use Log;

class GoodsStore
{
	private static $goods = 'data_goods';
	private static $class = 'data_class';
	private $goodslist = HASH_GOODS_LIST_;
	private $goodsID = LIST_GOODS_ID_LIST_;

	/**
	 * 查询商品列表
	 */
	public static function adminGetGoodsAll()
	{
		return \DB::table('data_goods')
				->join('data_class', 'data_class.id', 'data_goods.class_id')
				->get();
	}

	/**
	 * 执行添加商品
	 */
	public static function adminAddGoods($data)
	{
		return \DB::table('data_goods')->insert($data);
	}

	/**
	 * 根据商品id 查询
	 * @param $guid $num    商品id
	 * @return mixed
	 */
	public static function adminGetGoods($guid)
	{
		return \DB::table('data_goods')
				->where('guid', $guid)->get();
	}

	/**
	  * 更新状态
	  * 
	  */
	public static function adminUpdateGoods($data)
	{
		if (strcmp($data['param'], 'status') == 0) {	// 更新上下架
			$guid = $data['id'];		// 对象 guid
			$status = $data['status'];	// 状态
			if ($status == 0) {
				return \DB::table('data_goods')
					->where(['guid'=>$guid])
					->update(array('status'=>1));
			}else{
				return \DB::table('data_goods')
					->where(['guid'=>$guid])
					->update(array('status'=>0));
			}
		} elseif (strcmp($data['param'], 'new') == 0) {	// 更新新品状态
			$guid = $data['id'];		// 对象 guid
			$status = $data['status'];	// 状态
			if ($status == 0) {
				return \DB::table('data_goods')
					->where(['guid'=>$guid])
					->update(array('new'=>1));
			}else{
				return \DB::table('data_goods')
					->where(['guid'=>$guid])
					->update(array('new'=>0));
			}
		} else {	// 更新商品信息
			$param = [
				'name' => $data['name'],
				'subtitle' => $data['subtitle'],
				'stock' => $data['stock'],
				'price' => $data['price'],
				'spec' => $data['spec'],
				'pic' => $data['pic_id'],
				'describe' => $data['content'],
				'addtime' => time()
			];

			return \DB::table('data_goods')
					->where(['guid'=>$data['guid']])
					->update($param);
		}
		
	}

	// 返回编辑页内容
	public static function adminEditGoods($id)
	{
		$res = \DB::table('data_goods')->where('guid', $id)
				->join('data_class', 'data_goods.class_id', 'data_class.id')
				->get();
		$img = \DB::table('data_goods_img')->where('guid', $id)
				->get();

		foreach($res as $key){
			$key->img = $img;
		}
		return $key;
	}

	// 删除
	public static function adminDeleteGoods($id)
	{
		$str = \DB::table('data_goods')
				->where('guid', $id)->delete();

		$img = \DB::table('data_goods_img')
				->where('guid', $id)->delete();
				
		return $img;
	}

	/**
	 * 显示商品添加页面
	 */
	public function adminAddGoodsShow($sql)
	{
		return \DB::select($sql);
	}


	/**
	 * 获取商品列表 Api
	 * @param $id     商品类别
	 * @param $num    页数
	 * @return mixed
	 */
	public function apiGetGoodsList($id, $num)
	{
		$key = $this->goodsID.$id;
		// 检查redis 键值是否存在
		$result = Redis::exists($key);
		if($result) {// 如果键值存在 直接返回
			if($num == 1) {
				$star = 0;
				$end = $num * 10 - 1;
			}elseif($num > 1) {
				$star = $num * 10 - 10;
				$end = $num * 10 - 1;
			}
					
			$guid = Redis::LRANGE($key, $star, $end);
			for($i=0; $i<count($guid); $i++){
				$listKey = $this->goodslist.$id.':'.$guid[$i];
				$goodslist[] = Redis::HGETALL($listKey);
			}
			
			Log::info('通过 redis 获取商品列表');
			return $goodslist;
			// 从redis取出的字符串,需要json_decode()解码
			// return json_decode($goodslist);
		} else {
			$goodslist = \DB::table(self::$goods)
				        ->where(['status'=>0, 'class_id'=>$id])
				        ->skip(0)->take(10)->get();
			// 由于 redis 只支持一维数组,这里需要将取得的数据转换为字符串。
			// $strGoodsList = json_encode($goodslist);
			// $result = Redis::Set($key, $strGoodsList);
			// if(!$result){ Log::error('redis 商品列表写入失败'); }
			Log::info('通过 mysql 获取商品列表');
			return $goodslist;
		}
		
	}

	/**
	 * 获取商品详情 Api
	 * @param $uid
	 * @return mixed
	 */
	public static function apiGoodsInfo($guid)
	{
		$goods = Goods::where(['status'=>0,'guid'=>$guid])
			     ->first();
		// 判断符合上架条件商品是否存在
		if($goods) {
			$img = Goods::where(['guid'=>$guid])
			   ->first()->goodsImg;	
			if($img) {
				$info = Goods::where(['guid'=>$guid])
					    ->first()->goodsInfo;
				$data = [
					'goods' => $goods,
					'img' => $img,
					'info' => $info
				];
				return $data;
			}else{
				return '';
			}
		}
		
		return '';
		
	}

	/**
	 * 根据商品id获取商品基本信息 Api
	 * @param $guid 
	 * @return mixed
	 */
	public static function apiGetGoods($guid)
	{
		return Goods::where(['status'=>0,'guid'=>$guid])
			     ->first();
	}


}