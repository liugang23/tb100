### 作为被继承的验证基础模块	App\api\Controllers
	BaseController.php
### 验证模块	App\Api\Controllers\V1
	AuthController.php
### token 获取信息模块	App\Api\Transformers

	<?php

	namespace App\Api\Transformers;

	/**该类为dingo api封装好**/
	use League\Fractal\TransformerAbstract;

	class OrderTransformer extends TransformerAbstract
	{
	    /***
	     * 分开为了解耦
	     * 数据字段选择
	     * @param $lesson
	     * @return array
	     */
	    public function transform($lesson)
	    {
	        /******隐藏数据库字段*****/
	        return [
	            'username' => $lesson['user_name'],
	            'email' => $lesson['user_email'],
	        ];
	    }
	}
注：这里继承了dingo的TransformerAbstract类 


然后在Controllers目录下新建TestsController.php作为基础信息获取，代码如下：

	<?php
	namespace App\Api\Controllers;


	use App\Api\Transformers\TestsTransformer;
	use App\Client;

	class TestsController extends BaseController
	{
	    public function index()
	    {
	        $tests = Client::all();
	        return $this->collection($tests, new TestsTransformer());
	    }

	    public function show($id)
	    {
	        $test = Client::find($id);
	        if (!$test) {
	            return $this->response->errorNotFound('Test not found');
	        }
	        return $this->item($test, new TestsTransformer());
	    }
	}

	注：这里引用了TestsTransformer作为数据格式，item为dingo自带函数，处理数据格式并返回
	请求方式与⑤中请求localhost:8000/api/user/me?token=xxxxxxxxxxxxxxxxxxxx 一致，详情请求地址请看routes文件。

