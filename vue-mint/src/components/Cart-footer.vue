<template>
	<div class="app-fix-bottom">
		<div class="app-half-area">
			<button class="app-btn app-btn-primary" @click="onPaly">结 算</button>
		</div>
		<div class="app-half-area">
			<button class="app-btn app-btn-default" @click="onDel">删 除</button>
		</div>
	</div>
</template>

<script>
var store = require('store')
export default {
	data () {
		return {
			selected: "/pay"
		}
	},
	methods: {
		onPaly: function() {
			console.log('paly')
		},
		onDel: function() {
            // 删除
            // store.remove('')
			console.log('del')
		}
	},
	watch: {
		selected: function (id) {
			console.log(id);
			this.$router.push({ path: id })
		}
	}
}

</script>

<style>
.app-fix-bottom {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #eeeeee;
}
.app-half-area {
    width: 45%;
    padding: 5px 2%;
    display: inline-block;
}
.app-btn {
    position: relative;
    display: block;
    margin-left: auto;
    margin-right: auto;
    padding-left: 14px;
    padding-right: 14px;
    box-sizing: border-box;
    font-size: 18px;
    text-align: center;
    text-decoration: none;
    color: #FFFFFF;
    line-height: 2.33333333;
    border-radius: 5px;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    overflow: hidden;
}
.app-btn:after {
    content: " ";
    width: 200%;
    height: 200%;
    position: absolute;
    top: 0;
    left: 0;
    border: 1px solid rgba(0, 0, 0, 0.2);
    -webkit-transform: scale(0.5);
    -ms-transform: scale(0.5);
    transform: scale(0.5);
    -webkit-transform-origin: 0 0;
    -ms-transform-origin: 0 0;
    transform-origin: 0 0;
    box-sizing: border-box;
    border-radius: 10px;
}
.app-btn-primary {
    background-color: #04BE02;
}
.app-btn-default {
    background-color: #F7F7F7;
    color: #454545;
}
button.app-btn {
    width: 100%;
    border-width: 0;
    outline: 0;
    -webkit-appearance: none;
}
</style>