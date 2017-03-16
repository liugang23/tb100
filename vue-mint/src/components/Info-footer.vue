<template>
	<mt-tabbar v-model="selected" fixed>
		<mt-tab-item id="add" v-on:click.native="onAddCart">
			<img >加入购物车
		</mt-tab-item>

		<mt-tab-item id="cart" >
			<img >查看购物车 
			<a>{{ count }}</a>
		</mt-tab-item>

		<mt-tab-item id="pay" >
			<img >支付
		</mt-tab-item>
	</mt-tabbar>
</template>

<script>
var storage = require('store')
export default {
	data () {
		return {
			selected: "pay",
			count: 0
		}
	},
	mounted() {// 生命周期钩子
		// 查询购物车商品数量
		this.guid = this.$route.params.id

	    // 获取购物车数据
	    var cart = storage.get("cart");
	    var count = 0;	// 初始为0
	    if(cart != null) {
		    cart.forEach((item, index) => {
			    var i =  item.indexOf(':');
			    // 如果商品存在, 加1
			    if(item.substring(0, i) == this.guid) {
			        count = Number(item.substring(i+1));
			    }
			})
			this.count = count;
		}else if(cart == null) {
			this.count = count;
		}
		
	},
	methods: {
		onAddCart: function() {
			this.guid = this.$route.params.id
			// sessionStorage：仅在当前浏览器窗口关闭前有效
	        // localStorage：始终有效，窗口或浏览器关闭也一直保存，因此用作持久数据
	        // localStorage只支持string类型的存储
			if(!window.localStorage){
	            alert("浏览器不支持localstorage");
	            return false;
	        }else{
	        	// 获取购物车数据
	        	var cart = storage.get("cart");
	        	// 判断本地购物车是否为空  cart.split(",") 将字串分割为数组
	        	var arr = (cart != null ? cart : []);

	        	var count = 0;	// 初始为0
	        	// 在购物车中遍历传进来的商品 guid
		        for(var n=0; n<arr.length; n++) {
		        	var i = arr[n].indexOf(':');
		        	// 如果商品存在, 加1
		        	if(arr[n].substring(0, i) == this.guid) {
		        		count = Number(arr[n].substring(i+1)) + Number(1);
		        		// 拼接购物车商品信息 $guid : $count
		        		arr[n] = this.guid + ':' + count;
		        		// 删除之保存
		        		storage.remove("cart")
		        		// 保存最新
		        		storage.set("cart", arr);
		        	}
		        }

	        	// 如果count == 0 说明商品不存在  写入
	        	if(count == 0) {
	        		count = 1;
	        		// 定义商品信息格式
	        		var obj = [this.guid + ':' + count];
	        		arr.push.apply(arr, obj)	// 添加至数组
	        		// 写入购物车
	            	storage.set("cart", arr);
	        	}
	        	this.count = count;JSON.parse

	        };
			//this.axios.post('http://www.tb.com/api/cart', { id: this.guid })
			//.then((response) => {
				//if(response.data.resultStatus == 200) {
					//console.log(JSON.parse(response.data.resultData));
					//this.count = JSON.parse(response.data.resultData);
				//}else{

				//}
			//});
			//.catch(function (error) {
			//	console.log(error);
				// 显示返回的错误信息
			//	this.$set('toasttext',String(error.status));
			//	this.$set('toastshow',true);
			//});
		}
	},
	watch: {// watch 监听变化
		selected: function (id) {
			if(id == "add") {

			} else if(id != "add") {
				this.$router.push({ name: id })
			}
		}
	}
}

</script>