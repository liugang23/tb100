@extends('admin.layout')
@section('content')
<div class="wraper container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">添加商品</h3></div>
                <div class="panel-body">
                    <div class=" form p-20">
                        <form class="cmxform form-horizontal tasi-form" id="form-goods-add" method="post" action="" novalidate="novalidate">
                            <div class="form-group ">
                                <label for="goods_name" class="control-label col-sm-2"><span class="i_red">* </span>商品名称：</label>
                                <div class="col-sm-5 formControls">
                                    <input class=" form-control" id="goods_name" name="name" type="text" required="" aria-required="true" datatype="*" nullmsg="商品名称不能为空">
                                </div>
                                <div class="col-sm-4"> </div>
                            </div>
                            <div class="form-group ">
                                <label for="goods_info" class="control-label col-sm-2"><span class="i_red">* </span>商品简介：</label>
                                <div class="col-sm-5 formControls">
                                    <input class="form-control " id="goods_info" type="text" name="subtitle" required="" aria-required="true" datatype="*" nullmsg="商品简介不能为空">
                                </div>
                                <div class="col-sm-4"> </div>
                            </div>
                            <div class="form-group ">
                                <label for="goods_stock" class="control-label col-sm-2"><span class="i_red">* </span>商品库存：</label>
                                <div class="col-sm-5 formControls">
                                    <input class="form-control " id="goods_stock" type="text" name="stock" datatype="*" nullmsg="商品价格不能为空">
                                </div>
                                <div class="col-sm-4"> </div>
                            </div>
                            <div class="form-group ">
                                <label for="goods_price" class="control-label col-sm-2"><span class="i_red">* </span>商品价格：</label>
                                <div class="col-sm-5 formControls">
                                    <input class="form-control " id="goods_price" type="text" name="price" datatype="*" nullmsg="商品价格不能为空">
                                </div>
                                <div class="col-sm-4"> </div>
                            </div>
                            <div class="form-group ">
                                <label for="goods_spec" class="control-label col-sm-2"><span class="i_red">* </span>起卖数量：</label>
                                <div class="col-sm-5 formControls">
                                    <input class="form-control " id="goods_spec" type="text" name="spec" datatype="*" nullmsg="起卖数量不能为空">
                                </div>
                                <div class="col-sm-4"> </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-sm-2"><span class="i_red">* </span>商品分类：</label>
                                <div class="col-sm-5 formControls">
                                    <span>
                                    	<select class="col-sm-9" name="class_id" style="height: 35px;">
                                        @foreach($class as $key)
                                    		<option value="{{ $key->id }}">{{str_repeat('&nbsp;&nbsp;&nbsp;',substr_count($key->path,','))}}|--- {{$key->class_name}}</option>
                                        @endforeach
                                    	</select>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-sm-2"><span class="i_red">* </span>添加商品预览图：</label>
                                <div class="col-sm-10">
                                    <img id="pic_id" src="{{ asset('/admin/images/icon-add.png') }}" style="border: 1px solid #B8B9B9; width: 150px; height: 150px;" onclick="$('#input_id').click()" />
                                    <input type="file" name="file" id="input_id" style="display: none;" onchange="return uploadImageToServer('input_id','images', 'pic_id');" />
                                </div> 
                            </div>
                            <div class="form-group ">
                            	<label class="control-label col-sm-2"><span class="i_red">* </span>添加商品图片：</label>
                            	<div class="col-sm-10">
                            		<img id="pic_id1" src="{{ asset('/admin/images/icon-add.png') }}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id1').click()" />
                            		<input type="file" name="file" id="input_id1" style="display: none;" onchange="return uploadImageToServer('input_id1','images', 'pic_id1');" />
                            		<img id="pic_id2" src="{{ asset('/admin/images/icon-add.png') }}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id2').click()" >
                            		<input type="file" name="file" id="input_id2" style="display: none;" onchange="return uploadImageToServer('input_id2','images', 'pic_id2');" />
                            		<img id="pic_id3" src="{{ asset('/admin/images/icon-add.png') }}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id3').click()" >
                            		<input type="file" name="file" id="input_id3" style="display: none;" onchange="return uploadImageToServer('input_id3','images', 'pic_id3');" />
                            		<img id="pic_id4" src="{{ asset('/admin/images/icon-add.png') }}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id4').click()" >
                            		<input type="file" name="file" id="input_id4" style="display: none;" onchange="return uploadImageToServer('input_id4','images', 'pic_id4');" />
                            		<img id="pic_id5" src="{{ asset('/admin/images/icon-add.png') }}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id5').click()" >
                            		<input type="file" name="file" id="input_id5" style="display: none;" onchange="return uploadImageToServer('input_id5','images', 'pic_id5');" />
                            	</div> 
                            </div>
                            <div class="form-group ">
                                <label for="goods_details" class="control-label col-sm-2"><span class="i_red">* </span>商品详情：</label>
                                <div class="col-sm-8 formControls">
                                    <!-- <textarea class="form-control " id="describe" name="details" required="" aria-required="true"></textarea> -->
                                    <script id="editor" type="text/plain" style="width:100%; height:200px;"></script>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <!-- <button class="btn btn-success" type="submit" onclick="onGoodsAdd();">提交</button>
                                    <button class="btn btn-default" type="button">取消</button> -->
                                    <input style="margin: 20px 0; width: 100px;" class="btn btn-success radius" type="submit" value="&nbsp;&nbsp;提 交&nbsp;&nbsp;">

                                    <input style="margin: 20px 0; width: 100px;" class="btn btn-default radius" type="submit" value="&nbsp;&nbsp;重 置&nbsp;&nbsp;">
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div> <!-- End row -->
</div>
@endsection

@section('my-js')
<script type="text/javascript" src="{{ asset('/admin/lib/ueditor/1.4.3/ueditor.config.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admin/lib/ueditor/1.4.3/ueditor.all.min.js') }}"> </script>
<script type="text/javascript" src="{{ asset('/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js') }}"></script>

<script type="text/javascript">
    var ue = UE.getEditor('editor');
    ue.execCommand( "getlocaldata" );

    $("#form-goods-add").Validform({
        tiptype:2,  // 可以为1、2 和 自定义函数。2 表示右侧提示
        callback:function(form){
            $('#form-goods-add').ajaxSubmit({
                type: 'post', // 提交方式 get/post
                url: '{{asset('/goods')}}', // 需要提交的 url
                dataType: 'json',
                data: {
                    name: $('input[name=name]').val(),
                    subtitle: $('input[name=subtitle]').val(),
                    price: $('input[name=price]').val(),
                    class_id: $('select[name=class_id] option:selected').val(),
                    pic_id: ($('#pic_id').attr('src')!='/admin/images/icon-add.png'?$('#pic_id').attr('src'):''),
                    content: ue.getContent(),
                    pic_id1: ($('#pic_id1').attr('src')=='http://admin.tb.com/admin/images/icon-add.png'?'':$('#pic_id1').attr('src')),
                    pic_id2: ($('#pic_id2').attr('src')=='http://admin.tb.com/admin/images/icon-add.png'?'':$('#pic_id2').attr('src')),
                    pic_id3: ($('#pic_id3').attr('src')=='http://admin.tb.com/admin/images/icon-add.png'?'':$('#pic_id3').attr('src')),
                    pic_id4: ($('#pic_id4').attr('src')=='http://admin.tb.com/admin/images/icon-add.png'?'':$('#pic_id4').attr('src')),
                    pic_id5: ($('#pic_id5').attr('src')=='http://admin.tb.com/admin/images/icon-add.png'?'':$('#pic_id5').attr('src')),
                    _token: "{{csrf_token()}}"
                },
                success: function(data) {
                    if(data.status == 0) {
                        layer.msg(data.message, {icon:1, time:2000});
                        // 刷新当前页
                        location.reload();
                    }
                    if(data == null) {
                        layer.msg('服务端错误', {icon:2, time:2000});
                        return;
                    }
                    if(data.status != 0) {
                        layer.msg(data.message, {icon:2, time:2000});
                        return;
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                    layer.msg('ajax error', {icon:2, time:2000});
                },
                beforeSend: function(xhr){
                    layer.load(0, {shade: false});
                },
            });

            return false;
        }
    });
</script>
@endsection