// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
// import Vuex from 'vuex'
import VueRouter from 'vue-router'// 路由
import VueResource from 'vue-resource'
import axios from 'axios'	// ajax 插件
import VueAxios from 'vue-axios' // vue请求ajax插件
import routes from './route-config.js'// 引入路由配置文件
import store from './vuex/store.js'//状态管理

// 引入 mintui 样式
import Mint from 'mint-ui'
import 'mint-ui/lib/style.css'

// 引入自定义样式
import './assets/css/common.css'
import './assets/css/base.css'

import App from './App'

// 声明使用
// Vue.use(Vuex)
Vue.use(VueAxios, axios)
Vue.use(Mint)
Vue.use(VueRouter)
Vue.use(VueResource)

// Vue的路由默认模式是散列模式-它使用URL散列来模拟一个完整的URL，页面不会改变时重新加载的URL。所以需要 开启html5 history模式
// 实例化VueRouter 并创建 router 创建路由
const router = new VueRouter ({
	mode: 'history',
	saveScrollPosition: true,   // 并开启位置纪录
	routes // （缩写）相当于 routes: routes
});
// meta 路由元信息
// from 当前导航要离开的路由  next  进行管道中的下一个钩子
router.beforeEach(({meta, name}, from, next) => {
	var { auth = true } = meta;
	var isLogin = Boolean(store.state.login.token) // true用户已登录,false用户未登录

	if (auth && !isLogin && name == 'register') {
		return next({ name: 'register' })
	}
	if (auth && !isLogin && name !== 'login') {
		return next({ name: 'login' })
	}
	if (isLogin && (name == 'login' || name == 'register')) {
		return next({ name: 'me' })
	}
	next()
	
});

// 3.(admin.vue)logout方法

// logout: function () {
// localStorage.removeItem(‘token’);
// this.$route.router.go(‘/login’);
// }

// 点击登出按钮，销毁本地token

// 创建和挂载根实例。
// 记得要通过 router 配置参数注入路由，
// 从而让整个应用都有路由功能
/* eslint-disable no-new */
new Vue({
	router,
	store,
  	el: '#app',
  	template: '<App/>',
  	components: { App }
})
