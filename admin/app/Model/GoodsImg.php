<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsImg extends Model
{	// 商品表
    protected $table = 'data_goods_img';
    // 自定义主键
    protected $primaryKey = 'id';
    // 关闭 创建时间 与 更新时间的自动维护
    public $timestamps = false;

    /**
	 * 定义相对应的关联
     */
    public function belongsToGoods() {
    	return $this->belongsToMany('App\Model\Goods', 'guid');
    }
}