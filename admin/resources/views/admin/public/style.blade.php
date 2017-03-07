<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="shortcut icon" href="img/favicon_1.ico">

        <title>团呗--管理平台</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ url('admin/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('admin/css/bootstrap-reset.css') }}" rel="stylesheet">

        <!--Animation css-->
        <link href="{{ url('admin/css/animate.css') }}" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="{{ url('admin/css/font-awesome.css') }}" rel="stylesheet" />
        <link href="{{ url('admin/css/ionicons.min.css') }}" rel="stylesheet" />
        <link href="{{ url('admin/css/material-design-iconic-font.min.css') }}" rel="stylesheet" />

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{ url('admin/css/morris.css') }}">

        <!-- sweet alerts -->
        <link href="{{ url('admin/css/sweet-alert.min.css') }}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ url('admin/css/style.css') }}" rel="stylesheet">
        <link href="{{ url('admin/css/helper.css') }}" rel="stylesheet">
        
        <!-- 自定义样式 -->
        <link href="{{ url('admin/lib/my/my_css.css') }}" rel="stylesheet">
        <!-- DataTables -->
        <!-- <link href="{{ URL::asset('admin/css/jquery.datatables.min.css') }}" rel="stylesheet" type="text/css" /> -->

        <!-- @yield('css') -->
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