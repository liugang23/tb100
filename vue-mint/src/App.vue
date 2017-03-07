<template>
	<div id="app">
		<IndexHeader></IndexHeader>
		<router-view></router-view>
		<IndexFooter v-show="$route.meta.navShow"></IndexFooter>
	</div>
</template>

<script>
import IndexHeader from './components/Index-header'
import IndexFooter from './components/Index-footer'
import Login from './views/login'
import Register from './views/register'

export default {
	name: 'app',
	components: {
		IndexHeader,
		IndexFooter,
		'v-login': Login,
		'v-register': Register,
	}
}
</script>

<style>
#app {
	font-family: 'Avenir', Helvetica, Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	text-align: center;
	color: #2c3e50;
}
</style>
