import { 
	GOODS_INFO 
} from '../types'// 引入并解构

const state = {
	info: null
};

const mutations = {
	[GOODS_INFO](state, info) {
		state.data = info;// 商品详情
	}
}

export default {
	state,
	mutations
}