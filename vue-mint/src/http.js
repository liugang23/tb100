/**
 * 拦截器
 * 统一处理所有http请求和响应
 * 配置 http response inteceptor,当后端接口返回401 Unauthorzed(未授权),让用户重新登录
 */
import axios from 'axios'	// ajax 插件
import VueAxios from 'vue-axios' // vue请求ajax插件
import store from './vuex/store.js'//状态管理
import { USER_SIGNIN,USER_SIGNOUT,USER_REGISTER } from './vuex/types'// 引入状态定义 并解构
import router from './route-config.js'// 引入路由配置文件

// 全局 axios 默认值
// axios.defaults.baseURL = 'http://www.tb.com';

// 请求 拦截器
axios.interceptors.request.use(
	config => {
		// 在请求之前做某事发送
		if (store.state.login.token) {// 判断是否存在token,如果存在,则每个http header都加上 token
			config.headers.Authorization = `Bearer ${store.state.login.token}`;
		}
		return config;
	}, err => {// 发生错误
		return promise.reject(err);
	});

// 响应 拦截器
axios.interceptors.response.use(
	response => { // 对响应数据做某事
		return response;
	}, error => {
		if (error.response) {// 对响应错误做出反应
			switch (error.response.status) {
				case 401:
					// 401 清除token信息  并跳转到login
					store.commit(USER_SIGNOUT);
					router.replace({
						name: 'login',
						query: {redirect: router.currentRoute.fullPath}
					})
			}
			// 返回接口返回的错误信息
			return Promise.reject(error.response.data);
		}
	});

export default axios;