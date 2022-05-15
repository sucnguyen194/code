@extends('admin.layouts.layout')
@section('title') {{__('_messenger')}} @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('_messenger')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_messenger')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">

                    <div id="custom-toolbar">
                        <form method="get" class="form-inline filter-form">

                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" name="status" data-allow-clear="true" data-placeholder="{{__('_status')}}">
                                    <option value="">{{__('_status')}}</option>
                                    <option value="1">{{__('lang.unview')}}</option>
                                    <option value="2"> {{__('lang.viewed')}}</option>
                                </select>
                            </div>

                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" name="user" data-allow-clear="true" data-placeholder="{{__('lang.checker')}}" name="author">
                                    <option value="">{{__('lang.checker')}}</option>
                                    @foreach($admins as $item)
                                        <option value="{{$item->id}}">{{$item->name ?? $item->email}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </form>
                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.contacts.data') }}"
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
                                <th data-field="note">
                                    {{__('lang.message')}}
                                </th>

                                <th data-field="created_at" data-sortable="true" data-visible="true">
                                    {{__('_created_at')}}
                                </th>
                                <th data-field="updated_at" data-sortable="true" data-visible="true">
                                    {{__('lang.checked_at')}}
                                </th>

                                <th data-field="status" data-formatter="statusFormatter">
                                    {{__('_status')}}
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $("select").on('change', function(){
                $table.bootstrapTable('refresh');
            })
        });

        function sortFormatter(value, row) {
            return '<input style="width: 80px" type="number" min="0" class="form-control" name="sort" data-id="'+row.id+'" value="'+row.sort+'">';
        }

        function statusFormatter(value, row) {
            if(value == 1)
                return '<a class="font-weight-bold text-primary">{{__('lang.unview')}}</a>';

            return  '<a class="font-weight-bold text-danger">{{__('lang.viewed')}}</a>';
        }

        function titleFormatter(value, row){
            return '<a href="'+ '{{ route('slug', ':id') }}'.replace(':id',row.alias) +'" target="_blank">'+ value +'</a>';
        }

        function actionFormatter(value, row){
            let html = '';
            @can('contact.edit')
            html = '<a href="'+ '{{ route('admin.contacts.show', ':id') }}'.replace(':id',row.id) +'" class="btn btn-primary waves-effect waves-light"><i class="pe-7s-look"></i></a> ';
            @endcan
            @can('contact.destroy')
            html+='<a href="'+ '{{ route('admin.contacts.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('_delete_record')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
            @endcan
            return html;
        }

    </script>

@stop
