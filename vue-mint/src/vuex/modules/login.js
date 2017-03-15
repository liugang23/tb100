import { 
	USER_SIGNIN,
	USER_SIGNOUT,
	USER_REGISTER 
} from '../types'// 引入并解构

// 引入 store.js 插件
var storage = require('store');
var isLoggedIn = function() {
	// 获取localStorage 中保存的用户信息
	var token = storage.get('user');
	
	if (token) {
		// token.replace(/(^\")|(\"$)/g, '');
		// split() 方法用于把一个字符串分割成字符串数组
		token = JSON.parse(token.replace(/(^\")|(\"$)/g, '').split(','));
		// 获取过期时间 并 转换为时间戳
		var exp = new Date(token.expired_at).getTime();
		// console.log(exp);
		// console.log(Date.now())
		// 用户是否已过期
		if( exp > Date.now() ) {
			// console.log('令牌有效')
			// 返回用户信息
			// return JSON.parse(storage.get('user'))
			return token.token;
		}
		// 令牌已过期
		// return false;
	} else {
		// 令牌不存在
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
	[USER_SIGNOUT](state) {// 退出
		storage.remove('user');// 删除用户信息
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

