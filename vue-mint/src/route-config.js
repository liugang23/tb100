// 引入视图文件
// import Login from './views/login';
// import Register from './views/register';
// import Home from './views/home';
// import Info from './views/home/goodsInfo';
// import Me from './views/me';
// import Order from './views/order';
// import Cart from './views/cart/cartItem';


// 定义路由
const routes = [
	{ 
		path: '/login', 
		name: 'login',
		meta: { title: "登 录" },
		// es6箭头函数  使用了webpack代码分割功能，这样会安需加载
		component: (resolve)=>require(['./views/login'], resolve),
	},
	{ 
		path: '/register', 
		name: 'register',
		meta: { title: "注 册", auth: false },
		component: (resolve)=>require(['./views/register'], resolve),
	},
	{ 
		path: '/', 
		name: 'home',
		meta: { navShow: true, title: "首 页", cname: '一级页面', auth: false },
		component: (resolve)=>require(['./views/home'], resolve),
	},
	{ 
		path: '/info/:id', 
		name: 'info',
		meta: { navShow: false, title: "商品详情", cname: '二级页面', auth: false },
		component: (resolve)=>require(['./views/home/goodsInfo'], resolve),
	},
	{ 
		path: '/order', 
		name: 'order',
		meta: { navShow: true, title: "我的订单", cname: '一级页面' },
		component: (resolve)=>require(['./views/order'], resolve),
	},
	{ 
		path: '/cart', 
		name: 'cart',
		meta: { navShow: false, title: "我的购物车", cname: '二级页面' },
		component: (resolve)=>require(['./views/cart/cartItem'], resolve)
	},
	{ 
		path: '/pay', 
		name: 'pay',
		meta: { navShow: true, title: "支付页面", cname: '三级页面' }
		// component: (resolve)=>require([''], resolve)
	},
	{ 
		path: '/me', 
		name: 'me',
		meta: { navShow: true, title: "个人中心", cname: '一级页面' },
		component: (resolve)=>require(['./views/Me'], resolve)
	}
]

// export与export default均可用于导出常量、函数、文件、模块等。
// 在一个文件或模块中，export、import可以有多个，export default仅有一个。 
export default routes;