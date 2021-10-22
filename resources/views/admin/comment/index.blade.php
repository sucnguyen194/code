@extends('admin.layouts.layout')
@section('title') Danh sách bình luận @stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Danh sách bình luận</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Danh sách bình luận</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div id="custom-toolbar">

                    </div>
                    <div class="table-bootstrap">
                        <table class="table table-bordered table-hover bs-table"
                               data-toolbar="#custom-toolbar"
                               data-url="{{ route('admin.comments.data', ['type' => $type]) }}"
                               data-side-pagination="server"
                               data-pagination="true"
                               data-search="true"
                               data-search-on-enter-key="false"
                               data-show-search-button="false"
                               data-sort-name="created_at"
                               data-sort-order="desc"
                               data-filename="comments"
                               data-cookie="true"
                               data-cookie-id-table="comment"
                        >
                            <thead>
                            <tr>
                                <th data-field="id" data-width="150" data-sortable="true">ID</th>
                                <th data-field="title" data-formatter="titleFormatter">
                                    Bài viết
                                </th>
                                <th data-field="comment_last">
                                    Bình luận cuối cùng
                                </th>
                                <th data-field="commenter">
                                   NgƯời bình luận
                                </th>

                                <th data-field="comment_count" data-width="150" data-sortable="true" data-visible="true">
                                    Chưa trả lời
                                </th>
                                <th data-field="created_at" data-width="150" data-sortable="true" data-visible="true">
                                    Cập nhật
                                </th>

                                <th data-formatter="actionFormatter" data-width="150" data-switchable="false" data-force-hide="true">
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

        function titleFormatter(value, row){
            return '<a href="'+ '{{ route('slug', ':slug') }}'.replace(':slug',row.translation.slug) +'" target="_blank">'+ value +'</a>';
        }

        function actionFormatter(value, row){
            let html = '<a href="'+ '{{ route('admin.comments.reply', [':type', ':id' ]) }}'.replace(':id',row.id).replace(':type','{{$type}}') +'" class="btn btn-primary waves-effect waves-light"><i class="fe-edit-2"></i></a> ';
            html+='<a href="'+ '{{ route('admin.comments.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
            return html;
        }

    </script>

@stop
