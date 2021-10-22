@extends('admin.layouts.layout')
@section('title') Quản lý ngôn ngữ @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Quản lý ngôn ngữ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Quản lý ngôn ngữ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="action-datatable text-right">
                        <a href="{{route('admin.languages.create')}}" class="btn btn-primary waves-effect width-md waves-light mb-2 ajax-modal">
                            <span class="icon-button"><i class="fe-plus"></i></span> Thêm mới</a>
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
                               data-filename="alias"
                               data-cookie="true"
                               data-cookie-id-table="alias"
                        >
                            <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name">
                                    Ngôn ngữ
                                </th>

                                <th data-field="value" >
                                    Giá trị
                                </th>
                                <th data-field="status" data-formatter="statusFormatter"  data-width="200" data-sortable="true" data-visible="true">
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
@endsection

@section('scripts')
    <script>

        function statusFormatter(value){
            if(value == 1){
                return '<strong class="text-info"><span class="icon-button"><i class="pe-7s-star"></i></span> Mặc định</strong>';
            }
            return "";
        }

        function actionFormatter(value, row){
            let html = '<a href="'+ '{{ route('admin.languages.edit', ':id') }}'.replace(':id',row.id) +'" class="btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a> ';
            html+='<a href="'+ '{{ route('admin.languages.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';

            html+='<a href="'+ '{{ route('admin.languages.active', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-info waves-effect waves-light" data-confirm="Xác nhận chuyển ngôn ngữ?" data-refresh="true" data-method="POST"><i class="fa fa-language"></i></a> ';

            return html;
        }

    </script>

@stop
