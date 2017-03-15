<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{	// 商品表
    protected $table = 'data_order';
    // 自定义主键
    protected $primaryKey = 'id';
    // 关闭 创建时间 与 更新时间的自动维护
    public $timestamps = false;
    /**
     * 白名单 $fillable 属性指定了哪些字段支持批量赋值
     * @var array
     */
    protected $fillable = ['uid', 'title', 'order_id', 'total_price', 'addtime'];

}