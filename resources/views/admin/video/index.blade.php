@extends('admin.layouts.layout')
@section('title') {{__('lang.video')}} @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('lang.video')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('lang.video')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="action-datatable text-right">
                        @can('video.create')
                        <a href="{{route('admin.products.videos.create')}}" class="btn btn-primary waves-effect width-md waves-light mb-2 ajax-modal">
                            <span class="icon-button"><i class="fe-plus"></i></span> {{__('lang.create')}}</a>
                        @endcan
                    </div>
                    <div id="custom-toolbar">
                        <form method="get" class="form-inline filter-form">
                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" name="public" data-allow-clear="true" data-placeholder="{{__('lang.display')}}">
                                    <option value=""></option>
                                    @foreach(\App\Enums\ActiveDisable::getInstances() as $public)
                                        <option value="{{$public->value}}"> {{$public->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" data-allow-clear="true" data-placeholder="{{__('lang.highlights')}}" name="status">
                                    <option value=""></option>
                                    @foreach(\App\Enums\ActiveDisable::getInstances() as $public)
                                        <option value="{{$public->value}}"> {{$public->description}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" data-allow-clear="true" data-placeholder="{{__('lang.author')}}" name="author">
                                    <option value=""></option>
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
                               data-url="{{ route('admin.products.data',['type' => \App\Enums\ProductType::video]) }}"
                               data-side-pagination="server"
                               data-pagination="true"
                               data-search="true"
                               data-search-on-enter-key="false"
                               data-show-search-button="false"
                               data-sort-name="created_at"
                               data-sort-order="desc"
                               data-filename="videos"
                               data-cookie="true"
                               data-cookie-id-table="videos"
                        >
                            <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-formatter="sortFormatter" data-width="150">{{__('lang.sort')}}</th>
                                <th data-field="image" data-formatter="imageFormatter" data-width="100">{{__('lang.image')}}</th>
                                <th data-field="name" data-formatter="titleFormatter">
                                    {{__('lang.title')}}
                                </th>
                                <th data-field="video" data-formatter="videoFormatter">
                                    {{__('lang.video')}}
                                </th>
                                @can('comment.view')
                                    <th data-field="comments" data-formatter="commentFormatter" data-sortable="true" data-visible="true">
                                        {{__('lang.review')}}
                                    </th>
                                @endcan

                                <th data-field="admin.name" data-width="150">
                                    {{__('lang.author')}}
                                </th>
                                <th data-field="created_at" data-width="150" data-sortable="true" data-visible="true">
                                    {{__('lang.created_at')}}
                                </th>

                                <th data-formatter="statusFormatter" data-width="150">
                                    {{__('lang.status')}}
                                </th>

                                <th data-formatter="actionFormatter" data-width="200" data-switchable="false" data-force-hide="true">
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
    <input type="hidden" class="type" value="{{\App\Enums\ProductType::product}}">
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $("select").on('change', function(){
                $table.bootstrapTable('refresh');
            })
        })
        function commentFormatter(value, row){
            let html = value + ' / ' + row.rating + ' <i class="fa fa-star text-warning" aria-hidden="true"></i> ';
            return html;
        }
        function sortFormatter(value, row) {
            return '<input style="width: 80px" type="number" min="0" class="form-control" name="sort" data-id="'+row.id+'" value="'+row.sort+'">';
        }

        function imageFormatter(value, row) {
            if(value){
                return  '<img src="'+value+'" class="rounded" width="80">'
            }else{
                return  '<img src="/lib/images/no-image.png" class="rounded" width="80">'
            }
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

            @can('video.edit')
                html += '<div class="checkbox" >';
            html += '<input id="checkbox_public_'+row.id+'" '+public+' type="checkbox" name="public">';
            html += '<label for="checkbox_public_'+row.id+'" class="data_public" data-id="'+row.id+'">{{__('lang.display')}}</label>';
            html += '</div>';

            html += '<div class="checkbox" >';
            html += '<input id="checkbox_status_'+row.id+'" '+status+' type="checkbox" name="status">';
            html += '<label for="checkbox_status_'+row.id+'" class="mb-0 data_status" data-id="'+row.id+'">{{__('lang.highlights')}}</label>';
            html += '</div>';
            @endcan

             @cannot('video.edit')

                html += '<div class="checkbox">';
            html += '<input '+public+' type="checkbox" name="public">';
            html += '<label>{{__('lang.display')}}</label>';
            html += '</div>';

            html += '<div class="checkbox">';
            html += '<input '+status+' type="checkbox" name="status">';
            html += '<label class="mb-0">{{__('lang.highlights')}}</label>';
            html += '</div>';
            @endcan

                return html;
        }

        function videoFormatter(value){
            return '<a href="https://www.youtube.com/watch?v='+value+'" class="font-weight-bold" target="_blank">https://www.youtube.com/watch?v='+ value +'</a>';
        }

        function titleFormatter(value, row){
            if(!value)
                return ;
            return '<a href="'+ '{{ route('slug', ':id') }}'.replace(':id',row.translation.slug) +'" class="font-weight-bold" target="_blank">'+ value +'</a>';
        }

        function actionFormatter(value, row){
            let html = '';
            @can('video.edit')
            html += '<a href="'+ '{{ route('admin.products.videos.edit', ':id') }}'.replace(':id',row.id) +'" class="btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a> ';
            @endcan

                @can('video.destroy')
            html+='<a href="'+ '{{ route('admin.products.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('lang.confirm_destroy')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
            @endcan
            return html;
        }

    </script>

@stop
