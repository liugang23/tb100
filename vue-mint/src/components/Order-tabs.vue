<template>
	<mt-navbar v-model="selected">
		<mt-tab-item id="0">全部订单</mt-tab-item>
		<mt-tab-item id="1">待付款</mt-tab-item>
		<mt-tab-item id="2">待收货</mt-tab-item>
	</mt-navbar>
</template>

<script>
export default {
	data:function () {
		return {
			selected: "0"
		}
	},
	watch: {
		selected: function (id) {
			this.$emit('selected', id)
		}
	}
}
</script>