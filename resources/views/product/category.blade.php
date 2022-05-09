@extends('layouts.layout')
@section('title') {{$translation->title_seo}} @stop
@section('url') {{route('slug',$translation->slug)}} @stop
@section('site_name') {{$translation->title_seo}} @stop
@section('description') {{$translation->description_seo}} @stop
@section('keywords') {{$translation->keyword_seo}} @stop
@section('image') {{$translation->category->image}} @stop
@section('content')
    <main id="main-wrap">
        <div class="page-child-wrap category-pd-page">
            <div class="all">
                <div class="all1170">
                    <div class="page-title">
                        <h1 class="tt-txt">{{$translation->name}}</h1>
                        <br>
                        <div class="breadcrumb">
                            <div class="container">
                                <ul class="breadcrumb-nav">
                                    <li><a href="/">Trang chủ</a></li>
                                    /
                                    <li class="a">{{$translation->name}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="all1000">
                        <ul class="product-list-ul">
                            @foreach($products as $product)
                            <li id="id-2727">
                                <div class="pd-pane">
                                    <a href="{{$product->slug}}" class="img"><img
                                                width="125" height="602" src="{{$product->image}}"
                                                class="attachment-250x609 size-250x609" alt="{{$product->name}}"
                                                loading="lazy"
                                                sizes="(max-width: 125px) 100vw, 125px"/></a>
                                    <div class="info">
                                        <h2><p class="pd-name">{{$product->name}}</p></h2>
{{--                                        <p class="pd-name2">Nước uống 82X The Pink Collagen cao cấp Nhật Bản vừa giúp làm--}}
{{--                                            đẹp da, đồng thời cung cấp lượng dưỡng chất dồi dào, mang đến sức sống căng tràn--}}
{{--                                            cho ngày mới tươi trẻ. </p>--}}
                                        <div class="pd-excerpt">
                                            {!! str_limit($product->description, 100) !!}
                                        </div>
                                        <h3>

                                            <a href="{{$product->slug}}"
                                               class="btn primary-btn">CHI TIẾT</a>
                                            <a href="javascript:void(0)" v-on:click="buyNow({{$product->id}})" class="btn primary-btn 1">MUA
                                                NGAY</a></h3>
                                    </div>
                                </div>
                            </li>
                           @endforeach
                        </ul>
                    </div>
{{--                    <section class="product-detail-feature ">--}}
{{--                        <div class="all1000 clear">--}}
{{--                            <div class="feature-title">--}}
{{--                                <h2 class="tt-txt">Thông tin thêm về sản phẩm</h2>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </section>--}}
                </div>
            </div>
        </div>
    </main>
@stop
