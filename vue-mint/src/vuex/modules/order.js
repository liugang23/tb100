import { 
	ORDER_ADD_TO,
	ORDER_LIST_ALL,
	ORDER_DELETE_TO
} from '../types'// 引入并解构

const state = {
	data: null
};

const mutations = {
	[ORDER_ADD_TO](state, data) {// 添加订单
		state.data = data;
	},
	[ORDER_LIST_ALL](state, data) {// 订单列表
		state.data = data;
	},
	[ORDER_DELETE_TO](state, data) {// 删除订单
		state.data = data;
	}
}

export default {
	state,
	mutations
}