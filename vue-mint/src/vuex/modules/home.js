import { SET_MENU,SET_MENU_ACTIVE } from '../types'

let state = {
	index_nav: [{
		index: 0,
		path: {
			name: 'home'
		}
	}]
}
const mutations = {
	[SET_MENU](state, index_nav) {
		state.index_nav = index_nav;
	},
	[SET_MENU_ACTIVE](state, _index) {
		// 底部导航激活
		state.menu_active = state.index_nav[_index]
	}
}

export default {
	state,
	mutations
}