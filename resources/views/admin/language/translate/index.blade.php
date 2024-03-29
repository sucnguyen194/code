@extends('admin.layouts.layout')
@section('title') @lang('_translate') #{{$language->value}} @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">@lang('_dashboard')</a></li>
                            <li class="breadcrumb-item active">@lang('_translate')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('_translate') #{{$language->value}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">

                    <div class="action-datatable text-right">
                        <a href="{{route('admin.languages.import.translate', ['to' => $language->value])}}" class="btn btn-primary waves-effect width-md waves-light float-left mb-2 ajax-modal">
                            <span class="icon-button"><i class="fe-download"></i></span> @lang('_import_language')</a>


                        @include('admin.render.add_new', ['route' => route('admin.languages.create.translate', $language->value), 'modal' => true])
                    </div>
                    <div id="custom-toolbar">

                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.languages.translate.data', $language->value)}}"
                               data-side-pagination="server"
                               data-pagination="true"
                               data-search="true"
                               data-search-on-enter-key="false"
                               data-show-search-button="false"
                               data-sort-name="key"
                               data-filename="translates"
                               data-cookie="true"
                               data-cookie-id-table="translates"
                        >
                            <thead>
                            <tr>
                                <th data-field="key" data-formatter="keyFormatter">
                                   @lang('_key')
                                </th>

                                <th data-field="value">
                                    @lang('_value')
                                </th>

                                <th data-formatter="actionFormatter" data-width="200" data-switchable="false" data-force-hide="true">
                                    @lang('_action')
                                </th>

                            </tr>
                            </thead>
{{--                            <tbody>--}}
{{--                            @foreach($jsons as $key => $json)--}}
{{--                                <tr>--}}
{{--                                    <td class="font-weight-bold text-primary">{{$key}}</td>--}}
{{--                                    <td>{{$json}}</td>--}}
{{--                                    <td>--}}
{{--                                        <a href="{{route('admin.languages.edit.translate', ['key' => $key, 'value' => $json,'lang' => $language->value])}}" title="@lang('_edit')" class="btn btn-primary waves-effect waves-light tooltip-hover ajax-modal"><i class="fe-edit-2"></i></a>--}}
{{--                                        <a href="{{route('admin.languages.delete.translate',['key' => $key, 'lang' => $language->value])}}" class="ajax-link btn btn-warning waves-effect waves-light tooltip-hover" title="@lang('_delete_record')" data-confirm="{{__('_delete_record')}}" data-refresh="true"><i class="fe-x"></i></a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
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
        function keyFormatter(value) {
            return '<strong class="text-primary">' + value + '</strong>';
        }

        function actionFormatter(value, row){

            const _value = row.value.replaceAll(' ', '_|_');

            let html = '<a href="'+ '{{ route('admin.languages.edit.translate', [':lang',':key',':value']) }}'.replace(':key','key='+row.key).replace(':value','value='+_value).replace(':lang','lang='+row.lang) +'" title="{{__('_edit')}}" class="btn btn-primary waves-effect waves-light tooltip-hover ajax-modal"><i class="fe-edit-2"></i></a> ';

            html+='<a href="'+ '{{ route('admin.languages.delete.translate', [':lang',':key']) }}'.replace(':key','key='+row.key).replace(':lang','lang='+row.lang) +'" class="ajax-link btn btn-warning waves-effect waves-light tooltip-hover" title="Delete" data-confirm="{{__('_delete_record')}}" data-refresh="true"><i class="fe-x"></i></a> ';
            return html;
        }

    </script>

@stop
