@extends('admin.layouts.layout')
@section('title') {!! __('_language') !!} @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{!! __('_dashboard') !!}</a></li>
                            <li class="breadcrumb-item active">{!! __('_language') !!}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{!! __('_language') !!}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="action-datatable text-right">
                        <a href="{{route('admin.languages.create')}}" class="btn btn-primary waves-effect width-md waves-light mb-2 ajax-modal">
                            <span class="icon-button"><i class="fe-plus"></i></span> {!! __('_add_new') !!}</a>
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
                               data-filename="languages"
                               data-cookie="true"
                               data-cookie-id-table="languages"
                        >
                            <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name">
                                    {!! __('_language') !!}
                                </th>

                                <th data-field="value" >
                                    {!! __('_value') !!}
                                </th>
                                <th data-field="status" data-formatter="statusFormatter"  data-width="200" data-sortable="true" data-visible="true">
                                    {!! __('_status') !!}
                                </th>
                                <th data-formatter="actionFormatter" data-width="300" data-switchable="false" data-force-hide="true">
                                    {!! __('_action') !!}
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
                return '<strong class="text-info"><span class="icon-button"><i class="pe-7s-star"></i></span> {{__('_default')}}</strong>';
            }
            return "";
        }

        function actionFormatter(value, row){

            let html = '<a href="'+ '{{ route('admin.languages.translate', ':lang') }}'.replace(':lang',row.value) +'" title="@lang('_translate')" class="btn btn-info waves-effect waves-light tooltip-hover"><i class="fa fa-language"></i></a> ';

            html += '<a href="'+ '{{ route('admin.languages.edit', ':id') }}'.replace(':id',row.id) +'" title="@lang('_edit')" class="btn btn-primary waves-effect waves-light tooltip-hover ajax-modal"><i class="fe-edit-2"></i></a> ';

            if(row.status != 1) {
                html+='<a href="'+ '{{ route('admin.languages.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light tooltip-hover" title="@lang('_delete')" data-confirm="{{__('_delete_record')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
                html+='<a href="'+ '{{ route('admin.languages.change', ':value') }}'.replace(':value',row.value) +'" class="ajax-link btn btn-primary waves-effect waves-light" title="@lang('_active')" id="tooltip-hover"  data-confirm="{{__('_confirm_change_language')}}" data-refresh="true" data-method="GET"><i class="fe-settings"></i></a> ';
            }

            return html;
        }

    </script>

@stop
