@extends('admin.layout')
@section('content')
<div class="wraper container-fluid">
	<div class="row">
		<div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">添加商品分类</h3></div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal p-20" role="form" id="form-class-add">
                        <div class="form-group">
                            <label for="inputCate" class="col-sm-3 control-label"><span class="i_red">* </span>商品分类名称:</label>
                            <div class="col-sm-5 formControls">
                                <input type="text" class="form-control" id="inputCate" name="name" placeholder="输入商品分类名称" datatype="*" nullmsg="分类名称不能为空">
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                        <div class="form-group">
                            <label for="inputPid" class="col-sm-3 control-label">Pid:</label>
                            <div class="col-sm-5">
                              	<input type="text" class="form-control" id="inputPid" name="pater" value="{{ $pater }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPath" class="col-sm-3 control-label">Path:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="inputPath" name="path" value="{{ $path }}" readonly>
                            </div>
                        </div>
                                
                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input class="btn btn-info radius" type="submit" value="&nbsp;&nbsp;提 交&nbsp;&nbsp;">
                            </div>
                        </div>
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div>
    </div>
</div>
@endsection

@section('my-js')
<script type="text/javascript">
    $("#form-class-add").Validform({
        tiptype:2,
        callback:function(form){
        var name = $('input[name=name]').val();

        if(confirm('确定添加 【'+ name +'】 分类？')){
            $('#form-class-add').ajaxSubmit({
                type: 'post', // 提交方式 get/post
                url: '{{asset('/category')}}', // 需要提交的 url
                dataType: 'json',
                data: {
                    name: $('input[name=name]').val(),
                    parent_id: $('input[name=parent_id]').val(),
                    path: $('input[name=path]').val(),
                    _token: "{{csrf_token()}}"
                },
                success: function(data) {
                	if(data.status == 0) {
                		layer.msg(data.message, {icon:1, time:2000});
	                    // 刷新当前页面
	                    parent.location.reload();
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
        }
        return false;
    }
  });
</script>
@endsection