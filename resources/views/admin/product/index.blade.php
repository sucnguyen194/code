@extends('admin.layouts.layout')
@section('title') {{__('lang.list_product')}} @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('lang.list_product')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('lang.list_product')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="action-datatable text-right">
                        @can('product.create')
                        <a href="{{route('admin.products.create')}}" class="btn btn-primary waves-effect width-md waves-light mb-2">
                            <span class="icon-button"><i class="fe-plus"></i></span> {{__('_add_new')}} {{\Illuminate\Support\Str::lower(__('_product'))}}</a>
                        @endcan
                    </div>
                    <div id="custom-toolbar">
                        <form method="get" class="form-inline filter-form">
                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" name="public" data-allow-clear="true" data-placeholder="{{__('_display')}}">
                                    <option value=""></option>
                                    @foreach(\App\Enums\ActiveDisable::getInstances() as $public)
                                        <option value="{{$public->value}}"> {{$public->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" data-allow-clear="true" data-placeholder="{{__('_highlights')}}" name="status">
                                    <option value=""></option>
                                    @foreach(\App\Enums\ActiveDisable::getInstances() as $public)
                                        <option value="{{$public->value}}"> {{$public->description}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" data-allow-clear="true" data-placeholder="{{__('_author')}}" name="author">
                                    <option value=""></option>
                                    @foreach($admins as $item)
                                        <option value="{{$item->id}}">{{$item->name ?? $item->email}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" name="category" data-allow-clear="true" data-placeholder="{{__('lang.category')}}">
                                    <option value=""></option>
                                    @include('admin.render.options', ['options' => $categories, 'selected' => 0])
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.products.data') }}"
                               data-side-pagination="server"
                               data-pagination="true"
                               data-search="true"
                               data-search-on-enter-key="false"
                               data-show-search-button="false"
                               data-sort-name="created_at"
                               data-sort-order="desc"
                               data-filename="products"
                               data-cookie="true"
                               data-cookie-id-table="products"
                        >
                            <thead>
                            <tr>
                                <th data-field="id" data-width="100" data-sortable="true">ID</th>
                                <th data-formatter="sortFormatter" data-width="100">{{__('_sort')}}</th>
                                <th data-field="thumb" data-formatter="imageFormatter"  data-width="100">{{__('_image')}}</th>
                                <th data-field="name" data-formatter="titleFormatter">
                                    {{__('_product')}}
                                </th>
                                <th data-field="category" data-formatter="categoryFormatter">
                                    {{__('lang.category')}}
                                </th>
{{--                                <th data-field="code">--}}
{{--                                    {{__('lang.code')}}--}}
{{--                                </th>--}}

                                <th data-field="price" data-formatter="priceFormatter">
                                    Gói dịch vụ
                                </th>
                                @can('comment.view')
                                    <th data-field="comments" data-formatter="commentFormatter" data-sortable="true" data-visible="true">
                                        {{__('_review')}}
                                    </th>
                                @endcan

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
    <input type="hidden" class="type" value="{{\App\Enums\TagType::product}}">
    <div id="viewImage" class="modal fade" tabindex="-1" aria-labelledby="myLargeModalLabel" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('_image')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" class="img-fluid showImage">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <style>
        .modal-lg {
            min-width: auto;
            max-width: fit-content;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $("select").on('change', function(){
                $table.bootstrapTable('refresh');
            });

            $(document).on('click','.view-image',function(){
                let image = $(this).data('image');
                $('#viewImage').modal('show');
                $('.showImage').attr('src', image);
            })
        });
        function commentFormatter(value, row){
            let html = value + ' / ' + row.rating + ' <i class="fa fa-star text-warning" aria-hidden="true"></i> ';
            return html;
        }
        function sortFormatter(value, row) {
            return '<input style="width: 80px" type="number" min="0" class="form-control" name="sort" data-id="'+row.id+'" value="'+row.sort+'">';
        }

        function categoryFormatter(value, row){
            var html ="";

            if(row.category){
                let name  = row.category.translation ? row.category.translation.name : "#" +row.category.id;
                let route = '{{route('admin.products.categories.edit', ':id')}}'.replace(':id', row.category.id);
                html += '<a class="w-100 font-weight-bold ajax-modal" href="'+route+'" target="_blank">'+name+'</a> ';
                let categories = row.categories;

                if($(categories).length > 0){
                    html += '<hr style="margin: 4px 0; border-top: 1px solid #e2e2e2">';
                    categories.map(function (val){
                        if(value.id != val.id){
                            let _name = val.translation ? val.translation.name : "#" + val.id;
                            let _route = '{{route('admin.products.categories.edit', ':id')}}'.replace(':id', val.id);
                            html  +=  '<a href="'+_route+'" class="small badge badge-light-primary ajax-modal" target="_blank">'+ _name + '</a> ';
                        }
                    }).join(' ');
                }
            }
            return html;
        }

        function imageFormatter(value, row) {

            if(value){
                return  '<img src="'+value+'" class="rounded view-image" data-image="'+row.image+'" width="80">'
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

            @can('product.edit')
                html += '<div class="checkbox" >';
            html += '<input id="checkbox_public_'+row.id+'" '+public+' type="checkbox" name="public">';
            html += '<label for="checkbox_public_'+row.id+'" class="data_public" data-id="'+row.id+'">{{__('_display')}}</label>';
            html += '</div>';

            html += '<div class="checkbox" >';
            html += '<input id="checkbox_status_'+row.id+'" '+status+' type="checkbox" name="status">';
            html += '<label for="checkbox_status_'+row.id+'" class="mb-0 data_status" data-id="'+row.id+'">{{__('_highlights')}}</label>';
            html += '</div>';

            @endcan

                @cannot('product.edit')

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
            return '<a href="'+ row.slug +'" class="font-weight-bold" target="_blank">'+ value +'</a>';
        }

        // function priceFormatter(value,row){
        //
        //     if(row.price_sale > 0 && row.price_sale < value){
        //         return row.price_sale + ' <small>('+value+')</small>';
        //     }else{
        //         return value;
        //     }
        // }
        function priceFormatter(value,row){
            let options = row.options;

            let option = '';
            if(options){

                $(options).each(function(index, value){

                    option += '<div>' + value.name + ' <strong>[ ' + value.price + ']</strong><div>';
                });
            }

            return option;
        }

        function actionFormatter(value, row){

            let html = '';
            @can('product.edit')
                html += '<a href="'+ '{{ route('admin.products.edit', ':id') }}'.replace(':id',row.id) +'" class="btn btn-primary waves-effect waves-light"><i class="fe-edit-2"></i></a> ';
            @endcan

                @can('product.destroy')
                html+='<a href="'+ '{{ route('admin.products.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('_delete_record')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
            @endcan
                return html;
        }

    </script>

@stop
