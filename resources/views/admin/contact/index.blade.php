@extends('admin.layouts.layout')
@section('title') Tin nhắn @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Tin nhắn</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Tin nhắn</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">

                    <div id="custom-toolbar">
                        <form method="get" class="form-inline filter-form">

                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" name="status">
                                    <option value="">Trạng thái (All)</option>
                                    <option value="1">Đã xem</option>
                                    <option value="2"> Chưa xem</option>
                                </select>
                            </div>

                            <div class="mr-2 mb-2" style="width: 200px">
                                <select class="form-control" data-toggle="select2" name="user">
                                    <option value="">Người duyệt (All)</option>
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
                               data-url="{{ route('admin.contacts.data') }}"
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
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="note">
                                    Tin nhắn
                                </th>

                                <th data-field="created_at" data-sortable="true" data-visible="true">
                                    Tạo lúc
                                </th>
                                <th data-field="updated_at" data-sortable="true" data-visible="true">
                                    Duyệt lúc
                                </th>

                                <th data-field="status" data-formatter="statusFormatter">
                                    Trạng thái
                                </th>

                                <th data-formatter="actionFormatter" data-switchable="false" data-force-hide="true">
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
        $(document).ready(function(){
            $("select").on('change', function(){
                $table.bootstrapTable('refresh');
            })
        })

        function sortFormatter(value, row) {
            return '<input style="width: 80px" type="number" min="0" class="form-control" name="sort" data-id="'+row.id+'" value="'+row.sort+'">';
        }

        function statusFormatter(value, row) {
            if(value == 1)
                return '<a class="font-weight-bold text-primary">Đã xem</a>';

            return  '<a class="font-weight-bold text-danger">Chưa xem</a>';
        }

        function titleFormatter(value, row){
            return '<a href="'+ '{{ route('slug', ':id') }}'.replace(':id',row.alias) +'" target="_blank">'+ value +'</a>';
        }

        function actionFormatter(value, row){
            let html = '<a href="'+ '{{ route('admin.contacts.show', ':id') }}'.replace(':id',row.id) +'" class="btn btn-primary waves-effect waves-light"><i class="pe-7s-look"></i></a> ';
            html+='<a href="'+ '{{ route('admin.contacts.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';

            return html;
        }

    </script>

@stop
