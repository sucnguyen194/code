@extends('admin.layouts.layout')
@section('title')
    {{__('_product')}} #{{$product->id}}
@stop
@section('content')

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">{{__('lang.list_product')}}</a></li>
                            <li class="breadcrumb-item active">#{{$product->id}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_product')}} #{{$product->id}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <div class="container-fluid" id="update-product">
        <form method="post" action="{{route('admin.products.update',$product)}}" class="ajax-form" enctype="multipart/form-data">
            <div class="row">
                @csrf
                @method('PUT')
                <div class="col-xl-9 col-lg-9 col-md-8">
                    @include('admin.render.edit.nav')
                    <div class="tab-content pt-0">
                        @foreach($translations as $key => $translation)
                            <div class="tab-pane language-{{$translation->locale}} {{$translation->locale == session('lang') ? 'active' : null}}" id="language-{{$translation->locale}}">
                                <div class="card-box">
                                    @include('admin.render.edit.name')
                                    @include('admin.render.edit.description')
                                    @include('admin.render.edit.content')
                                </div>
                            </div>
                        @endforeach

                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                <div class="tab-pane language-{{$language->value}} {{$language->value == session('lang') ? 'active' : null}}" id="language-{{$language->value}}">
                                    <div class="card-box">
                                        @include('admin.render.create.name')
                                        @include('admin.render.create.description')
                                        @include('admin.render.create.content')
                                    </div>
                                </div>
                            @endforeach

                        </div>

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
                                @if($product->options)
                                    @foreach($product->options as $key=>$option)
                                <tr>
                                    <td>
                                        <input type="text" name="fields[{{$key}}][name]" class="form-control" value="{{$option['name']}}" required>
                                    </td>


                                    <td>
                                        <input type="price" step="0.1" name="fields[{{$key}}][price]" class="form-control" value="{{$option['price'] ?? '0.00'}}">
                                    </td>

                                    <td>
                                        <i class="fa fa-minus" data-remove></i>
                                        <i class="fa fa-arrows" data-move></i>
                                        <i class="fa fa-plus" data-add></i>

                                    </td>
                                </tr>
                                @endforeach

                                @else
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
                                @endif


                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-box position-relative box-action-image float-left w-100">
                        @include('admin.render.edit.multiple_image', ['item' => $product])
                        <style>
                            .box-action-image #box-input{
                                right:1.5rem!important;
                                top:1.5rem!important;
                            }
                        </style>
                    </div>

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
                                                        <input id="checkbox_attibute_{{$parent->id}}" type="checkbox" name="filter[]" value="{{$parent->id}}" {{checked($parent->id, $product->filters->pluck('id')->toArray())}}>
                                                        <label for="checkbox_attibute_{{$parent->id}}" class="{{$loop->last ? "mb-0" : ""}}">{{$parent->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        @endif


                    <div class="tab-content pt-0 float-left w-100">
                        @foreach($translations as $key => $translation)
                            <div class="tab-pane language-{{$translation->locale}} {{$translation->locale == session('lang') ? 'active' : null}}" id="language-{{$translation->locale}}">
                                    <div class="card-box">
                                        @include('admin.render.edit.seo')
                                    </div>
                                </div>
                        @endforeach
                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                <div class="tab-pane language-{{$language->value}} {{$language->value == session('lang') ? 'active' : null}} " id="language-{{$language->value}}">
                                    <div class="card-box">
                                        @include('admin.render.create.seo')
                                    </div>
                                </div>
                            @endforeach
                    </div>

                    {{--                    <div class="card-box clearfix">--}}
                    {{--                        <label>Thuộc tính sản phẩm</label>--}}
                    {{--                        <table data-dynamicrows class="table table-bordered table-striped mb-0">--}}
                    {{--                            <thead>--}}
                    {{--                            <tr>--}}
                    {{--                                <th>Tên thuộc tính</th>--}}
                    {{--                                <th>Giá trị</th>--}}
                    {{--                                <th>Hành động</th>--}}
                    {{--                            </tr>--}}
                    {{--                            </thead>--}}
                    {{--                            <tbody>--}}

                    {{--                            @if($product->options)--}}

                    {{--                                @foreach($product->options as $key => $item)--}}
                    {{--                                    <tr>--}}
                    {{--                                        <td><input type="text" name="fields[{{$key}}][name]" value="{{$item['name']}}" class="form-control"></td>--}}
                    {{--                                        <td><input type="text" name="fields[{{$key}}][value]" value="{{$item['value']}}" class="form-control"></td>--}}
                    {{--                                        <td>--}}
                    {{--                                            <i class="fas fa-minus" data-remove></i>--}}
                    {{--                                            <i class="fas fa-arrows-alt" data-move></i>--}}
                    {{--                                            <i class="fas fa-plus" data-add></i>--}}
                    {{--                                        </td>--}}
                    {{--                                    </tr>--}}
                    {{--                                @endforeach--}}
                    {{--                            @else--}}
                    {{--                                <tr>--}}
                    {{--                                    <td><input type="text" name="fields[0][name]"  class="form-control"></td>--}}
                    {{--                                    <td><input type="text" name="fields[0][value]" class="form-control"></td>--}}
                    {{--                                    <td>--}}
                    {{--                                        <i class="fas fa-minus" data-remove></i>--}}
                    {{--                                        <i class="fas fa-arrows-alt" data-move></i>--}}
                    {{--                                        <i class="fas fa-plus" data-add></i>--}}
                    {{--                                    </td>--}}
                    {{--                                </tr>--}}
                    {{--                            @endif--}}
                    {{--                            </tbody>--}}
                    {{--                        </table>--}}
                    {{--                    </div>--}}

                </div>
                <div class="col-lg-3">
                    <div class="card-box">
                        @include('admin.render.edit.status', ['item' => $product])
                    </div>
                    @include('admin.render.edit.category', ['item' => $product, 'type' => \App\Enums\CategoryType::product])

                    @include('admin.render.edit.tag', ['item' => $product, 'type' => \App\Enums\TagType::product])
                </div>

                <div class="col-lg-12">
                    @include('admin.render.button',['route' => route('admin.products.index')])
                </div>
            </div>
            <!-- end row -->
        </form>
    </div>

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
    <script>
        $(document).on('click','.view-image',function(){
            let image = $(this).attr('data-image');
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
            console.log($(format_price).val());
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
@stop

@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
{{--    <script src="/lib/assets/js/pages/form-advanced.init.js"></script>--}}
    <script src="/lib/js/dynamicrows/dynamicrows.js"></script>
    <script>
        $('[data-dynamicrows]').dynamicrows();
        $( "#sortable" ).sortable();
    </script>
@stop
