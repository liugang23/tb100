@extends('admin.layout')
@section('content')

<div class="wraper container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">用户订单</span>
                    <span class="panel-title" style="margin-left:35px;">
                        <a class="btn btn-info" href="javascript:;" onclick="onOrder(1)">
                            <strong>未付款订单</strong>
                        </a>
                        <a class="btn btn-warning" href="javascript:;" onclick="onOrder(2)">
                            <strong>已付款订单</strong>
                        </a>
                        <a class="btn btn-purple" href="javascript:;" onclick="onOrder(3)">
                            <strong>未发货订单</strong>
                        </a>
                        <a class="btn btn-inverse" href="javascript:;" onclick="onOrder(4)">
                            <strong>已发货订单</strong>
                        </a>
                        <a class="btn btn-danger" href="javascript:;" onclick="onOrder(6)">
                            <strong>已撤消订单</strong>
                        </a>
                        <a class="btn btn-success" href="javascript:;" onclick="onOrder(5)">
                            <strong>已完结订单</strong>
                        </a>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="datatable_length"><label>显示 <select name="datatable_length" aria-controls="datatable" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> 条数</label></div></div><div class="col-sm-6"><div id="datatable_filter" class="dataTables_filter"><label>Search: <input type="search" class="form-control input-sm" placeholder="" aria-controls="datatable"></label></div></div></div><div class="row">
                            <!-- <div class="col-sm-12"> -->
                            <div class="panel">
                            
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped" id="datatable-editable">
                                        <thead>
                                            <tr>
                                                <th class="col-md-1 col-sm-1 col-xs-1">ID</th>
                                                <th class="col-md-2 col-sm-2 col-xs-2">订单号</th>
                                                <th class="col-md-2 col-sm-2 col-xs-2">订单名称</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">支付金额</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">支付方式</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">订单状态</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">用户ID</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="gradeX">
                                                <td>Trident</td>
                                                <td>Internet
                                                    Explorer 5.0
                                                </td>
                                                <td>Win 95+</td>
                                                <td>Trident</td>
                                                <td>Trident</td>
                                                <td>
                                                {{-- @if()
                                                    <span class="btn btn-info">未付款</span>
                                                @elseif()
                                                    <span class="btn btn-success">已付款</span>
                                                @elseif()
                                                    <span class="btn btn-warning">未发货</span>
                                                @elseif()
                                                    <span class="btn btn-success">已发货</span>
                                                @elseif()
                                                    <span class="btn btn-danger">未发货</span>
                                                    <span >已撤单</span>
                                                @elseif() --}}
                                                    <span class="lg_tit btn-info">已完结</span>
                                                {{-- @endif --}}
                                                </td>
                                                <td>11</td>
                                                <td class="actions">
                                                    <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- </div> -->
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
    function onOrder(id) {
        console.log(id);
    }
</script>
@endsection