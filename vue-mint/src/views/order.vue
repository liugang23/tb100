<template>
	<div class="page app-main-top">
		<OrderTabs v-on:selected="onSelected"></OrderTabs>
		<div v-if="lists.length > 0">
			<div v-for="list in lists" class="app-order-cell">
				<mt-cell :title="list.order_id" value="订单编号"></mt-cell>
				<mt-cell :title="list.goods.name">
				  	<span><span>{{ list.goods.price }}</span> x {{ list.count }}</span>
				  	<img slot="icon" :src="list.goods.pic" width="60" height="60">
				</mt-cell>
				<mt-cell :title="list.total_price" value="总计"></mt-cell>
			</div>
		</div>
		<div v-else>
			{{ lists.length }}
			<mt-cell title="暂无订单"></mt-cell>
		</div>
	</div>
</template>

<script>
import OrderTabs from '../components/Order-tabs'
var storage = require('store')
import store from '../vuex/store.js'//状态管理
import { mapActions } from 'vuex'

export default {
    components: {
    	OrderTabs
    },
    data () {
		return {
			lists: []
		}
	},
	mounted() {// 生命周期钩子
		// rest参数(形式为'...变量名')   …mapActions 就是把需要的方法给映射到当前组件中,然后就可以把action当做普通的方法来使用了
		//...mapActions({
		//	UserOrder: 'UserOrder'
		//}),
		this.UserOrder(0);
		//this.axios.get('http://www.tb.com/api/order/0')
		//.then((response) => {
			//if(response.data.resultStatus == 200) {
		//		console.log(response.data)
				//console.log(JSON.parse(response.data));
				
		//		this.lists = response.data.data_orders;
			//}else{

			//}
		//})
		//.catch(function (error) {
			//	console.log(error);
				// 显示返回的错误信息
			//	this.$set('toasttext',String(error.status));
			//	this.$set('toastshow',true);
		//});
	},
	methods: {
		onSelected: function (id) {
			this.axios.get('http://www.tb.com/api/order/'+id).then((response) => {
				console.log(response.data.data_orders);
				this.lists = response.data.data_orders;
				//this.lists = JSON.parse(response.data.resultData);
			});
		}
	}

}

</script>