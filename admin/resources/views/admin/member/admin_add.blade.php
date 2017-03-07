@extends('admin.layout')
@section('content')
<div class="wraper container-fluid">
    <div class="page-title"> 
        <h3 class="title">添加管理员</h3> 
    </div>

    <div class="row">                    
        <!-- Horizontal form -->
        <div class="col-md-8">
            <div class="panel panel-default">
                <!-- <div class="panel-heading"><h3 class="panel-title">添加管理员</h3></div> -->
                <div class="panel-body">
                    <form class="form-horizontal p-20" role="form" action="" method="post">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">用户名</label>
                            <div class="col-sm-9">
                               	<input type="text" name="username" class="form-control" id="inputName" placeholder="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">管理员级别</label>
                            <div class="col-md-9">
                                <div class="radio-inline">
                                    <label class="cr-styled" for="example-radio4">
                                        <input type="radio" id="example-radio4" name="level" value="0"> 
                                        <i class="fa"></i>
                                            超级管理员 
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label class="cr-styled" for="example-radio5">
                                        <input type="radio" id="example-radio5" name="level" value="1"> 
                                        <i class="fa"></i> 
                                            主管
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label class="cr-styled" for="example-radio6">
                                        <input type="radio" id="example-radio6" name="level" value="2"> 
                                        <i class="fa"></i> 
                                            普通管理员
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">密码</label>
                            <div class="col-sm-9">
                              	<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword4" class="col-sm-3 control-label">重复密码</label>
                            <div class="col-sm-9">
                                <input type="password" name="rpassword" class="form-control" id="inputPassword4" placeholder="Retype Password">
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="btn btn-info" onclick="onAdd();">提交</div>
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
    function onAdd() {

        var 
            username = $('input[name=username]').val(),
            level = $('input[name=level]:checked').val(),
            password = $('input[name=password]').val(),
            rpassword = $('input[name=rpassword]').val();
        console.log(username);
        console.log(level);
        console.log(password);
        if (username == '') {// 用户名不能为空
            // $('.lg_toptips').show();
            // $('.lg_toptips span').html('请输入手机号');
            // setTimeout(function() {$('.lg_toptips').hide();}, 3000);
            return;
        }
        if (!password == rpassword) {// 判断两次输入的密码是否一致
            // $('.lg_toptips').show();
            // $('.lg_toptips span').html('请输入手机号');
            // setTimeout(function() {$('.lg_toptips').hide();}, 3000);
            return;
        }
        if (confirm("确定添加管理员")) {
            // 基本信息验证通过后,发起请求
            $.ajax({
                type: 'post',       // 提交方式 get/post
                url: '/member',     // 需要提交的 url
                dataType: 'json',
                data: {
                    username: username,
                    password: password,
                    level: level,
                    _token: "{{csrf_token()}}"
                },
                success: function(data) {
                    if(data.status == 0) {
                        // $('.lg_toptips').show();
                        // $('.lg_toptips span').html(data.message);
                        // setTimeout(function() {$('.lg_toptips').hide();}, 2000);
                        // location.href = '/';
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
                }
            });
        }
    }
</script>
@endsection