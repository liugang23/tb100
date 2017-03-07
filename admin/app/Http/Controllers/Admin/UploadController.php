<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\UploadFile;

class UploadController extends Controller
{
    public function uploadFile(Request $request, $type)
    {
    	$data = $request->all();
    	$file = $data['file'];
		$fileName = new UploadFile();	// 实例文件上传类
		$result = $fileName->upload($file);

		return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     * 执行添加操作
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $result = self::$goodsService->adminAddGoods($data);
    }
}
