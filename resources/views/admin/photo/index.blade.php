@extends('admin.layouts.layout')
@section('title') {{__('lang.image')}} @stop
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('lang.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">{{__('lang.image')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('lang.image')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="action-datatable text-right">
                        @can('photo.create')
                        <a href="{{route('admin.photos.create')}}" class="ajax-modal btn btn-primary waves-effect width-md waves-light mb-2">
                            <span class="icon-button"><i class="fe-plus"></i></span> {{__('lang.create')}} <span class="text-lowercase">{{__('lang.image')}}</span></a>
                        @endcan
                    </div>
                    <div id="custom-toolbar">
                        <form method="get" class="form-inline filter-form">
                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" name="public" data-allow-clear="true" data-placeholder="{{__('lang.display')}}">
                                    <option value="">{{__('lang.display')}}</option>
                                    @foreach(\App\Enums\ActiveDisable::getInstances() as $public)
                                        <option value="{{$public->key}}"> {{$public->description}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" name="position" data-allow-clear="true" data-placeholder="{{__('lang.position')}}">
                                    <option value="">{{__('lang.position')}}</option>
                                    @foreach(\App\Enums\Position::getInstances() as $item)
                                        <option value="{{$item->value}}">{{$item->description}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </form>
                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.photos.data') }}"
                               data-side-pagination="server"
                               data-pagination="true"
                               data-search="true"
                               data-search-on-enter-key="false"
                               data-show-search-button="false"
                               data-sort-name="created_at"
                               data-sort-order="desc"
                               data-filename="photos"
                               data-cookie="true"
                               data-cookie-id-table="photos"
                        >
                            <thead>
                            <tr>
                                <th data-field="id" data-width="100" data-sortable="true">ID</th>
                                <th data-formatter="sortFormatter" data-width="100">{{__('lang.sort')}}</th>
                                <th data-field="image" data-formatter="imageFormatter" data-width="120">
                                    {{__('lang.image')}}
                                </th>

                                <th data-field="name">
                                    {{__('lang.title')}}
                                </th>

                                <th data-field="path" data-formatter="pathFormatter">
                                    {{__('lang.slug')}}
                                </th>

                                <th data-field="position" data-width="150">
                                    {{__('lang.position')}}
                                </th>

                                <th data-field="target" data-width="100" >
                                    {{__('lang.target')}}
                                </th>

                                <th data-formatter="statusFormatter" data-width="150">
                                    {{__('lang.status')}}
                                </th>

                                <th data-formatter="actionFormatter" data-switchable="false" data-width="200" data-force-hide="true">
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

    </div> <!-- end container-fluid -->
    <input type="hidden" class="type" value="{{\App\Enums\PhotoType::photo}}">

    <div id="viewImage" class="modal fade" tabindex="-1" aria-labelledby="myLargeModalLabel" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('lang.image')}}</h5>
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
@stop

@section('scripts')
    <script>
        $(document).on('click','.coppy-image',function (){
            var image = $(this).data('image');
            navigator.clipboard.writeText(image);
            flash({'message': '{{__("lang.coppy_success")}}', 'type': 'success'});
        });
        $(document).on('click','.view-image',function(){
            let image = $(this).data('image');
            $('#viewImage').modal('show');
            $('.showImage').attr('src', image);
        });

        $(document).ready(function(){
            $("select").on('change', function(){
                $table.bootstrapTable('refresh');
            })
        });

        function sortFormatter(value, row) {
            return '<input style="width: 80px" type="number" min="0" class="form-control" name="sort" data-id="'+row.id+'" value="'+row.sort+'">';
        }

        function statusFormatter(value, row) {

            let html = '<div class="checkbox" >';
            let public = null;

            if(row.public == 1){
                public = "checked";
            }

            html += '<input id="checkbox_public_'+row.id+'" '+public+' type="checkbox" name="public">';
            html += '<label for="checkbox_public_'+row.id+'" class="data_public" data-id="'+row.id+'">{{__('lang.display')}}</label>';
            html += '</div>';

            return html;
        }

        function pathFormatter(value){
            if(!value)
                return "";

            return '<a href="'+ value +'" target="_blank">'+ value +'</a>';
        }


        function imageFormatter(value, row) {
            return  '<img src="'+row.thumb+'" class="rounded view-image" data-image="'+row.image+'" style="cursor: pointer" width="120">';
        }

        function actionFormatter(value, row){
            let html = '';
            @can('photo.edit')
            html = '<a href="'+ '{{ route('admin.photos.edit', ':id') }}'.replace(':id',row.id) +'" class="ajax-modal btn btn-primary waves-effect waves-light"><i class="fe-edit-2"></i></a> ';
            @endcan
                @can('photo.destroy')
            html+='<a href="'+ '{{ route('admin.photos.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="{{__('lang.confirm_destroy')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
            @endcan

            if(row.image)
              html +='<a href="javascript:void(0)" class="btn btn-facebook  coppy-image waves-effect waves-light tooltip-hover" title="{{__('lang.coppy')}} {{__('lang.image')}}" data-image="'+row.image+'"><i class="fe-copy"></i></a>';

            return html;
        }

    </script>

@stop
