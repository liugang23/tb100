<?php
namespace App\Service;

use App\Store\CategoryStore;

class CategoryService
{
	private static $categoryStore;
	
	public function __construct(CategoryStore $categoryStore)
	{
		self::$categoryStore = $categoryStore;
	}

	// 创建分类
	public function adminAddClass($data)
	{
		// 判断分类等级
		$level = substr_count($data['path'], ',');

		if($data['pater'] > 0) {
			$path = $data['path'].$data['pater'].',';
			$level = $level + 1;
		} elseif ($data['pater'] == 0) {
			$path = $data['path'];
			$level = $level;
		}
		// 相关参数
		$param = [
			'class_name' => $data['name'],
			'pater' => $data['pater'],
			'path' => $path,
			'level' => $level,
			'addtime' => time()
		];

		return self::$categoryStore->adminAddClass($param);
	}

	// 查询
	public function adminGetClass($id='')
	{
		if($id == '') {
			return self::$categoryStore->adminGetClassAll();
		} else {
			return self::$categoryStore->adminGetClass($id);
		}
	}

	// 更新
	public function adminUpdateClass($data)
	{	
		return self::$categoryStore->adminUpdateClassStatus($data);
	}


}