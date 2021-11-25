@extends('admin.layouts.layout')
@section('title')
    {{__('lang.product')}} #ID{{$product->id}}
@stop
@section('content')

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('lang.dashboard')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">{{__('lang.list_product')}}</a></li>
                            <li class="breadcrumb-item active">#ID{{$product->id}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('lang.product')}} #ID{{$product->id}}</h4>
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
                <div class="col-lg-9">
                    @include('admin.render.edit.nav')
                        <div class="tab-content{{setting('site.languages') ? "pt-0" : ""}}">
                        @foreach($translations as $key => $translation)
                            <div class="tab-pane language-{{$translation->locale}} {{$key == 0 ? 'active' : null}}" id="language-{{$translation->locale}}">
                                <div class="card-box">
                                    @include('admin.render.edit.name')
                                    @include('admin.render.edit.description')
                                    @include('admin.render.edit.content')
                                </div>
                            </div>
                        @endforeach


                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                <div class="tab-pane language-{{$language->value}}" id="language-{{$translation->locale}}">
                                    <div class="card-box">
                                        @include('admin.render.create.name')
                                        @include('admin.render.create.description')
                                        @include('admin.render.create.content')
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-lg-0 mb-sm-0 mb-md-0">
                                        <label>{{__('lang.code')}}</label>
                                        <input type="text" class="form-control" value="{{$product->code}}" id="code" name="data[code]">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mb-lg-0 mb-sm-0 mb-md-0">
                                        <label>{{__('lang.price')}}</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  class="form-control text-primary font-weight-bold" min="0" value="{{number_format($product->price)}}" id="price">
                                        <input type="number" class="form-control d-none" min="0" value="{{$product->price}}" id="format-price" name="data[price]">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label>{{__('lang.price_sale')}}</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  class="form-control text-primary font-weight-bold" value="{{number_format($product->price_sale)}}" min="0" id="price_sale">
                                        <input type="number" class="form-control d-none" value="{{$product->price_sale}}" min="0" id="format-price-sale" name="data[price_sale]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($attributes->count())
                            <div class="card-box pb-1 clearfix">
                                <label>{{__('lang.filter')}}</label>

                                <div class="row">
                                    @foreach($attributes->where('category_id',0) as $attribute)
                                        <div class="col-lg-4 form-group">
                                            <div class="border h-100 p-2">
                                                <label>{{$attribute->translation->name}}</label>
                                                <hr class="mt-0 border-primary">
                                                @foreach($attributes->where('category_id', $attribute->id) as $parent)
                                                    <div class="checkbox">
                                                        <input id="checkbox_attibute_{{$parent->id}}" type="checkbox" name="attribute[]" value="{{$parent->id}}" {{checked($parent->id, $product->attributes->pluck('id')->toArray())}}>
                                                        <label for="checkbox_attibute_{{$parent->id}}" class="{{$loop->last ? "mb-0" : ""}}">{{$parent->title}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        @endif

                    <div class="card-box position-relative box-action-image float-left w-100">
                        @include('admin.render.edit.multiple_image', ['item' => $product])
                        <style>
                            .box-action-image #box-input{
                                right:1.5rem!important;
                                top:1.5rem!important;
                            }
                        </style>
                    </div>
                    <div class="tab-content pt-0 float-left w-100">
                        @foreach($translations as $key => $translation)
                            <div class="tab-pane language-{{$translation->locale}}  {{$key == 0 ? 'active' : null}}" id="language-{{$translation->locale}}">
                                    <div class="card-box">
                                        @include('admin.render.edit.seo')
                                    </div>
                                </div>
                        @endforeach
                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                <div class="tab-pane language-{{$language->value}} " id="language-{{$language->value}}">
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

                    <div class="card-box">
                        @include('admin.render.edit.tag', ['item' => $product, 'type' => \App\Enums\TagType::product])
                    </div>
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
    <script>
        $(document).on('click','.view-image',function(){
            let image = $(this).attr('data-image');
            $('.showImage').attr('src', image);
        })
        $('[data-toggle="tab"]').on('click',function(e){
            e.preventDefault();
            let pane = $(this).attr('href');

            $('.tab-pane').removeClass('active').hide();
            $(pane).addClass('active').show();
        });

        let price = document.getElementById('price');
        let sale = document.getElementById('price_sale');
        let format_price = document.getElementById('format-price');
        let format_price_sale = document.getElementById('format-price-sale');

        $(price).on('keyup',function (){
            let value = $(this).val();
            console.log(value);
            value = value.replaceAll(',','');
            $(this).val(number_format(value))
            $(format_price).val(value);
        })

        $(sale).on('keyup',function (){
            let value = $(this).val();
            value = value.replaceAll(',','');
            $(this).val(number_format(value))
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
