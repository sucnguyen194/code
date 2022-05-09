@extends('layouts.layout')
@section('title') {{$author->name}} @stop
@section('url') {{route('post.author',$author->id)}} @stop
@section('content')
    <section id="wrapper-content" class="wrapper-content">
        <div class="title-container">
            <div class="title">
                <nav class="bread-crumbs">
                    <ul>

                        <li data-key="home"><a href="/">{{__('client.home')}}</a></li>
                        <li>/</li>

                        <li data-key="category"><span class="current">{{$author->name}}</span></li>
                    </ul>
                </nav>
                <h3 class="heading">{{$author->name}}</h3>
            </div>
        </div>

        <section class="container content-main archive clearfix">

            <div class="column span-8">
                @foreach($posts as $post)
                    <article id="post-3475"
                             class="post-news-item span-12 post-3475 post type-post status-publish format-standard has-post-thumbnail hentry category-tin-tuc">

                        <div class="thumbnail push-bottom span-4"><a
                                    href="{{$post->slug}}"><img width="355" height="200"
                                                                src="{{$post->image}}"
                                                                class="attachment-large size-large"
                                                                alt="{{$post->title}}"/></a></div>
                        <div class="post-content span-8">
                            <header class="article-title">
                                <h2 class="heading"><a href="{{$post->slug}}">{{$post->title}}</a></h2>
                            </header>

                            <div class="copy">
                                <p class="excerpt">{!! str_limit($post->description,50) !!}</p>
                            </div>

                            <meta-info class="meta-info"><p><span class="meta-item meta-date"><i class="l-clock-o"></i> {{$post->created_at->format('d/m Y')}}</span>
                                </p></meta-info>
                        </div>
                    </article>
                @endforeach
                <nav class="navigation pagination" role="navigation">
                    {!! $posts->appends(request()->except(['page']))->links() !!}
                </nav>
            </div>

            @include('partials.right')
        </section>

        <div id="back-to-top">
            <a href="#top">{{__('client.top')}}</a>
        </div> <!-- back-to-top -->

    </section>
@stop

