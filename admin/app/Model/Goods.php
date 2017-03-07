<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{	// 商品表
    protected $table = 'data_goods';
    // 自定义主键
    protected $primaryKey = 'id';
    // 关闭 创建时间 与 更新时间的自动维护
    public $timestamps = false;

    /**
     * 建立商品与商品图片表一对多关系
     */
    public function goodsImg()
    {
        return $this->hasMany('App\Model\GoodsImg', 'guid', 'guid');
    }

    /**
     * 建立商品与商品信息表一对多关系
     */
    public function goodsInfo() 
    {
    	return $this->hasMany('App\Model\GoodsInfo', 'guid', 'guid');
    }
}