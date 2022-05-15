@extends('admin.layouts.layout')
@section('title') {{__('_list_post')}} @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('_list_post')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_list_post')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="action-datatable text-right">
                        @can('blog.create')
                            @include('admin.render.add_new', ['route' => route('admin.posts.create')])
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
                                    @foreach($authors as $item)
                                        <option value="{{$item->id}}">{{$item->name ?? $item->email}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" data-allow-clear="true" data-placeholder="{{__('_category')}}" name="category">
                                    <option value="">{{__('_category')}}</option>
                                    @include('admin.render.options', ['options' => $categories, 'selected' => 0])
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.posts.data',['type' => \App\Enums\PostType::post]) }}"
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
                                <th data-field="image" data-formatter="imageFormatter"  data-width="100">{{__('_image')}}</th>
                                <th data-field="title" data-formatter="titleFormatter">
                                    {{__('_title')}}
                                </th>
                                <th data-field="category" data-formatter="categoryFormatter">
                                    {{__('_category')}}
                                </th>

                                @can('comment.view')
                                    <th data-field="comments" data-formatter="commentFormatter" data-sortable="true" data-visible="true">
                                        {{__('_review')}}
                                    </th>
                                @endcan

                                <th data-field="admin.name">
                                    {{__('_author')}}
                                </th>
                                <th data-field="created_at" data-sortable="true" data-visible="true">
                                    {{__('_created_at')}}
                                </th>

                                <th data-formatter="statusFormatter" data-width="150" >
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
    <input type="hidden" class="type" value="{{\App\Enums\PostType::post}}">
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $("select").on('change', function(){
                $table.bootstrapTable('refresh');
            })
        });

        function commentFormatter(value, row){
            let html = value + ' / ' + row.rating + ' <i class="fa fa-star text-warning" aria-hidden="true"></i> ';
            return html;
        }

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

            @can('blog.edit')
            html += '<div class="checkbox" >';
            html += '<input id="checkbox_public_'+row.id+'" '+public+' type="checkbox" name="public">';
            html += '<label for="checkbox_public_'+row.id+'" class="data_public" data-id="'+row.id+'">{{__('_display')}}</label>';
            html += '</div>';

            html += '<div class="checkbox" >';
            html += '<input id="checkbox_status_'+row.id+'" '+status+' type="checkbox" name="status">';
            html += '<label for="checkbox_status_'+row.id+'" class="mb-0 data_status" data-id="'+row.id+'">{{__('_highlights')}}</label>';
            html += '</div>';

            @endcan

            @cannot('blog.edit')

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

        function imageFormatter(value, row) {
            if(value){
                return  '<img src="'+value+'" class="rounded" width="80">'
            }else{
                return  '<img src="/lib/images/no-image.png" class="rounded" width="80">'
            }
        }

        function categoryFormatter(value, row){
            var html ="";

            if(row.category){
                let name  = row.category.translation ? row.category.translation.name : "#" +row.category.id;
                let route = '{{route('admin.posts.categories.edit', ':id')}}'.replace(':id', row.category.id);
                html += '<a class="w-100 font-weight-bold ajax-modal" href="'+route+'" target="_blank">'+name+'</a> ';
                let categories = row.categories;

                if($(categories).length > 0){
                    html += '<hr style="margin: 4px 0; border-top: 1px solid #e2e2e2">';
                    categories.map(function (val){
                        if(value.id != val.id){
                            let _name = val.translation ? val.translation.name : "#" + val.id;
                            let _route = '{{route('admin.posts.categories.edit', ':id')}}'.replace(':id', val.id);
                            html  +=  '<a href="'+_route+'" class="small badge badge-light-primary ajax-modal" target="_blank">'+ _name + '</a> ';
                        }
                    }).join(' ');
                }
            }
            return html;
        }

        function titleFormatter(value, row){
            if(!value)
                return ;
            return '<a href="'+ row.slug +'" class="font-weight-bold" target="_blank">'+ value +'</a>';
        }

        function actionFormatter(value, row){
            let html = '';
            @can('blog.edit')
                html += '<a href="'+ '{{ route('admin.posts.edit', ':id') }}'.replace(':id',row.id) +'" class="btn btn-primary waves-effect waves-light"><i class="fe-edit-2"></i></a> ';
            @endcan

            @can('blog.destroy')
                html+='<a href="'+ '{{ route('admin.posts.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('_delete_record')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
            @endcan
                return html;
        }

    </script>

@stop
