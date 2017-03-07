<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{	// 购物车列表
    protected $table = 'data_cart_item';
    protected $primaryKey = 'id';

    // 关闭 创建时间 与 更新时间的自动维护
    public $timestamps = false;

    /**
     * 
     */

}