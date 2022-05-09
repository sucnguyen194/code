@extends('layouts.layout')
@section('title') {{$translation->title_seo}} @stop
@section('url') {{route('slug',$translation->slug)}} @stop
@section('site_name') {{$translation->title_seo}} @stop
@section('description') {{$translation->description_seo}} @stop
@section('keywords') {{$translation->keyword_seo}} @stop
@section('image') {{$translation->post->image}} @stop

@section('content')
    <section id="wrapper-content" class="wrapper-content">
        <div class="title-container">
            <div class="title">
                <nav class="bread-crumbs">
                    <ul>

                        <li data-key="home"><a href="/">Trang chủ</a></li>
                        <li>/</li>
                        @if($translation->post->category)
                        <li data-key="tin-tuc"><a href="{{$translation->post->category->slug}}">{{$translation->post->category->name}}</a></li>
                        <li>/</li>
                        @endif
                        <li data-key="lich-ngoai-khoa-thang-01-nam-2022"><span class="current">{{$translation->name}}</span>
                        </li>
                    </ul>
                </nav>

                <h3 class="heading">{{$translation->post->category ? $translation->post->category->name : $translation->name}}</h3>
            </div>
        </div>

        <section id="post-3475"
                 class="content-main clearfix post-3475 post type-post status-publish format-standard has-post-thumbnail hentry category-tin-tuc container">
            <div class="row">


                <article class="column span-8">
                    <header class="section-title large">
                        <h5 class="meta-info"><p><span class="meta-item meta-date"><i class="l-clock-o"></i> {{$translation->post->created_at->format('d/m Y')}}</span>
                            </p></h5>
                        <h1 class="heading">{{$translation->name}}</h1>
                    </header>

                    <footer class="meta-info"><p><span class="meta-item meta-date"><i class="l-clock-o"></i> {{$translation->post->created_at->format('d/m Y')}}</span>
                            @if($translation->post->category)
                            <span class="meta-item meta-category"><i class="l-folder-open-o"></i>  <a
                                        href="{{$translation->post->category->slug}}"
                                        title="{{$translation->post->category->name}}">{{$translation->post->category->name}}</a></span>
                            @endif
                            @if($translation->post->admin)
                            <span
                                    class="meta-item meta-author"><i class="l-user"></i> <a
                                        href="{{route('post.author', $translation->post->admin->id)}}"
                                        rel="tác giả">{{$translation->post->admin->name}}</a></span>
                            @endif
                        </p></footer>
                    <div class="story">
                        {!! $translation->content !!}

                    </div>

                    <div class="tag-content"></div>


                </article>


                @include('partials.right')
            </div>
        </section>


        <div id="back-to-top">
            <a href="#top">{{__('client.top')}}</a>
        </div> <!-- back-to-top -->

    </section>
@stop
