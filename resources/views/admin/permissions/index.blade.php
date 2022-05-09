@extends('admin.layouts.layout')
@section('title') {{__('lang.permission')}} @stop
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('lang.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('lang.permission')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('lang.permission')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    @can('permission.create')
                    <div class="action-datatable text-right">
                        <a href="{{route('admin.permissions.create')}}" class="btn btn-primary waves-effect width-md waves-light mb-2 ajax-modal">
                            <span class="icon-button"><i class="fe-plus"></i></span> {{__('lang.create')}} {{\Illuminate\Support\Str::lower(__('lang.permission'))}}</a>
                    </div>
                    @endcan
                    <div id="custom-toolbar">

                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.permissions.data')}}"
                               data-show-refresh="false"
                               data-show-columns="false"
                               data-show-export="false"
                               data-side-pagination="server"
                               data-pagination="false"
                               data-search="false"
                               data-search-on-enter-key="false"
                               data-show-search-button="false"
                               data-filename="permissions"
                               data-cookie="true"
                               data-cookie-id-table="permissions"
                               data-tree-show-field="title"
                               data-parent-id-field="parent_id"
                                 >
                            <thead>
                            <tr>

                                <th data-field="title">
                                    {{__('lang.name')}}
                                </th>

{{--                                <th data-field="name" >--}}
{{--                                    {{__('lang.value')}}--}}
{{--                                </th>--}}

                                <th data-formatter="actionFormatter" data-width="200"  data-switchable="false" data-force-hide="true">
                                    {{__('lang.action')}}
                                </th>

                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('post-body.bs.table', function() {
            var columns = $table.bootstrapTable('getOptions').columns;

            if (columns && columns[0][1].visible) {

                $table.treegrid({
                    treeColumn: 0,
                    onChange: function() {
                        $table.bootstrapTable('resetView')
                    }
                })
            }
        });

        function actionFormatter(value, row){
            let html = '';
            @can('permission.edit')
            html = '<a href="'+ '{{ route('admin.permissions.edit', ':id') }}'.replace(':id',row.id) +'" class="btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a> ';
            @endcan

            @can('permission.destroy')
            html+='<a href="'+ '{{ route('admin.permissions.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('lang.confirm_destroy')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
            @endcan
            return html;
        }

    </script>
@stop
