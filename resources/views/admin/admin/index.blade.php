@extends('admin.layouts.layout')
@section('title') {{__('lang.account')}} @stop
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('lang.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('lang.account')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('lang.account')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    @can('admin.create')
                    <div class="action-datatable text-right">
                        <a href="{{route('admin.admins.create')}}" class="btn btn-primary waves-effect width-md waves-light mb-2 ajax-modal">
                            <span class="icon-button"><i class="fe-plus"></i></span> {{__('lang.create')}} {{\Illuminate\Support\Str::lower(__('lang.account'))}}</a>
                    </div>
                    @endif
                    <div id="custom-toolbar">

                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.admins.data')}}"
                               data-side-pagination="server"
                               data-pagination="true"
                               data-search="true"
                               data-search-on-enter-key="false"
                               data-show-search-button="false"
                               data-sort-name="created_at"
                               data-sort-order="desc"
                               data-filename="posts"
                               data-cookie="true"
                               data-cookie-id-table="posts"
                        >
                            <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name">
                                    {{__('lang.name')}}
                                </th>

                                <th data-field="email">
                                    Email
                                </th>
                                <th data-field="roles" data-formatter="roleFormatter">
                                    {{__('lang.role')}}
                                </th>
                                <th data-field="created_at" data-sortable="true" data-visible="true">
                                    {{__('lang.created_at')}}
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
        function roleFormatter(value) {

            if (!value)
                return '';

            return value.map(function (val){
                return '<span class="badge badge-primary">'+ val + '</span>';
            }).join(' ');

        }

        function actionFormatter(value, row){
            let html = '';
            @can('admin.edit')
            html += '<a href="'+ '{{ route('admin.admins.edit', ':id') }}'.replace(':id',row.id) +'" class="btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a> ';
            @endcan
            @can('admin.destroy')
            html+='<a href="'+ '{{ route('admin.admins.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('lang.confirm_destroy')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
            @endcan
            return html;
        }

    </script>
@stop
