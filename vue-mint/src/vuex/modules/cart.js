import { 
	CART_ADD_TO,
	CART_LIST_ALL,
	CART_DELETE_TO 
} from '../types'// 引入并解构

const state = {
	data: null
};

const mutations = {
	[CART_ADD_TO](state, data) {// 添加购物车
		state.data = data;
	},
	[CART_LIST_ALL](state, data) {// 购物车列表
		state.data = data;
	},
	[CART_DELETE_TO](state, data) {// 删除购物车
		state.data = data;
	}
}

export default {
	state,
	mutations
}