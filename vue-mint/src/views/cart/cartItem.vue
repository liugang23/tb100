<template>
<div>
	<div class="page app-main-top">
		<div class="weui_cells weui_cells_checkbox">
	        <label class="weui_cell weui_check_label" :for="list.guid" v-for="list in lists">
	            <div class="weui_cell_hd" style="width: 23px;">
	                <input type="checkbox" class="weui_check" :id="list.guid" :value="list.guid" v-model="toggle">
	                <i :class="isCheck(list.guid)"></i>
	            </div>
	            <div class="weui_cell_bd weui_cell_primary">
	              	<div style="position: relative;">
		                <img class="app-cart-img">
		                <div class="app-cart-info">
		                	<div style="text-align:left">123</div>
		                	<div class="app-time app-space-20">数量：<span class="app-cart-summary">x </span></div>
		                	<div class="app-time">总计：<span class="app-cart-price">￥ </span></div>
		                </div>
	                </div>
	            </div>
	        </label>

		<!--	<div style="text-align:center">购物车暂无商品</div>  -->

	    </div>
	</div>
	<div class="app-fix-bottom">
		<div class="app-half-area">
			<button class="app-btn app-btn-primary" @click="onPaly">结 算</button>
		</div>
		<div class="app-half-area">
			<button class="app-btn app-btn-default" @click="onDel">删 除</button>
		</div>
	</div>
</div>
</template>
<script>
require('../../assets/css/weui.css')

export default {
	components: {

	},
	data () {
		return {
			//isCheck: [true],
			toggle: [],
			lists: [],
		}
	},
	mounted() {// 生命周期钩子
		var _this = this;
		_this.axios.get('http://www.tb.com/api/cart')
		.then((response) => {
			//if(response.data.resultStatus == 200) {
				console.log(response.data.resultData);
				_this.lists = JSON.parse(response.data.resultData);
			//}else{

			//}
		})
		.catch(function (error) {
			console.log(error);
			// 显示返回的错误信息
			//this.$set('toasttext',String(error.status));
			//this.$set('toastshow',true);
		});
	},
	methods: {
		isCheck(val) {
			console.log(val);
			let isCheck = false;
			this.toggle.forEach((item, index) => {
				if (item == val) {
					isCheck = true
					return false
				}
			})
			return isCheck ? 'weui_icon_checked' : 'weui_icon_unchecked'
		},
		onPaly: function() {
			console.log('paly')
			var guids_arr = [];	//初始化商品id数组
			// 获取被勾选的项的id

			// 将相应选中商品的id写入数组
			// guids_arr.push
			

			//发送ajax请求
		},
		onDel: function() {
			console.log('del')
			if(!window.localStorage){
                alert("浏览器不支持localstorage");
                return false;
            }else{
                // 获取被选中商品 guid

                // 初始化 localStorage
                var storage = window.localStorage;
                // 获取购物车数据
                var cart = storage.getItem("cart");

                var count = 0;  // 初始为0
                if(cart != null) {
                    // cart.split(",") 将字串分割为数组
                    var carts = cart.split(",");

                    // 在购物车中遍历传进来的商品 guid
                    carts.forEach((item, index) => {
                        var i =  item.indexOf(':');
                        // 如果商品存在  删除
                        if(item.substring(0, i) == this.guid) {
                            // 将localStorage的所有内容清除
                            storage.clear();
                            // 将localStorage中的某个键值对删除
                            storage.removeItem('a');
                        }
                    })
                }
            };

			// 发送ajax请求
			
		}
	},
	watch: {
		toggle: function(id) {
			//console.log(id)
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
.weui_icon_checked:before {
  content: '\EA06';
  color: #09BB07;
  font-size: 23px;
  display: block;
}
.weui_icon_unchecked:before {
  content: '\EA01';
  color: #C9C9C9;
  font-size: 23px;
  display: block;
}
</style>