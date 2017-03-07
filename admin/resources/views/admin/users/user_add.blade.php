@extends('admin.layout')
@section('content')
<div class="wraper container-fluid">
    <div class="row">                    
        <!-- Horizontal form -->
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">添加用户</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal p-20" role="form" action="" method="post" id="form-user-add">
                        <div class="form-group">
                            <label for="username" class="col-sm-3 control-label">用户名</label>
                            <div class="col-sm-5 formControls">
                               	<input type="text" name="name" class="form-control" id="user" placeholder="username" datatype="*" nullmsg="用户名不能为空">
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="form-group">
                            <label for="tel" class="col-sm-3 control-label">手机号</label>
                            <div class="col-sm-5 formControls">
                                <input type="text" name="tel" class="form-control" id="tel" placeholder="请输入手机号" datatype="m" nullmsg="请输入11位手机号">
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">密码</label>
                            <div class="col-sm-5 formControls">
                              	<input type="password" name="password" class="form-control" id="password" placeholder="password" datatype="*6-20" nullmsg="请输入6 ~ 20位密码">
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="form-group">
                            <label for="pic" class="col-sm-3 control-label">头像</label>
                            <div class="col-sm-5">
                                <img id="pic" src="{{ asset('/admin/images/icon-add.png') }}" style="border: 1px solid #B8B9B9; width: 60px; height: 60px;" onclick="$('#input_pic').click()" />
                                <input type="file" name="file" id="input_pic" style="display: none;" onchange="return uploadImageToServer('input_pic','images', 'pic');"  />
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9">
                                <!-- <div class="btn btn-info" onclick="onAddUser();">提交</div> -->
                                <input style="margin: 20px 0; width: 200px;" class="btn btn-info radius" type="submit" value="&nbsp;&nbsp;提 交&nbsp;&nbsp;">
                            </div>
                        </div>
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div> <!-- End row -->
</div>
@endsection

@section('my-js')
<script type="text/javascript">
    $("#form-user-add").Validform({
        tiptype:2,  // 可以为1、2 和 自定义函数。2 表示右侧提示
        callback:function(form){
            $('#form-user-add').ajaxSubmit({
                type: 'post', // 提交方式 get/post
                url: '{{asset('/users')}}', // 需要提交的 url
                dataType: 'json',
                data: {
                    name: $('input[name=name]').val(),
                    tel: $('input[name=tel]').val(),
                    password: $('input[name=password]').val(),
                    pic: ($('#pic').attr('src')!='/admin/images/icon-add.png'?$('#pic').attr('src'):''),
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