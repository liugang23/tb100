<template>
	<mt-header fixed :title="$route.meta.title">

		<mt-button slot="left" icon="back" onclick="window.history.go(-1)"></mt-button>

	</mt-header>

</template>

<script>

export default {
	data () {
		return {

		}
	},

}
</script>

<style>
.mint-header { 
	background-color: #25201f !important;
	height: 50px;
	line-height: 50px;
}
</style>