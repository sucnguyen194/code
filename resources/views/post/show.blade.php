@extends('layouts.layout')
@section('title') {{$translation->title_seo}} @stop
@section('url') {{route('slug',$translation->slug)}} @stop
@section('site_name') {{$translation->title_seo}} @stop
@section('description') {{$translation->description_seo}} @stop
@section('keywords') {{$translation->keyword_seo}} @stop
@section('image') {{$translation->post->image}} @stop

@section('content')

<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->
{{--<section class="g-bg-img-hero u-bg-overlay g-bg-black-opacity-0_6--after g-py-80"--}}
{{--         style="background-image: url(../assets/img/tamloi-slide-03.jpg);">--}}
{{--    <div class="container u-bg-overlay__inner text-center">--}}
{{--        <div class="text-uppercase text-center u-heading-v2-5--bottom g-brd-main-6 g-mb-20">--}}
{{--            <h2 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-26 g-color-main-6 g-mb-0">Tin tức - sự kiện</h2>--}}
{{--        </div>--}}
{{--    </div></section>--}}
{{--<section class="g-bg-img-hero g-py-50">--}}
{{--    <div class="container u-bg-overlay__inner text-center">--}}
{{--        <div class="text-center u-heading-v2-5--bottom g-brd-primary">--}}
{{--            <h1 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-22 g-color-primary g-mb-0">--}}
{{--                {{$translation->item->category->name}}</h1>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<section  class="g-py-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-9 col-12">
                <h3 class="h2 g-font-weight-300 g-mb-20 g-color-primary">
                    {{$translation->name}}
                </h3>
                <h6 class='g-font-size-12 g-mb-5'><i class='icon-clock align-middle g-mr-5'></i>{{$translation->item->created_at->format('d/m/Y')}}</h6>

                <div class="entry-content">
                    {!! $translation->content !!}
                </div>
                @include('include.comment')
                <div class="u-label g-bg-primary u-label--lg g-px-15 g-py-8 g-mr-10 g-mb-15">
                    Các tin khác
                </div>
                @foreach(\App\Models\Post::ofType(\App\Enums\PostType::post)->ofCategory($translation->item->category->id)->ofTake(\App\Enums\TakeItem::replated)->where('id','!=',$translation->item->id)->latest()->get() as $item)
                <div class="d-flex g-mb-10">
                    <div class="g-mr-10">
              <span class="g-color-icon-footer">
                <i class="fa fa-angle-right"></i>
              </span>
                    </div>
                    <p class="mb-0"> <a class="g-color-gray-dark-v2 g-text-underline--none--hover" href="{{$item->slug}}">
                            {{$item->title}}</a></p>
                </div>
                @endforeach
            </div>
            <div class="col-md-4 col-lg-3 g-pa-0">
                @include('include.left')
            </div>
{{--            <div class="col-lg-3 col-md-5 col-12">--}}
{{--                <div class="card g-brd-none g-mb-30">--}}
{{--                    <!-- Links -->--}}
{{--                    <div class="card-body g-pa-0 g-bg-primary">--}}
{{--                        <div class="media g-pb-5 g-bg-white">--}}
{{--                            <div class="d-flex align-self-center mr-4">--}}
{{--                      <span class="d-block g-color-primary g-font-size-30">--}}
{{--                        <i class="icon-social-youtube"></i>--}}
{{--                      </span>--}}
{{--                            </div>--}}
{{--                            <div class="media-body align-self-center">--}}
{{--                                <h3 class="mb-0 g-color-gray-dark-v2">VIDEO</h3>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <article class="u-block-hover">--}}
{{--                            <div class="g-z-index-2 g-pa-15">--}}
{{--                                <div class="embed-responsive embed-responsive-16by9 g-mb-10">--}}
{{--                                    <iframe src='http://www.youtube.com/embed/dFP4LgwVhxc' allowfullscreen='' width='100%' frameborder='0'></iframe>--}}
{{--                                </div>--}}
{{--                                <h3 class="h6 g-font-weight-700 g-color-white">Sản phẩm từ công ty cổ phần thức ăn chăn nuôi Tiền Trung</h3>--}}
{{--                                <p class="g-color-white g-ma-0">Đây là các sản phẩm trực tiếp của trang trại đang sử dụng, phù hợp từ lợn con đến lợn thịt</p>--}}
{{--                            </div>--}}
{{--                        </article>--}}
{{--                    </div>--}}
{{--                    <!-- End Links -->--}}
{{--                </div>--}}

{{--                <div class="card g-brd-none">--}}
{{--                    <!-- Links -->--}}
{{--                    <div class="card-body g-pa-0 g-bg-main-4">--}}
{{--                        <div class="media g-pb-5 g-bg-white">--}}
{{--                            <div class="d-flex align-self-center mr-4">--}}
{{--                      <span class="d-block g-color-main-5 g-font-size-30">--}}
{{--                        <i class="icon-media-014 u-line-icon-pro"></i>--}}
{{--                      </span>--}}
{{--                            </div>--}}
{{--                            <div class="media-body align-self-center">--}}
{{--                                <h3 class="mb-0 g-color-gray-dark-v2">THƯ VIỆN ẢNH</h3>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <article class="u-block-hover">--}}
{{--                            <div class="g-z-index-2 g-pa-15">--}}
{{--                                <div id="carousel-08-1" class="js-carousel text-center g-mb-15" data-infinite="true" data-arrows-classes="u-arrow-v1 g-absolute-centered--y g-width-35 g-height-40 g-font-size-18 g-color-gray g-bg-white g-mt-minus-10" data-arrow-left-classes="fa fa-angle-left g-left-0" data-arrow-right-classes="fa fa-angle-right g-right-0" data-nav-for="#carousel-08-2">--}}
{{--                                    <div class="js-slide">--}}
{{--                                        <a class='js-fancybox d-block g-pos-rel image-wrapper169' href='javascript:;' data-fancybox='lightbox-gallery--08-1' data-src='/Upload/Gallery/tamloi-2020-04-15-09-56-15-.jpg' data-caption='Gà Mía Sơn Tây - Mã mào, chân cẳng đỏ hây hây' data-animate-in='bounceInDown' data-animate-out='bounceOutDown' data-speed='1000' data-overlay-blur-bg='true'><img class='img-fluid w-100' src='../Upload/Gallery/tamloi-2020-04-15-09-56-15-.jpg' alt=''/><span class='u-bg-overlay__inner h6 g-font-weight-700 g-color-white g-pos-abs g-left-20 g-bottom-10'>Gà Mía Sơn Tây - Mã mào, chân cẳng đỏ hây hây</span></a>--}}
{{--                                    </div>--}}

{{--                                    <div class="js-slide">--}}
{{--                                        <a class="js-fancybox d-block g-pos-rel image-wrapper169" href="javascript:;" data-fancybox="lightbox-gallery--08-1" data-src="/Upload/Gallery/tamloi-2020-04-15-10-05-17-.jpg" data-caption="" data-animate-in="bounceInDown" data-animate-out="bounceOutDown" data-speed="1000" data-overlay-blur-bg="true">--}}
{{--                                            <img class="img-fluid w-100" src="../Upload/Gallery/tamloi-2020-04-15-10-05-17-.jpg" alt="" />--}}
{{--                                        </a>--}}
{{--                                    </div>--}}

{{--                                    <div class="js-slide">--}}
{{--                                        <a class="js-fancybox d-block g-pos-rel image-wrapper169" href="javascript:;" data-fancybox="lightbox-gallery--08-1" data-src="/Upload/Gallery/tamloi-2020-04-15-10-11-01-.jpg" data-caption="" data-animate-in="bounceInDown" data-animate-out="bounceOutDown" data-speed="1000" data-overlay-blur-bg="true">--}}
{{--                                            <img class="img-fluid w-100" src="../Upload/Gallery/tamloi-2020-04-15-10-11-01-.jpg" alt="" />--}}
{{--                                        </a>--}}
{{--                                    </div>--}}

{{--                                    <div class="js-slide">--}}
{{--                                        <a class="js-fancybox d-block g-pos-rel image-wrapper169" href="javascript:;" data-fancybox="lightbox-gallery--08-1" data-src="/Upload/Gallery/tamloi-2020-04-15-10-11-13-.jpg" data-caption="" data-animate-in="bounceInDown" data-animate-out="bounceOutDown" data-speed="1000" data-overlay-blur-bg="true">--}}
{{--                                            <img class="img-fluid w-100" src="../Upload/Gallery/tamloi-2020-04-15-10-11-13-.jpg" alt="" />--}}
{{--                                        </a>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                                <div id="carousel-08-2" class="js-carousel text-center g-mx-minus-10 u-carousel-v3" data-infinite="true" data-center-mode="true" data-slides-show="4" data-is-thumbs="true" data-nav-for="#carousel-08-1">--}}
{{--                                    <div class="js-slide g-px-10">--}}
{{--                                        <img class='img-fluid w-100' src='../Upload/Gallery/tamloi-2020-04-15-09-56-15-.jpg' alt=''/>--}}
{{--                                    </div>--}}

{{--                                    <div class="js-slide g-px-10">--}}
{{--                                        <img class="img-fluid w-100" src="../Upload/Gallery/tamloi-2020-04-15-10-05-17-.jpg" alt="" />--}}
{{--                                    </div>--}}

{{--                                    <div class="js-slide g-px-10">--}}
{{--                                        <img class="img-fluid w-100" src="../Upload/Gallery/tamloi-2020-04-15-10-11-01-.jpg" alt="" />--}}
{{--                                    </div>--}}

{{--                                    <div class="js-slide g-px-10">--}}
{{--                                        <img class="img-fluid w-100" src="../Upload/Gallery/tamloi-2020-04-15-10-11-13-.jpg" alt="" />--}}
{{--                                    </div>--}}


{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </article>--}}
{{--                    </div>--}}
{{--                    <!-- End Links -->--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
</section>
<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->
@stop
