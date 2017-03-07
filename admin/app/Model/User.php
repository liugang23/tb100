<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{	
    protected $fillable = ['uid', 'username', 'tel', 'password', 'pic', 'status', 'addtime'];
    // 用户表
    protected $table = 'data_users';
    // 自定义主键
    // protected $primaryKey = 'id';
    public $incrementing = false;
    // 关闭 创建时间 与 更新时间的自动维护
    public $timestamps = false;

    /**
     * 用户-订单一对多关联
     */
    public function hasUserOrder()
    {
        return $this->hasMany('App\Model\Order', 'uid', 'uid');
    }

    /**
     * 用户-购物车一对多关联
     */
    public function hasUserCart()
    {
        return $this->hasMany('App\Model\Cart', 'uid', 'uid');
    }

}