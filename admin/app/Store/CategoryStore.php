<?php
namespace App\Store;

class CategoryStore
{
	// 查询分类
	public static function adminGetClassAll()
	{
		return \DB::table('data_class')->get();
	}

	// 执行添加分类
	public static function adminAddClass($data)
	{
		return \DB::table('data_class')->insert($data);
	}

	// 查询子类、等级
	public static function adminGetClass($data)
	{
		$str = explode(',', $data);

		return \DB::table('data_class')
				->where([$str['0']=>$str['1']])->get();
	}

	// 执行更新操作
	public static function adminUpdateClassStatus($data)
	{
		// dd($data);
		$id = $data['id'];		// 对象 id
		$status = $data['status'];	// 状态
		// dd($id);
		if ($status == 0) {
			return \DB::table('data_class')
				->where(['id'=>$id])
				->update(array('status'=>1));
		}else{
			return \DB::table('data_class')
				->where(['id'=>$id])
				->update(array('status'=>0));
		}
		
	}
}