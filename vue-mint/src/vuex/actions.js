// 执行操作
import api from '../api'
import { USER_SIGNIN,USER_SIGNOUT,USER_REGISTER } from './types'// 引入并解构

// export 输出   const 声明常量
// 用户登录
export const UserLoging = ({ commit }, data) =>{
	api.localLogin(data).then(function (response) {
		// if( response.data.type == true) {
			console.log(response.data);
			commit(USER_SIGNIN, response.data.token);
			window.location = '/me'	// 个人中心
		// }else{
			// console.log(response.data);
			// window.location = './login'
		// }
	})
	.catch(function (error) {
		console.log(error);
	});
};

// 用户退出
export const UserLogout = ({ commit }, data) => {
	api.localLogout(data).then(function (response) {
		commit(USER_SIGNOUT);
		window.location = '/login'
	})
	.catch(function (error) {
		console.log(error);
	});
};

// 用户注册
export const UserRegister = ({ commit }, data) => {
	api.localRegister(data).then(function (response) {
		console.log(response.data);
		//if( response.data.type == true ) {
			commit(USER_REGISTER, response.data.token);
			window.location = '/me' // 注册成功 进入个人中心
		//}
	})
	.catch(function (error) {
		console.log(error);
	});
};

// 发送短信


