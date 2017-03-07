<template>
	<div class="page app-main-top">
		<HomeTabs v-on:selected="onSelected"></HomeTabs>
		<goodsList :lists = "lists"></goodsList>
	</div>
</template>

<script>
import goodsList from '../components/Goods-list'

export default {
	components: {
		HomeTabs: require('../components/Home-tabs'),
		goodsList
	},
	data () {
		return {
			lists: []
		}
	},
	mounted() {// 生命周期钩子
		this.axios.get('http://www.tb.com/api/goodslist').then((response) => {
			console.log(response.data);
			this.lists = response.data;
		});
	},
	methods: {
		onSelected: function (id) {
			console.log(id);
			this.axios.get('http://www.tb.com/api/goodslist/'+id).then((response) => {
				//console.log(JSON.parse(response.data.resultData));
				console.log(response.data);
				this.lists = response.data;
			})
		}
	}
}

</script>