<template>
	<div class="page app-main-top">
		<div class="app-space-20">
			<!-- 组件:用于显示提示信息 -->
	        <v-toast ref="toast" :toasttext="toasttext"></v-toast>

			<mt-field label="用户名" placeholder="请输入用户名" v-model="user.phone"></mt-field>

			<mt-field label="密码" placeholder="请输入密码" type="password" v-model="user.passw"></mt-field>

			<mt-field label="验证码" placeholder="请输入验证码" v-model="user.captcha">
				<img @click="loginValidateCode" :src="img" height="48px" width="105px">
			</mt-field>
		</div>

		<div class="app-space-20"></div>
		<mt-button size="large" type="danger" @click="loginClick"><strong>登 录</strong></mt-button>

		<mt-cell
		    title="没有帐号？去注册"
		    to="/register"
		    style="color: #04BE02;">
		</mt-cell>
	</div>
</template>

<script>
import { mapActions } from 'vuex'
// 导入显示提示信息的组件
import toast from '../components/Toast'

export default {
	components: {
		'v-toast': toast
	},
	data () {
		return {
			user: {
				phone: '',
				passw: '',
				captcha: '',
			},
			img: 'http://www.tb.com/api/validate',
			toastshow: false,		// 默认不显示提示信息
			toasttext: ''			// 提示信息内容
		}
	},
	computed: {
	// 所有 getter 和 setter 的 this 上下文自动地绑定为 Vue 实例
	//计算属性的结果会被缓存，除非依赖的响应式属性变化才会重新计算

		
	},
	methods: {
		// rest参数(形式为'...变量名')   …mapActions 就是把需要的方法给映射到当前组件中,然后就可以把action当做普通的方法来使用了
		...mapActions({
			UserLoging: 'UserLoging'
		}),
		loginValidateCode: function () {
			// 每次请求验证码地址都带上随机数据，确保不会被浏览器缓存 -->
			this.img = 'http://www.tb.com/api/validate'+ '?random=' + Math.random()
		},
		loginClick: function () {
			var that = this,
				phone = that.user.phone,
				passw = that.user.passw,
				captcha = that.user.captcha;

			var telRule = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;

			if (phone == null || !telRule.test(phone))
			{
				that.$refs.toast.setToasttext('请输入有效的手机号');
				that.$refs.toast.setToastshow('true');
				return false;
			}

			if (!(passw.match(/\d/) && passw.match(/[a-zA-Z]/) && passw.length == 6))
			{
				that.$refs.toast.setToasttext('您输入的密码至少包含一个数字和一个字母！');
				that.$refs.toast.setToastshow('true');
           		return false;
			}

			if (captcha.length != 4) {
				that.$refs.toast.setToasttext('请输入四位验证码！');
				that.$refs.toast.setToastshow('true');
           		return false;
			}

			// 验证通过，执行登录请求
			// 通过 store.dispatch('actionName') 触发Actions
			// console.log(that.user);
			that.$store.dispatch('UserLoging', that.user);
			// that.UserLoging(that.user);
		}
	}
}
</script>
<style>

</style>