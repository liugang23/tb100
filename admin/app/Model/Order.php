<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{	// 商品表
    protected $table = 'data_Order';
    // 自定义主键
    protected $primaryKey = 'id';
    // 关闭 创建时间 与 更新时间的自动维护
    public $timestamps = false;


}