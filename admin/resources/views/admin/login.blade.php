<!DOCTYPE html>
<html lang="cn">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="img/favicon_1.ico">

        <title>Velonic - Responsive Admin Dashboard Template</title>

        <!-- Bootstrap core CSS -->
        <link href="admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="admin/css/bootstrap-reset.css" rel="stylesheet">

        <!--Animation css-->
        <link href="admin/css/animate.css" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="admin/css/font-awesome.css" rel="stylesheet" />
        <link href="admin/css/ionicons.min.css" rel="stylesheet" />
        <link href="admin/css/material-design-iconic-font.min.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="admin/css/style.css" rel="stylesheet">
        <link href="admin/css/helper.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-62751496-1', 'auto');
          ga('send', 'pageview');

        </script>

    </head>

    <body>
        <div class="wrapper-page">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading"> 
                   <h3 class="text-center m-t-10"> 欢迎登录 <strong>团呗管理后台</strong> </h3>
                </div> 

                <div class="panel-body">
                    <form class="form-horizontal m-t-10 p-20 p-b-0" action="" method="post">               
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <label class="cr-styled">
                                    <input type="checkbox" checked>
                                    <i class="fa"></i> 
                                    记住我
                                </label>
                            </div>
                        </div>
 
                        <div class="form-group text-right">
                            <div class="col-xs-12">
                                <div class="btn btn-success w-md" type="submit" onclick="onLogin();">登录</div>

                            </div>
                        </div>
                        <div class="form-group m-t-30">
                            <div class="col-sm-7">
                                <a href="pages-recoverpw.html"><i class="fa fa-lock m-r-5"></i> 忘记密码?</a>
                            </div>
                            <div class="col-sm-5 text-right">
                                <a href="pages-register.html">创建帐户</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function onLogin() {

                var username = $('input[name=username]').val();
                var password = $('input[name=password]').val();

                $.ajax({
                    type: 'post', // 提交方式 get/post
                    url: '/login', // 需要提交的 url
                    dataType: 'json',
                    data: {
                        username: username,
                        password: password,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(data) {
                        if(data.status == 1) {
                            // $('.lg_toptips').show();
                            // $('.lg_toptips span').html(data.message);
                            // setTimeout(function() {$('.lg_toptips').hide();}, 2000);
                            location.href = '/login';
                        }
                        if(data.status == 0) {
                            // $('.lg_toptips').show();
                            // $('.lg_toptips span').html(data.message);
                            // setTimeout(function() {$('.lg_toptips').hide();}, 2000);
                            location.href = '/';
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
        </script>

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="admin/js/jquery.js"></script>
        <script src="admin/js/bootstrap.min.js"></script>
        <script src="admin/js/pace.min.js"></script>
        <script src="admin/js/wow.min.js"></script>
        <script src="admin/js/jquery.nicescroll.js" type="text/javascript"></script>
            
        <!--common script for all pages-->
        <script src="admin/js/jquery.app.js"></script>
        <!-- 自定义js -->
        <!-- // <script src="admin/lib/my_store.js"></script> -->
        <!-- 引用第三方 js 文件 -->
        <script src="admin/lib/layer/2.1/layer.js"></script>
    </body>
</html>
