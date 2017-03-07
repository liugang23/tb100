<template>
	<div class="page app-main-top">
		<mt-cell title="注册" style="color: #888; background-color: #eceded;"></mt-cell>
		<!-- 组件:用于显示提示信息 -->
        <v-toast ref="toast" :toasttext="toasttext"></v-toast>

		<!-- Validate组件 用于表单验证 -->
		<div class="app-mint-cell app-mint-field">
			<div class="app-mint-cell-wrapper">
				<label class="app-label">手机号</label>
				<input type="text" v-model="user.phone" placeholder="请输入手机号" class="app-input">
			</div>
		</div>

		<div class="app-mint-cell app-mint-field">
			<div class="app-mint-cell-wrapper">
				<label class="app-label">密码</label>
				<input class="app-input" type="password" v-model="user.passw" placeholder="请输入密码">
			</div>
		</div>
		<div class="app-mint-cell app-mint-field">
			<div class="app-mint-cell-wrapper">
				<label class="app-label">确认密码</label>
				<input class="app-input" type="password" v-model="user.rpassw" placeholder="请输入密码">
			</div>
		</div>

		<div class="app-mint-cell app-mint-field">
			<div class="app-mint-cell-wrapper">
				<div>
					<label class="app-label">验证码</label>
				</div>
				<div>
					<input class="app-input-code" type="text" v-model="user.captcha">
				</div>
				<div class="app-Validator-code">
					<img v-on:click="registerValidateCode" :src="img">
				</div>
			</div>
		</div>

		<div class="app-mint-cell app-mint-field">
			<div class="app-mint-cell-wrapper">
				<div>
					<label class="app-label">手机验证码</label>
				</div>
				<div>
					<input class="app-input-code" type="text" v-model="user.phoneCode">
				</div>
				<div>
					<timer-btn ref="timerbtn" class="app-phone-code" v-on:run="sendCode"></timer-btn>
				</div>
			</div>
		</div>

		<div class="app-space-20"></div>
		<mt-button size="large" type="danger" @click="registerClick"><strong>注 册</strong></mt-button>

		<mt-cell
			title="已有帐号？去登录"
			to="/login"
			style="color: #04BE02;">
		</mt-cell>

	</div>
</template>

<script>
// 短信验证码组件
import timerBtn from '../components/TimerBtn'
// 导入显示提示信息的组件
import toast from '../components/Toast'

export default {
	components: {
		'v-toast': toast,
		'timer-btn': timerBtn
	},
	data () {
		return {
			title: '首页',
			user: {
				phone: '',				// 电话号码
				passw: '',				// 首次输入密码
				rpassw: '',				// 再次输入密码
				captcha: '',		    // 验证码
				phoneCode: '',			// 手机验证短信
			},
			toastshow: false,		// 默认不显示提示信息
			toasttext: '',			// 提示信息内容
			img: 'http://www.tb.com/api/validate'// 验证码
		}
	},
	methods: {
		registerValidateCode: function () {
			// 每次请求验证码地址都带上随机数据，确保不会被浏览器缓存 -->
			this.img = 'http://www.tb.com/api/validate'+ '?random=' + Math.random()
		},
		sendCode: function(){
			var phone = this.user.phone,
				telRule = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;

			if (phone == null || !telRule.test(phone))
			{
				that.$refs.toast.setToasttext('请输入有效的手机号');
				that.$refs.toast.setToastshow('true');
				return false;
			}
			
			// $refs 只在组件渲染完成后才填充，并且它是非响应式的。它仅仅作为一个直接访问子组件的应急方案——应当避免在模版或计算属性中使用 $refs .
			//设置按钮不可用
            this.$refs.timerbtn.setDisabled(true); 
            // 请求
            this.axios.post('http://www.tb.com/api/validate', {
				phone: this.phone,
			})
			.then((response) => {
				console.log(response.data)

				if (response.data.statusCode == 200) {
					//启动倒计时
					this.$refs.timerbtn.start() 
				}else{
					//停止倒计时
                    this.$refs.timerbtn.stop() 
                }
			});
        },
		registerClick: function () {
			var that = this,
				phone = that.user.phone,
				passw = that.user.passw,
				rpassw = that.user.rpassw,
				captcha = that.user.captcha,
				phonecode = that.user.phoneCode;

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

			if (!(rpassw.match(/\d/) && rpassw.match(/[a-zA-Z]/) && rpassw.length == 6))
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

			//if (phonecode.length != 6) {
			//	that.$refs.toast.setToasttext('请输入六位验证码！');
			//	that.$refs.toast.setToastshow('true');
           	//	return false;
			//}

			// 验证通过，执行注册请求
			that.$store.dispatch('UserRegister', that.user);	
		}
	}


}
</script>

<style>

</style>