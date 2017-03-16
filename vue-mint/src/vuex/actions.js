// 执行操作
import api from '../api'
import { 
	USER_SIGNIN,
	USER_SIGNOUT,
	USER_REGISTER,
	GOODS_LIST,
	GOODS_INFO,
	CART_ADD_TO,
	CART_LIST_ALL,
	CART_DELETE_TO,
	ORDER_ADD_TO,
	ORDER_LIST_ALL,
	ORDER_DELETE_TO
} from './types'// 引入并解构

// export 输出   const 声明常量
// 用户登录
export const UserLoging = ({ commit }, data) =>{
	api.localLogin(data).then(function (response) {
		if( response.data.data.type == true) {
			commit(USER_SIGNIN, response.data.data);
			window.location = '/me'	// 个人中心
		}else{
			// console.log(response.data);
			window.location = './login'
		}
	})
	.catch(function (error) {
		console.log(error);
	});
};

// 用户退出
export const UserLogout = ({ commit }, data) => {
	api.localLogout(data).then(function (response) {
		commit(USER_SIGNOUT, response.data.data);
		window.location = '/login'
	})
	.catch(function (error) {
		console.log(error);
	});
};

// 用户注册
export const UserRegister = ({ commit }, data) => {
	api.localRegister(data).then(function (response) {
		// console.log(response.data);
		//if( response.data.type == true ) {
			commit(USER_REGISTER, response.data.token);
			window.location = '/me' // 注册成功 进入个人中心
		//}
	})
	.catch(function (error) {
		console.log(error);
	});
};
// 商品
export const GoodsList = ({ commit }, data) => {// 商品列表
	var promise = new Promise(function(resolve, reject){
		api.localGoods(data).then(function (response) {
			commit(GOODS_LIST, resolve(response.data));
			console.log(789)
		})
		.catch(function (error) {
			console.log(error);
		});
	});
	promise.then(function() {
		console.log(response.data)
	});

};
export const GoodsInfo = ({ commit }, data) => {// 商品详情
	api.goodsInfo(data).then(function (response) {
		commit(GOODS_INFO, response.data);
	})
	.catch(function (error) {
		console.log(error);
	});
};

// 购物车
export const AddCart = ({ commit }, data) => {// 添加购物车
	api.addCart(data).then(function (response) {
		commit(CART_ADD_TO, response.data);
	})
	.catch(function (error) {
		console.log(error);
	});
};
export const UserCart = ({ commit }, data) => {// 购物车列表
	api.locatCart(data).then(function (response) {
		commit(CART_LIST_ALL, response.data);
	})
	.catch(function (error) {
		console.log(error);
	});
};
export const DeleteCart = ({ commit }) => {// 删除购物车
	api.deleteCart(data).then(function (response) {
		commit(CART_DELETE_TO, response.data);
	})
	.catch(function (error) {
		console.log(error);
	});
}
// 订单
export const AddOrder = ({ commit }, data) => {// 添加订单
	api.addOrder(data).then(function (response) {
		commit(ORDER_ADD_TO, response.data);
	})
	.catch(function (error) {
		console.log(error);
	});
};
export const UserOrder = ({ commit }, data) => {// 查询订单
	api.locatOrder(data).then(function (response) {
		commit(ORDER_LIST_ALL, response.data);
	})
	.catch(function (error) {
		console.log(error);
	});
};
export const DeleteOrder = ({ commit }, data) => {// 删除订单
	api.deleteOrder(data).then(function (response) {
		commit(ORDER_DELETE_TO, response.data);
	})
	.catch(function (error) {
		console.log(error);
	});
};
