<template>
	<div class="page app-main-top">
		<div class="app-page-my-hd app-my-head">
			<div class="app-my-head-pic">
				<img calss="app-my-head-img">
			</div>
		</div>
        <div class="weui_cells weui_cells_access">
            <div class="weui_cell app-nav-item-bd">
                <a><span>全部订单</span></a>
                <a><span>待付款</span></a>
                <a><span>待收货</span></a>
            </div>
            <a class="weui_cell app-nav-cart">
                <div class="weui_cell_bd weui_cell_primary app-nav-item-hd">
                    <p class="app-text-left">我的购物车</p>
                </div>
            </a>
            <a class="weui_cell app-nav-site">
                <div class="weui_cell_bd weui_cell_primary app-nav-item-hd">
                    <p class="app-text-left">我的地址</p>
                </div>
            </a>
            <a class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary app-nav-item-hd-coupons">
                    <p class="app-text-left">我的优惠券</p>
                </div>
            </a>
            <a class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary app-nav-item-hd-coupons-sale">
                    <p class="app-text-left">售后服务</P>
                </div>
            </a>
            <a class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary app-nav-item-hd-promotion">
                    <p class="app-text-left">降价通知</p>
                </div>
                <mt-switch v-model="value"></mt-switch>
            </a>
        </div>
	</div>
</template>

<script>
require('../assets/css/weui.css')
export default {

    data () {
        return {
            value: false
        }
    },
}

</script>

<style>
.app-page-my-hd {
    background-color: #ebebeb;
    padding: 1px;
    height: 150px;
}
.app-my-head {
    text-align: center;
}
.app-my-head-pic {
    padding: 50px 0 0;
}
.app-my-head-pic img {
    border-radius: 50%;
    -webkit-border-radius: 50%;
    box-shadow: 0 0 0 2px #fff;
    height: 65px;
    width: 65px;
    display: inline-block;
    background-repeat: no-repeat;
}
</style>