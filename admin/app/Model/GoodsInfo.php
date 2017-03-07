<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsInfo extends Model
{	// 商品表
    protected $table = 'data_goods_info';
    // 自定义主键
    protected $primaryKey = 'id';
    // 关闭 创建时间 与 更新时间的自动维护
    public $timestamps = false;

    /**
	 * 定义一对多关系
     */
//    public function goodsImg() {
//    	return $this->hasMany();
//    }
}