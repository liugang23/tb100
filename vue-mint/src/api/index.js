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
	}
}