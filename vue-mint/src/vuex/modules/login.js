import { USER_SIGNIN,USER_SIGNOUT,USER_REGISTER } from '../types'// 引入并解构

// 引入 store.js 插件
var storage = require('store');
var isLoggedIn = function() {
	var token = storage.get('user');// 获取localStorage 中保存的用户信息
	if (token) {
		// WindowBase64.atob() 函数用来解码一个已经被base-64编码过的数据
		// split() 方法用于把一个字符串分割成字符串数组
		// JSON.parse() 方法用于将一个 JSON 字符串转换为对象
		var payload = JSON.parse(window.atob(token.split('.')[1]));
		// 用户是否已过期
		if( payload.exp > Date.now() / 1000 ) {
			// 返回用户信息
			return JSON.parse(storage.get('user'))
		}
	} else {
		return false;
	}
};

// 定义状态
const state = {
	token: isLoggedIn() || null
};

// store中state的改变 必须通过 mutation 来实现
// 不应该在 action 中 替换原始的状态对象 - 组件和 store 需要引用同一个共享对象，mutation 才能够被观察
// JSON.stringify()用于从一个对象解析出字符串
const mutations = {
	[USER_SIGNIN](state, user) {// 登录
		storage.set('user',JSON.stringify(user));
		state.token = user;
	},
	[USER_SIGNOUT](state) {
		storage.remove('user');// 退出 删除用户信息
		state.token = null;// 状态token值设为空
	},
	[USER_REGISTER](state, user) {// 注册
		storage.set('user',JSON.stringify(user));
		state.token = user;
	}
}

export default {
	state,
	mutations
}

