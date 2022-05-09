@extends('layouts.layout')
@section('title') {{$product->translation->title_seo}} @stop
@section('url') {{route('slug',$product->slug)}} @stop
@section('site_name') {{$product->translation->title_seo}} @stop
@section('description') {{$product->translation->description_seo}} @stop
@section('keywords') {{$product->translation->keyword_seo}} @stop
@section('image') {{$product->image}} @stop
@section('content')

    <section class="all-sections pt-60">
        <div class="container-fluid p-max-sm-0">
            <div class="sections-wrapper d-flex flex-wrap justify-content-center">
                <article class="main-section">
                    <div class="section-inner">
                        <div class="item-section item-details-section">
                            <div class="container">
                                <div class="row justify-content-center mb-30-none">
                                    <div class="col-xl-9 col-lg-9 mb-30">
                                        <div class="item-details-area">
                                            <div class="item-details-box">
                                                @if($product->photo)
                                                <div class="item-details-thumb-area">
                                                    <div class="item-details-slider-area">
                                                        <div class="item-details-slider">
                                                            <div class="swiper-wrapper">
                                                                <div class="swiper-slide">
                                                                    @foreach($product->photo as $photo)
                                                                    <div class="item-details-thumb">
                                                                        <img src="{{$photo}}" alt="item-banner">
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="slider-prev">
                                                                <i class="las la-angle-left"></i>
                                                            </div>
                                                            <div class="slider-next">
                                                                <i class="las la-angle-right"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div thumbsSlider="" class="item-small-slider mt-20">
                                                        <div class="swiper-wrapper">
                                                        </div>
                                                    </div>
                                                    <div class="item-details-content">
                                                        <h2 class="title">{{$product->name}}</h2>
                                                        <div class="item-details-footer mb-20-none">
                                                            <div class="left mb-20">

{{--                                                                <a href="javascript:void(0)" class="item-love me-2 loveHeartAction" data-serviceid="26"><i class="fas fa-heart"></i> <span--}}
{{--                                                                            class="give-love-amount">(7)</span></a>--}}

{{--                                                                <a href="javascript:void(0)" class="item-ratings">--}}
{{--                                                                    <i class="las la-star text--warning"></i>--}}
{{--                                                                    <i class="las la-star text--warning"></i>--}}
{{--                                                                    <i class="las la-star text--warning"></i>--}}
{{--                                                                    <i class="las la-star text--warning"></i>--}}
{{--                                                                    <i class="las la-star text--warning"></i>--}}
{{--                                                                </a>--}}
                                                            </div>
                                                            <div class="right mb-20">
                                                                <div class="social-area">
                                                                    <ul class="footer-social">
                                                                        <li>
                                                                            <a href="https://www.facebook.com/sharer.php?u={{$product->slug}}" target="__blank"><i class="fab fa-facebook-f"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="https://twitter.com/share?url={{$product->slug}}&text={{$product->name}}" target="__blank"><i class="fab fa-twitter"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{$product->slug}}" target="__blank"><i class="fab fa-linkedin-in"></i></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="product-tab mt-40">
                                                <nav>
                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                        <button class="nav-link active" id="des-tab" data-bs-toggle="tab" data-bs-target="#des" type="button"
                                                                role="tab" aria-controls="des" aria-selected="true">Description</button>

                                                        <button class="nav-link" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" type="button"
                                                                role="tab" aria-controls="detail" aria-selected="false">Chi tiết</button>
                                                    </div>
                                                </nav>
                                                <div class="tab-content" id="nav-tabContent">

                                                    <div class="tab-pane fade show active" id="des" role="tabpanel" aria-labelledby="des-tab">
                                                        <div class="product-desc-content">
                                                            {!! $product->description !!}
                                                        </div>
                                                        @if($product->tags->count())
                                                        <div class="item-details-tag">
                                                            <ul class="tags-wrapper">
                                                                <li class="caption">Tags</li>
                                                                @foreach($product->tags as $tag)
                                                                <li><a href="javascript:void(0)">{{$tag->name}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        @endif
                                                    </div>

                                                    <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                                                        <div class="product-desc-content">
                                                            {!! $product->content !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 mb-30">
                                        <div class="sidebar">
                                            <div class="widget custom-widget mb-30" id="order">
                                                <h3 class="widget-title">Order now</h3>
                                                <form method="post" action="{{route('order.store')}}" class="ajax-form">
                                                    @csrf
                                                    <div class="details-list">
                                                        <div class="form-group">
                                                            <label>Quantity</label>
                                                            <input type="number" class="form-control" name="amount" min="1" value="1">
                                                        </div>

                                                        @if($product->options)
                                                            <label>Services</label>
                                                            <select class="form-control" name="price">
                                                                <option value="0">Please select service</option>
                                                                @foreach($product->options as $option)
                                                                    <option value="{{$option['price']}}">{{$option['name']}} [${{$option['price']}}]</option>
                                                                @endforeach
                                                            </select>
                                                        @endif

                                                        <input type="hidden" value="{{$product->id}}" name="product_id">
                                                    </div>
                                                    <div class="widget-btn mt-20">
                                                        <button type="submit" class="btn--base w-100">Order Now</button>
                                                    </div>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="item-bottom-area pt-100 mb-100">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12">
                                            <div class="section-header">
                                                <h2 class="section-title">Other services</h2>
                                            </div>
                                            <div class="item-card-wrapper border-0 p-0 grid-view">
                                                @foreach($realateds as $realated)
                                                <div class="item-card">
                                                    <div class="item-card-thumb">
                                                        <img src="{{$realated->thumb}}" alt="service-banner">
                                                        <div class="item-level">Featured</div>
                                                    </div>
                                                    <div class="item-card-content">
                                                        <div class="item-card-content-top">
                                                            <div class="left" style="opacity: 0">
                                                                <div class="author-thumb">
                                                                    <img src="https://script.viserlab.com/viserlance/assets/images/user/profile/60d467876f2fb1624532871.jpg" alt="author">
                                                                </div>
                                                                <div class="author-content">
                                                                    <h5 class="name"><a href="https://script.viserlab.com/viserlance/user/Adrian">Adrian</a> <span
                                                                                class="level-text">level-5</span></h5>
                                                                    <div class="ratings">
                                                                        <i class="fas fa-star"></i>
                                                                        <span class="rating me-2">5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right">
                                                                <div class="item-amount">${{$realated->price}}</div>
                                                            </div>
                                                        </div>
                                                        <h3 class="item-card-title"><a href="{{$realated->slug}}">{{$realated->name}}</a></h3>
                                                    </div>
                                                    <div class="item-card-footer">
                                                        <div class="left">
{{--                                                            <a href="javascript:void(0)" class="item-love me-2 loveHeartAction" data-serviceid="106"><i class="fas fa-heart"></i> <span--}}
{{--                                                                        class="give-love-amount">(1)</span></a>--}}
{{--                                                            <a href="javascript:void(0)" class="item-like"><i class="las la-thumbs-up"></i> (8)</a>--}}
                                                        </div>
                                                        <div class="right">
                                                            <div class="order-btn">
                                                                <a href="{{$realated->slug}}#order" class="btn--base"><i class="las la-shopping-cart"></i> Order
                                                                    Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

@stop

@section('scripts')
    <script>
        'use strict';

        var swiper = new Swiper(".item-small-slider", {
            spaceBetween: 30,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });

        var swiper2 = new Swiper(".item-details-slider", {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.slider-next',
                prevEl: '.slider-prev',
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
 @stop