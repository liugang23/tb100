<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	/**
	 * 黑名单  $guarded 阻挡所有属性被批量赋值
	 */
	//protected $guarded = ['id', 'updated_at'];
	/**
	 *
	 */
    //protected $dates = ['created_at', 'updated_at'];

    /** 
     * 转换成数组或 JSON 时隐藏属性
     * 查询用户的时候，不暴露密码
     * @var array 
     */
    //protected $hidden = ['updated_at', 'deleted_at', 'extra'];
  
}
