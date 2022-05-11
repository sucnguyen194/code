@extends('admin.layouts.layout')
@section('title') {{__('_account')}} @stop
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('_account')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_account')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    @can('admin.create')
                    <div class="action-datatable text-right">
                        @include('admin.render.add_new', ['route' => route('admin.admins.create'), 'modal' => true])

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
                                <th data-field="id" data-sortable="true">{{__('_id')}}</th>
                                <th data-field="name">
                                    {{__('_name')}}
                                </th>

                                <th data-field="email">
                                    {{__('_email')}}
                                </th>
                                <th data-field="roles" data-formatter="roleFormatter">
                                    {{__('_role')}}
                                </th>
                                <th data-field="created_at" data-sortable="true" data-visible="true">
                                    {{__('_created_at')}}
                                </th>

                                <th data-formatter="actionFormatter" data-switchable="false" data-force-hide="true">
                                    {{__('_action')}}
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
            html+='<a href="'+ '{{ route('admin.admins.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('_delete_record')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
            @endcan
            return html;
        }

    </script>
@stop
