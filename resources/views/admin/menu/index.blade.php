@extends('admin.layouts.layout')
@section('title')
    {{__('_menu')}}
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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('_menu')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_menu')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div> <!-- end container-fluid -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-left" id="nestable_list_menu">
                    @can('menu.create')
                        <div class="action-datatable text-right mb-2">
                            @include('admin.render.add_new', ['route' => route('admin.menus.create'), 'modal' => true])
                        </div>
                    @endcan
                </div>
            </div>
        </div>
        <!-- End row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-box">
                            <h4 class="header-title">{{__('_quick_add')}}</h4>
                            <p class="sub-header mb-0">
                                {!! __('_quick_add_note') !!}
                            </p>
                        </div>
                        @can('product.view')
                            <div class="card-box">
                                <div class="form-group mb-0">
                                    <table class="table table-bordered table-hover bs-table"
                                           data-toolbar="#custom-toolbar"
                                           data-url="{{ route('admin.categories.data',['type' => \App\Enums\CategoryType::product]) }}"
                                           data-side-pagination="server"
                                           data-pagination="false"
                                           data-search="false"
                                           data-show-refresh="false"
                                           data-show-columns="false"
                                           data-show-export="false"
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
                                                {{__('_category_product')}}
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>

                                </div>
                            </div>
                        @endcan

                        @can('blog.view')
                            <div class="card-box">
                                <div class="form-group mb-0">
                                    <table class="table table-bordered table-hover bs-table category-table"
                                           data-toolbar="#custom-toolbar"
                                           data-url="{{ route('admin.categories.data',['type' => \App\Enums\CategoryType::post]) }}"
                                           data-side-pagination="server"
                                           data-pagination="false"
                                           data-search="false"
                                           data-show-refresh="false"
                                           data-show-columns="false"
                                           data-show-export="false"
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
                                                {{__('_category_post')}}
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
                                           data-search="false"
                                           data-show-refresh="false"
                                           data-show-columns="false"
                                           data-show-export="false"
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
                                                {{__('_page')}}
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        @endcan
                    </div>
                    <div class="col-md-6">
                        <div class="card-box">
                            <h4 class="header-title"><b>{{__('_menu')}}</b></h4>
                            <p class="sub-header">
                                {!! __('_menu_list_note') !!}
                            </p>
                            <div id="menus">
                                @include('admin.render.menu',['menus' => $menus])
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
            max-width: 100% !important;
        }
    </style>
    <style type="text/css" media="screen">
        .list__menu {
            position: relative;
        }

        .list__menu label.control-label, .list__menu label a {
            display: block;

        }

        .list__menu .text-right {
            float: right;
            cursor: pointer;
            position: absolute;
            right: 15px;
        }

        .tab__menu {
            margin-left: 15px;

        }

        .box-shadow {
            box-shadow: 2px 2px 2px 2px #d58512
        }
    </style>

    <!-- Plugins css -->
    <link href="/lib/assets/libs/nestable2/jquery.nestable.min.css" rel="stylesheet" type="text/css"/>

    <style>
        .treegrid-expander {
            display: none !important;
        }

        .treegrid-indent + .treegrid-expander {
            display: inline-block !important;
        }

        .treegrid-expander.treegrid-expander-collapsed {
            display: inline-block !important;
        }

        .treegrid-expanded .treegrid-expander {
            background: url('https://cdnjs.cloudflare.com/ajax/libs/jquery-treegrid/0.2.0/img/collapse.png') no-repeat;
            width: 16px;
            height: 16px;
            display: inline-block !important;
            position: relative;
            cursor: pointer;
        }
    </style>
@stop
@section('scripts')

    <script type="text/javascript">

        function ajaxFormMenu(ele) {
            var html = document.getElementById('menus');
            $(ele).ajaxSubmit({
                headers: {
                    "X-CSRF-Token": $('meta[name=_token]').attr('content')
                },
                beforeSubmit: function (formData, jqForm, options) {
                    $(ele).find('[type=submit]').attr('disabled', true);

                },
                complete: function (xhr, statusText, $form) {

                    $(ele).find('[type=submit]').attr('disabled', false);

                    let result = xhr.responseText;

                    $(html).html(result).show();
                    $('.dd-empty').hide();
                    $('#ajax-modal').modal('hide');
                    $('select').each(function () {
                        $(this).select2({
                            dropdownParent: $(this).parent(),
                            placeholder: $(this).data('placeholder'),
                        });
                    });
                    if ($(ele).find('input[name="_method"]').length) {
                        flash({'message': '{{__("_the_record_is_updated_successfully")}}', 'type': 'success'});
                    } else {
                        flash({'message': '{{__("_the_record_is_added_successfully")}}', 'type': 'success'});
                    }
                }

            });
            return false;
        }

        $(document).on('submit', '.ajax-form-menu', function (e) {
            e.preventDefault();
            ajaxFormMenu(this);
            return false;
        });
    </script>
    <script>
        @can('menu.destroy')
        $('.ajax-link-menu').off('dblclick');
        $(document).on('click', '.ajax-link-menu', function (e) {
            e.preventDefault();
            if ($(this).data('confirm')) {
                Swal.fire({
                    title: '{{__("_are_you_sure")}}',
                    text: $(this).data('confirm'),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{__("_confirm")}}',
                    cancelButtonText: '{{__("_back")}}'
                }).then((result) = > {
                    if(result.isConfirmed
            )
                {
                    ajaxMenu(this);
                }
            })
            }
        });

        function ajaxMenu(ele) {
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
            }).done(function (result) {
                let html = document.getElementById('menus');
                let success = {
                    'message': '{{__("_the_record_is_deleted_successfully")}}',
                    'type': 'success'
                };
                $(html).html(result);
                if ($(html).children().length == 0) {
                    $(html).hide();
                    $('.dd-empty').show();
                }
                $('select').each(function () {
                    $(this).select2({
                        dropdownParent: $(this).parent(),
                        placeholder: $(this).data('placeholder'),
                    });
                });
                flash(success);

                $('#ajax-modal').modal('hide');
            });

            return false;
        }
        @endcan
    </script>

    <script>
        function titleFormatter(value, row) {
            return '<a href="javascript:void(0)" class="addmenu font-weight-bold" data-id="' + row.id + '" data-type="{{\App\Enums\PostType::page}}">' + value + '</a>';
        }

        function categoryFormatter(value, row) {
            return '<a href="javascript:void(0)" class="addmenu font-weight-bold" data-id="' + row.id + '" data-type="{{\App\Enums\CategoryType::category}}">' + value + '</a>';
        }

        $(document).on('post-body.bs.table.', function () {
            var columns = $table.bootstrapTable('getOptions').columns;

            if (columns && columns[0][0].visible) {
                $table.treegrid({
                    treeColumn: 0,
                    onChange: function () {
                        $table.bootstrapTable('resetView');
                    }
                })
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            @can('menu.create')
            $(document).on('click', '.addmenu', function () {
                var _token = $('input[name="_token"]').val();
                var url = '{{route('admin.ajax.append.menu')}}';
                var type = $(this).data('type');
                var id = $(this).data('id');
                $.ajax({
                    url: url,
                    type: 'post',
                    cache: false,
                    data: {
                        'type': type, 'id': id, '_token': _token,
                    },
                    success: function (result) {
                        $('#result_data').append(result).show();
                        $('.dd-empty').hide();
                        flash({'message': '{{__("_the_record_is_added_successfully")}}', 'type': 'success'});
                    }
                })
            });
            @endcan

            @can('menu.edit')
            $('.position').change(function () {
                var _token = $('meta[name=_token]').attr('content');
                var position = $(this).val();
                var url = "{{route('admin.change.position.menu',":position")}}".replace(':position', position);
                var html = document.getElementById('result_data');
                $.ajax({
                    url: url,
                    type: 'get',
                    cache: false,
                    data: {
                        'position': position, '_token': _token,
                    },
                    success: function (result) {
                        $(html).html(result).show();
                        $('.dd-empty').hide();
                        if (result.length == 0) {
                            $(html).hide();
                            $('.dd-empty').show();
                        }
                    }
                })
            });

            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };

            $('#nestable').nestable({
                group: 1,
                maxDepth: 10
            })
                .on('change', updateOutput);

            updateOutput($('#nestable').data('output', $('#nestable-output')));

            $('#nestable').change(function () {
                val = $('#nestable-output').val();
                _token = $('input[name="_token"]').val();
                url = "{{route('admin.ajax.menu.sort')}}";
                $.ajax({
                    url: url,
                    type: "get",
                    data: {"val": val, '_token': _token},
                    cache: false,
                    success: function (result, status) {
                    }
                });
            });
            @endcan
        });

    </script>

    <!-- Plugins js-->
    <script src="/lib/assets/libs/nestable2/jquery.nestable.min.js"></script>

@stop

