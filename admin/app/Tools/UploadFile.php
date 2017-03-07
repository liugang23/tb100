<?php
namespace App\Tools;

use App\Service\OssService;


class uploadFile
{
	private static $maxSize = 1024*1024;	// 上传文件的最大值
	private static $allowTypes = array('image','jpeg','text'); // 允许上传的文件类型
	private $error = '';	// 错误信息

	/*
	 * 文件上传
	 */
	public function upload($file)
	{
		// 检验上传文件是否有效
		$check = $this->checkFile($file);

		if(!$check['status']) {
			return response()
				->json(['status' => '2', 
						'message' => $check['msg']]);
		}

		// 取得上传文件的原始文件名：
		$clientName = $file->getClientOriginalName();
		// 获取缓存文件夹中的文件名
		$tmpName = $file->getFileName();
		// 获取缓存文件夹下的绝对路径
		$realPath = $file->getRealPath();
		// 获取上传文件后缀(扩展名)
		$ext = $file->getClientOriginalExtension();
		// 根据上传时间生成文件夹
		// 生成文件名
		$fileName = time().rand(10000,99999).'.'.$ext;
		// 上传至阿里云 oss
		$result = OssService::upload($fileName, $realPath);
		
		// 判断上传是否成功
		if (empty($result)) {
			return false;
		}
		// return $fileName;
		$url = 'http://liugang23.oss-cn-shenzhen.aliyuncs.com';
		$data = array('status' => 0,
              		  'message' => '上传成功',
              		  'uri' => $url.'/'.$fileName);

		// return response()->json($data);
		return $data;
	}

	/**
	 * 检查上传的文件
	 * @access private
	 * @param array $file 文件信息
	 * @return boolean
	 */
	private function checkFile($file) 
	{
		if(!$file->isValid()) {
			return ['status' => false, 'msg' => '文件上传失败'];
		}
        // 错误号
	    if($_FILES['file']['error'] !== 0) {
		    //文件上传失败
		    //捕获错误代码
		    return ['status' => false, 'msg' => $this->error($file['error'])];
	    }
	    //文件上传成功，进行自定义规则检查
	    //检查文件大小
	    if(!$this->checkSize($_FILES['file']['size'])) {
		    return ['status' => false, 'msg' => '上传文件大小不符！'];
	    }
	    //检查文件Mime类型
	    if(!$this->checkType($_FILES['file']['type'])) {
	        return ['status' => false, 'msg' => '上传文件MIME类型不允许！'];
	    }
	    // //检查是否合法上传
	    // if(!$this->checkUpload($_FILES[$file]['tmp_name'])) {
	    //     return ['status' => false, 'msg' => '非法上传文件！'];
	    // }
	    return ['status' => true];
	}

	/**
	* 检查上传的文件大小是否合法
	* @access private
	* @param string $size 数据
	* @return boolean
	*/
	private function checkSize($size) {
		return !($size > self::$maxSize);
	}

	/**
	* 检查上传的文件类型是否合法
	* @access private
	* @param string $type 数据
	* @return boolean
	*/
	private function checkType($type) {
		if(!empty(self::$allowTypes)) {
			list($type) = explode('/', $_FILES['file']['type']);
			return in_array(strtolower($type), self::$allowTypes);
		}
        return true;
	}

	/**
	* 检查文件是否非法提交
	* @access private
	* @param string $filename 文件名
	* @return boolean
	*/
	// private function checkUpload($filename) {
	// 	// is_uploaded_file() 函数判断指定的文件是否是通过 HTTP POST 上传的
	//     return is_uploaded_file($filename);
	// }
}