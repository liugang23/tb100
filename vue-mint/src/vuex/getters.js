/***** getters可以认为是store的计算属性 *****/
// 用户状态信息
export const UserInfo = state => state.login.token;
// 商品列表
export const GoodsList = state => state.goods.list;
// 商品详情
export const GoodsInfo = state => state.goods.info;
// 购物车列表
export const CartList = state => state.cart.list;
// 订单列表
export const OrderList = state => state.order.list;
//

//

//

//

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