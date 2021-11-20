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
{{--         style="background-image: url(../Upload/Adv/tamloi-2020-09-07-15-48-48.jpg)">--}}
{{--    <div class="container u-bg-overlay__inner text-center">--}}
{{--        <div class="text-uppercase text-center u-heading-v2-5--bottom g-brd-main-6 g-mb-20">--}}
{{--            <h2 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-26 g-color-main-6 g-mb-0">Tin tức - sự kiện</h2>--}}
{{--        </div>--}}
{{--    </div></section>--}}
<section class="g-bg-img-hero g-py-50">
    <div class="container u-bg-overlay__inner text-center">
        <div class="text-center u-heading-v2-5--bottom g-brd-primary">
            <h1 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-22 g-color-primary g-mb-0">
               {{$translation->category->name}}</h1>
        </div>
    </div>
</section>

<section  class="g-py-0">
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-4 col-lg-4 col-6 g-mb-15">
                <!-- Article -->
                <article>
                    <a class="g-text-underline--none--hover" href="{{$post->slug}}">
                        <label class="u-ribbon-v1 g-color-white g-bg-primary g-font-weight-500 g-font-size-12 text-uppercase rounded g-top-20 g-left-30 g-px-10 g-py-4">{{$post->created_at->format('d/m/Y')}}</label>
                        <img class="img-fluid w-100 g-pa-5 img-post" src="{{$post->thumb}}" alt="{{$post->title}}" /></a>
                    <div class="g-bg-white g-pa-5">
                        <!--<div class="g-mb-5 small">
                          12/04/2021
                        </div>
                        <div class="g-width-60 g-brd-bottom g-brd-3 g-brd-primary g-mb-10"></div>-->
                        <h3 class="h6 g-font-weight-600 g-mb-10">
                            <a class="g-color-gray-dark-v2 g-text-underline--none--hover" href="{{$post->slug}}">{{$post->title}}</a>
                        </h3>
                        <p class="g-color-gray-dark-v2">
                            {!! str_limit($post->description) !!}
                        </p>
                    </div>
                </article>
                <!-- End Article -->
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12 g-mt-30">
                {{ $posts->appends(request()->except(['page']))->links() }}
            </div>
        </div>
    </div>
</section>
<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->
@stop

