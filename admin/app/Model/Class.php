<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Class extends Model
{	// 购物车列表
    protected $table = 'data_class';
    protected $primaryKey = 'id';
    // 关闭 创建时间 与 更新时间的自动维护
    public $timestamps = false;

    public function hasCalssGoods()
    {
        return $this->hasMany('App\Model\Goods', 'id', 'class_id');
    }
}