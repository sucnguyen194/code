@extends('admin.layouts.layout')
@section('title')
    {{__('_add_new')}} {{\Illuminate\Support\Str::lower(__('lang.product'))}}
@stop
@section('content')
{{--    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>--}}
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">{{__('lang.list_product')}}</a></li>
                            <li class="breadcrumb-item active">{{__('_add_new')}} {{\Illuminate\Support\Str::lower(__('lang.product'))}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_add_new')}} {{\Illuminate\Support\Str::lower(__('lang.product'))}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <div class="container-fluid" id="vue-app">
        <form method="post" action="{{route('admin.products.store')}}" class="ajax-form" enctype="multipart/form-data">
            <div class="row">
                @csrf
                <div class="col-xl-9 col-lg-9 col-md-8">
                   @include('admin.render.create.nav')

                        <div class="tab-content pt-0">
                            @foreach(languages() as $key => $language)
                                <div class="tab-pane language-{{$language->value}} {{$language->value == session('lang') ? 'active' : null}}" >
                                    <div class="card-box">
                                        @include('admin.render.create.name')
                                        @include('admin.render.create.description')
                                        @include('admin.render.create.content')
                                    </div>
                                </div>
                            @endforeach

                                <div class="card-box">
                                    <label class="form-label">Gói dịch vụ</label>
                                    <div class="table-responsive">
                                        <table class="table product-options text-center" data-dynamicrows>
                                            <thead>
                                            <tr>
                                                <th>Tên dịch vụ <span class="required">*</span></th>
                                                <th>Giá ($)</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr>
                                                <td>
                                                    <input type="text" name="fields[0][name]" class="form-control" value="" required>
                                                </td>


                                                <td>
                                                    <input type="price" step="0.1" name="fields[0][price]" class="form-control" value="0.00">
                                                </td>

                                                <td>
                                                    <i class="fa fa-minus" data-remove></i>
                                                    <i class="fa fa-arrows" data-move></i>
                                                    <i class="fa fa-plus" data-add></i>

                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card-box position-relative box-action-image">
                                    @include('admin.render.create.multiple_image')
                                </div>

{{--                                <div class="card-box pb-1 clearfix">--}}
{{--                                    <label>Thông tin bán hàng</label>--}}
{{--                                    <hr class="mt-0 border-primary">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="col-xl-12">Thuộc tính 1</label>--}}
{{--                                        <div class="col-xl-12">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-xl-3">--}}
{{--                                                    <input type="text" name="attribute[0][name]" placeholder="Nhập tên thuộc tính, ví dụ: màu sắc, kích thước v.v" class="form-control" required>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-xl-9 attribute_before">--}}
{{--                                                    <input type="text" placeholder="Phân loại thuộc tính, ví dụ: Trắng, đỏ v.v" data-role="tagsinput" name="attribute_before" class="form-control">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="col-xl-12">Thuộc tính 2</label>--}}
{{--                                        <div class="col-xl-12">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-xl-3">--}}
{{--                                                    <input type="text" name="attribute[1][name]" placeholder="Nhập tên thuộc tính, ví dụ: Size, v.v" class="form-control w-100" required>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-xl-9 attribute_after">--}}
{{--                                                    <input type="text" placeholder="Phân loại thuộc tính. Ví dụ: S, M, v.v" data-role="tagsinput" name="attribute_after" class="form-control w-100">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <hr class="mt-0 border-primary">--}}

{{--                                    <div class="attributes-view">--}}
{{--                                        <div class="attribute-item" v-if="attribute_after.length == 0" v-for="(key,attribute) in attribute_before">--}}
{{--                                            @{{ key }}--}}
{{--                                            <div class="d-flex">--}}
{{--                                                <div class="col m-auto pl-0 table-break-word pl-lg-4"><label class="main-content">@{{ attribute }}</label></div>--}}
{{--                                                <div class="col-auto text-right m-auto">--}}

{{--                                                    <label class="main-content"><input type="text" name="item[]" class="form-control" min="0" placeholder="Item" v-bind:value="attribute" readonly></label>--}}
{{--                                                    <label class="main-content"><input type="number" name="price[]" class="form-control" min="0" placeholder="Giá"></label>--}}
{{--                                                    <label class="sub-content"><input type="number" name="quantity[]" class="form-control" min="0" placeholder="Số lượng"></label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <hr class="mt-0 border-light">--}}
{{--                                        </div>--}}

{{--                                        <div class="attribute-item" v-if="attribute_after.length > 0" v-for="before in attribute_before">--}}
{{--                                            <div class="d-flex" v-for="after in attribute_after">--}}
{{--                                                <div class="col m-auto pl-0 table-break-word pl-lg-4"><label class="main-content">@{{ before }} / @{{ after }}</label></div>--}}
{{--                                                <div class="col-auto text-right m-auto">--}}
{{--                                                    <label class="main-content"><input type="text" name="group[]" class="form-control" min="0" placeholder="Nhóm" v-bind:value="before" readonly></label>--}}
{{--                                                    <label class="main-content"><input type="text" name="item[]" class="form-control" min="0" placeholder="Item" v-bind:value="after" readonly></label>--}}
{{--                                                    <label class="main-content"><input type="number" name="price[]" class="form-control" min="0" placeholder="Giá"></label>--}}
{{--                                                    <label class="sub-content"><input type="number" name="quantity[]" class="form-control" min="0" placeholder="Số lượng"></label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <hr class="mt-0 border-light">--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
                                @if($filters->count())
                                    <div class="card-box pb-1 clearfix">
                                        <label>{{__('lang.filter')}}</label>

                                        <div class="row">
                                            @foreach($filters->where('parent_id',0) as $filter)
                                                <div class="col-lg-4 form-group">
                                                    <div class="border h-100 p-2">
                                                        <label>{{$filter->name}}</label>
                                                        <hr class="mt-0 border-primary">
                                                        @foreach($filters->where('parent_id', $filter->id) as $parent)
                                                            <div class="checkbox">
                                                                <input id="checkbox_attibute_{{$parent->id}}" type="checkbox" name="filter[]" value="{{$parent->id}}">
                                                                <label for="checkbox_attibute_{{$parent->id}}" class="{{$loop->last ? "mb-0" : ""}}">{{$parent->name}}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                @endif

                            @foreach(languages() as $key => $language)
                                    <div class="tab-pane language-{{$language->value}} {{$language->value == session('lang') ? 'active' : null}}" >
                                        <div class="card-box">
                                            @include('admin.render.create.seo')
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="card-box">
                        @include('admin.render.create.status')
                    </div>
                    @include('admin.render.create.category', ['type' => \App\Enums\CategoryType::product])
                    @include('admin.render.create.tag',['type' => \App\Enums\TagType::product])
                </div>

                <div class="col-lg-12">
                    @include('admin.render.button', ['route' => route('admin.products.index') ])
                </div>
            </div>
            <!-- end row -->
        </form>
    </div>
    <div id="viewImage" class="modal fade" tabindex="-1" aria-labelledby="myLargeModalLabel" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('lang.image')}}</h5>
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
{{--<style>--}}
{{--    .bootstrap-tagsinput input {--}}
{{--        width: 100%!important;--}}
{{--    }--}}
{{--    .bootstrap-tagsinput {--}}
{{--        min-height: 36px!important;--}}
{{--    }--}}
{{--</style>--}}

@stop

@section('scripts')
{{--    <script type="text/javascript">--}}
{{--        var app = new Vue({--}}
{{--            el: '#vue-app',--}}
{{--            mounted:function(){--}}
{{--                $('.attribute_before input').on('change', function(event) {--}}
{{--                    var $element = $(event.target);--}}

{{--                    if (!$element.data('tagsinput'))--}}
{{--                        return;--}}

{{--                    var val = $element.tagsinput('items');--}}
{{--                    if (val === null)--}}
{{--                        val = null;--}}

{{--                    app.attribute_before = val;--}}
{{--                }).trigger('change');--}}

{{--                $('.attribute_after input').on('change', function(event) {--}}
{{--                    var $element = $(event.target);--}}

{{--                    if (!$element.data('tagsinput'))--}}
{{--                        return;--}}

{{--                    var val = $element.tagsinput('items');--}}
{{--                    if (val === null)--}}
{{--                        val = null;--}}

{{--                    app.attribute_after = val;--}}
{{--                }).trigger('change');--}}
{{--            },--}}
{{--            data:{--}}
{{--                attribute_before: [],--}}
{{--                attribute_after: []--}}
{{--            },--}}
{{--            watch:{--}}

{{--            }--}}
{{--        })--}}
{{--    </script>--}}
    <script>
        $(document).on('click','.view-image',function(){
            let image = $(this).attr('data-image');
            $('#viewImage').modal('show');
            $('.showImage').attr('src', image);
        });
        $('[data-toggle="tab"]').on('click',function(e){
            e.preventDefault();
            let pane = $(this).attr('href');

            $('.tab-pane').removeClass('active').hide();
            $(pane).addClass('active').show();
        });

        $('[data-toggle="custom"]').on('click',function(e){
            e.preventDefault();
            let pane = $(this).attr('href');

            $('[data-toggle="custom"]').removeClass('active');
            $(this).addClass('active');

            $('.tab-custom').removeClass('active').hide();
            $(pane).addClass('active').show();
        });

        let price = document.getElementById('price');
        let sale = document.getElementById('price_sale');
        let format_price = document.getElementById('format-price');
        let format_price_sale = document.getElementById('format-price-sale');

        $(price).on('keyup',function (){
            let value = $(this).val();
            if(value > 99)
                value = value.replace(/^0+/, '');

            $(this).val(number_format(value));
            value = value.replaceAll(',','');

            $(format_price).val(value);
        });

        $(sale).on('keyup',function (){
            let value = $(this).val();
            if(value > 99)
                value = value.replace(/^0+/, '');

            $(this).val(number_format(value));
            value = value.replaceAll(',','');
            $(format_price_sale).val(value);
        })

    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
{{--     <script src="/lib/assets/js/pages/form-advanced.init.js"></script>--}}
    <script src="/lib/js/dynamicrows/dynamicrows.js"></script>
    <script>
        $('[data-dynamicrows]').dynamicrows();
        $( "#sortable" ).sortable();
    </script>
@stop
