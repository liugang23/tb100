<template>
	<div class="post">
		<div class="page app-main-top">
			<!-- 商品轮播 -->
			<div class="app-goods-swiper">
				<mt-swipe :show-indicators="false">
				    <mt-swipe-item v-for="img in imgs">
				    	<img :src="img.img_path">
				    </mt-swipe-item>
				</mt-swipe>
			</div>
			<!-- 商品详情 -->
			<div class="app-goods-info app-goods-white">
				<div class="app-goods-name">{{ goods.subtitle }}</div>
				<p class="tuan-goods-cx">{{ goods.describe }}</p>
				<div class="app-goods-price">
					<span class="red"><span class="red-padding">￥ </span>{{ goods.price }}</span>
					<span class="price-spec"><span>/ </span>{{ goods.spec }}</span>
				</div>
			</div>
			<div class="app-image-text app-goods-white">
				<div class="app-text-title">图文详情</div>
				<div class="app-img-info">
					<ul>
						<li></li>
					</ul>
				</div>
			</div>
		</div>
		<Info-Footer></Info-Footer>
	</div>
</template>

<script>
import InfoFooter from '../../components/Info-footer'

export default {
	components: {
		'Info-Footer': InfoFooter
	},
	data () {
		return {
			goods: [],
			imgs: [],
			info: []
		}
	},
	mounted() {// 生命周期钩子
		this.id = this.$route.params.id
	    //console.log(this.$route.params.id);
	    this.axios.get('http://www.tb.com/api/goodsinfo/'+this.id)
	    .then((response) => {
	    	//if(response.data.statusCode !== 200) {}
				//console.log(JSON.parse(response.data.resultData));
				//this.lists = JSON.parse(response.data.resultData);

			//}else{
				this.lists = JSON.parse(response.data.resultData);
				this.goods = this.lists.info.goods;
				this.imgs = this.lists.info.img;
				this.info = this.lists.info.info;
				this.count = this.lists.count;
				//console.log(this.goods);
			//}
		})
		.catch(function (error) {
			console.log(error);
		});
	}
	
}
</script>
<style>
.app-goods-info {
    position: relative;
    padding: 8px 0;
    text-align: center;
}
.app-goods-white {
    background-color: #fff;
}
.app-goods-name {
    padding: 0 15px;
    font-size: 18px;
    height: auto;
    color: #343434;
    line-height: 22px;
    text-align: center;
}
.tuan-goods-cx {
    padding: 6px 0 4px;
    line-height: 15px;
    font-size: 13px;
    color: #a4a5a7;
}
.app-goods-price {
    margin-top: 10px;
    height: 25px;
    line-height: 25px;
    text-align: center;
}
.red {
    color: #ff4d45;
    font-size: 24px;
}
.red-padding {
    padding-left: 1px;
}
.price-spec {
    color: #626262;
    font-size: 12px;
}
.app-image-text {
    padding: 0 12px;
}
.app-text-title {
    width: 65px;
    height: 42px;
    line-height: 42px;
    font-size: 16px;
    color: #343434;
    border-bottom: 1px solid #ff473f;
}
.app-img-info {
    padding: 10px 0;
}
</style>