@extends('layouts.layout')
@section('title') {{$translation->title_seo}} @stop
@section('url') {{route('slug',$translation->slug)}} @stop
@section('site_name') {{$translation->title_seo}} @stop
@section('description') {{$translation->description_seo}} @stop
@section('keywords') {{$translation->keyword_seo}} @stop
@section('image') {{$translation->product->image}} @stop
@section('content')
<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->

<section id="products" class="g-py-30 g-px-20">
    <div class="container">
        <ul class="u-list-inline mb-3">
            <li class='list-inline-item g-mr-7'>
                <a class='u-link-v5' href='/'><i class="fa fa-home"></i></a><i class='fa fa-angle-right g-ml-7'></i>
            </li>
            <li class='list-inline-item g-mr-7'>
                <a class='u-link-v5' href='{{$translation->item->category->slug}}'>{{$translation->item->category->name}}</a>
                <i class='fa fa-angle-right g-ml-7'></i>
            </li>
            <li class='list-inline-item g-mr-7'>
                {{$translation->name}}
            </li>
        </ul>
        <div class="row">
            <div class="col-lg-12">
                <header class="g-mb-20">
                    <h1 class="h4 g-color-primary text-uppercase"> {{$translation->name}}</h1>
                    <div class="g-width-100 g-brd-bottom g-brd-2 g-brd-primary g-mb-20"></div>
                </header>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-5 col-12 order-md-1">
                <div class="g-pos-rel g-pa-20">
                    <a class="js-fancybox" href="javascript:;" data-fancybox="lightbox-gallery--07-1" data-src="{{$translation->item->images}}" data-caption="{{$translation->name}}" data-animate-in="bounceInDown" data-animate-out="bounceOutDown" data-speed="1000" data-overlay-blur-bg="true">
                        <img class="img-fluid" src="{{$translation->item->images}}" alt="{{$translation->name}}" />                </a>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 col-12 order-md-2">
                <h2 class="h4 g-font-weight-300 text-danger g-pt-20">Giá:<b>@if($translation->item->price_sale > 0) {{number_format($translation->item->price_sale)}} <strike class="text-secondary">({{number_format($translation->item->price_sale )}})</strike>  @else {{$translation->item->price > 0 ? number_format($translation->item->price) : 'liên hệ'}} @endif</b></h2>
                <h2 class="h4 g-font-weight-300 g-color-primary g-pt-10">Mã sản phẩm:<b>&nbsp;&nbsp;{{$translation->item->code}}</b></h2>

                <div class="entry-content mt-3">
                    {!! $translation->content !!}
                </div>

            </div></div>

        <div class="row">
            <div class="col-lg-12">
                <header class="g-mb-20">
                    <div class="u-heading-v6-2 text-uppercase">
                        <h2 class="h4 g-font-weight-700 g-color-primary text-uppercase">Sản phẩm cùng loại</h2>
                        <div class="g-width-100 g-brd-bottom g-brd-2 g-brd-primary g-mb-20"></div>
                    </div>
                </header> </div>
        </div>
        <div class="row">
            @foreach(\App\Models\Product::ofType(\App\Enums\ProductType::product)->ofCategory($translation->item->category->id)->ofTake(\App\Enums\TakeItem::replated)->where('id','!=',$translation->item->id)->latest()->get() as $item)
                <div class="col-lg-3 col-md-3 col-6">
                    @include('include.product')
                </div>
            @endforeach
        </div>

    </div>
</section>
<style>
    .img-product {
        height: 255px;
    }
</style>
<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->
@stop
