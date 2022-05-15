@extends('admin.layouts.layout')
@section('title') {{__('_discount')}} @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('_discount')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_discount')}}</h4>
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
                        @include('admin.render.add_new', ['route' => route('admin.discounts.create')])
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
                            <th data-field="id" data-sortable="true" data-switchable="false">@lang('_id')</th>
                            <th data-field="name">
                                {{__('_discount')}}
                            </th>
                            <th data-field="code">
                                {{__('_code')}}
                            </th>
                            <th data-field="value" data-formatter="valueFormatter">
                                {{__('_value_down')}}
                            </th>
                            <th data-field="start_at" data-formatter="shortDateTimeFormatter">
                                {{__('_start')}}
                            </th>
                            <th data-field="end_at" data-formatter="shortDateTimeFormatter">
                                {{__('_end')}}
                            </th>
                            <th data-field="invoices_count" data-formatter="usedFormatter">
                                {{__('_used')}}
                            </th>
                            <th data-field="discount" data-formatter="numberFormatter">
                                {{__('_money_down')}}
                            </th>

                            <th data-field="status" data-formatter="statusFormatter" data-visible="true">
                                {{__('_status')}}
                            </th>
                            <th data-formatter="actionFormatter" data-force-hide="true">
                                {{__('_action')}}
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
        	html+='<a href="'+ '{{ route('admin.discounts.history', ':id') }}'.replace(':id',row.id) +'" class="ajax-modal btn btn-info waves-effect waves-light" title="{{__('lang.view_history')}}"><i class="fe-file-text"></i></a> ';
            @can('discount.destroy')
        	html+='<a href="'+ '{{ route('admin.discounts.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('_delete_record')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a>';
            @endcan
            html+='</div>';
        	return html;
        }

        $(function() {


        });
	</script>
@endsection
