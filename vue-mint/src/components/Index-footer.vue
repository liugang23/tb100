<template>
	<mt-tabbar v-model="selected" fixed>
		<mt-tab-item id="home">
			<img class="app-icon-index">首页
		</mt-tab-item>
		
		<mt-tab-item id="order">
			<img >我的订单
		</mt-tab-item>

		<mt-tab-item id="me">
			<img >个人中心
		</mt-tab-item>
	</mt-tabbar>
</template>

<script>
export default {
	data () {
		return {
			selected: "home"
		}
	},
	watch: {
		selected: function (id) {
			console.log(id);
			this.$router.push({ name: id })
		}
	}
}

</script>