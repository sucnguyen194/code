@extends('admin.layouts.layout')
@section('title') Image @stop
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Image</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Image</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="action-datatable text-right">
                        <a href="{{route('admin.photos.create')}}" class="ajax-modal btn btn-primary waves-effect width-md waves-light mb-2">
                            <span class="icon-button"><i class="fe-plus"></i></span> Thêm mới</a>
                    </div>
                    <div id="custom-toolbar">
                        <form method="get" class="form-inline filter-form">
                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" name="public">
                                    <option value="">Hiên thị (All)</option>
                                    @foreach(\App\Enums\ActiveDisable::getInstances() as $public)
                                        <option value="{{$public->value}}"> {{$public->description}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" name="position">
                                    <option value="">Vị trí (All)</option>
                                    @foreach(\App\Enums\Position::getInstances() as $item)
                                        <option value="{{$item->key}}">{{$item->description}}</option>
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
                                <th data-formatter="sortFormatter" data-width="100">STT</th>
                                <th data-field="image" data-formatter="imageFormatter" data-width="150">
                                    Hình ảnh
                                </th>
                                <th data-field="image" data-formatter="linkFormatter">
                                    Link ảnh
                                </th>
                                <th data-field="name">
                                    Tiêu đề
                                </th>

                                <th data-field="path" data-formatter="pathFormatter">
                                   Đường dẫn
                                </th>

                                <th data-field="position" data-width="150">
                                    Vị trí
                                </th>

{{--                                <th data-field="created_at" data-sortable="true" data-width="150" data-visible="true">--}}
{{--                                    Tạo lúc--}}
{{--                                </th>--}}

                                <th data-formatter="statusFormatter" data-width="150">
                                    Trạng thái
                                </th>

                                <th data-formatter="actionFormatter" data-switchable="false" data-width="200" data-force-hide="true">
                                    Quản lý
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
@stop

@section('scripts')
    <script>
        $(document).ready(function(){
            $("select").on('change', function(){
                $table.bootstrapTable('refresh');
            })
        })

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
            html += '<label for="checkbox_public_'+row.id+'" class="data_public" data-id="'+row.id+'">Hiển thị</label>';
            html += '</div>';

            return html;
        }

        function pathFormatter(value){
            if(!value)
                return "";

            return '<a href="'+ value +'" target="_blank">'+ value +'</a>';
        }

        function linkFormatter(value){
            if(!value)
                return "";

            return '<a href="'+ value +'" target="_blank">'+ value +'</a>';
        }

        function imageFormatter(value, row) {
            return  '<img src="'+value+'" class="rounded" width="80">';
        }

        function actionFormatter(value, row){
            let html = '<a href="'+ '{{ route('admin.photos.edit', ':id') }}'.replace(':id',row.id) +'" class="ajax-modal btn btn-primary waves-effect waves-light"><i class="fe-edit-2"></i></a> ';
            html+='<a href="'+ '{{ route('admin.photos.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
            return html;
        }

    </script>

@stop
