@extends('admin.layout')
@section('content')

<div class="wraper container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <sapn class="panel-title">商品列表</span>
                    <span class="panel-title" style="margin-left:35px;">
                        <a href="{{ url('/goods') }}" class="btn btn-info">
                            <strong>全部商品</strong>
                        </a>
                        <a href="#" class="btn btn-success">
                            <strong>热销</strong>
                        </a>
                        <a href="{{ url('/goods/status') }}" class="btn btn-purple">
                            <strong>新上架</strong>
                        </a>
                        <a href="{{ url('/goods/new') }}" class="btn btn-pink">
                            <strong>新品</strong>
                        </a>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="datatable_length"><label>显示 <select name="datatable_length" aria-controls="datatable" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> 条数</label></div></div><div class="col-sm-6"><div id="datatable_filter" class="dataTables_filter"><label>Search: <input type="search" class="form-control input-sm" placeholder="" aria-controls="datatable"></label></div></div></div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped" id="datatable-editable">
                                        @foreach($goods as $key)
                                        <thead id="th{{ $key->guid }}">
                                            <tr align="center">
                                                <th class="col-md-1 col-sm-1 col-xs-1">ID：</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">名称：{{ $key->name }}</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">分类：{{ $key->class_name }}</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">库存：{{ $key->stock }}</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">价格：{{ $key->price }}</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">销量：{{ $key->sales }}</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">上下架：<a href="javascript:;" id='{{ $key->guid }}' onclick='goods_update("{{ $key->guid }}","{{ $key->status }}","status")'>{!! $key->status == 0 ? "<sapn style='color:red;'>上架</sapn>" : '下架' !!}</a></th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">新品：<a href="javascript:;" id='{{ $key->guid }}' onclick='goods_update("{{ $key->guid }}","{{ $key->new }}","new")'>{!! $key->new == 0 ? '<i class="ion-checkmark"></i>' : '<i class="ion-close"></i>' !!}</a></th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody id="td{{ $key->guid }}">
                                            <tr class="gradeX">
                                                <td align="center">
                                                    @if($key->pic != null)
                                                    <img src="{{ $key->pic }}" alt="" style="width:90px; height:90px;">
                                                    @else
                                                    <img src="{{ asset('/admin/images/icon-add.png') }}" alt="" style="width:90px; height:90px;">
                                                    @endif
                                                </td>
                                                <td colspan="2">
                                                <strong>商品简介：</strong><br>{{ $key->subtitle }} 
                                                </td>
                                                <td colspan="5">
                                                <strong>商品详情：</strong><br>{{ strip_tags($key->describe) }}
                                                </td>
                                                <td colspan="2">
                                                    <a href="{{ url('/goods') }}/{{ $key->guid }}{{ '/edit' }}" class="btn btn-success"><strong>编 辑</strong></a><br><br>
                                                    <a class="btn btn-warning" onclick='goods_del("td{{ $key->guid }}", "th{{ $key->guid }}", "{{ $key->name }}")'><strong>删 除</strong></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="row"><div class="col-sm-6"><div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-6"><div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate"><ul class="pagination"><li class="paginate_button previous disabled" aria-controls="datatable" tabindex="0" id="datatable_previous"><a href="#">Previous</a></li><li class="paginate_button active" aria-controls="datatable" tabindex="0"><a href="#">1</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">2</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">3</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">4</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">5</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">6</a></li><li class="paginate_button next" aria-controls="datatable" tabindex="0" id="datatable_next"><a href="#">Next</a></li></ul></div></div></div></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Row -->
</div>
@endsection

@section('my-js')
<script type="text/javascript">
    function goods_del(td, th, name) {
        layer.confirm('确认删除【' + name +'】吗？',function(index){
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                type: 'DELETE', // 提交方式 get/post
                url: '/goods/' + td, // 需要提交的 url
                dataType: 'json',
                data: {
                  id: td,
                  _token: "{{csrf_token()}}"
                },
                success: function(data) {
                    if(data.status == 0) {
                        layer.msg(data.message, {icon:1, time:2000});
                        //给div添加文字
                        $('#'+td).remove();
                        $('#'+th).remove();
                        // 刷新当前页
                        // location.reload();
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
                // beforeSend: function(xhr){
                //     // 加载等待
                //     layer.load(0, {shade: false});
                // }
            });
        });
        
        // $('#'+id).empty();
        // console.log($('#'+id));
    }

    function goods_update(id, status, param) {
        if(param === 'status') {
            if(status == 0) {
                var str = '下架';
            } else {
                var str = '上架';
            }
        } else if(param === 'new') {
            if(status == 0) {
                var str = '下新品';
            } else {
                var str = '上新品';
            }
        }
        
        var html = document.getElementById(id);

        layer.confirm('确认要【' + str +'】吗？',function(index){
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                type: 'PUT', // 提交方式 get/post
                url: '/goods/' + id, // 需要提交的 url
                dataType: 'json',
                data: {
                  id: id,
                  status: status,
                  param: param,
                  _token: "{{csrf_token()}}"
                },
                success: function(data) {
                    if(data.status == 0) {
                        //给div添加文字
                        // html.innerHTML = str;

                        location.replace(location.href);
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
        });
    }
</script>
@endsection