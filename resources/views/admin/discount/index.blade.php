@extends('admin.layouts.layout')
@section('title') Mã giảm giá @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.discounts.index')}}">Mã giảm giá</a></li>
                            <li class="breadcrumb-item active">Thêm mới</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Thêm mới</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <div class="action-datatable text-right">
                    @can('discount.create')
                    <a href="{{route('admin.discounts.create')}}" class="btn btn-primary waves-effect width-md waves-light mb-2">
                        <span class="icon-button"><i class="fe-plus"></i></span> Thêm mới</a>
                    @endcan
                </div>
                <div id="custom-toolbar">

                </div>
                <div class="table-bootstrap">
                    <table class="table table-bordered table-striped table-hover bs-table"
                           data-toolbar="#custom-toolbar"
                           data-url="{{ route('admin.discounts.data') }}"
                           data-side-pagination="server"
                           data-pagination="true"
                           data-search="true"
                           data-search-on-enter-key="true"
                           data-show-search-button="true"
                           data-sort-name="created_at"
                           data-sort-order="desc"
                           data-query-params="thisQueryParams"
                           data-filename="discounts"
                           data-cookie="true"
                           data-cookie-id-table="discounts"
                    >
                        <thead>
                        <tr>
                            <th data-field="id" data-sortable="true" data-switchable="false">ID</th>
                            <th data-field="name">
                                Tên chương trình
                            </th>
                            <th data-field="code">
                                CODE
                            </th>
                            <th data-field="value" data-formatter="valueFormatter">
                                Giá trị giảm
                            </th>
                            <th data-field="start_at" data-formatter="shortDateTimeFormatter">
                                Bắt đầu
                            </th>
                            <th data-field="end_at" data-formatter="shortDateTimeFormatter">
                                Kết thúc
                            </th>
                            <th data-field="invoices_count" data-formatter="usedFormatter">
                                Đã dùng
                            </th>
                            <th data-field="discount" data-formatter="numberFormatter">
                                Tiền giảm
                            </th>

                            <th data-field="status" data-formatter="statusFormatter" data-visible="true">
                                Trạng thái
                            </th>
                            <th data-formatter="actionFormatter" data-force-hide="true">
                                Quản lý
                            </th>

                        </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
	<script type="text/javascript">

        function thisQueryParams(params) {
            params.start = params.offset;
            params.length = params.limit;

            $.each($('.filter-form').serializeArray(), function( index, value ) {
                params[value.name] = value.value;
            });
            return params;
        }

        function limitFormatter(value, row) {
            return value.limit + '/' + value.limit_by;
        }

        function valueFormatter(value, row){
            return  numberFormatter(value) + (row.value_type ? 'đ' : '%' )
        }

        function usedFormatter(value, row){
            return  value + '/' + (row.uses_total || '∞' )
        }

        function statusFormatter(value) {
            if (value == 'True')
                return '<span class="badge badge-success">Active</span>';
            else
                return '<span class="badge badge-danger">Disabled</span>';
        }

        function actionFormatter(value, row){
            let html = '<div class="">';
            @can('discount.edit')
			html += '<a href="'+ '{{ route('admin.discounts.edit', ':id') }}'.replace(':id',row.id) +'" class="btn btn-primary waves-effect waves-light"><i class="fe-edit-2"></i></a> ';
            @endcan
        	html+='<a href="'+ '{{ route('admin.discounts.history', ':id') }}'.replace(':id',row.id) +'" class="ajax-modal btn btn-info waves-effect waves-light" title="Xem lịch sử"><i class="fe-file-text"></i></a> ';
            @can('discount.destroy')
        	html+='<a href="'+ '{{ route('admin.discounts.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a>';
            @endcan
            html+='</div>';
        	return html;
        }

        $(function() {


        });
	</script>
@endsection
