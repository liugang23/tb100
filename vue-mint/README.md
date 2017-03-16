# vue-mint

> 基于vue商城项目

### 环境依赖
```
vue-cli
vue2
vuex
vue-router
vue-axios
store.js
```
### 项目结构

	|---build
	|---config
	|---src 
	|	|---api					// api 目录(ajax 请求)
	|	|	|---index.js
	|	|---assets				// 
	|	|	|---css
	|	|	|---images
	|	|	|---js
	|	|---components				// 组件
	|	|---views					// 视图
	|	|---vuex					// 状态管理
	|	|	|---modules				// 模块
	|	|	|	|---cart.js			// 购物车模块
	|	|	|	|---goodsInfo.js	// 商品详情模块
	|	|	|	|---goodsList.js	// 商品列表模块
	|	|	|	|---home.js			// 首页模块
	|	|	|	|---login.js		// 登录模块
	|	|	|	|---order.js		// 订单模块
	|	|	|---actiions.js		    // 操作
	|	|	|---getters.js
	|	|	|---store.js		    // 仓库
	|	|	|---types.js	        // 类型初始化
	|	|---App.vue
	|	|---http.js				    // 拦截器 统一处理http请求
	|	|---main.js					// 入口配置文件
	|	|---route-config.js			// 路由配置
	|---static

### 路由说明
	/login      // 登录，不需要登录可以访问，登录后不可以访问
	/register   // 注册，不需要登录可以访问，登录后不可以访问
	/logout     // 退出登录，需要登录后才可以访问
	/home       // 首页，不需要登录可以访问
	/info		// 商品详情，不需要登录可以访问
	/order		// 订单页，需要登录后可以访问
	/me         // 个人中心，需要登录后可以访问
	/cart		// 购物车，需要登录后可以访问
	/pay		// 支付，需要登录后可以访问

### 登录拦截逻辑
#### 第一步：路由拦截


定义完路由后，我们利用 vue-router 提供的勾子函数 beforeEach() 对路由进行判断。


每个勾子接收三个参数：



登录拦截到这里就结束了吗？这里只是简单的前端路由控制，并不能真正阻止用户访问需要登录权限的路由。还有一种情况：当前token失效，但是token依然保存在本地。这时去访问需要登录权限的路由时，实际应该让用户重新登录。此时，需要结合http拦截器 + 后端接口返回的http状态码来判断。

#### 第二步：拦截器
要想统一处理所有的http请求和响应，需要用上axios拦截器。通过配置 http response inteceptor，当后端接口返回401 Unauthorized(未授权)，让用户重新登录

	// 请求拦截器


	// 响应拦截器


通过上面两步，就实现了前端登录拦截。退出也很简单，清除token，跳转首页。

### 关于axios
> [axios中文文档](http://www.kancloud.cn/yunye/axios/234845)

## 安装 运行
	
	// install dependencies
	npm install

	// serve with hot reload at localhost:8088
	npm run dev

	// build for production with minification
	npm run build

