@extends('admin.layouts.layout')
@section('title') Module @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Module</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Module</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="action-datatable text-right">
                        <a href="{{route('admin.modules.create')}}" class="btn btn-primary waves-effect width-md waves-light mb-2">
                            <span class="icon-button"><i class="fe-plus"></i></span> Thêm mới</a>
                    </div>
                    <div id="custom-toolbar">

                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.modules.data')}}"
                               data-side-pagination="server"
                               data-pagination="true"
                               data-search="true"
                               data-search-on-enter-key="false"
                               data-show-search-button="false"
                               data-sort-name="created_at"
                               data-sort-order="desc"
                               data-filename="modules"
                               data-cookie="true"
                               data-cookie-id-table="modules"
                        >
                            <thead>
                            <tr>
                                <th data-field="id" data-width="100" data-sortable="true">ID</th>

                                <th data-field="name">
                                    Tên
                                </th>

                                <th data-field="table">
                                   Bảng
                                </th>
                                <th data-field="collumn">
                                    Số cột
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
        function titleFormatter(value, row){
            return '<a href="'+ '{{ route('alias', ':id') }}'.replace(':id',row.alias) +'" target="_blank">'+ value +'</a>';
        }

        function actionFormatter(value, row){
            let html = '<a href="'+ '{{ route('admin.modules.show', ':id') }}'.replace(':id',row.id) +'" class="btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a> ';
            html+='<a href="'+ '{{ route('admin.modules.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';

            return html;
        }

    </script>

@stop
