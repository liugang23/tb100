<template>
	<div class="page app-main-top">
		<OrderTabs v-on:selected="onSelected"></OrderTabs>
		<div v-for="list in lists" class="app-order-cell">
			<mt-cell :title="list.guid" value="说明文字"></mt-cell>
			<mt-cell title="标题文字">
			  	<span>{{ list.password }}</span>
			  	<img slot="icon" src="" width="24" height="24">
			</mt-cell>
			<mt-cell :title="list.username" value="说明文字"></mt-cell>
		</div>
	</div>
</template>

<script>
import OrderTabs from '../components/Order-tabs'

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
		this.axios.get('http://www.tb.com/api/order')
		.then((response) => {
			//if(response.data.resultStatus == 200) {
				//console.log(JSON.parse(response.data.resultData));
				this.lists = JSON.parse(response.data.resultData);
			//}else{

			//}
		})
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
				console.log(response.data.resultData);
				//this.lists = response.data.resultData;
				this.lists = JSON.parse(response.data.resultData);
			});
		}
	}

}

</script>