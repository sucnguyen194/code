@extends('admin.layouts.layout')
@section('title') Danh sách sản phẩm @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Danh sách sản phẩm</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Danh sách sản phẩm</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="action-datatable text-right">
                        <a href="{{route('admin.products.create')}}" class="btn btn-primary waves-effect width-md waves-light mb-2">
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
                                <select class="form-control" data-toggle="select2" name="status">
                                    <option value="">Nổi bật (All)</option>
                                    @foreach(\App\Enums\ActiveDisable::getInstances() as $public)
                                        <option value="{{$public->value}}"> {{$public->description}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" name="author">
                                    <option value="">Tác giả (All)</option>
                                    @foreach($admins as $item)
                                        <option value="{{$item->id}}">{{$item->name ?? $item->email}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mr-2 mb-2" style="width: 200px">

                                <select class="form-control" data-toggle="select2" name="category">
                                    <option value="">Danh mục (All)</option>
                                    @foreach($categories as $item )
                                        <option value="{{$item->id}}" class="font-weight-bold">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.products.data',['type' => \App\Enums\ProductType::product]) }}"
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
                                <th data-formatter="sortFormatter" data-width="100">STT</th>
                                <th data-field="image" data-formatter="imageFormatter"  data-width="100">Ảnh</th>
                                <th data-field="name" data-formatter="titleFormatter">
                                    Sản phẩm
                                </th>
                                <th data-field="category" data-formatter="categoryFormatter">
                                    Danh mục
                                </th>
                                <th data-field="code">
                                    Code
                                </th>

                                <th data-field="price" data-formatter="priceFormatter">
                                    Giá
                                </th>

                                <th data-field="created_at" data-sortable="true" data-visible="true">
                                    Tạo lúc
                                </th>

                                <th data-formatter="statusFormatter" data-width="150">
                                    Trạng thái
                                </th>

                                <th data-formatter="actionFormatter" data-width="200" data-switchable="false" data-force-hide="true">
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

        function sortFormatter(value, row) {
            return '<input style="width: 80px" type="number" min="0" class="form-control" name="sort" data-id="'+row.id+'" value="'+row.sort+'">';
        }

        function categoryFormatter(value, row){
            let route = "";

            if(row.category){
                let slug = value.translation.slug;
                route += '{{route('slug',':slug')}}'.replace(':slug', slug);
            }
            let html = value ? '<a class="w-100 font-weight-bold" href="'+route+'" target="_blank">'+value.translation.name+'</a> ' : '';
            let categories = row.categories;

            if($(categories).length > 0){
                html += '<hr style="margin: 4px 0; border-top: 1px solid #e2e2e2">';
                categories.map(function (val){
                    if(value.id != val.id){
                        html  +=  '<span class="small badge badge-light-primary">'+ val.translation.name + '</span> ';
                    }
                }).join(' ');
            }

            return html;
        }

        function imageFormatter(value, row) {
            if(value){
                return  '<img src="'+value+'" class="rounded" width="80">'
            }else{
                return  '<img src="/lib/images/no-image.png" class="rounded" width="80">'
            }
        }


        function statusFormatter(value, row) {

            let html = '<div class="checkbox" >';
            let public = null;
            let status = null;

            if(row.public == 1){
                public = "checked";
            }

            if(row.status == 1){
                status = "checked";
            }

            html += '<input id="checkbox_public_'+row.id+'" '+public+' type="checkbox" name="public">';
            html += '<label for="checkbox_public_'+row.id+'" class="data_public" data-id="'+row.id+'">Hiển thị</label>';
            html += '</div>';

            html += '<div class="checkbox" >';
            html += '<input id="checkbox_status_'+row.id+'" '+status+' type="checkbox" name="status">';
            html += '<label for="checkbox_status_'+row.id+'" class="mb-0 data_status" data-id="'+row.id+'">Nổi bật</label>';
            html += '</div>';

            return html;
        }

        function titleFormatter(value, row){
            return '<a href="'+ '{{ route('slug', ':id') }}'.replace(':id',row.translation.slug) +'" class="font-weight-bold" target="_blank">'+ value +'</a>';
        }

        function priceFormatter(value,row){

            if(row.price_sale > 0 && row.price_sale < value){
                return number_format(row.price_sale) + ' <small>('+number_format(value)+')</small>';
            }else{
                return number_format(value);
            }
        }

        function actionFormatter(value, row){
            let html = '<a href="'+ '{{ route('admin.products.edit', ':id') }}'.replace(':id',row.id) +'" class="btn btn-primary waves-effect waves-light"><i class="fe-edit-2"></i></a> ';
            html+='<a href="'+ '{{ route('admin.products.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';

            return html;
        }

    </script>

@stop
