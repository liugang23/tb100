@extends('admin.layout')
@section('content')
<div class="wraper container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <sapn class="panel-title">用户列表</span>
                    <span class="panel-title" style="margin-left:35px;">
                        <a class="btn btn-info" href="javascript:;" onclick="onUsers(1)">
                            <strong>全部用户</strong>
                        </a>
                        <a class="btn btn-success" href="javascript:;" onclick="onUsers(2)">
                            <strong>活跃用户</strong>
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
                                        <thead>
                                            <tr>
                                                <th class="col-md-1 col-sm-1 col-xs-1">ID</th>
                                                <th class="col-md-2 col-sm-2 col-xs-2">用户名</th>
                                                <th class="col-md-2 col-sm-2 col-xs-2">注册时间</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">用户状态</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">累积消费金额</th>
                                                <th class="col-md-1 col-sm-1 col-xs-1">消费积分</th>
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
                                                <td>Win 95+</td>
                                                <td class="actions">
                                                    <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                                    <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                                    <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
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