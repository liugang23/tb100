@extends('admin.layout')
@section('content')
<div class="wraper container-fluid">
    <div class="panel">            
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="m-b-10">
                        <a href="{{ url('/category/pater=0&path=0,') }}" class="btn btn-pink waves-effect waves-light"><strong>添加一级分类 </strong> <i class="fa fa-plus"></i></a>
                        <a href="{{ url('/category') }}" class="btn btn-success"><strong>查看全部分类</strong></a>
                        <a class="btn btn-info" onclick='class_query("level,1")'><strong>查看一级分类</strong></a>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="datatable_length"><label>显示 <select name="datatable_length" aria-controls="datatable" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> 条数</label></div></div><div class="col-sm-6"><div id="datatable_filter" class="dataTables_filter"><label>Search: <input type="search" class="form-control input-sm" placeholder="" aria-controls="datatable"></label></div></div></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-striped" id="datatable-editable">
                                <thead>
                                    <tr align="center">
                                        <th class="col-md-1 col-sm-1 col-xs-1" align="center">ID</th>
                                        <th class="col-md-2 col-sm-2 col-xs-2">分类名称</th>
                                        <th class="col-md-1 col-sm-1 col-xs-1">分类级别</th>
                                        <th class="col-md-1 col-sm-1 col-xs-1">父类ID</th>
                                        <th class="col-md-2 col-sm-2 col-xs-2">path</th>
                                        <th class="col-md-1 col-sm-1 col-xs-1">状态</th>
                                        <th class="col-md-1 col-sm-1 col-xs-1">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(!$class)
                                    <tr><td align="center" colspan="7">暂 无 分 类</td></tr>
                                @elseif(count($class) > 1)
                                @foreach($class as $key)
                                    <tr class="gradeX"  align="center">
                                        <td>{{ $key->id }}</td>
                                        <td>{{ $key->class_name }}</td>
                                        <td>{{ $key->level }}</td>
                                        <td>{{ $key->pater }}</td>
                                        <td>{{ $key->path }}</td>
                                        <td><a href="javascript:;" onclick='class_update("{{ $key->id }}","{{ $key->status }}")'>{!! $key->status == 0 ? "<sapn style='color:red;'>显示</sapn>" : '不显示' !!}</a>
                                            <form action="{{asset('/category')}}{{ '/'. $key->id }}{{ '&'.$key->status }}" method="post" name="Category" >
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                <input type="hidden" name="id" value=""><input type="hidden" name="status" value="">
                                                <input type="hidden" name="_method" value="put" />
                                            </form>
                                        </td>
                                        <td class="actions">
                                            <a title="查看子类" href="#" class="zmdi zmdi-zoom-in" onclick='class_query("pater,{{ $key->id }}")'></a>
                                            <a title="添加子类" href="javascript:;" class="on-default edit-row" onclick="class_add('pater={{ $key->id }}&path={{ $key->path }}')"><i class="fa fa-pencil"></i></a>
                                            <a title="删除子类" href="#" class="on-default remove-row" onclick="class_del()"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @elseif($class)
                                {{-- dd($class) --}}
                                    <tr class="gradeX"  align="center">
                                        <td>{{ $class->id }}</td>
                                        <td>{{ $class->class_name }}</td>
                                        <td>{{ $class->level }}</td>
                                        <td>{{ $class->pater }}</td>
                                        <td>{{ $class->path }}</td>
                                        <td><a href="javascript:;" onclick='class_update("{{ $class->id }}","{{ $class->status }}")'>{!! $class->status == 0 ? "<sapn style='color:red;'>显示</sapn>" : '不显示' !!}</a>
                                            <form action="{{asset('/category')}}{{ '/'. $class->id }}" method="post" name="Category" >
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                <input type="hidden" name="id" value=""><input type="hidden" name="status" value="">
                                                {{ method_field('PUT') }}
                                            </form>
                                        </td>
                                        <td class="actions">
                                            <a title="查看子类" href="#" class="zmdi zmdi-zoom-in" onclick='class_query(pater, "{{ $class->id }}")'></a>
                                            <a title="添加子类" href="javascript:;" class="on-default edit-row" onclick="class_add('pater={{ $class->id }}&path={{ $class->path }}')"><i class="fa fa-pencil"></i></a>
                                            <a title="删除分类" href="#" class="on-default remove-row" onclick="class_del()"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row"><div class="col-sm-6"><div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-6"><div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate"><ul class="pagination"><li class="paginate_button previous disabled" aria-controls="datatable" tabindex="0" id="datatable_previous"><a href="#">上一页</a></li><li class="paginate_button active" aria-controls="datatable" tabindex="0"><a href="#">1</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">2</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">3</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">4</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">5</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">6</a></li><li class="paginate_button next" aria-controls="datatable" tabindex="0" id="datatable_next"><a href="#">下一页</a></li></ul></div></div></div></div>
                </div>
            </div>
        </div>
    </div> <!-- end Panel -->
</div>

@endsection

@section('my-js')
<script type="text/javascript">
    function class_query(param) {
        console.log(param);
        location.href = '{{ url('/category/query') }}'+'/'+param;

        // $.ajax({
        //     type: 'get',
        //     dataType: 'json',
        //     url: '{{ url('/category/query') }}'+'/'+id,
        //     data: {
        //         key: param,
        //         id: id,
        //         _token: "{{csrf_token()}}"
        //     },
        //     success: function(data){
        //         if(data == null) {
        //             layer.msg('服务端错误', {icon:2, time:2000});
        //             return;
        //             }
        //         if(data.status != 0) {
        //             layer.msg(data.message, {icon:2, time:2000});
        //             return;
        //         }

        //         layer.msg(data.message, {icon:1, time:2000});
        //         parent.location.reload();
        //     },
        //     error: function(xhr, status, error) {
        //         console.log(xhr);
        //         console.log(status);
        //         console.log(error);
        //         layer.msg('ajax error', {icon:2, time:2000});
        //     },
        // });
    }

    function class_add(id) {
        location.href = '{{ asset('/category/') }}'+'/'+id;
    }

    function class_del() {
        console.log(456);
    }

    function class_update(id, status) {
        if(confirm("确定改变显示状态？")) {
            // $('input[name="id"]').val(id);
            $('input[name="id"]').attr('value',id);
            $('input[name="status"]').attr('value',status);
            $('form[name="Category"]').submit();
        }
    }
</script>
@endsection