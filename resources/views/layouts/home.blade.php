@extends('layouts.layout')
@section('content')
    <section id="home">

        <div class="master-slider" id="masterslider">
            @foreach(\App\Models\Photo::OfPosition(\App\Enums\Position::Slider)->get() as $slider)
            <div class="ms-slide">
                <img src="{{$slider->image}}" alt="{{$slider->name}}" data-src="{{$slider->image}}"/>
            </div>
            @endforeach

        </div>

    </section>
    @php
       $page = \App\Models\Post::OfType(\App\Enums\PostType::page)->status()->sort()->first();
    @endphp
    @if($page)
    <section class="g-py-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 g-mb-50 g-mb-0--lg">
                    <img class="img-fluid" src="{{$page->image}}"
                         alt="{{$page->image}}"/>
                </div>

                <div class="col-lg-7 align-self-center">
                    <header class="u-heading-v2-5--bottom g-brd-primary g-mb-20">
                        <h2 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-22 g-color-primary">
                            {{$page->title}}</h2>
                    </header>

                    <p class="g-mb-30 text-justify">{!! $page->description !!}</p>

                    <a class="btn btn-md u-btn-primary rounded-0"
                       href="{{$page->slug}}">Tìm hiểu thêm</a>
                </div>
            </div>
        </div>
    </section>
    @endif
    <section class="g-py-30 text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center u-heading-v2-5--bottom g-brd-primary g-mb-30">
                    <h2 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-22 g-color-primary g-mb-0">
                        {{setting('site.name',1)}}</h2>
                </div>
            </div>
            <div class="row">
                @foreach(\App\Models\Category::OfType(\App\Enums\CategoryType::product)->status()->get()  as $category)
                <div class="col-lg-4 col-md-4 col-12 g-mb-20">
                    <article class="text-center g-pa-20 g-mb-5">

                        <a class="g-text-underline--none--hover" href="{{$category->slug}}"><img
                                class="d-inline-block img-fluid border g-pa-20 w-100 img-category"
                                src="{{$category->thumb}}" alt="{{$category->name}}"/></a>

                    </article>
                    <h4 class="h5 g-font-weight-600 g-mt-15 text-uppercase"><a
                            class="g-text-underline--none--hover g-color-product-1"
                            href="{{$category->slug}}">{{$category->name}}</a></h4>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @foreach(\App\Models\Category::with('translation')->whereType(\App\Enums\CategoryType::product)->public()->status()->oldest('sort')->latest()->get() as $category)
    <section class="g-py-20 text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center u-heading-v2-5--bottom g-brd-primary g-mb-20">
                    <h2 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-22 g-color-primary g-mb-0">
                      <a href="{{route($category->slug)}}" title="{{$category->name}}">{{$category->name}}</a>  </h2>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach(\App\Models\Product::OfTake(\App\Enums\TakeItem::index)->public()->latest()->get() as $product)
                    <div class="col-lg-3 col-md-4 col-6">
                        @include('include.product',['item' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endforeach
    <section class="g-py-20 text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center u-heading-v2-5--bottom g-brd-primary g-mb-20">
                    <h2 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-22 g-color-primary g-mb-0">
                        Sản mới nổi bật</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach(\App\Models\Product::OfTake(\App\Enums\TakeItem::index)->status()->sort()->get() as $product)
                <div class="col-lg-3 col-md-4 col-6">
                    @include('include.product',['item' => $product])
                </div>
                @endforeach
            </div>
        </div>
    </section>

{{--    <section class="g-py-20">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="card-group d-block d-md-flex g-mx-minus-4">--}}
{{--                        <div class="card g-brd-none">--}}

{{--                            <div class="card-body g-pa-0 g-bg-primary g-brd-none">--}}
{{--                                <div class="media g-pb-5 g-bg-white">--}}
{{--                                    <div class="d-flex align-self-center mr-4">--}}
{{--                      <span class="d-block g-color-primary g-font-size-30">--}}
{{--                        <i class="icon-social-youtube"></i>--}}
{{--                      </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body align-self-center">--}}
{{--                                        <h3 class="mb-0 g-color-gray-dark-v2 g-font-weight-600">VIDEO</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <article class="u-block-hover">--}}
{{--                                    <div class="g-z-index-2 g-pa-15">--}}
{{--                                        <div class="embed-responsive embed-responsive-16by9 g-mb-10">--}}
{{--                                            <iframe src='/www.youtube.com/embed/dFP4LgwVhxc' allowfullscreen=''--}}
{{--                                                    width='100%' frameborder='0'></iframe>--}}
{{--                                        </div>--}}
{{--                                        <h3 class="h6 g-font-weight-700 g-color-white">Sản phẩm từ công ty cổ phần--}}
{{--                                            thức ăn chăn nuôi Tiền Trung</h3>--}}
{{--                                        <p class="g-color-white g-ma-0">Đây là các sản phẩm trực tiếp của trang trại--}}
{{--                                            đang sử dụng, phù hợp từ lợn con đến lợn thịt</p>--}}
{{--                                    </div>--}}
{{--                                </article>--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                        <div class="card g-brd-none">--}}

{{--                            <div class="card-body g-pa-0 g-bg-main-4 g-brd-none">--}}
{{--                                <div class="media g-pb-5 g-bg-white">--}}
{{--                                    <div class="d-flex align-self-center mr-4">--}}
{{--                      <span class="d-block g-color-main-5 g-font-size-30">--}}
{{--                        <i class="icon-media-014 u-line-icon-pro"></i>--}}
{{--                      </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body align-self-center">--}}
{{--                                        <h3 class="mb-0 g-color-gray-dark-v2 g-font-weight-600 text-uppercase">Thư--}}
{{--                                            viện ảnh</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <article class="u-block-hover">--}}
{{--                                    <div class="g-z-index-2 g-pa-15">--}}
{{--                                        <div id="carousel-08-1" class="js-carousel text-center g-mb-15"--}}
{{--                                             data-infinite="true"--}}
{{--                                             data-arrows-classes="u-arrow-v1 g-absolute-centered--y g-width-35 g-height-40 g-font-size-18 g-color-gray g-bg-white g-mt-minus-10"--}}
{{--                                             data-arrow-left-classes="fa fa-angle-left g-left-0"--}}
{{--                                             data-arrow-right-classes="fa fa-angle-right g-right-0"--}}
{{--                                             data-nav-for="#carousel-08-2">--}}
{{--                                            <div class="js-slide">--}}
{{--                                                <a class='js-fancybox d-block g-pos-rel image-wrapper169'--}}
{{--                                                   href='javascript:;' data-fancybox='lightbox-gallery--08-1'--}}
{{--                                                   data-src='Upload/Gallery/tamloi-2020-04-15-09-56-15-.jpg'--}}
{{--                                                   data-caption='Gà Mía Sơn Tây - Mã mào, chân cẳng đỏ hây hây'--}}
{{--                                                   data-animate-in='bounceInDown' data-animate-out='bounceOutDown'--}}
{{--                                                   data-speed='1000' data-overlay-blur-bg='true'><img--}}
{{--                                                        class='img-fluid w-100'--}}
{{--                                                        src='Upload/Gallery/tamloi-2020-04-15-09-56-15-.jpg'--}}
{{--                                                        alt=''/><span--}}
{{--                                                        class='u-bg-overlay__inner h6 g-font-weight-700 g-color-white g-pos-abs g-left-20 g-bottom-10'>Gà Mía Sơn Tây - Mã mào, chân cẳng đỏ hây hây</span></a>--}}
{{--                                            </div>--}}

{{--                                            <div class="js-slide">--}}
{{--                                                <a class="js-fancybox d-block g-pos-rel image-wrapper169"--}}
{{--                                                   href="javascript:;" data-fancybox="lightbox-gallery--08-1"--}}
{{--                                                   data-src="Upload/Gallery/tamloi-2020-04-15-10-05-17-.jpg"--}}
{{--                                                   data-caption="" data-animate-in="bounceInDown"--}}
{{--                                                   data-animate-out="bounceOutDown" data-speed="1000"--}}
{{--                                                   data-overlay-blur-bg="true">--}}
{{--                                                    <img class="img-fluid w-100"--}}
{{--                                                         src="Upload/Gallery/tamloi-2020-04-15-10-05-17-.jpg"--}}
{{--                                                         alt=""/>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}

{{--                                            <div class="js-slide">--}}
{{--                                                <a class="js-fancybox d-block g-pos-rel image-wrapper169"--}}
{{--                                                   href="javascript:;" data-fancybox="lightbox-gallery--08-1"--}}
{{--                                                   data-src="Upload/Gallery/tamloi-2020-04-15-10-11-01-.jpg"--}}
{{--                                                   data-caption="" data-animate-in="bounceInDown"--}}
{{--                                                   data-animate-out="bounceOutDown" data-speed="1000"--}}
{{--                                                   data-overlay-blur-bg="true">--}}
{{--                                                    <img class="img-fluid w-100"--}}
{{--                                                         src="Upload/Gallery/tamloi-2020-04-15-10-11-01-.jpg"--}}
{{--                                                         alt=""/>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}

{{--                                            <div class="js-slide">--}}
{{--                                                <a class="js-fancybox d-block g-pos-rel image-wrapper169"--}}
{{--                                                   href="javascript:;" data-fancybox="lightbox-gallery--08-1"--}}
{{--                                                   data-src="Upload/Gallery/tamloi-2020-04-15-10-11-13-.jpg"--}}
{{--                                                   data-caption="" data-animate-in="bounceInDown"--}}
{{--                                                   data-animate-out="bounceOutDown" data-speed="1000"--}}
{{--                                                   data-overlay-blur-bg="true">--}}
{{--                                                    <img class="img-fluid w-100"--}}
{{--                                                         src="Upload/Gallery/tamloi-2020-04-15-10-11-13-.jpg"--}}
{{--                                                         alt=""/>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                        <div id="carousel-08-2"--}}
{{--                                             class="js-carousel text-center g-mx-minus-10 u-carousel-v3"--}}
{{--                                             data-infinite="true" data-center-mode="true" data-slides-show="4"--}}
{{--                                             data-is-thumbs="true" data-nav-for="#carousel-08-1">--}}
{{--                                            <div class="js-slide g-px-10">--}}
{{--                                                <img class='img-fluid w-100'--}}
{{--                                                     src='Upload/Gallery/tamloi-2020-04-15-09-56-15-.jpg' alt=''/>--}}
{{--                                            </div>--}}

{{--                                            <div class="js-slide g-px-10">--}}
{{--                                                <img class="img-fluid w-100"--}}
{{--                                                     src="Upload/Gallery/tamloi-2020-04-15-10-05-17-.jpg" alt=""/>--}}
{{--                                            </div>--}}

{{--                                            <div class="js-slide g-px-10">--}}
{{--                                                <img class="img-fluid w-100"--}}
{{--                                                     src="Upload/Gallery/tamloi-2020-04-15-10-11-01-.jpg" alt=""/>--}}
{{--                                            </div>--}}

{{--                                            <div class="js-slide g-px-10">--}}
{{--                                                <img class="img-fluid w-100"--}}
{{--                                                     src="Upload/Gallery/tamloi-2020-04-15-10-11-13-.jpg" alt=""/>--}}
{{--                                            </div>--}}


{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </article>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    @foreach(\App\Models\Category::OfType(\App\Enums\CategoryType::post)->status()->get() as $cate)
    <section class="g-py-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center u-heading-v2-5--bottom g-brd-primary g-mb-20">
                    <h2 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-22 g-color-primary g-mb-0">
                        {{$cate->name}}</h2>
                </div>
            </div>

            <div class="row">
                @foreach(\App\Models\Post::OfType(\App\Enums\PostType::post)->OfCategory($cate->id)->OfTake(\App\Enums\TakeItem::index)->status()->sort()->get() as $post)
                <div class="col-md-3 col-lg-4 col-6 g-mb-20">
                    <article>
                        <a class="g-text-underline--none--hover"
                           href="{{$post->slug}}">
                            <label class="u-ribbon-v1 g-color-white g-bg-primary g-font-weight-500 g-font-size-12 text-uppercase rounded g-top-20 g-left-30 g-px-10 g-py-4">{{$post->created_at->format('d/m/Y')}}</label>
                            <img class="img-fluid w-100 g-pa-5 img-post" src="{{$post->thumb}}"
                                 alt="{{$post->title}}"/></a>
                        <div class="g-bg-white g-pa-5">
                            <!--<div class="g-mb-5 small">
                              12/04/2021
                            </div>
                            <div class="g-width-60 g-brd-bottom g-brd-3 g-brd-primary g-mb-10"></div>-->
                            <h3 class="h6 g-font-weight-600 g-mb-10">
                                <a class="g-color-gray-dark-v2 g-text-underline--none--hover"
                                   href="{{$post->slug}}">{{$post->title}}</a>
                            </h3>
                            <!--<p class="g-color-gray-dark-v2">Bệnh cầu trùng và viêm ruột hoại tử ước tính gây thiệt hại khoảng 10 tỷ USA mỗi năm ở Mỹ. ...</p>
                          </div>..-->
                    </article>

                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endforeach
@endsection
