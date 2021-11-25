@extends('admin.layouts.layout')
@section('title') {{__('lang.role')}} @stop
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('lang.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('lang.role')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('lang.role')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    @can('role.create')
                    <div class="action-datatable text-right">
                        <a href="{{route('admin.roles.create')}}" class="btn btn-primary waves-effect width-md waves-light mb-2 ajax-modal">
                            <span class="icon-button"><i class="fe-plus"></i></span> {{__('lang.create')}} {{\Illuminate\Support\Str::lower(__('lang.role'))}}</a>
                    </div>
                    @endcan
                    <div id="custom-toolbar">

                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.roles.data')}}"
                               data-side-pagination="server"
                               data-pagination="true"
                               data-search="true"
                               data-search-on-enter-key="false"
                               data-show-search-button="false"
                               data-sort-name="created_at"
                               data-sort-order="desc"
                               data-filename="roles"
                               data-cookie="true"
                               data-tree-show-field="title"
                               data-cookie-id-table="roles"
                        >
                            <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name">
                                    {{__('lang.roll')}}
                                </th>

                                <th data-field="permission" data-width="1100" data-formatter="permissionFormatter">
                                    {{__('lang.permission')}}
                                </th>

                                <th data-formatter="actionFormatter" data-switchable="false" data-force-hide="true">
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
        function permissionFormatter(value) {

            if (!value)
                return '';

            return value.map(function (val){
                return '<span class="badge badge-primary">'+ val + '</span>';
            }).join(' ');

        }

        function actionFormatter(value, row){
            let html = '';
            @can('role.edit')
            html += '<a href="'+ '{{ route('admin.roles.edit', ':id') }}'.replace(':id',row.id) +'" class="btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a> ';
            @endcan
            @can('role.destroy')
            html+='<a href="'+ '{{ route('admin.roles.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('lang.confirm.destroy')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
            @endcan
            return html;
        }

    </script>
@stop
