@extends('admin.layouts.layout')
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

                    <div class="action-datatable">
                        <a href="{{route('admin.languages.import.translate', ['to' => $language->value])}}" class="btn btn-primary waves-effect width-md waves-light mb-2 ajax-modal">
                            <span class="icon-button"><i class="fe-download"></i></span> Import Language</a>


                        <a href="{{route('admin.languages.create')}}" class="btn btn-primary waves-effect width-md float-right waves-light mb-2 ajax-modal">
                            <span class="icon-button"><i class="fe-plus"></i></span> {!! __('lang.create') !!} {{\Illuminate\Support\Str::lower(__('lang.language'))}}</a>
                    </div>
                    <div id="custom-toolbar">

                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-pagination="true"
                               data-search="true"
                               data-search-on-enter-key="false"
                               data-show-search-button="false"
                               data-sort-name="created_at"
                               data-sort-order="desc"
                               data-filename="translates"
                               data-cookie="true"
                               data-cookie-id-table="translates"
                        >
                            <thead>
                            <tr>
                                <th>
                                   Key
                                </th>

                                <th>
                                    Value
                                </th>

                                <th data-width="200" data-switchable="false" data-force-hide="true">
                                    {!! __('lang.action') !!}
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jsons as $key => $json)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$json}}</td>
                                    <td>
                                        <a href="{{route('admin.languages.edit.translate', ['key' => $key, 'value' => $json,'lang' => $language->value])}}" title="Edit" class="btn btn-primary waves-effect waves-light tooltip-hover ajax-modal"><i class="fe-edit-2"></i></a>
                                        <a href="{{route('admin.languages.delete.translate',['key' => $key, 'lang' => $language->value])}}" class="ajax-link btn btn-warning waves-effect waves-light tooltip-hover" title="Delete" data-confirm="{{__('lang.confirm_destroy')}}" data-refresh="true"><i class="fe-x"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@stop
