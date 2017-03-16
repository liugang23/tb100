<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{	// 购物车列表
    protected $table = 'data_cart_item';
    // protected $primaryKey = 'id';
    /**
     * 白名单 $fillable 属性指定了哪些字段支持批量赋值
     * @var array
     */
    protected $fillable = ['uid', 'guid', 'count', 'status', 'addtime'];

    // 关闭 创建时间 与 更新时间的自动维护
    public $timestamps = false;

    /**
     * 
     */

}