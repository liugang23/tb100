import Vue from 'vue'
import axios from 'axios'	// ajax 插件
import VueAxios from 'vue-axios' // vue请求ajax插件

Vue.use(VueAxios, axios);

var storage = require('store');
// 自定义配置新建一个 axios 实例
var instance = axios.create();
// 从localStorage中的token判断是否已经登陆，如果已登陆，我们为每个http请求设置Authorization通用参数：
if(storage.get('user')) {
	// 在实例已创建后修改默认值 Authorization(授权)
	instance.defaults.headers.common['Authorization'] = 'Bearer' + storage.get('user').replace(/(^\")|(\"$)/g, '');
}

export default {
	localLogin: function (data) {// 登录
		return axios.post('http://www.tb.com/api/login', data)
	},
	lccalLogout: function (data) {// 退出
		return instance.post('/api/logout', data);
		storage.remove('user');
		// this.$route.router.go(‘/login’);
	},
	localRegister: function (data) {// 注册
		return axios.post('http://www.tb.com/api/register', data)
	},
	// 商品
	localGoods: function (data) {// 查询商品列表
		console.log(data)
		return axios.get('http://www.tb.com/api/goods/'+data)
	},
	// goodslInfo: function (data) {// 商品详情
	// 	return axios.get('http://www.tb.com/api/goodsInfo'+data)
	// },
	// // 购物车
	// addCart: function (data) {// 添加购物车
	// 	return axios.post('http://www.tb.com/api/cart', data)
	// },
	// localCart: function (data) {// 查询购物车
	// 	return axios.get('http://www.tb.com/api/cart')
	// },
	// deleteCart: function (data) {// 删除购物车
	// 	return axios.get('http://www.tb.com/api/cart')
	// },
	// // 订单
	// addOrder: function (data) {// 添加订单
	// 	return axios.post('http://www.tb.com/api/order',data)
	// },
	// localOrder: function (data) {// 查询订单
	// 	return axios.get('http://www.tb.com/api/order', data)
	// },
	// deleteOrder: function (data) {// 删除订单
	// 	return axios.post('http://www.tb.com/api/order', data)
	// },
}