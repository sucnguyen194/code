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

<div id="content" class="site-content">
    <div class="container">
        <div class="row">
            <div id="layout" class="clearfix sidebar-right">
                <p class="rt-breadcrumbs"><span><span><a href="/">Trang chủ</a> » <span
                                class="breadcrumb_last" aria-current="page">{{$cate->name}}</span></span></span></p>
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <div class="rt-news list content_style_4">
                            <h1 class="heading"><span>{{$cate->name}}</span></h1>
                            <div class="list-news">
                                @foreach($posts as $item)
                                    @include('Include.post')
                                @endforeach
                                <div class="wp-pagenavi" style="float: left; width: 100%;margin-top: 30px">
                                    {!! $posts->appends(request()->except('page'))->links() !!}
                                </div>
                            </div>
                        </div><!--End #news-wrap-->
                    </main><!-- #main -->
                </div><!-- #primary -->

                @include('Include.right')
            </div><!-- #layout -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- #content -->

<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->
@stop

