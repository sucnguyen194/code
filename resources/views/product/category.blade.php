@extends('layouts.layout')
@section('title') {{$translation->title_seo}} @stop
@section('url') {{route('slug',$translation->slug)}} @stop
@section('site_name') {{$translation->title_seo}} @stop
@section('description') {{$translation->description_seo}} @stop
@section('keywords') {{$translation->keyword_seo}} @stop
@section('image') {{$translation->category->image}} @stop
@section('content')
    <!-------------------------->
    <!-----------SOURCSE----------->
    <!-------------------------->
    {{--<section class="g-bg-img-hero u-bg-overlay g-bg-black-opacity-0_6--after g-py-50"--}}
    {{--         style="background-image: url(../assets/img/tamloi-slide-03.jpg)">--}}
    {{--    <div class="container u-bg-overlay__inner text-center">--}}
    {{--        <div class="text-uppercase text-center u-heading-v2-5--bottom g-brd-main-6 g-mb-20">--}}
    {{--            <h2 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-26 g-color-main-6 g-mb-0">Sản phẩm</h2>--}}
    {{--        </div>--}}
    {{--        <ul class="u-list-inline">--}}
    {{--            <li class='list-inline-item g-mr-7'><a class='u-link-v5 g-color-white' href='San-pham-prc4.html'>Sản phẩm</a><i class='fa fa-angle-right g-ml-7'></i></li><li class='list-inline-item g-mr-7'><a class='u-link-v5 g-color-white' href='Thuc-an-chan-nuoi-prc4.html'>Thức ăn chăn nuôi</a><i class='fa fa-angle-right g-ml-7'></i></li>--}}
    {{--        </ul>--}}
    {{--    </div></section>--}}

    <section id="products" class="g-py-50 g-px-30">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <style>
                        .img-product {
                            height: 255px;
                        }
                    </style>
                    <header class="g-mb-20">
                        <h2 class="h4 g-font-weight-700 g-color-primary text-uppercase">{{$translation->name}}</h2>
                        <div class="g-width-100 g-brd-bottom g-brd-2 g-brd-primary g-mb-20"></div>
                    </header>

                    <div class="row">
                        @foreach($products as $item)
                            <div class="col-lg-4 col-md-4 col-6">
                                @include('include.product')
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12 g-mt-30">
                            {{$products->appends(request()->except(['page']))->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 g-pa-0">
                    @include('include.left')
                </div>
            </div>

        </div>
    </section>
    <!-------------------------->
    <!-----------SOURCSE----------->
    <!-------------------------->
@stop
