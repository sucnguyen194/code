@extends('admin.layouts.layout')
@section('title')
    {!! __('_source_code_editor') !!}
@stop
@section('content')

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{!! __('_dashboard') !!}</a></li>
                            <li class="breadcrumb-item active">{!! __('_source_code_editor') !!}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{!! __('_source_code_editor') !!}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-9">
                <form id="put-content-file" class="loading-file" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="card-box">
                        <h4 class="header-title mb-3"><img src="/lib/images/file-webscript.png" height="24"> <span class="path_file">{!! __('_source_code_editor') !!}</span>
                        </h4>
                        <div class="autohide-scroll view-source bg-listSource">
                            <div id="editor" class="views-source"></div>
                            <input class="hidden" name="dir" id="dir-file">
                            <textarea class="hidden" name="put_file"></textarea>

                        </div>
                    </div>
                    <div class="">
                        @include('admin.render.button', ['route' => route('admin.sources.index')])
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <div class="card-box">
                    <h4 class="header-title mb-3">{!! __('_source') !!}</h4>
                    <div id="">
                        <div class="list-group">
                            <ul class="pl-0">
                                <li class="folder-name">
                                    <a href="javascript:void(0)" id="open-folder" class="open-folder text-primary"
                                       data-path="folder_public"><i class="icon-img"><img
                                                src="https://s2d142.cloudnetwork.vn:8443/cp/theme/icons/16/plesk/file-folder.png?377a0415c8e86b629f04f2de969b6dc7">
                                        </i> public</a>
                                    <ul class="parent-folder" id="folder_public">
                                        @include('admin.source.show',['dir' => '../public', 'icon'=> $icon, 'child' => false])
                                    </ul>
                                </li>
                                @include('admin.source.show',['dir' => '../resources', 'icon'=> $icon, 'child' => false])
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-box table-responsive">
                    <div class="action-datatable text-right">
                        @can('photo.create')
                            @include('admin.render.add_new', ['route' => route('admin.photos.create'), 'modal' => true])
                        @endcan
                    </div>
                    <div id="custom-toolbar">

                    </div>
                    @can('photo.view')
                        <div class="table-bootstrap">
                            <table class="table table-bordered table-hover bs-table"
                                   data-toolbar="#custom-toolbar"
                                   data-url="{{ route('admin.photos.data') }}"
                                   data-side-pagination="server"
                                   data-pagination="true"
                                   data-search="false"
                                   data-show-refresh="false"
                                   data-show-columns="false"
                                   data-show-export="false"
                                   data-search-on-enter-key="false"
                                   data-show-search-button="false"
                                   data-sort-name="created_at"
                                   data-sort-order="desc"
                                   data-filename="files"
                                   data-cookie="true"
                                   data-cookie-id-table="files"
                            >
                                <thead>
                                <tr>
                                    <th data-field="image" data-formatter="imageFormatter">
                                        {{__('_image')}}
                                    </th>
                                    <th data-formatter="actionFormatter" data-switchable="false" data-width="150" data-force-hide="true">
                                        {{__('_action')}}
                                    </th>

                                </tr>
                                </thead>

                            </table>
                        </div>
                    @endcan
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- end container-fluid -->
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
@stop
@section('styles')
    <style type="text/css">
        .file-name {
            word-wrap: break-word;
        }

        .hidden {
            display: none;
        }

        #editor, .view-source {
            height: 600px !important;
        }
    </style>
@stop
@section('scripts')

    <script>
        $(document).on('click','.coppy-image',function (){
            var image = $(this).data('image');
            navigator.clipboard.writeText(image);
            flash({'message': '{{__("_copy_success")}}', 'type': 'success'});
        });
        $(document).on('click','.view-image',function(){
            let image = $(this).data('image');
            $('#viewImage').modal('show');
            $('.showImage').attr('src', image);
        });

        function imageFormatter(value, row) {
            return  '<img src="'+row.thumb+'" class="rounded view-image" data-image="'+row.image+'" style="cursor: pointer" height="30">';
        }

        function actionFormatter(value, row){
            let html = '';
            @can('photo.edit')
                html = '<a href="'+ '{{ route('admin.photos.edit', ':id') }}'.replace(':id',row.id) +'" class="ajax-modal btn btn-xs btn-primary waves-effect waves-light"><i class="fe-edit-2"></i></a> ';
            @endcan
            @can('photo.destroy')
                html+='<a href="'+ '{{ route('admin.photos.destroy', ':id') }}'.replace(':id',row.id) +'" class="ajax-link btn btn-xs btn-warning waves-effect waves-light" data-confirm="{{__('_delete_record')}}" data-refresh="true" data-method="DELETE"><i class="fe-x"></i></a> ';
            @endcan

            if(row.image)
                html +='<a href="javascript:void(0)" class="btn btn-xs btn-facebook  coppy-image waves-effect waves-light tooltip-hover" title="{{__('_copy_image')}}" data-image="'+row.image+'"><i class="fe-copy"></i></a>';

            return html;
        }
        </script>


    <script src="{{asset('lib/sources/ace.js')}}" type="text/javascript"></script>
    <!-- scrollbar init-->
    <script src="https://coderthemes.com/adminox/layouts/vertical/assets/js/pages/scrollbar.init.js"></script>
    <script>
        $(document).on('click', '#open-folder', function () {
            var path = $(this).attr('data-path');
            var result = $('#' + path);
            if (result.css('display') == 'block') {
                result.slideUp();
            } else {
                result.slideDown();
            }
        });

        $(document).on('click', '#open-sub-folder', function () {
            var path = $(this).attr('data-path');
            var result = $('#' + path);
            if (result.css('display') == 'block') {
                result.slideUp();
            } else {
                result.slideDown();
            }

        });
        $(document).on("click", "#show-file", function () {
            var white_list = ['html', 'ctp', 'txt', 'xml', 'css', 'js', 'php'];
            var ext = $(this).attr('data-ext');
            var path = $(this).attr('data-path');
            if (path != 'undefined' && ext != 'undefined' && $.inArray(ext, white_list) > -1) {
                loadContentFile(path, ext)
            }
        });

        function loadContentFile(path, ext) {

            if (typeof ace != "undefined" && typeof require != "undefined") {

                var editor = ace.edit("editor");
                var url = '{{route('admin.load.sources')}}';

                if (typeof ext != "undefined" && ext.length > 0) {
                    switch (ext) {
                        case 'css':
                            editor.session.setMode("ace/mode/css");
                            break;
                        case 'js':
                            editor.session.setMode("ace/mode/javascript");
                            break;
                        case 'php':
                            editor.session.setMode("ace/mode/php");
                            break;
                        default:
                            editor.session.setMode("ace/mode/html");
                            break;
                    }
                }

                editor.getSession().setUseWrapMode(true);
                editor.setBehavioursEnabled(true);
                editor.renderer.setOption('showLineNumbers', true);
                editor.setTheme("ace/theme/monokai");

                $.ajax({
                    async: true,
                    url: url,
                    type: 'get',
                    data: {
                        path: path
                    },
                    dataType: 'html',
                    success: function (response) {
                        var data = JSON.parse(response);
                        $('#dir-file').val(path);
                        $('span.path_file').text(data.file);
                        console.log(data);
                        editor.setValue(data.content);
                    },
                    error: function (response) {

                    }
                });
            }

        }
    </script>


    <script type="text/javascript">
        var editor = ace.edit("editor");
        var textarea = $('textarea[name="put_file"]');
        editor.setTheme("ace/theme/monokai");
        editor.getSession().setUseWrapMode(true);
        editor.setBehavioursEnabled(true);
        editor.renderer.setOption('showLineNumbers', true);
        editor.session.setMode("ace/mode/php");
        editor.getSession().on("change", function () {
            textarea.val(editor.getSession().getValue());
        });
        textarea.val(editor.getSession().getValue());
        $('#submit').click(function (e) {
            e.preventDefault();
            data = $('form#put-content-file').serialize();
            var url = '{{route('admin.push.sources')}}';
            var _token = $('input[name="_token"]').val();
            var dir = $('#dir-file').val();
            $.ajax({
                type: "post",
                cache: false,
                url: url,
                data: data,
                success: function (response) {
                    flash({'message': '{{__('_the_record_is_updated_successfully')}}', 'type': 'success'});
                },
                error: function (response) {
                    flash({'message': '{{__('_file_error')}}', 'type': 'error'});
                }
            });
        })

    </script>
@stop
