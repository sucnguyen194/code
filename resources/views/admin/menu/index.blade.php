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
                        <textarea id="nestable-output" name="menuval" style="display: none;"></textarea>
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
                            <h4 class="header-title mb-3"><b>Danh mục sản phẩm</b></h4>
                            <div class="form-groupmb mb-0">
                                @foreach($categories->where('parent_id', 0)->where('type',\App\Enums\CategoryType::product) as $item)
                                    <label class="w-100"><a href="javascript:void(0)" class="addmenu text-secondary" data-type="{{\App\Enums\CategoryType::category}}" data-id="{{$item->id}}"><span class=""><i class="fe-plus pr-1"></i>  {{$item->translation->name}}</span></a></label>
                                    {{sub_menu_category_checkbox($categories,$item->id)}}
                                @endforeach
                            </div>
                        </div>

                        <div class="card-box">
                            <h4 class="header-title mb-3"><b>Danh mục Blog</b></h4>
                            <div class="form-group mb-0">
                                @foreach($categories->where('parent_id', 0)->where('type',\App\Enums\CategoryType::post) as $item)
                                    <label class="w-100"><a href="javascript:void(0)" class="addmenu text-secondary" data-type="{{\App\Enums\CategoryType::category}}" data-id="{{$item->id}}"><i class="fe-plus pr-1"></i>  {{$item->translation->name}}</a></label>
                                    {{sub_menu_category_checkbox($categories,$item->id)}}
                                @endforeach
                            </div>
                        </div>

                        <div class="card-box">
                            <h4 class="header-title mb-3"><b>Pages</b></h4>
                            <div class="form-group mb-0">
                                @foreach($pages as $item)
                                    <label class="w-100"><a href="javascript:void(0)" class="addmenu text-secondary" data-type="{{\App\Enums\PostType::page}}" data-id="{{$item->id}}"><span class=""><i class="fe-plus pr-1"></i>  {{$item->translation->name}}</span></a></label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-box">
                            <h4 class="header-title"><b>Danh sách menu</b></h4>
                            <p class="sub-header">
                                * Danh sách menu tùy thuộc vào "vị trí" hiển thị tại thời điển hiện tại (top, bottom, left,right,home).
                            </p>

                            <div class="form-group">
                                <label><strong class="text-tranform">VI TRÍ</strong></label>
                                <select id="position" class="form-control" data-toggle="select2">
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
                                                <i class="fa fa-star pr-1" aria-hidden="true"></i> {{optional($items->translation)->name}}
                                            </div>

                                            <div class="menu_action">
                                                <a href="{{route('admin.menus.edit',$items)}}" title="Sửa" class="btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a>
                                                <a href="{{route('admin.menus.destroy',$items)}}" title="Xóa" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i> </a>
                                            </div>

                                            <ol class="dd-list">
                                                {{admin_menu_sub($menus, $items->id)}}
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

    <link href="{{asset('lib/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" />
    <link href="{{asset('lib/assets/libs/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('lib/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('lib/assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('lib/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />

    <!-- Summernote css -->
    <link href="{{asset('lib/assets/libs/summernote/summernote-bs4.css')}}" rel="stylesheet" type="text/css" />
    <!-- Plugins css -->
    <link href="/lib/assets/libs/nestable2/jquery.nestable.min.css" rel="stylesheet" type="text/css" />
@stop
@section('scripts')

    <script type="text/javascript">
        $(document).ready(function(){
            $('.addmenu').click(function(){
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
                        $('#result_data').append(result);
                        $('.dd-empty').remove();
                        flash({'message':'Thêm mới thành công!', 'type': 'success'});
                    }
                })
            })


            $('#position').change(function(){
                position = $(this).val();
                url = "{{route('admin.change.position.menu',":position")}}".replace(':position', position);
                window.location.href = url;
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

