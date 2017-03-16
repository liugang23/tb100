import { 
	GOODS_LIST
} from '../types'// 引入并解构

// var isList = function() {
// 	[GOODS_LIST](state, list) {
// 		console.lot(list);
// 	}
// }

const state = {
	data: []
};

const mutations = {
	[GOODS_LIST](state, data) {// 登录
		state.data = data;// 商品列表
	}
}

export default {
	state,
	mutations
}