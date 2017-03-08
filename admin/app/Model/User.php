<?php
namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends BaseModel implements AuthenticatableContract, JWTSubject
{	
    // 软删除和用户验证attempt
    use Authenticatable;
    
    /**
     * 白名单 $fillable 属性指定了哪些字段支持批量赋值
     * @var array
     */
    //protected $fillable = ['uid', 'username', 'tel', 'password', 'pic', 'status', 'addtime'];
    /**
     * 模型所使用的数据库表
     * @var string
     */
    protected $table = 'data_users';
    /** 
     * 自定义主键
     */
    protected $primaryKey = 'uid';

    /**
     * 关闭 递增
     */
    public $incrementing = false;
    /**
     * 关闭 创建时间 与 更新时间的自动维护
     */
    public $timestamps = false;

    /** 
     * 转换成数组或 JSON 时隐藏属性
     * 查询用户的时候，不暴露密码
     * @var array 
     */  
    protected $hidden = ['password', 'remember_token'];

    /**
     * 获取用户的唯一标识符
     * jwt 需要实现的方法
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();// 模型的方法
    }

    // jwt 需要实现的方法
    public function getJWTCustomClaims()
    {
        return [];
    }

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