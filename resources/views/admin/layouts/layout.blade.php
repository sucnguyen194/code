<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <title>@yield('title') - {{setting('site.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{setting('site.favicon')}}">
    @yield('styles')

    <link href="/lib/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet"/>
    <link href="/lib/assets/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
    <link href="/lib/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="/lib/assets/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
    <link href="/lib/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript">
        var links = "{{route('home')}}";
        var language = "{{session('lang')}}";
    </script>

    <!-- App css -->
    <link href="/lib/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet"/>
    <link href="/lib/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="/lib/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Cpanel css -->
    <link href="/lib/css/cpanel.css" rel="stylesheet" type="text/css">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    {{--    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>--}}
    {{--    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>--}}
    <script src="/lib/tinymce/tinymce.min.js"></script>
    <!-- Cpanel -->
    <script src="/lib/js/cpanel.js"></script>
</head>
<body>
<!-- Begin page -->
<div id="wrapper">
    <!-- Topbar Start -->
    <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            <li class="redirect-website"><a href="{{route('home')}}"
                                            class="nav-link dropdown-toggle mr-0 waves-effect waves-light"
                                            target="_blank"><i class="fas fa-home h3 text-white"></i></a></li>


            <li class="dropdown notification-list dropdown d-lg-inline-block"><a
                    class="nav-link dropdown-toggle mr-0 waves-effect waves-light" data-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false"
                    aria-expanded="false">{{implode($languages->where('value',Session::get('lang'))->pluck('name')->toArray())}} </a>
                @if(setting('site.languages'))
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    @foreach($languages->where('value','<>',session()->get('lang')) as $item)
                        <!-- item-->
                            <a href="{{route('admin.languages.change',$item->value)}}"
                               class="dropdown-item notify-item"><span
                                    class="align-middle">{{$item->name}}</span> </a>
                        @endforeach
                    </div>
                @endif
            </li>

            <li class="dropdown notification-list"><a class="nav-link dropdown-toggle  waves-effect waves-light"
                                                      data-toggle="dropdown" href="#" role="button"
                                                      aria-haspopup="false" aria-expanded="false"><i
                        class="dripicons-bell noti-icon"></i> <span
                        class="badge badge-pink rounded-circle noti-icon-badge">{{$contacts->count()}}</span></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                    <div class="dropdown-header noti-title">
                        <h5 class="text-overflow m-0"><span class="float-right"> <span
                                    class="badge badge-danger float-right">{{$contacts->count()}}</span> </span>{{__('lang.notify')}}
                        </h5>
                    </div>
                    <div class="slimscroll noti-scroll">
                        @foreach($contacts->take(10) as $item)
                            <a href="{{route('admin.contacts.show',$item)}}" class="dropdown-item notify-item">
                                <div class="notify-icon rounded-circle"><img src="{{$item->avatar}}"
                                                                             class="rounded-circle"></div>
                                <p class="notify-details">
                                    @if($item->status == 0)
                                        <strong class="bg-danger pl-1 pr-1 text-white rounded-circle">!</strong>
                                    @endif
                                    {{$item->note ? str_limit($item->note) : __('_customer_request_to_receive_infomation')}}
                                    }<small class="text-muted">{{$item->created_at->diffForHumans()}}</small></p>
                            </a>
                            <!-- item-->
                        @endforeach
                    </div>
                    <!-- All-->
                    <a href="{{route('admin.contacts.index')}}"
                       class="dropdown-item text-center text-primary notify-item notify-all"> {{__('lang.view_all')}} <i
                            class="fi-arrow-right"></i> </a></div>
            </li>
            <li class="dropdown notification-list"><a
                    class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false"> <img
                        src="{{Auth::user()->gravatar}}" alt="user-image" class="rounded-circle"> <span
                        class="pro-user-name ml-1"> {{Auth::user()->name}} <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{Auth::user()->name}} !</h6>
                    </div>
                    <!-- item-->
                    <a href="{{route('admin.admins.edit',Auth::id())}}" class="dropdown-item notify-item"> <i
                            class="fe-user"></i> <span>{{__('_account')}}</span> </a>
                    <!-- item-->
                    <a href="{{route('admin.settings')}}" class="dropdown-item notify-item"> <i class="fe-settings"></i>
                        <span>{{__('_setting')}}</span> </a>
                    <!-- item-->
                    <div class="dropdown-divider"></div>
                    <!-- item-->
                    <a href="#" onclick="document.querySelector('#logout').submit()" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i> <span>{{__('lang.logout')}}</span> </a></div>
                <form method="post" action="{{route('admin.logout')}}" class="d-none" id="logout">
                    @csrf
                </form>
            </li>
        </ul>
        <!-- LOGO -->
        <div class="logo-box"><a href="#" class="logo text-center"> <span class="logo-lg"> <img
                        src="{{asset('lib/assets/images/logo-light.png')}}" alt="" height="25">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
      </span> <span class="logo-sm">
      <!-- <span class="logo-sm-text-dark">U</span> -->
      <img src="{{asset('lib/assets/images/logo-sm.png')}}" alt="" height="28"> </span> </a></div>
        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light"><i class="fe-menu"></i></button>
            </li>
        </ul>
    </div>
    <!-- end Topbar -->
    <!-- ========== Left Sidebar Start ========== -->
    <div class="left-side-menu p-0">
        <div class="slimscroll-menu">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                @include('admin.layouts.partials.menu')
            </div>
            <!-- End Sidebar -->
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -left -->
    </div>
    <!-- Left Sidebar End -->
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
                    <div class="col-md-12"> Admin Cpanel - Support <a
                            href="https://www.facebook.com/thietkewebsitegiare247194" target="_blank">Facebook</a></div>
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
        background: rgba(0, 0, 0, 0.9);
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
        background-color: #4d97c1 !important;
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
<script src="/lib/assets/js/vendor.min.js"></script>


<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.js"></script>
<script src="//rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/extensions/cookie/bootstrap-table-cookie.min.js"></script>
<script
    src="https://unpkg.com/bootstrap-table@1.18.1/dist/extensions/page-jump-to/bootstrap-table-page-jump-to.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.1/dist//locale/bootstrap-table-vi-VN.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-treegrid/0.2.0/css/jquery.treegrid.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-treegrid/0.2.0/js/jquery.treegrid.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/extensions/treegrid/bootstrap-table-treegrid.js"></script>


<script src="/lib/assets/libs/switchery/switchery.min.js"></script>
<script src="/lib/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="https://coderthemes.com/adminox/layouts/vertical/assets/libs/select2/select2.min.js"></script>
<script src="/lib/assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
<script src="/lib/assets/libs/autocomplete/jquery.autocomplete.min.js"></script>
<script src="/lib/assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
<script src="/lib/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="/lib/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="/lib/assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

<!-- Init js-->
<script src="/lib/assets/js/pages/form-advanced.init.js"></script>

<!-- App js -->
<script src="/lib/assets/js/app.min.js"></script>
<!-- javascript -->
<link href="/lib/assets/libs/spinkit/spinkit.css" rel="stylesheet" type="text/css">
<!-- Tost-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/locale/vi.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"
        integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css"
      integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA=="
      crossorigin="anonymous" referrerpolicy="no-referrer"/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/lib/assets/libs/tooltipster/tooltipster.bundle.min.js"></script>
<script src="/lib/assets/libs/tooltipster/tooltipster.bundle.min.js"></script>
<script src="/lib/assets/js/pages/tooltipster.init.js"></script>

@include('errors.note')
<style>
    .clearfix {
        clear: left;
    }
</style>
<script type="text/javascript">
    moment.locale('{{session('lang')}}');

    function defaultQueryParams(params) {
        params.start = params.offset;
        params.length = params.limit;

        $.each($('.filter-form').serializeArray(), function (index, value) {
            params[value.name] = value.value;
        });
        return params;
    }

    $table = jQuery('.bs-table');

    $.extend(jQuery.fn.bootstrapTable.defaults, {
        responseHandler: function (res) {
            if (this.sidePagination == 'server') {

                return {
                    rows: res.data,
                    total: res.recordsFiltered
                }
            } else {
                return res.data || res;
            }
        },
        pagination: true,
        showColumns: true,
        silentSort: false,
        showRefresh: true,
        pageList: [10, 25, 50, 100, 200, 500, 1000],
        pageSize: 25,
        searchOnEnterKey: true,
        showSearchButton: true,
        cookie: true,
        cookieExpire: '1m',
        cookieStorage: 'localStorage',
        cookiesEnabled: ['bs.table.columns'],
        exportDataType: 'basic',
        showExport: 'true',
        exportTypes: ['csv', 'txt', 'excel'],
        buttonsClass: 'default',
        formatSearch: function () {
            return '{{__('_search')}}';
        },
        formatNoMatches() {
            return '{{__('_no_data')}}';
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
        exportOptions: {
            fileName: $table.data('filename') + '_' + Date.now(),
            ignoreColumn: ['action']
        }
    }).on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table load-success.bs.table', function () {
        $('.enableonselect').prop('disabled', !$table.bootstrapTable('getSelections').length);
        $('.showonselect').toggle($table.bootstrapTable('getSelections').length > 0);
    });

    $('.table-filter').on('change', function () {
        $table.bootstrapTable('refresh');
    });

    $('.table-filter-input').on('input', function () {
        $table.bootstrapTable('refresh');
    });

    $('.filter-form').on('submit', (function () {
        event.preventDefault();
        $table.bootstrapTable('refresh');
    })).on('reset', (function () {
        setTimeout(function () {
            $table.bootstrapTable('refresh');
        }, 500);

    }));
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("select.select2-multiple").on("select2:select select2:unselect", function (e) {
            var li = $('li.select2-selection__choice');

            $.each(li, function (index, value) {
                var html = $(value).html();
                html = html.replaceAll('&nbsp;', "");
                $(value).html(html);
            })
        });

        var li = $('li.select2-selection__choice');

        $.each(li, function (index, value) {
            var html = $(value).html();
            html = html.replaceAll('&nbsp;', "");
            $(value).html(html);
        })

        $('select').not(".select2-multiple").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: $(this).data('placeholder'),
            }).on('change', function (e) {
                var span = $('span.select2-selection__rendered');

                $.each(span, function (index, value) {
                    var html = $(value).html();
                    html = html.replaceAll('&nbsp;', "");
                    $(value).html(html);
                });
            });

            var _selected = $('span.select2-selection__rendered');

            $.each(_selected, function (i, v) {
                var _html = $(v).html();
                $(v).html(_html.replaceAll('&nbsp;', ''));
            });
        });
    })
</script>
<script type="text/javascript">
    $('#slider-file').on('change', function () {

        let count = $(this)[0].files.length;
        let slider = $('.slider-holder');
        let imgur_client_id = "{{setting('api.imgur_client_id')}}";

        if (!imgur_client_id)
            return flash({'message': '{{__("_api_not_configured")}}', 'type': 'error'});

        for (var i = 0; i < count; i++) {
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
                        "Authorization": "Client-ID " + imgur_client_id
                    },
                }
            ).then(response => response.json()
        ).
            then(result => {
                $(slider).removeClass('d-none').addClass('d-inline-block');

            $('<li class="box-product-images">' +
                '<div class="item-image position-relative">' +
                '<div class="img-rounded"><img src="' + result.data.link + '" class="position-image-product"/></div>' +
                '<input name="photos[]" type="hidden" value="' + result.data.link + '">' +
                '<div class="photo-hover-overlay">' +
                '<div class="box-hover-overlay">' +
                '<a class="tooltip-hover view-image text-white" data-image="' + result.data.link + '" data-toggle="modal" data-target="#viewImage" title="{{__('lang.detail')}}">' +
                '<i class="far fa-eye"></i>' +
                '</a>' +
                '<a class="pl-2 tooltip-hover text-white" id="slider-delete" title="{{__('lang.destroy')}}">' +
                '<i class="far fa-trash-alt"></i>' +
                '</a>' +
                '</div> ' +
                '</div>' +
                '</div>' +
                '</li>').appendTo(slider);
            $('#remove-label').removeClass('d-block').hide();
            $('.loading').fadeOut();
        }).catch(error => {
                $('#remove-label').show();
                $(slider).addClass('d-none');

            var obj = {
                'message': '{{__("_error")}} {{__("_upload")}}: ' + error,
                'type': 'error'
            };
            flash(obj);
        });
        }
    });

    $(document).on('click', '#slider-delete', function () {
        let slider = document.getElementsByClassName('slider-holder');
        let remove = document.getElementById('remove-label');
        $(this).parent().parent().parent().parent().remove();

        if ($(slider).children().length == 0) {
            $(slider).addClass('d-none').removeClass('d-inline-block');
            $(remove).removeClass('d-none').show();
        }
    });
    $(document).on('change', '#slider-input', function () {

        let parent = $(this).parent().parent().parent().parent();

        $(parent).find('div > img').attr('src', $(this).val());
    });


    $('.logo-upload, .og-upload, .favicon-upload, .image-upload, .background-upload').on('change', function () {
        let file = $(this).prop('files')[0];
        let imgur_client_id = "{{setting('api.imgur_client_id')}}";
        if (!file)
            return false;
        if (!imgur_client_id)
            return flash({'message': '{{__("_api_not_configured")}}', 'type': 'error'});

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
            .then(response => response.json()
    )
    .
        then(result => {
            $(target).val(result.data.link).trigger('change');
        $('.loading').fadeOut();
    })
    .
        catch(error => {
            var obj = {
                'message': '{{__("_error")}} upload: ' + error,
                'type': 'error'
            };
        flash(obj);
    })
        ;

    });

    $('.logo-src, .og-src, .favicon-src, .image-src, .background-src').on('change', function () {

        let target = $(this).data('target');
        let hidden = $(this).data('hidden');
        if ($(this).val()) {
            $(target).removeClass('d-none').attr('src', $(this).val()).show();
            $(hidden).removeClass('d-block').hide();
        } else {
            $(target).removeClass('d-block').hide();
            $(hidden).removeClass('d-none').show();
        }
    });
</script>
<script type="text/javascript">
    $('.ajax-modal').off('dblclick');
    $(document).on('click', '.ajax-modal', function (e) {
        e.preventDefault();

        $(e.target).attr('disabled', true);
        $(e.target).addClass('disabled');

        $remote = $(this).data('remote') || $(this).attr('href');
        $('#ajax-modal, .modal-backdrop').remove();
        $modal = $('<div class="modal fade" id="ajax-modal" tabindex="-1" role="dialog"></div>');
        $('body').append($modal);
        $modal.load($remote, function (text, status, xhr) {
            $('select').each(function () {
                $(this).select2({
                    dropdownParent: $(this).parent(),
                    placeholder: $(this).data('placeholder'),
                });
            });

            $(e.target).attr('disabled', false);
            $(e.target).removeClass('disabled');
            try {
                flash(jQuery.parseJSON(text));
            } catch {
                $modal.modal();
            }

        });

        return false;
    });

    $('.ajax-link').off('dblclick');

    $(document).on('click', '.ajax-link', function (e) {
        e.preventDefault();
        if ($(this).data('confirm')) {
            Swal.fire({
                title: '{{__("_are_you_sure")}}',
                text: $(this).data('confirm'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: '{{__("_back")}}',
                confirmButtonText: '{{__("_confirm")}}',
            }).then((result) => {
                if(result.isConfirmed
        )
            {
                ajaxlink(this);
            }
        })
        } else {
            ajaxlink(this);
        }
    });

    function ajaxlink(ele) {
        var url = $(ele).attr('href');
        if (!url)
            return false;
        $this = $(ele);

        let method = 'GET';
        if ($this.data('method')) {
            method = $this.data('method');
        }

        $.ajax({
            method: method,
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json'
        }).done(function (result) {
            flash(result);
            if ($this.data('refresh')) {
                $table.bootstrapTable('refresh', {silent: true});
            }
            if ($this.data('row')) {
                $(e.target).parents('tr').remove();
            }
            $('#ajax-modal').modal('hide');
        });

        return false;
    }
</script>
<script type="text/javascript">

    function ajaxForm(ele) {

        $(ele).ajaxSubmit({
            headers: {
                "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
            },
            beforeSubmit: function (formData, jqForm, options) {
                $(ele).find('[type=submit]').attr('disabled');

            },
            success: function (responseText, statusText, xhr, $form) {


            },
            error: function (xhr, status, errMsg, $form) {

            },
            complete: function (xhr, statusText, $form) {

                $(ele).find('[type=submit]').attr('disabled', false);

                let result = xhr.responseText;

                try {
                    result = $.parseJSON(result);
                } catch {
                    console.log('invalid json response');
                    $('#ajax-modal').html(result).modal();
                    return;
                }

                flash(result);

                if (result.type == 'success' || result.type == 'info') {

                    if ($form.data('reset') == true)
                        $form.resetForm();

                    $('#ajax-modal').modal('hide');

                    try {
                        $table.bootstrapTable('refresh', {silent: true});
                    } catch {
                    }
                }

            }

        });
        return false;
    }

    $(document).on('submit', '.ajax-form', function (e) {
        e.preventDefault();

        ajaxForm(this);
        return false;
    });
</script>
<script type="text/javascript">
    function ajaxSelect(ele) {

        let selected = $(ele).data('selected');
        let option = $(ele).data('option');

        $(ele).ajaxSubmit({
            headers: {
                "X-CSRF-Token": $('meta[name=_token]').attr('content')
            },
            beforeSubmit: function (formData, jqForm, options) {
                $(ele).find('[type=submit]').attr('disabled');

            },
            complete: function (xhr, statusText, $form) {

                $(ele).find('[type=submit]').attr('disabled', false);

                let result = xhr.responseJSON;

                if (result.errors) {
                    $.each(result.errors, function (index, value) {
                        var obj = {
                            'message': value,
                            'type': 'error'
                        };
                        flash(obj);
                    });
                } else {
                    var data = {
                        id: result.id,
                        text: result.translation.name
                    };

                    var newOption = new Option(data.text, data.id, true, true);
                    var addOption = new Option(data.text, data.id, false, false);

                    $(selected).append(newOption).trigger('change');
                    $(option).prepend(addOption).trigger('change');

                    $('#ajax-modal').modal('hide');
                    flash({'message': '{{__("_the_record_is_added_successfully")}}', 'type': 'success'});
                }
            }

        });
        return false;
    }

    $(document).on('submit', '.ajax-select', function (e) {
        e.preventDefault();
        ajaxSelect(this);
        return false;
    });
</script>
<script type="text/javascript">
    function sumFormatter(data) {
        field = this.field;
        var total_sum = data.reduce(function (sum, row) {
            let value = 0;
            try {
                value = eval('row.' + field) || 0;
            } catch {

            }

            return (sum) + parseFloat(value.toString().replace(/,/g, '').replace('$', '') || 0);
        }, 0);


        type = this.type;
        if (type)
            return window[type + 'Formatter'](total_sum);
        else
            return total_sum;
    }

    function avgFormatter(data) {
        field = this.field;
        var i = 0;
        var total_sum = data.reduce(function (sum, row) {
            i++;
            return (sum) + parseFloat(row[field].replace(/,/g, '').replace('$', '').replace('%', '') || 0);
        }, 0);

        total_sum = total_sum / i;

        type = this.type;
        if (type)
            total_sum = window[type + 'Formatter'](total_sum);

        return total_sum + '%';
    }

    function numberFormatter(value, row) {
        if (value != null)
            return Number(value).toLocaleString('en-US');
    }

    function shortDateTimeFormatter(value, row, index) {
        if (value)
            return moment(value).format('DD/MM HH:mm');
    }
</script>
<script type="text/javascript">
    $('.datetimepicker').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        timePickerSeconds: true,
        timePicker24Hour: true,
        showDropdowns: true,
        autoUpdateInput: false,
        allowClear: true,

    }).on('cancel.daterangepicker', function () {
        $(this).val('');
    }).on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY HH:mm:ss'));
    });
</script>
<script type="text/javascript">
    function initEvents() {
        $('.tooltip-hover').each(function () {
            $(this).tooltipster();
        })
    }

    initEvents();
</script>
<script type="text/javascript">
    $(window).on('load', function () {
        $('.loading').fadeOut();
    });
</script>
<script type="text/javascript">
    function ChangeToSlug(el) {
        var title, slug;
        title = el.value;
        slug = title.toLowerCase();
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        slug = slug.replace(/ /gi, "-");
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        if (document.getElementById(el.getAttribute('language')))
            document.getElementById(el.getAttribute('language')).value = slug;
        if (document.getElementById(el.getAttribute('seo')))
            document.getElementById(el.getAttribute('seo')).innerText = links + '/' + slug;
    }
</script>
<script type="text/javascript">
    function changeToTitleSeo(el) {
        return document.getElementById(el.getAttribute('language')).innerText = el.value;
    }

    function changeToDescriptionSeo(el) {
        return document.getElementById(el.getAttribute('language')).innerText = el.value;
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', 'input[name=sort]', function () {
            url = "{{route('admin.ajax.data.sort')}}";
            id = $(this).attr('data-id');
            num = $(this).val();
            type = $('input.type').val();
            _token = $('input[name=_token]').val();
            $.ajax({
                url: url,
                type: 'GET',
                cache: false,
                data: {'_token': _token, 'id': id, 'num': num, 'type': type},
                success: function (data) {
                    flash({'message': " {{__('_the_record_is_updated_successfully')}}", 'type': 'success'})
                }
            });
        });

        $(document).on('click', '.data_status', function () {
            url = "{{route('admin.ajax.data.status')}}";
            id = $(this).attr('data-id');
            _token = $('input[name=_token]').val();
            type = $('input.type').val();
            $.ajax({
                url: url,
                type: 'GET',
                cache: false,
                data: {'_token': _token, 'id': id, 'type': type},
                success: function (data) {
                    flash({'message': "{{__('_the_record_is_updated_successfully')}}", 'type': 'success'})
                }
            });
        });
        $(document).on('click', '.data_public', function () {
            url = "{{route('admin.ajax.data.public')}}";
            id = $(this).attr('data-id');
            _token = $('input[name=_token]').val();
            type = $('input.type').val();
            $.ajax({
                url: url,
                type: 'GET',
                cache: false,
                data: {'_token': _token, 'id': id, 'type': type},
                success: function (data) {
                    flash({'message': "{{__('_the_record_is_updated_successfully')}}", 'type': 'success'})
                }
            });
        })
    })
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

@yield('scripts')
</body>
</html>
