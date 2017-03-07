@extends('admin.layout')
@section('css')
<!-- DataTables -->
        <link href="{{ asset('admin/css/jquery.datatables.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/css/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/css/fixedheader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/css/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/css/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('admin/css/jquery.datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="wraper container-fluid">
    <div class="page-title"> 
        <h3 class="title">Datatable</h3> 
    </div>

	<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Default Example</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="datatable_length"><label>Show <select name="datatable_length" aria-controls="datatable" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="datatable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="datatable"></label></div></div></div><div class="row"><div class="col-sm-12">
                            <table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
	                        <thead>
	                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 106px;">Name</th><th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 180px;">Position</th><th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 75px;">Office</th><th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 28px;">Age</th><th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 68px;">Start date</th><th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 56px;">Salary</th></tr>
                            </thead>

                            <tbody>                                 
                                <tr role="row" class="odd">
                                    <td class="sorting_1">Airi Satou</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>33</td>
                                    <td>2008/11/28</td>
                                    <td>$162,700</td>
                                </tr>
                                <tr role="row" class="even">
                                    <td class="sorting_1">Angelica Ramos</td>
                                    <td>Chief Executive Officer (CEO)</td>
                                    <td>London</td>
                                    <td>47</td>
                                    <td>2009/10/09</td>
                                    <td>$1,200,000</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-sm-6">
                    		<div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                    	</div>
                    	<div class="col-sm-6">
                    		<div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                    			<ul class="pagination">
                    				<li class="paginate_button previous disabled" aria-controls="datatable" tabindex="0" id="datatable_previous"><a href="#">Previous</a></li><li class="paginate_button active" aria-controls="datatable" tabindex="0"><a href="#">1</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">2</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">3</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">4</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">5</a></li><li class="paginate_button " aria-controls="datatable" tabindex="0"><a href="#">6</a></li><li class="paginate_button next" aria-controls="datatable" tabindex="0" id="datatable_next"><a href="#">Next</a></li>
                    			</ul>
	                    	</div>
	                    </div>
	                </div>
	            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection