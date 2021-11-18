<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') - {{setting('site.name',1)}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{setting('site.favicon')}}">
    @yield('styles')

    <link href="{{asset('lib/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" />
    <link href="{{asset('lib/assets/libs/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('lib/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('lib/assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('lib/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />
    <script>
        var DOMAIN = "{{asset('/')}}";
    </script>

    <!-- App css -->
    <link href="{{asset('lib/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{asset('lib/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('lib/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"  id="app-stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Cpanel css -->
    <link href="{{asset('lib/css/cpanel.css')}}" rel="stylesheet" type="text/css">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>--}}

    <script src="/lib/tinymce/tinymce.min.js"></script>
    <!-- Cpanel -->
    <script src="{{asset('lib/js/cpanel.js')}}"></script>
</head>
<body>
<!-- Begin page -->
<div id="wrapper">
    <!-- Topbar Start -->
    <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            @php
                $contact = \App\Models\Contact::whereRepId(0)->oldest('status')->latest()->get();
            @endphp
            <li class="redirect-website"><a href="{{route('home')}}" class="nav-link dropdown-toggle mr-0 waves-effect waves-light" target="_blank"><i class="fas fa-home h3 text-white"></i></a> </li>


            <li class="dropdown notification-list dropdown d-lg-inline-block"> <a class="nav-link dropdown-toggle mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">{{implode(languages()->where('value',Session::get('lang'))->pluck('name')->toArray())}} </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                @foreach(\App\Models\Language::where('value','<>',session()->get('lang'))->get() as $item)
                    <!-- item-->
                        <a href="{{route('admin.languages.change',$item->value)}}" class="dropdown-item notify-item"><span
                                class="align-middle">{{$item->name}}</span> </a>
                    @endforeach
                </div>
            </li>

            <li class="dropdown notification-list"> <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><i class="dripicons-bell noti-icon"></i> <span class="badge badge-pink rounded-circle noti-icon-badge">{{$contact->count()}}</span></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                    <div class="dropdown-header noti-title">
                        <h5 class="text-overflow m-0"><span class="float-right"> <span class="badge badge-danger float-right">{{$contact->count()}}</span> </span>Thông báo</h5>
                    </div>
                    <div class="slimscroll noti-scroll">
                        @foreach($contact->take(10) as $item)
                            <a href="{{route('admin.contacts.show',$item)}}" class="dropdown-item notify-item">
                                <div class="notify-icon rounded-circle"><img src="{{$item->avatar}}" class="rounded-circle"></div>
                                <p class="notify-details">
                                    @if($item->status == 0)
                                        <strong class="bg-danger pl-1 pr-1 text-white rounded-circle">!</strong>
                                    @endif
                                    {{$item->note ? str_limit($item->note) : 'Khách hàng yêu cầu nhận thông tin'}}<small class="text-muted">{{$item->created_at->diffForHumans()}}</small></p>
                            </a>
                            <!-- item-->
                        @endforeach
                    </div>
                    <!-- All-->
                    <a href="{{route('admin.contacts.index')}}" class="dropdown-item text-center text-primary notify-item notify-all"> Xem tất cả <i class="fi-arrow-right"></i> </a> </div>
            </li>
            <li class="dropdown notification-list"> <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <img src="{{Auth::user()->gravatar}}" alt="user-image" class="rounded-circle"> <span class="pro-user-name ml-1"> {{Auth::user()->name}} <i class="mdi mdi-chevron-down"></i> </span> </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Xin chào !</h6>
                    </div>
                    <!-- item-->
                    <a href="{{route('admin.admins.edit',Auth::id())}}" class="dropdown-item notify-item"> <i class="fe-user"></i> <span>Tài khoản</span> </a>
                    <!-- item-->
                    <a href="{{route('admin.settings')}}" class="dropdown-item notify-item"> <i class="fe-settings"></i> <span>Settings</span> </a>
                    <!-- item-->
                    {{--                    <a href="javascript:void(0);" class="dropdown-item notify-item"> <i class="fe-lock"></i> <span>Lock Screen</span> </a>--}}
                    <div class="dropdown-divider"></div>
                    <!-- item-->
                    <a href="#" onclick="document.querySelector('#logout').submit()" class="dropdown-item notify-item"> <i class="fe-log-out"></i> <span>Thoát</span> </a> </div>
                <form method="post" action="{{route('admin.logout')}}" class="d-none" id="logout">
                    @csrf
                </form>
            </li>
        </ul>
        <!-- LOGO -->
        <div class="logo-box"> <a href="" class="logo text-center"> <span class="logo-lg"> <img src="{{asset('lib/assets/images/logo-light.png')}}" alt="" height="25">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
      </span> <span class="logo-sm">
      <!-- <span class="logo-sm-text-dark">U</span> -->
      <img src="{{asset('lib/assets/images/logo-sm.png')}}" alt="" height="28"> </span> </a> </div>
        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light"> <i class="fe-menu"></i> </button>
            </li>
        </ul>
    </div>
    <!-- end Topbar -->
    <!-- ========== Left Sidebar Start ========== -->
    <div class="left-side-menu p-0">
        <div class="slimscroll-menu">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul class="metismenu" id="side-menu">
                    <li>
                        <a href="{{route('admin.dashboard')}}">
                            <i class="pe-7s-home"></i>
                            <span>Bảng điều khiển</span>
                        </a>
                    </li>
                    @can('admin.view')
                        <li>
                            <a href="javascript:void(0)">
                                <i class="pe-7s-user"></i>
                                <span>Quản trị</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="{{route('admin.admins.index')}}">Tài khoản</a>
                                </li>
                                @can('role.view')
                                    <li>
                                        <a href="{{route('admin.roles.index')}}">Phân quyền</a>
                                    </li>
                                @endcan
                                @can('permission.view')
                                    <li>
                                        <a href="{{route('admin.permissions.index')}}">Quyền hạn</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('menu.view')
                        <li>
                            <a href="{{route('admin.menus.index')}}">
                                <i class="pe-7s-menu"></i>
                                <span>Menu</span>
                            </a>
                        </li>
                    @endcan
                    @can('photo.view')
                        <li>
                            <a href="{{route('admin.photos.index')}}">
                                <i class="pe-7s-photo-gallery"></i>
                                <span>Hình ảnh</span>
                            </a>
                        </li>
                    @endcan
                    @canany(['contact.view','support.view'])
                        <li>
                            <a href="javascript:void(0)">
                                <i class="pe-7s-micro"></i>
                                <span>Hỗ trợ</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                @can('support.view')
                                <li>
                                    <a href="{{route('admin.supports.customers.index')}}">Ý kiến khách hàng</a>
                                </li>

                                <li>
                                    <a href="{{route('admin.supports.index')}}">Đội ngũ hỗ trợ</a>
                                </li>
                                @endcan
                                    @can('contact.view')
                                <li>
                                    <a href="{{route('admin.contacts.index')}}">Tin nhắn</a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('comment.view')
                        <?php
                            $comments = \App\Models\Comment::whereStatus(\App\Enums\ActiveDisable::disable)->get();
                        ?>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="pe-7s-comment"></i>
                                <span>Bình luận</span>
                                <span class="menu-arrow"></span>
                               @if($comments->count()) <span class="badge badge-danger badge-pill">{{$comments->count()}}</span>@endif
                                <ul class="nav-second-level" aria-expanded="false">
                                    @can('blog.view')
                                        <li>
                                            <a href="{{route('admin.comments.list','posts')}}">Bài viết <span class="badge badge-danger badge-pill">{{$comments->where('comment_type',\App\Enums\CommentMap::posts)->count()}}</span></a>
                                        </li>
                                    @endcan
                                    @can('product.view')
                                        <li>
                                            <a href="{{route('admin.comments.list','products')}}">Sản phẩm <span class="badge badge-danger badge-pill">{{$comments->where('comment_type',\App\Enums\CommentMap::products)->count()}}</span></a>
                                        </li>
                                    @endcan
                                </ul>
                            </a>
                        </li>
                    @endcan
                    @canany(['blog.view', 'video.view','gallery.view'])
                    <li class="menu-title">Nội dung</li>
                    @endcan
                    @can('blog.view')
                        <li class="">
                            <a href="javascript:void(0)">
                                <i class="pe-7s-news-paper"></i>
                                <span>Blog</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                @can('blog.create')
                                    <li>
                                        <a href="{{route('admin.posts.create')}}">Thêm bài viết</a>
                                    </li>
                                @endcan
                                <li>
                                    <a href="{{route('admin.posts.index')}}">Danh sách bài viết</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.posts.categories.index')}}">Danh mục bài viết</a>
                                </li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="javascript:void(0)">
                                <i class="pe-7s-wallet"></i>
                                <span>Page</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="{{route('admin.posts.pages.create')}}">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.posts.pages.index')}}">Danh sách bài viết</a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can('gallery.view')
                        <li>
                            <a href="{{route('admin.products.galleries.index')}}">
                                <i class="pe-7s-albums"></i>
                                <span>Thư viện</span>
                            </a>
                        </li>
                    @endcan
                    @can('video.view')
                        <li>
                            <a href="{{route('admin.products.videos.index')}}">
                                <i class="pe-7s-video"></i>
                                <span>Video</span>
                            </a>
                        </li>
                    @endcan

                    @canany(['product.view', 'discount.view','order.view','user.view'])
                    <li class="menu-title">Bán hàng</li>
                    @endcan
                    @can('product.view')
                        <li>
                            <a href="javascript:void(0)">
                                <i class="pe-7s-plugin"></i>
                                <span>Sản phẩm</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                @can('product.create')
                                    <li>
                                        <a href="{{route('admin.products.create')}}">Thêm mới</a>
                                    </li>
                                @endcan
                                <li>
                                    <a href="{{route('admin.products.index')}}">Danh sách sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.products.categories.index')}}">Danh mục sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.attributes.index')}}">Phân loại sản phẩm</a>
                                </li>

                            </ul>
                        </li>
                    @endcan

                    @can('discount.view')
                        <li>
                            <a href="{{route('admin.discounts.index')}}">
                                <i class="pe-7s-bandaid"></i>
                                <span>Mã giảm giá</span>
                            </a>
                        </li>
                    @endcan

                    @can('order.view')
                        <li>
                            <a href="{{route('admin.orders.index')}}">
                                <i class="pe-7s-cart"></i>
                                <span>Đơn hàng</span>
                            </a>
                        </li>
                    @endcan

                    @can('user.view')
                        <li>
                            <a href="{{route('admin.users.index')}}">
                                <i class="pe-7s-users"></i>
                                <span>Khách hàng</span>
                            </a>
                        </li>
                    @endcan

                    @can('setting.update')
                        <li class="menu-title">Cấu hình</li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="pe-7s-global"></i>
                                <span>Website</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="{{route('admin.settings')}}">Cấu hình hệ thống</a>
                                </li>

                                @can('setting.source')
                                    <li>
                                        <a href="{{route('admin.sources.index')}}">Sửa website</a>
                                    </li>
                                @endcan
                                @can('setting.language')
                                    <li>
                                        <a href="{{route('admin.languages.index')}}">Ngôn ngữ</a>
                                    </li>
                                @endcan


                            </ul>
                        </li>
                    <li>
                        <a href="{{route('admin.logs')}}">
                            <i class="pe-7s-attention"></i>
                            <span>System Logs</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
            <!-- End Sidebar -->
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -left -->
    </div>
    <!-- Left Sidebar End -->
    <style>
        #sidebar-menu>ul>li>a i {
            font-size: 1.3rem;
        }
    </style>
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
        @yield('content')
        <!-- end container-fluid -->
        </div>
        <!-- end content -->
        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12"> Admin Cpanel - Support <a href="https://www.facebook.com/thietkewebsitegiare247194" target="_blank">Facebook</a> </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
</div>
<!-- END wrapper -->
<style>
    .loading {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0, 0.9);
        z-index: 9999;
    }
    .loading .sk-cube-grid {
        position: absolute;
        top: 40%;
        left: 0;
        right: 0;
        bottom: 0;
    }
    .sk-cube-grid .sk-cube {
        background-color: #4d97c1!important;
    }
</style>
<div class="loading">
    <div class="sk-cube-grid">
        <div class="sk-cube sk-cube1"></div>
        <div class="sk-cube sk-cube2"></div>
        <div class="sk-cube sk-cube3"></div>
        <div class="sk-cube sk-cube4"></div>
        <div class="sk-cube sk-cube5"></div>
        <div class="sk-cube sk-cube6"></div>
        <div class="sk-cube sk-cube7"></div>
        <div class="sk-cube sk-cube8"></div>
        <div class="sk-cube sk-cube9"></div>
    </div>
</div>
<!-- Vendor js -->
<script src="{{asset('lib/assets/js/vendor.min.js')}}"></script>

<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.js"></script>
<script src="//rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/extensions/cookie/bootstrap-table-cookie.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/extensions/page-jump-to/bootstrap-table-page-jump-to.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.1/dist//locale/bootstrap-table-vi-VN.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-treegrid/0.2.0/css/jquery.treegrid.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-treegrid/0.2.0/js/jquery.treegrid.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/extensions/treegrid/bootstrap-table-treegrid.js"></script>


<script src="{{asset('lib/assets/libs/switchery/switchery.min.js')}}"></script>
<script src="{{asset('lib/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
<script src="https://coderthemes.com/adminox/layouts/vertical/assets/libs/select2/select2.min.js"></script>
<script src="{{asset('lib/assets/libs/jquery-mockjax/jquery.mockjax.min.js')}}"></script>
<script src="{{asset('lib/assets/libs/autocomplete/jquery.autocomplete.min.js')}}"></script>
<script src="{{asset('lib/assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{asset('lib/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('lib/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('lib/assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js')}}"></script>

<!-- Init js-->
<script src="{{asset('lib/assets/js/pages/form-advanced.init.js')}}"></script>

<!-- App js -->
<script src="{{asset('lib/assets/js/app.min.js')}}"></script>
<!-- javascript -->
<link href="/lib/assets/libs/spinkit/spinkit.css" rel="stylesheet" type="text/css" >
<!-- Tost-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/locale/vi.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="/lib/assets/libs/tooltipster/tooltipster.bundle.min.js"></script>

@include('errors.note')
<style>
    .clearfix {
        clear: left;
    }
</style>
<script>
    moment.locale('vi');
    function defaultQueryParams(params){
        params.start = params.offset;
        params.length = params.limit;

        $.each($('.filter-form').serializeArray(), function( index, value ) {
            params[value.name] = value.value;
        });
        return params;
    }

    $table = jQuery('.bs-table');

    $.extend( jQuery.fn.bootstrapTable.defaults, {
        responseHandler: function(res) {
            if (this.sidePagination=='server'){

                return {
                    rows: res.data,
                    total: res.recordsFiltered
                }
            }else{
                return res.data || res;
            }
        },
        pagination: true,
        showColumns: true,
        silentSort: false,
        showRefresh: true,
        pageList: [ 10, 25, 50, 100, 200, 500, 1000],
        pageSize: 25,
        searchOnEnterKey: true,
        showSearchButton: true,
        cookie: true,
        cookieExpire: '1m',
        cookieStorage: 'localStorage',
        //     cookiesEnabled:['bs.table.sortOrder', 'bs.table.sortName',  'bs.table.columns'],
        cookiesEnabled:['bs.table.columns'],
        exportDataType: 'basic',
        showExport: 'true',
        exportTypes: ['csv', 'txt', 'excel'],
        buttonsClass: 'default',
        formatSearch: function () {
            return 'Tìm kiếm';
        },
        formatNoMatches () {
            return 'Không có dữ liệu'
        },
        rowStyle: function (row, index) {
            if (row.deleted_at)
                return {
                    css: {
                        'text-decoration': 'line-through'
                    }
                };
            return {};
        },
        queryParams: 'defaultQueryParams',
    });

    $table.bootstrapTable({
        exportOptions:{
            fileName:$table.data('filename')+'_'+Date.now(),
            ignoreColumn: ['action']
        }
    }).on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table load-success.bs.table', function () {
        $('.enableonselect').prop('disabled', !$table.bootstrapTable('getSelections').length);
        $('.showonselect').toggle($table.bootstrapTable('getSelections').length>0);
    });

    $('.table-filter').on('change', function(){
        $table.bootstrapTable('refresh');
    });

    $('.table-filter-input').on('input', function(){
        $table.bootstrapTable('refresh');
    });

    $('.filter-form').on('submit',(function(){
        event.preventDefault();
        $table.bootstrapTable('refresh');
    })).on('reset',(function(){
        setTimeout(function() {
            $table.bootstrapTable('refresh');
        },500);

    }));
</script>
<script type="text/javascript">
    var links = "{{route('home')}}";

    $(document).ready(function(){
        tinymce.init({
            language : 'vi',
            plugins: "wordcount textcolor code preview image  link  anchor   charmap media   lists responsivefilemanager",
            toolbar: [
                'preview code | fontsizeselect | bold italic underline strikethrough  | alignleft aligncenter alignright alignjustify | removeformat',

            ],

            height : "150",
            menubar: true,
            wordcount_countregex: /[\w\u2019\x27\-\u00C0-\u1FFF]+/g,
            wordcount_cleanregex: /[0-9.(),;:!?%#$?\x27\x22_+=\\\/\-]*/g,
            textcolor_cols: 6,
            textcolor_map: [
                'FFF', 'White', 'CCC', 'Light gray', '999', 'Gray2', '666', 'Gray3', '333', 'Dark gray', '000', 'Black',
                'F00', 'Red', '00F', 'Blue', '0F0', 'Green', 'F90', 'Orange', 'FF0', 'Yellow', '0FF', 'Cyan',
                'F0F', 'Magento', '930', 'Burnt orange', '330', 'Dark olive', '030', 'Dark green', '036', 'Dark azure'
            ],
            textcolor_rows: 5,
            fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 22px 24px 26px 28px 30px 35px 40px 45px 50px",
            style_formats: [
                {title: "Header 1", format: "h1"},
                {title: "Header 2", format: "h2"},
                {title: "Header 3", format: "h3"},
                {title: "Header 4", format: "h4"},
                {title: "Header 5", format: "h5"},
                {title: "Header 6", format: "h6"},
                {title: "Paragraph", format: "p"},
                {title: "Blockquote", format: "blockquote"},
                {title: "Div", format: "div"},
                {title: "Pre", format: "pre"}
            ],
            // content_css: [
            //     '/public/css/app.css'
            // ],
            link_class_list: [
                {title: 'Geen', value: ''}
            ],
            table_class_list: [
                {title: 'Tabel', value: 'table'},
                {title: 'Table Style', value: 'table-style'}
            ],
            relative_urls: false,
            selector: ".summerdescription",
            image_advtab: true,
            filemanager_title: "Filemanager",
            external_filemanager_path: links+"/lib/filemanager/",
            external_plugins: {"filemanager": links+"/lib/filemanager/plugin.min.js"}
        });

    });
</script>
<script type="text/javascript">
    var links = "{{route('home')}}";

    $(document).ready(function(){
        tinymce.init({
            language : 'vi',
            plugins: "wordcount textcolor image link hr preview anchor code insertdatetime charmap media table print lists responsivefilemanager",
            toolbar: [
                'preview code | styleselect | bold italic underline strikethrough subscript superscript charmap | anchor link unlink image media | forecolor backcolor | cut copy paste | alignleft aligncenter alignright alignjustify | table | bullist numlist outdent indent | removeformat | undo redo | fontsizeselect | hr insertdatetime print | newdocument | responsivefilemanager',
            ],
            height : "500",
            menubar: true,
            wordcount_countregex: /[\w\u2019\x27\-\u00C0-\u1FFF]+/g,
            wordcount_cleanregex: /[0-9.(),;:!?%#$?\x27\x22_+=\\\/\-]*/g,
            textcolor_cols: 6,
            textcolor_map: [
                'FFF', 'White', 'CCC', 'Light gray', '999', 'Gray2', '666', 'Gray3', '333', 'Dark gray', '000', 'Black',
                'F00', 'Red', '00F', 'Blue', '0F0', 'Green', 'F90', 'Orange', 'FF0', 'Yellow', '0FF', 'Cyan',
                'F0F', 'Magento', '930', 'Burnt orange', '330', 'Dark olive', '030', 'Dark green', '036', 'Dark azure'
            ],
            textcolor_rows: 5,
            fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 22px 24px 26px 28px 30px 35px 40px 45px 50px",
            style_formats: [
                {title: "Header 1", format: "h1"},
                {title: "Header 2", format: "h2"},
                {title: "Header 3", format: "h3"},
                {title: "Header 4", format: "h4"},
                {title: "Header 5", format: "h5"},
                {title: "Header 6", format: "h6"},
                {title: "Paragraph", format: "p"},
                {title: "Blockquote", format: "blockquote"},
                {title: "Div", format: "div"},
                {title: "Pre", format: "pre"}
            ],
            // content_css: [
            //     '/public/css/app.css'
            // ],

            link_class_list: [
                {title: 'Geen', value: ''}
            ],
            table_class_list: [
                {title: 'Tabel', value: 'table'},
                {title: 'Table Style', value: 'table-style'}
            ],

            relative_urls: false,
            selector: ".summernote",
            image_advtab: true,
            filemanager_title: "Filemanager",
            external_filemanager_path: links+"/lib/filemanager/",
            external_plugins: {"filemanager": links+"/lib/filemanager/plugin.min.js"}
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('select:not(".select2-multiple")').each(function() {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: $(this).data('placeholder'),
            }).on('change', function(e){
                var data = $(this).find('option:selected').text();
                var text = data.replaceAll(/\xA0/g, "");
                $(this).closest('.form-group').find('.select2-selection__rendered').text(text);
            });

            var text = $(this).find('option:selected').text();
            text = text.replaceAll(/\xA0/g, "");
            test =  $(this).closest('.form-group').find('.select2-selection__rendered').text();
            //console.log(test);
        });

        $("select.select2-multiple").on("select2:select select2:unselect", function (e) {
            var li = $('li.select2-selection__choice');

            $.each(li, function (index, value) {
                var html = $(value).html();
                html = html.replaceAll('&nbsp;', "");
                 $(value).html(html);
            })
        })
        var li = $('li.select2-selection__choice');

        $.each(li, function (index, value) {
            var html = $(value).html();
            html = html.replaceAll('&nbsp;', "");
            $(value).html(html);
        })
    })
</script>

<script type="text/javascript">
    $('#slider-file').on('change', function () {

        let count = $(this)[0].files.length;
        let slider = $('.slider-holder');
        let  imgur_client_id = "{{setting('api.imgur_client_id')}}";

        if(!imgur_client_id)
            return flash({'message': 'API IMG chưa được cấu hình!', 'type': 'error'});

        for(var i=0 ; i < count ; i++){
            let file = $(this).prop('files')[i];
            if (!file)
                return false;

            let formData = new FormData();
            formData.append('image', file);
            $('.loading').fadeIn();
            fetch(
                "https://api.imgur.com/3/image",
                {
                    method: "POST",
                    body: formData,
                    "headers": {
                        "Authorization": "Client-ID "+ imgur_client_id
                    },
                }
            )
                .then(response => response.json())
                .then(result => {
                    $(slider).removeClass('d-none').addClass('d-inline-block');

                    $('<li class="box-product-images">' +
                        '<div class="item-image position-relative">' +
                        '<div class="img-rounded"><img src="'+result.data.link+'" class="position-image-product"/></div>' +
                        '<input name="photos[]" type="hidden" value="'+ result.data.link +'">' +
                        '<div class="photo-hover-overlay">' +
                        '<div class="box-hover-overlay">' +
                        '<a class="tooltip-hover view-image text-white" data-image="'+result.data.link+'" data-toggle="modal" data-target="#viewImage" title="Xem hình ảnh">' +
                        '<i class="far fa-eye"></i>' +
                        '</a>' +
                        '<a class="pl-2 tooltip-hover text-white" id="slider-delete" title="Xóa hình ảnh">' +
                        '<i class="far fa-trash-alt"></i>' +
                        '</a>' +
                        '</div> '+
                        '</div>' +
                        '</div>' +
                        '</li>').appendTo(slider);
                    $('#remove-label').removeClass('d-block').hide();
                    $('.loading').fadeOut();
                })
                .catch(error => {
                    $('#remove-label').show();
                    $(slider).addClass('d-none');

                    var obj  = {
                        'message': 'Lỗi upload: '+error,
                        'type' :'error'
                    };
                    flash(obj);
                });
        }

    });

    $(document).on('click','#slider-delete',function(){
        let slider = document.getElementsByClassName('slider-holder');
        let remove = document.getElementById('remove-label');
        $(this).parent().parent().parent().parent().remove();

        if($(slider).children().length == 0){
            $(slider).addClass('d-none').removeClass('d-inline-block');
            $(remove).removeClass('d-none').show();
        }
    })
    $(document).on('change','#slider-input',function(){

        let parent = $(this).parent().parent().parent().parent();

        $(parent).find('div > img').attr('src', $(this).val());
    })


    $('.logo-upload, .og-upload, .favicon-upload, .image-upload, .background-upload').on('change', function () {
        let file = $(this).prop('files')[0];
        let  imgur_client_id = "{{setting('api.imgur_client_id')}}";
        if (!file)
            return false;
        if(!imgur_client_id)
            return flash({'message': 'API IMG chưa được cấu hình!', 'type': 'error'});

        let target = $(this).data('target');

        let formData = new FormData();
        formData.append('image', file);
        $('.loading').fadeIn();
        fetch(
            "https://api.imgur.com/3/image",
            {
                method: "POST",
                body: formData,
                "headers": {
                    "Authorization": "Client-ID " + imgur_client_id
                },
            }
        )
            .then(response => response.json())
            .then(result => {
                $(target).val(result.data.link).trigger('change');
                $('.loading').fadeOut();
            })
            .catch(error => {
                var obj  = {
                    'message': 'Lỗi upload: '+error,
                    'type' :'error'
                };
                flash(obj);
            });

    });

    $('.logo-src, .og-src, .favicon-src, .image-src, .background-src').on('change', function (){

        let target = $(this).data('target');
        let  hidden = $(this).data('hidden');
        if ($(this).val()){
            $(target).removeClass('d-none').attr('src', $(this).val()).show();
            $(hidden).hide();
        }else{
            $(target).hide();
            $(hidden).removeClass('d-none').show();
        }
    });
</script>
<script>
    $('.ajax-modal').off('dblclick');
    $(document).on('click','.ajax-modal',function(e){
        e.preventDefault();

        $('select').each(function() {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: $(this).data('placeholder'),
            });
        });

        $(e.target).attr('disabled',true);
        $(e.target).addClass('disabled');

        $remote=$(this).data('remote')||$(this).attr('href');
        $('#ajax-modal, .modal-backdrop').remove();
        $modal=$('<div class="modal fade" id="ajax-modal" tabindex="-1" role="dialog"></div>');
        $('body').append($modal);
        /*
        $modal.load($remote,function(){
            $modal.modal();
        });
  */
        $modal.load($remote,function(text,status,xhr){

            $(e.target).attr('disabled',false);
            $(e.target).removeClass('disabled');
            try{
                flash(jQuery.parseJSON( text ));
            }catch{
                $modal.modal();
            }

        });

        return false;
    });

    $('.ajax-link').off('dblclick');

    $(document).on('click','.ajax-link',function(e){
        e.preventDefault();
        if($(this).data('confirm')){
            Swal.fire({
                title: 'Bạn có chắc không?',
                text:  $(this).data('confirm'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Quay lại',
                confirmButtonText: 'Xác nhận',
            }).then((result) => {
                if (result.isConfirmed) {
                ajaxlink(this);
            }
        })
        }else{
            ajaxlink(this);
        }
    });
    function ajaxlink(ele){
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
            dataType: 'json'
        }).done(function( result ) {
            flash(result);
            if($this.data('refresh')){
                $table.bootstrapTable('refresh',{silent: true});
            }
            if($this.data('row')){
                $(e.target).parents('tr').remove();
            }
            $('#ajax-modal').modal('hide');
        });

        return false;
    }
</script>

<script type="text/javascript">
    // Ajax form
    function ajaxform(ele){

        $(ele).ajaxSubmit({
            headers: {
                "X-CSRF-Token": $('meta[name=_token]').attr('content')
            },
            beforeSubmit:function(formData, jqForm, options){
                $(ele).find('[type=submit]').attr('disabled', true);

            },
            success: function(responseText, statusText, xhr, $form) {


            },
            error: function(xhr, status, errMsg, $form) {

            },
            complete: function(xhr, statusText, $form  ){

                $(ele).find('[type=submit]').attr('disabled', false);

                let result = xhr.responseText;

                try{
                    result = $.parseJSON(result);
                }catch{
                    console.log('invalid json response');
                    $('#ajax-modal').html(result).modal();
                    return;
                }

                flash(result);

                if(result.type=='success' || result.type=='info'){

                    if($form.data('reset')==true)
                        $form.resetForm();

                    $('#ajax-modal').modal('hide');

                    try{
                        $table.bootstrapTable('refresh',{silent: true});
                    }catch{}
                }

            }

        });
        return false;
    }
    $(document).on('submit','.ajax-form',function(e){
        e.preventDefault();

        ajaxform(this);
        return false;
    });
</script>

<script>
    function sumFormatter(data) {
        field = this.field;
        var total_sum = data.reduce(function(sum, row) {
            let value= 0
            try{
                value = eval('row.'+field) || 0;
            }catch{

            }

            return (sum) + parseFloat(value.toString().replace(/,/g,'').replace('$','') || 0);
        }, 0);


        type = this.type;
        if(type)
            return window[type+'Formatter'](total_sum);
        else
            return total_sum;
    }

    function avgFormatter(data) {
        field = this.field;
        var i=0;
        var total_sum = data.reduce(function(sum, row) {
            i++;
            return (sum) + parseFloat(row[field].replace(/,/g,'').replace('$','').replace('%','') || 0);
        }, 0);

        total_sum = total_sum/i;

        type = this.type;
        if(type)
            total_sum =  window[type+'Formatter'](total_sum);

        return total_sum+'%';
    }

    function numberFormatter(value,row){
        if(value != null)
            return Number(value).toLocaleString('en-US');
    }
    function shortDateTimeFormatter(value, row, index) {
        if(value)
            return moment(value).format('DD/MM HH:mm');
    }
</script>
<script>
    $('.datetimepicker').daterangepicker({
        singleDatePicker: true,
        //    drops: 'up',
        timePicker: true,
        timePickerSeconds: true,
        timePicker24Hour: true,
        showDropdowns: true,
        autoUpdateInput: false,
        allowClear: true,

    }).on('cancel.daterangepicker',function () {
        $(this).val('');
    }).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY HH:mm:ss'));
    });
</script>
<script type="text/javascript">
    function initEvents(){
        $('.tooltip-hover').each(function(){
            $(this).tooltipster();
        })
    }
    initEvents();
</script>
<script type="text/javascript">
    $(window).on('load',function() {
        $('.loading').fadeOut();
    });
</script>
<script type="text/javascript">
    function ChangeToSlug(el)
    {
        var title, slug;
        //Lấy text từ thẻ input title
        title = el.value;
        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById(el.getAttribute('language')).value = slug;
        document.getElementById(el.getAttribute('seo')).innerText = DOMAIN + slug + '.html';
    }
</script>

<script>
    function changeToTitleSeo(el){
       return  document.getElementById(el.getAttribute('language')).innerText = el.value;
    }
    function changeToDescriptionSeo(el){
      return  document.getElementById(el.getAttribute('language')).innerText = el.value;
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','input[name=sort]',function () {
            url = "{{route('admin.ajax.data.sort')}}";
            id = $(this).attr('data-id');
            num = $(this).val();
            type = $('input.type').val();
            _token = $('input[name=_token]').val();
            $.ajax({
                url:url,
                type:'GET',
                cache:false,
                data:{'_token':_token,'id':id,'num':num,'type':type},
                success:function(data){
                    flash({'message': 'Cập nhật thành công', 'type': 'success'})
                }
            });
        })

        $(document).on('click', '.data_status', function(){
            url = "{{route('admin.ajax.data.status')}}";
            id = $(this).attr('data-id');
            _token = $('input[name=_token]').val();
            type = $('input.type').val();
            $.ajax({
                url:url,
                type:'GET',
                cache:false,
                data:{'_token':_token,'id':id,'type':type},
                success:function(data){
                    flash({'message': 'Cập nhật thành công', 'type': 'success'})
                }
            });
        })
        $(document).on('click', '.data_public', function(){
            url = "{{route('admin.ajax.data.public')}}";
            id = $(this).attr('data-id');
            _token = $('input[name=_token]').val();
            type = $('input.type').val();
            $.ajax({
                url:url,
                type:'GET',
                cache:false,
                data:{'_token':_token,'id':id,'type':type},
                success:function(data){
                    flash({'message': 'Cập nhật thành công', 'type': 'success'})
                }
            });
        })
    })
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

@yield('scripts')
</body>
</html>
