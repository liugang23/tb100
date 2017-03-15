import Vue from 'vue'
import Vuex from 'vuex'
import * as actions from './actions'// 操作 执行改变
import * as getters from './getters'// * as 取别名  获取当前状态
import login from './modules/login'
import goodsList from './modules/goodsList'
import goodsInfo from './modules/goodsInfo'
import cart from './modules/cart'
import order from './modules/order'

Vue.use(Vuex)
// 判断是否处于生产环境
const debug = process.env.NODE_ENV !== 'production';

// 但在一个文件或模块中，export、import可以有多个，export default仅有一个
// 它们均用于导出常量、函数、文件、模块等
// 能改变 Vuex store 中的 state 状态的唯一方法是提交 mutation 变更
// 实例化 Vuex.Store 并输出相关内容,实现从根组件注入到所有子组件中，接着就可以在子组件中使用 this.$store
export default new Vuex.Store({
	actions,
	getters,
	modules: {
		login,
		goodsInfo,
		goodsList,
		cart,
		order
	},
	strict: debug	// strict 严格模式
})