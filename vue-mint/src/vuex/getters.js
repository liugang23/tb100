// getters可以认为是store的计算属性
export const UserInfo = state => state.login.token;// 用户状态信息

// 购物车 商品id  quantity数量  price价格
// export const cartProducts = state => {
// 	return state.cart.added.map(({ id, quantity })) => {
// 		const product = state.products.all.find(p => p.id === id)
// 		return {
// 			title: product.title,
// 			price: product.price,
// 			quantity
// 		}
// 	}
// }