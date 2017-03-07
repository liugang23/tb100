<!-- js placed at the end of the document so the pages load faster -->
<script src="{{ asset('admin/js/jquery.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/modernizr.min.js') }}"></script>
<script src="{{ asset('admin/js/pace.min.js') }}"></script>
<script src="{{ asset('admin/js/wow.min.js') }}"></script>
<script src="{{ asset('admin/js/jquery.scrollto.min.js') }}"></script>
<script src="{{ asset('admin/js/jquery.nicescroll.js') }}" type="text/javascript"></script>

<!-- Counter-up -->
<script src="{{ asset('admin/js/waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/jquery.counterup.min.js') }}" type="text/javascript"></script>

<!-- sparkline --> 
<script src="{{ asset('admin/js/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/chart-sparkline.js') }}" type="text/javascript"></script> 

<!-- skycons -->
<script src="{{ asset('admin/js/skycons.min.js') }}" type="text/javascript"></script>
    
<!--Morris Chart-->
<script src="{{ asset('admin/js/morris.min.js') }}"></script>
<script src="{{ asset('admin/js/raphael.min.js') }}"></script>

<script src="{{ asset('admin/js/jquery.app.js') }}"></script>
        
<!-- Dashboard -->
<script src="{{ asset('admin/js/jquery.dashboard.js') }}"></script>

<!-- 引用第三方 js 文件 -->
<script src="{{ asset('admin/lib/layer/2.1/layer.js') }}"></script>
<script src="{{ asset('admin/lib/jquery.form.js') }}"></script>
<script src="{{ asset('admin/lib/Validform/5.3.2/Validform.min.js') }}"></script>

<!-- 引用自定义js文件 -->
<script src="{{ asset('admin/lib/my/my_js.js') }}"></script>
<script src="{{ asset('admin/lib/my/uploadFile.js') }}"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        /* Counter Up */
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });
    });
    /* BEGIN SVG WEATHER ICON */
    if (typeof Skycons !== 'undefined'){
    var icons = new Skycons(
        {"color": "#fff"},
        {"resizeClear": true}
        ),
            list  = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for(i = list.length; i--; )
        icons.set(list[i], list[i]);
        icons.play();
    };
</script>
