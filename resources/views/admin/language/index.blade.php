@extends('admin.layouts.layout')
@section('title') {!! __('lang.language') !!} @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{!! __('lang.language') !!}</a></li>
                            <li class="breadcrumb-item active">{!! __('lang.language') !!}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{!! __('lang.language') !!}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="action-datatable text-right">
                        <a href="{{route('admin.languages.create')}}" class="btn btn-primary waves-effect width-md waves-light mb-2 ajax-modal">
                            <span class="icon-button"><i class="fe-plus"></i></span> {!! __('lang.create') !!}</a>
                    </div>
                    <div id="custom-toolbar">

                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.languages.data')}}"
                               data-side-pagination="server"
                               data-pagination="true"
                               data-search="true"
                               data-search-on-enter-key="false"
                               data-show-search-button="false"
                               data-sort-name="created_at"
                               data-sort-order="desc"
                               data-filename="alias"
                               data-cookie="true"
                               data-cookie-id-table="alias"
                        >
                            <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name">
                                    {!! __('lang.language') !!}
                                </th>

                                <th data-field="value" >
                                    {!! __('lang.value') !!}
                                </th>
                                <th data-field="status" data-formatter="statusFormatter"  data-width="200" data-sortable="true" data-visible="true">
                                    {!! __('lang.status') !!}
                                </th>
                                <th data-formatter="actionFormatter" data-width="200" data-switchable="false" data-force-hide="true">
                                    {!! __('lang.action') !!}
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

        function statusFormatter(value){
            if(value == 1){
                return '<strong class="text-info"><span class="icon-button"><i class="pe-7s-star"></i></span> {{__('lang.default')}}</strong>';
            }
            return "";
        }

        function actionFormatter(value, row){
            let html = '<a href="'+ '{{ route('admin.languages.edit', ':id') }}'.replace(':id',row.id) +'" class="btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a> ';
            html+='<a href="'+ '{{ route('admin.languages.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('lang.confirm_destroy')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';

            html+='<a href="'+ '{{ route('admin.languages.change', ':value') }}'.replace(':value',row.value) +'" class="ajax-link btn btn-info waves-effect waves-light" data-confirm="{{__('lang.confirm_change_language')}}" data-refresh="true" data-method="GET"><i class="fa fa-language"></i></a> ';

            return html;
        }

    </script>

@stop
