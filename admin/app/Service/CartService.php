<?php
namespace App\Service;

use App\Store\CartStore;
use App\Store\GoodsStore;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CartService 
{
	private static $cartStore;
	private static $goodsStore;

	public function __construct(CartStore $cartStore,GoodsStore $goodsStore)
	{
		self::$cartStore = $cartStore;
		self::$goodsStore = $goodsStore;
	}

	/*
	 * 查询用户购物车
	 */
	public function apiGetCartList()
	{
		$cartItems = array([
            'guid' => 112233,
            'username' => 'name',
            'password' => 'password',
        ],[
            'guid' => 558899,
            'username' => 'name',
            'password' => 'password',
        ]);

		// $cartItems = array();  // 声明一个购物车数组
		$cart = Cookie::get('cart');	// 获取用户cookie购物车信息
		// 购物车不为空时，通过explode对购物车内容按,分割否则写入数组
        $cart_arr = ($cart != null ? explode(',', $cart) : array());  // 商品购物车数组

        // 获取用户登录信息 
		$user = Session::get('user', '');

		// 如果用户已登录 则同步购物车
		if($user != '') {
			// 调用自定义函数 syncCart 同步购物车
			$cartItems = $this->syncCart($user->uid, $cart_arr);
			// 同步完成后,需要清空cookie里的数据
			return response()->json($cartItems)
				   ->withCookie('cart', null);

		} else {// 用户未登录 查询cookie中的购物车商品
			foreach ($cart_arr as $key => $val) {
				//查找 : 在字符串中第一次出现的位置
				$index = strpos($val, ':');	

				// 初始购物车数组
				$item = array();
				$item['guid'] = substr($val, 0, $index);
				$item['count'] = (int)substr($val, $index+1);
                $item['goods'] = self::$goodsStore->apiGetGoods($item->guid);

                // 判断商品是否存在
				if($item['goods'] != null) {
					// array_push() 函数向第一个参数的数组尾部添加一个或多个元素(入栈),然后返回新数组的长度。
                    array_push($cartItems, $item);
				}
			}

			return response()->json($cartItems);
		}


	}	

	/**
	 * 本地购物车数据 与 数据库购物车数据同步
	 * @param  $uid    用户id
	 * @param  $cart_arr 购物车数组
     * @return mixed
	 */
	private function syncCart($uid, $cart_arr)
	{
		// 根据用户id查询购物车列表 获取用户购物车数据
		$where = array(
					['uid', '=', $uid],
					['status', '=', 0]
				);
		$cartItems = self::$cartStore->apiGetCart($where);

		// 1、通过数据库商信息与本地商品信息比较
        // 2、当本地和服务器上都有相应商品数据信息时，以数量多的为准
        // 3、当本地商品信息有，而数据库无相应商品信息时，需要将本地的数据写入数据库

        $cartItems_arr = array();	// 初始化空数组
        // 循环遍历本地购物车
       foreach ($cart_arr as $value) {
        	// strpos() 函数查找字符串在另一字符串中第一次出现的位置
           $index = strpos($value, ':');
           $guid = substr($value, 0, $index);
           $count = (int) substr($value, $index+1);

           // 判断离线购物车中goods_id 是否存在于数据库中
           $exist = false;
           // 遍历数据库用户购物车数据
           foreach ($cartItems as $temp) {
               // 判断本地购物车商品信息是否存在于数据库购物车列表中
               if($temp->guid == $guid) {
                   // 如果存在 则判断它们数量是否相等
                   if($temp->count < $count) {
                       // 如果数据库数量小于本地，以数量多为准  更新数据库数据
                       $temp->count = $count;
                       // dd($temp->count);
                       $temp->save();
                   }
                   $exist = true;
                   break;  // 直接跳出循环
               }
           }

           // 根据前面的判断,如果本地购物车数据不存于数据库购物车列表中,则将商品数据存储进数据库
           if($exist == false) {
           		$param = array(
						['uid', '=', $uid],
						['guid', '=', $guid],
						['count', '=', $count],
						['status', '=', 0]
					);
				$cart_item = self::$cartStore
							 ->apiAddCart($param);

               array_push($cartItems_arr, $cart_item);
           }

       }
       // 为每个商品附加对应的商品信息 便于客户端显示
       foreach ($cartItems as $cart_item) {
           $cart_item->goods = Goods::where('id', $cart_item->goods_id)->first();

           array_push($cartItems_arr, $cart_item);
       }

       return $cartItems_arr;
	}

	/**
	 * 查询商品在购物车中的数量	API
	 * @param $guid    商品id
	 * @return mixed
	 */
	public function apiGetCartGoods($guid)
	{
		/***** 登录状态下购物车商品数量查询 *****/
		// 获取当前登录状态
		$user = Session::get('user', '');

		// 判断是否登录,如果登录 更新购物车
		if($user != '') {

		} else {

		/***** 未登录状态下购物车商品数量查询 ****/
			// 购物车信息格式 (商品id:数量) 
			// cookie 只能存字符串且长度有限
			$cart = Cookie::get('cart');
			// 判断本地购物车是否为空
			$cart_arr = ($cart != null ? explode(',', $cart) : array());
			// return $cart_arr;
			$count = 0;	// 初始为1
			// 在购物车中遍历传进来的商品id
			foreach ($cart_arr as &$val) {	// 此处采用&引用，将更新的变量结果直接存入变量
				// strpos 寻找字符串中某字符最先出现位置
				$index = strpos($val, ':');
				// dd($index);
				// 字符串截取购物车商品id 并与传进来的商品id匹配 判断商品是否存在
				if(substr($val, 0, $index) == $guid) {
					// 如果商品存在，则加1
					$count = ((int) substr($val, $index+1));
					break;
				}
			}

			return response()->json($count);
		}
	}


	/**
	 * 添加商品到购物车	API
	 * @param $guid    商品id
	 * @return mixed
	 */
	public function apiAddCart($guid)
	{
		$guid = $guid['id'];	// 获取商品id

		/******* 登录状态下添加购物车 *******/
		// 获取当前登录状态
		$user = Session::get('user', '');
		// 判断是否登录,如果登录 更新购物车
		if($user != '') {
			// 返回正常用户的购物车信息
			$cart_items = CartItem::where([
						['uid', $user->uid],
						['status', 0],
						])->get();

			$isCart = false; // 初始化购物车状态
			// 判断添加的商品是否已存在购物车,存在 则直接更新
			foreach ($cart_items as $cart_item) {
		        if($cart_item->guid == $guid) {
		            $cart_item->count ++;
		            $cart_item->save();
		            $isCart = true;
		            break;
		        }
		    }
		    // 如果商品不存在购物车中,添加商品至购物车
		    if($isCart == false) {
		    	$cart_item = new CartItem;
		        $cart_item->guid = $guid;
		        $cart_item->count = 1;
		        $cart_item->uid = $user->uid;
		        $cart_item->save();
		    }

		    return response()->json([
						'statusCode' => 200,
	                    'resultInfo' => '购物车添加成功',
					]);
		}else{
			/******* 未登录状态下添加购物车 ********/
			// 购物车信息格式 (商品id:数量) 
			// cookie 只能存字符串且长度有限
			$cart = Cookie::get('cart');
			// 判断本地购物车是否为空
			$cart_arr = ($cart != null ? explode(',', $cart) : array());
			// return $cart_arr;
			$count = 1;	// 初始为1
			// 在购物车中遍历传进来的商品id
			foreach ($cart_arr as &$val) {	// 此处采用&引用，将更新的变量结果直接存入变量
				// strpos 寻找字符串中某字符最先出现位置
				$index = strpos($val, ':');
				// dd($index);
				// 字符串截取购物车商品id 并与传进来的商品id匹配 判断商品是否存在
				if(substr($val, 0, $index) == $guid) {
					// 如果商品存在，则加1
					$count = ((int) substr($val, $index+1)) + 1;
					// 拼接购物车商品信息 $guid : $count (商品id : 数量)
					$val = $guid . ':' . $count;
					// dd($val);
					break;
				}
			}

			// 如果$count==1 说明购物车并没有该商品信息
			// 拼装购物车商品信息
			$goods = $guid . ':' . $count;
			// 此时需要将商品信息写入数组
			// array_push 将一个或多个元素压入数组的末尾
			if($count == 1) {
				array_push($cart_arr, $goods);
			}

			// $cookie = Cookie::make('cart', implode(',', $cart_arr));
			
			// $cart = Cookie::get('cart');
			// // dd($cart);
			// if($cart != null) {
			// 	return 123;
			// }else{
			// 	return 456;
			// }

			return response()->json($count)
				 ->withCookie('cart', implode(',', $cart_arr));
			
		}

	}


	/**
	 * 删除购物车中商品	API
	 * @param $guids    购物车中的商品id
	 * @return mixed
	 */
	public function apiDeleteCart($guids)
	{
		if($guids == '') {
			$data = array(
					'statusCode' => '',
                    'resultInfo' => '商品不存在'
                    );
            return $data;
		}
		// 将购物车商品id 转换为数组
		$guids_arr = explode(',', $guids);
		// 从session获取用户信息
		$user = Session::get('user', '');

		// 判断用户是否登录
		if($user == '') {
			// 已登录 从购物车列表中根据指定商品id删除商品
			// whereIn用于数组条件
			$result = self::$cartStore
						  ->apiDeleteCart($user->uid, $guids);

			return response()
				   ->json(array(
	                    'statusCode' => 200,
	                    'resultInfo' => '删除成功！'
	                ));

		}else{	// 未登录
			// 从cookie里获取购物车相应商品信息
			$cart = Cookie::get('cart');
			// 对本地购物车商品信息进行重组
			$cart_arr = ((!empty($cart) || isset($cart)) ? explode(',', $cart) : array());
			// 遍历商品数组
			foreach ($cart_arr as $key => $value) {
				// strpos() 函数返回字符串在另一个字符串中第一次出现的位置
				$index = strpos($value, ':');
				$guid = substr($value, 0, $index);// 获取商品ID
				// 如果商品id存在, 删除
				if (in_array($guid, $guids_arr)) {
					// array_splice() 函数从数组中移除选定的元素，并用新元素取代它。函数也将返回被移除元素的数组。
					array_splice($cart_arr, $key, 1);	
					continue;	// continue 立即停止目前执行循环，并回到循环的条件判断处，继续下一个循环
				}
			}
			// 返回信息 并更新cookie的信息
			return response()
				   ->json(array(
		               'statusCode' => 200,
		               'resultInfo' => '删除成功！'
		           ))
				   ->withCookie('cart', implode(',', $cart_arr));

		}
	

	}

}