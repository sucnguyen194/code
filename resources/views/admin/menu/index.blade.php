@extends('admin.layouts.layout')
@section('title')
    Danh sách menu
@stop
@section('content')

    <div class="container-fluid">
    @csrf
    <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Thêm mới</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Menu</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div> <!-- end container-fluid -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-left" id="nestable_list_menu">
                    <div class="action-datatable text-right mb-2">
                        <a href="{{route('admin.menus.create')}}" class="btn btn-primary waves-effect width-md waves-light ajax-modal">
                            <span class="icon-button"><i class="fe-plus pr-1"></i></span> Thêm mới</a>

                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-box">
                            <h4 class="header-title">Thêm nhanh</h4>
                            <p class="sub-header mb-0">
                                * Phía dưới gồm các danh mục sản phẩm, bài viết, page... Click vào tên danh mục, bài viết... sẽ được thêm trực tiếp vào menu.
                            </p>
                        </div>
                        <div class="card-box">
                            <div class="form-group mb-0">
                                <table class="table table-bordered table-hover bs-table"
                                       data-toolbar="#custom-toolbar"
                                       data-url="{{ route('admin.categories.data',['type' => \App\Enums\CategoryType::product]) }}"
                                       data-side-pagination="server"
                                       data-pagination="false"
                                       data-search="true"
                                       data-search-on-enter-key="false"
                                       data-show-search-button="false"
                                       data-sort-name="created_at"
                                       data-sort-order="desc"
                                       data-filename="categories"
                                       data-cookie="true"
                                       data-cookie-id-table="categories"
                                       data-tree-show-field="translation.name"
                                       data-parent-id-field="parent_id"
                                >
                                    <thead>
                                    <tr>
                                        <th data-field="translation.name" data-formatter="categoryFormatter">
                                            Danh mục sản phẩm
                                        </th>
                                    </tr>
                                    </thead>
                                </table>

                            </div>
                        </div>

                        <div class="card-box">
                            <div class="form-group mb-0">
                                <table class="table table-bordered table-hover bs-table category-table"
                                       data-toolbar="#custom-toolbar"
                                       data-url="{{ route('admin.categories.data',['type' => \App\Enums\CategoryType::post]) }}"
                                       data-side-pagination="server"
                                       data-pagination="false"
                                       data-search="true"
                                       data-search-on-enter-key="false"
                                       data-show-search-button="false"
                                       data-sort-name="created_at"
                                       data-sort-order="desc"
                                       data-filename="categories"
                                       data-cookie="true"
                                       data-cookie-id-table="categories"
                                       data-tree-show-field="translation.name"
                                       data-parent-id-field="parent_id"
                                >
                                    <thead>
                                    <tr>
                                        <th data-field="translation.name" data-formatter="categoryFormatter">
                                            Danh mục blog
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="card-box">
                            <div class="form-group mb-0">
                                <table class="table table-bordered table-hover bs-table"
                                       data-toolbar="#custom-toolbar"
                                       data-url="{{ route('admin.posts.data',['type' => \App\Enums\PostType::page]) }}"
                                       data-side-pagination="server"
                                       data-pagination="false"
                                       data-search="true"
                                       data-search-on-enter-key="false"
                                       data-show-search-button="false"
                                       data-sort-name="created_at"
                                       data-sort-order="desc"
                                       data-filename="categories"
                                       data-cookie="true"
                                       data-cookie-id-table="categories"
                                >
                                    <thead>
                                    <tr>
                                        <th data-field="translation.name" data-formatter="titleFormatter">
                                            Page
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-box">
                            <h4 class="header-title"><b>Danh sách menu</b></h4>
                            <p class="sub-header">
                                * Danh sách menu tùy thuộc vào "vị trí" hiển thị tại thời điển hiện tại (top, bottom, left,right,home).
                            </p>

                                <textarea id="nestable-output" class="d-none" name="menuval"></textarea>
                                <div class="form-group">
                                    <label><strong class="text-tranform">VI TRÍ</strong></label>
                                    <select class="form-control position" data-toggle="select2">
                                        <option value="top" {{selected(session('menu_position'),'top')}} class="form-control">MENU TOP</option>
                                        <option value="home" {{selected(session('menu_position'),'home')}} class="form-control">MENU HOME</option>
                                        <option value="left" {{selected(session('menu_position'),'left')}} class="form-control">MEN LEFT</option>
                                        <option value="right" {{selected(session('menu_position'),'right')}} class="form-control">MENU RIGHT</option>
                                        <option value="bottom" {{selected(session('menu_position'),'bottom')}} class="form-control">MENU BOTTOM</option>
                                    </select>
                                </div>

                                <div class="custom-dd dd" id="nestable">
                                    <ol class="dd-list" id="result_data">
                                        @foreach($menus->where('parent_id', 0) as $items)
                                            <li class="dd-item" data-id="{{$items->id}}">
                                                <div class="dd-handle">
                                                    {{optional($items->translation)->name}}
                                                </div>

                                                <div class="menu_action">
                                                    <a href="{{route('admin.menus.edit',$items)}}" title="Sửa" class="btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a>
                                                    <a href="{{route('admin.menus.destroy',$items)}}" title="Xóa" class="ajax-link-menu btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i> </a>
                                                </div>

                                                <ol class="dd-list">
                                                    {!! \App\Http\Controllers\Admin\MenuController::sub($menus, $items->id) !!}
                                                </ol>

                                            </li>
                                        @endforeach

                                    </ol>
                                </div>

                        </div><!-- end col -->
                    </div>
                </div> <!-- end row -->
            </div> <!-- end col -->
        </div>
        <!-- end Row -->
    </div>
@stop
@section('styles')
    <style>
        .dd {
            max-width: 100%!important;
        }
    </style>
    <style type="text/css" media="screen">
        .list__menu{
            position: relative;
        }
        .list__menu label.control-label, .list__menu label a {
            display: block;

        }
        .list__menu .text-right{
            float: right;
            cursor: pointer;
            position: absolute;
            right: 15px;
        }
        .tab__menu{
            margin-left: 15px;

        }
        .box-shadow {
            box-shadow: 2px 2px 2px 2px #d58512
        }
    </style>

    <!-- Plugins css -->
    <link href="/lib/assets/libs/nestable2/jquery.nestable.min.css" rel="stylesheet" type="text/css" />

    <style>
        .treegrid-expander {
            display: none!important;
        }
        .treegrid-expanded .treegrid-expander {
            background: url('https://cdnjs.cloudflare.com/ajax/libs/jquery-treegrid/0.2.0/img/collapse.png') no-repeat;
            width: 16px;
            height: 16px;
            display: inline-block!important;
            position: relative;
            cursor: pointer;
        }
    </style>
@stop
@section('scripts')

    <script type="text/javascript">
        // Ajax form
        function ajaxformmenu(ele){
            var html = document.getElementById('result_data');

            $(ele).ajaxSubmit({
                headers: {
                    "X-CSRF-Token": $('meta[name=_token]').attr('content')
                },
                beforeSubmit:function(formData, jqForm, options){
                    $(ele).find('[type=submit]').attr('disabled', true);

                },
                complete: function(xhr, statusText, $form  ){

                    $(ele).find('[type=submit]').attr('disabled', false);

                    let result = xhr.responseText;

                    $(html).html(result).show();
                    $('.dd-empty').hide();
                    $('#ajax-modal').modal('hide');

                    if($(ele).find('input[name="_method"]').length){
                        flash({'message':'Cập nhật thành công!', 'type': 'success'});
                    }else{
                        flash({'message':'Thêm mới thành công!', 'type': 'success'});
                    }
                }

            });
            return false;
        }
        $(document).on('submit','.ajax-form-menu',function(e){
            e.preventDefault();
            ajaxformmenu(this);
            return false;
        });
    </script>
    <script>
        $('.ajax-link-menu').off('dblclick');

        $(document).on('click','.ajax-link-menu',function(e){
            e.preventDefault();
            if($(this).data('confirm')){
                Swal.fire({
                    title: 'Bạn có chắc không?',
                    text:  $(this).data('confirm'),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Quay lại'
                }).then((result) => {
                    if (result.isConfirmed) {
                        ajaxmenu(this);
                    }
                })
            }
        });
        function ajaxmenu(ele){
            var url= $(ele).attr('href');

            if (!url)
                return false;
            $this= $(ele);

            let method = 'GET';
            if($this.data('method')){
                method = $this.data('method');
            }

            $.ajax({
                method: method,
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                // dataType: 'json'
            }).done(function( result ) {
                let html = document.getElementById('result_data');
                let  success = {
                    'message' : 'Xóa bản ghi thành công!',
                    'type' : 'success'
                }
                $(html).html(result);
                if($(html).children().length == 0){
                    $(html).hide();
                    $('.dd-empty').show();
                }

                flash(success);

                $('#ajax-modal').modal('hide');
            });

            return false;
        }
    </script>

    <script>
        function titleFormatter(value, row){
            return '<a href="javascript:void(0)" title="Thêm mới" class="addmenu" data-id="'+row.id+'" data-type="{{\App\Enums\PostType::page}}">'+value +'</a>';
        }
        function categoryFormatter(value, row){
            return '<a href="javascript:void(0)" title="Thêm mới" class="addmenu" data-id="'+row.id+'" data-type="{{\App\Enums\CategoryType::category}}">'+value +'</a>';
        }

        $(document).on('post-body.bs.table.', function() {
            var columns = $table.bootstrapTable('getOptions').columns

            if (columns && columns[0][0].visible) {
                $table.treegrid({
                    treeColumn: 0,
                    onChange: function() {
                        $table.bootstrapTable('resetView')
                    }
                })
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click','.addmenu',function (){
                var _token = $('input[name="_token"]').val();
                var url = '{{route('admin.ajax.append.menu')}}';
                var type = $(this).data('type');
                var id = $(this).data('id');
                $.ajax({
                    url:url,
                    type:'post',
                    cache:false,
                    data:{
                        'type':type,'id':id,'_token':_token,
                    },
                    success:function(result){
                        $('#result_data').append(result).show();
                        $('.dd-empty').hide();
                        flash({'message':'Thêm mới thành công!', 'type': 'success'});
                    }
                })
            })

            $('.position').change(function(){
                var _token = $('meta[name=_token]').attr('content');
                var position = $(this).val();
                var url = "{{route('admin.change.position.menu',":position")}}".replace(':position', position);
                var html = document.getElementById('result_data');
                $.ajax({
                    url:url,
                    type:'get',
                    cache:false,
                    data:{
                        'position':position,'_token':_token,
                    },
                    success:function(result){
                        $(html).html(result).show();
                        $('.dd-empty').hide();
                        if(result.length == 0){
                            $(html).hide();
                            $('.dd-empty').show();
                        }
                    }
                })
            });

            var updateOutput = function(e)
            {
                var list   = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };
            // activate Nestable for list 1
            $('#nestable').nestable({
                group: 1,
                maxDepth:10
            })
                .on('change', updateOutput);
            // output initial serialised data
            updateOutput($('#nestable').data('output', $('#nestable-output')));

            $('#nestable').change(function(){
                val = $('#nestable-output').val();
                _token = $('input[name="_token"]').val();
                url = "{{route('admin.ajax.menu.sort')}}";
                $.ajax({
                    url:url,
                    type:"get",
                    data:{"val":val,'_token':_token},
                    cache:false,
                    success:function(result, status){
                    }
                });
            });
        });
    </script>

    <!-- Plugins js-->
    <script src="/lib/assets/libs/nestable2/jquery.nestable.min.js"></script>

@stop

