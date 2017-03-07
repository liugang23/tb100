<template>
	<mt-navbar v-model="selected">
		<mt-tab-item id="1">水 果</mt-tab-item>
		<mt-tab-item id="2">美 食</mt-tab-item>
		<mt-tab-item id="3">电 器</mt-tab-item>
	</mt-navbar>
</template>

<script>
export default {
//自定义事件  是子组件把数据传回给父组件
// props 是父组件传值给子组件

	data () {
		return {
			selected: "1"
		}
	},
	watch: {
		selected: function (id) {
			this.$emit('selected', id)
		}
	}
}
</script>