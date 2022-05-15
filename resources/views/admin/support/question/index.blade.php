@extends('admin.layouts.layout')
@section('title') {{__('_frequently_asked_questions')}} @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('_frequently_asked_questions')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_frequently_asked_questions')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="action-datatable text-right">
                        @can('support.create')
                            @include('admin.render.add_new', ['route' => route('admin.supports.questions.create'), 'modal' => true])
                        @endcan
                    </div>
                    <div id="custom-toolbar">
                        <form method="get" class="form-inline filter-form">
                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" data-allow-clear="true" data-placeholder="{{__('_display')}}"  name="public">
                                    <option value="">{{__('_display')}}</option>
                                    @foreach(\App\Enums\ActiveDisable::getInstances() as $public)
                                        <option value="{{$public->value}}"> {{$public->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" data-allow-clear="true" data-placeholder="{{__('_highlights')}}" name="status">
                                    <option value="">{{__('_highlights')}}</option>
                                    @foreach(\App\Enums\ActiveDisable::getInstances() as $public)
                                        <option value="{{$public->value}}"> {{$public->description}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" data-allow-clear="true" data-placeholder="{{__('_author')}}" name="author">
                                    <option value="">{{__('_author')}}</option>
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
                               data-url="{{ route('admin.supports.data',['type' => \App\Enums\SupportType::question]) }}"
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
                                <th data-field="id" data-width="100" data-sortable="true">ID</th>
                                <th data-formatter="sortFormatter" data-width="100">{{__('_sort')}}</th>
                                <th data-field="name" data-formatter="titleFormatter">
                                    {{__('_question')}}
                                </th>

                                <th data-field="admin.name">
                                    {{__('_author')}}
                                </th>
                                <th data-field="created_at" data-sortable="true" data-visible="true">
                                    {{__('_created_at')}}
                                </th>

                                <th data-formatter="statusFormatter" data-width="150">
                                    {{__('_status')}}
                                </th>

                                <th data-formatter="actionFormatter" data-width="200" data-switchable="false" data-force-hide="true">
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
    <input type="hidden" class="type" value="{{\App\Enums\SupportType::support}}">
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

            let html = '';
            let public = null;
            let status = null;

            if(row.public == 1){
                public = "checked";
            }

            if(row.status == 1){
                status = "checked";
            }

            @can('contact.edit')
                html += '<div class="checkbox" >';
            html += '<input id="checkbox_public_'+row.id+'" '+public+' type="checkbox" name="public">';
            html += '<label for="checkbox_public_'+row.id+'" class="data_public" data-id="'+row.id+'">{{__('_display')}}</label>';
            html += '</div>';

            html += '<div class="checkbox" >';
            html += '<input id="checkbox_status_'+row.id+'" '+status+' type="checkbox" name="status">';
            html += '<label for="checkbox_status_'+row.id+'" class="mb-0 data_status" data-id="'+row.id+'">{{__('_highlights')}}</label>';
            html += '</div>';

            @endcan

                @cannot('contact.edit')

                html += '<div class="checkbox">';
            html += '<input '+public+' type="checkbox" name="public">';
            html += '<label>{{__('_display')}}</label>';
            html += '</div>';

            html += '<div class="checkbox">';
            html += '<input '+status+' type="checkbox" name="status">';
            html += '<label class="mb-0">{{__('_highlights')}}</label>';
            html += '</div>';

            @endcan

                return html;
        }

        function titleFormatter(value, row){
            if(!value)
                return ;
            return '<a href="#" target="_blank" class="font-weight-bold">'+ value +'</a>';
        }

        function actionFormatter(value, row){
            let html = '';
            @can('support.edit')
                html += '<a href="'+ '{{ route('admin.supports.questions.edit', ':id') }}'.replace(':id',row.id) +'" title="@lang('_edit')" class="btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a> ';
            @endcan

                @can('support.destroy')
                html+='<a href="'+ '{{ route('admin.supports.destroy', ':id') }}'.replace(':id',row.id) +'"  title="@lang('_delete')" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('_delete_record')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a>';
            @endcan
                return html;
        }

    </script>

@stop

