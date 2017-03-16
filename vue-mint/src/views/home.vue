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
		this.axios.get('http://www.tb.com/api/goods').then((response) => {
			//console.log(response.data);
			this.lists = response.data;
		});

		this.$store.dispatch('GoodsList', 1);
		console.log(this.$store.state.goodsList.data)
	},
	methods: {
		onSelected: function (id) {
			this.axios.get('http://www.tb.com/api/goods/'+id).then((response) => {
				// console.log(JSON.parse(response.data.resultData));
				// console.log(response.data);
				this.lists = response.data;
			})
			//console.log(id)
			this.$store.dispatch('GoodsList', id);
			//this.lists = this.$store.state.goods;
			console.log(789)
			console.log(this.$store.state.goodsList.data)
			console.log(123456)
			//this.GoodsList(id);
			//console.log(this.$store.state.goods)
		}
	}
}

</script>