@extends('layouts.layout')
@section('title') {{$translation->title_seo}} @stop
@section('url') {{route('slug',$translation->slug)}} @stop
@section('site_name') {{$translation->title_seo}} @stop
@section('description') {{$translation->description_seo}} @stop
@section('keywords') {{$translation->keyword_seo}} @stop
@section('image') {{$translation->category->image}} @stop
@section('content')
    <section id="wrapper-content" class="wrapper-conten widget layers-post-widget post-new posts-home t">
        <div class="title-container">
            <div class="title">
                <nav class="bread-crumbs">
                    <ul>

                        <li data-key="home"><a href="/">Trang chủ</a></li>
                        <li>/</li>

                        <li data-key="category"><span class="current">{{$translation->name}}</span></li>
                    </ul>
                </nav>
                <h3 class="heading">{{$translation->name}}</h3>
            </div>
        </div>

        <section class="container content-main archive clearfix">
            @if($fillters->count())
            <div class="fillter">
                <form method="get" action="">
                    <select name="fillter" class="form-control" onchange="this.form.submit();">
                        <option value="">Bộ phận tuyển dụng</option>
                        @foreach($fillters as $fillter)
                        <option value="{{$fillter->id}}" {{selected($fillter->id, [request()->fillter, $translation->category->id])}}>{{$fillter->name}}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            @endif
            <div class="column span-12 list-grid">
                @foreach($recruitments as $post)
                    <article class="layers-masonry-column thumbnail  column span-3 recruitment-item  " data-cols="3">
                        <div class="thumbnail-media"><a href="{{$post->slug}}"><img width="355"
                                                                                    height="200"
                                                                                    src="{{$post->image}}"
                                                                                    class="attachment-layers-square-medium size-layers-square-medium"
                                                                                    alt="{{$post->title}}"/></a>
                        </div>
                        <div class="thumbnail-body">
                            <div class="overlay">
                                @if($post->deadline)
{{--                                <div class="list_meta">--}}
{{--                                    <span>Hạn nộp hồ sơ: {{\Carbon\Carbon::parse($post->deadline)->format('d/m/Y')}}</span>--}}
{{--                                    <span><i class="fa fa-eye" aria-hidden="true"></i> 40314</span>--}}
{{--                                </div>--}}
                                @endif
                                <header class="article-title recruitment-title">
                                    <h4 class="heading"><a href="{{$post->slug}}"
                                                           title="{{$post->title}}">{{$post->title}}</a></h4>
                                </header>
                                    <div class="list_meta">
                                        <span><i class="l-clock-o"></i> {{\Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</span>
                                        {{--                                    <span><i class="fa fa-eye" aria-hidden="true"></i> 40314</span>--}}
                                    </div>

{{--                                <footer class="meta-info" style="margin-top: 15px"><p><span class="meta-item meta-date"><i--}}
{{--                                                    class="l-clock-o"></i> {{$post->created_at->format('d/m/Y')}}</span>--}}
{{--                                    </p></footer>--}}
                                <a href="{{$post->slug}}" class="button btn-medium">Xem thêm</a>
                            </div>
                        </div>
                    </article>
                @endforeach
                <nav class="navigation pagination" role="navigation">
                    {!! $recruitments->appends(request()->except(['page']))->links() !!}
                </nav>
            </div>


        </section>

        <div id="back-to-top">
            <a href="#top">Đầu trang</a>
        </div> <!-- back-to-top -->

    </section>
@stop

