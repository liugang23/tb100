<template>
	<div class="page app-nav-top">
		<div class="app-goods-swiper">
			<mt-swipe :show-indicators="false">
			    <mt-swipe-item v-for="goods in lists">
			    	<img :src="goods.pic" @click="onInfo(goods.guid)" />
			    </mt-swipe-item>
			</mt-swipe>
		</div>
		<!-- 商品列表 -->
		<div id="container">
		    <ul>
			    <li v-for="item in lists">
			    	<div class="app-tuan" @click="onInfo(item.guid)">
				      	<img v-lazy.container="item.pic">
				      	<div class="app-goods-info">
							<span class="app-goods-name">{{ item.subtitle }}</span><br>
							<span class="app-goods-cx">{{ item.describe }}</span>
						</div>
				      	<div class="app-goods-core">
							<div class="app-goods-btn">
								<span class="">3人团</span>
								<span class=""></span>
								<span class="">去开团</span>
							</div>
							<div class="app-goods-price">
								<span class="app-price-red"><small>￥</small>{{ item.price }}</span>
								<span class="divide"> /</span>
								<span class="spec">{{ item.spec }}</span>
							</div>
						</div>
					</div>
			    </li>
		    </ul>
		</div>
	</div>
</template>

<script>

export default {
	props: ['lists'],
	methods: {
		onInfo (id) {
			console.log(id);
			this.$router.push({ name: 'info', params: { id: id }});
		}
	}
}


</script>
<style>
.app-goods-swiper {
	width: 100%;
	height: 165px;
	margin-bottom: 3px;
}
.app-goods-swiper img {
    display: block;
    overflow: hidden;
    width: 100%;
}
#container ul { 
	margin-top: 0;
	margin-left: -40px;
}
li {list-style-type:none;}
li img {width: 100%;} 
.app-tuan {
    background-color: #fff;
    border: 1px solid #cbcbcb;
    margin-bottom: 5px;
    padding-bottom: 5px;
    position: relative;
}
.app-goods-info {
    padding: 9px 11px;
    text-align: left;
}
.app-goods-name {
	width: 100%;
    color: #343434;
    line-height: 20px;
    font-size: 18px;
    text-align: left;
}
.app-goods-cx {
    padding: 6px 0 4px;
    line-height: 15px;
    font-size: 13px;
    color: #a4a5a7;
}
.app-goods-core {
    padding: 0 11px 12px;
}
.app-goods-price {
    height: 26px;
    line-height: 26px;
    overflow: hidden;
    text-align: left;
}
.app-goods-btn {
    float: right;
    height: 34px;
    padding: 0 10px;
    line-height: 34px;
    color: #fff;
    background-color: #ff473f;
    font-size: 14px;
    border-radius: 2px;
}
.app-price-red {
    color: #ff4d45;
    font-size: 24px;
}
.spec {
    color: #878787;
    font-size: 13px;
}
.divide {
    color: #878787;
    font-size: 16px;
}

</style>