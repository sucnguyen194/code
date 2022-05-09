@extends('layouts.layout')
@section('title') {{$post->translation->title_seo}} @stop
@section('url') {{route('slug',$post->slug)}} @stop
@section('site_name') {{$post->translation->title_seo}} @stop
@section('description') {{$post->translation->description_seo}} @stop
@section('keywords') {{$post->translation->keyword_seo}} @stop
@section('image') {{$post->image}} @stop
@section('content')
    <div id="main-content" class="main-container blog-single" role="main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <article id="post-8182"
                             class="post-content post-single post-8182 post type-post status-publish format-standard has-post-thumbnail hentry category-lifestyle category-oto category-xe-co tag-lifestyle tag-oto tag-xe-co">
                        @if($post->image)
                        <div class="post-media post-image">
                            <img class="img-fluid"
                                 src="{{$post->image}}"
                                 alt=" {{$post->title}}">
                        </div>
                        @endif
                        <div class="post-body clearfix">

                            <!-- Article header -->
                            <header class="entry-header clearfix">
                                <div class="post-meta">
		<span class="post-meta-date">
                  <i class="fa fa-clock"></i>
                     {{$post->created_at->format('d/m/Y')}}</span>
                                    <span class="meta-categories post-cat">
                     <i class="fa fa-folder"></i>
                                        @if($post->category)
                        <a href="{{$post->category->slug}}" rel="category tag">{{$post->category->name}}</a>,
                                        @endif

                                        @foreach($post->categories as $cate)
                                        <a
                                            href="{{$cate->slug}}" rel="category tag">{{$cate->name}}</a>{{!$loop->last ?? ','}}
                                      @endforeach
                     </span>
{{--                                    <span class="post-comment"><i class="fa fa-comment"></i><a href="#"--}}
{{--                                                                                               class="comments-link"></a>{{$post->comments_count}}</span>--}}
                                </div>
                                <h1 class="entry-title">{{$post->title}}</h1>

                            </header><!-- header end -->

                            <!-- Article content -->
                            <div class="entry-content clearfix">
                                {!! $post->content !!}

                                @if($post->tags_count > 0)
                                <div class="post-footer clearfix">
                                    <div class="post-tag-container">
                                        <div class="tag-lists"><span>Tags:</span>
                                            @foreach($post->tags as $tag)
                                            <a href="{{$tag->slug}}"
                                                                                    rel="tag">{{$tag->name}}</a>
                                             @endforeach
                                        </div>
                                    </div>
                                </div> <!-- .entry-footer -->
                                @endif
                            </div> <!-- end entry-content -->
                        </div> <!-- end post-body -->
                    </article>

{{--                    <nav class="post-navigation clearfix">--}}
{{--                        <div class="post-previous">--}}
{{--                            <a href="">--}}
{{--                                <h3>Sản phẩm tài chính và những điều cần biết</h3>--}}
{{--                                <span><i class="fas fa-arrow-left"></i>Previous post</span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="post-next">--}}
{{--                            <a href="../bao-hiem-xa-hoi-la-gi-khai-niem-va-cac-quy-dinh-phap-luat/index.html">--}}
{{--                                <h3>Bảo hiểm xã hội là gì ? Khái niệm và các quy định pháp luật</h3>--}}

{{--                                <span>Next post <i class="fas fa-arrow-right"></i></span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </nav>--}}
                    @if($related->count())
                    <div class="related-post-area">
                        <h3 class="related-title">Related Posts</h3>
                        <div class="row">
                            @foreach($related as $item)
                            <div class="recent-project-wrapper col-lg-4">
                                <div class="recent-project-img">

                                    <img class="img-responsive" src="{{$item->thumb}}" alt="{{$item->title}}">
                                </div>
                                <!-- end recent-project-img -->
                                <div class="recent-project-info">
                                    <h3 class="ts-title"><a href="{{$item->slug}}">{{$item->title}}</a></h3>
                                    <div class="post-meta">
                                        <span class="post-date">{{$item->created_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                                <!-- end recent-project-info -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
{{--                    <div id="comments" class="blog-post-comment">--}}


{{--                        <div id="respond" class="comment-respond">--}}
{{--                            <h3 id="reply-title" class="comment-reply-title">Leave a Reply <small><a rel="nofollow"--}}
{{--                                                                                                     id="cancel-comment-reply-link"--}}
{{--                                                                                                     href="index.html#respond"--}}
{{--                                                                                                     style="display:none;">Cancel--}}
{{--                                        reply</a></small></h3>--}}
{{--                            <form action="" method="post"--}}
{{--                                  id="commentform" class="comment-form"><p class="comment-notes"><span id="email-notes">Email của bạn sẽ không được hiển thị công khai.</span>--}}
{{--                                    Các trường bắt buộc được đánh dấu <span class="required">*</span></p>--}}
{{--                                <div class="comment-info row">--}}
{{--                                    <div class="col-md-6"><input placeholder="Enter Name" id="author" class="form-control"--}}
{{--                                                                 name="author" type="text" value="" size="30"--}}
{{--                                                                 aria-required='true'/></div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <input placeholder="Enter Email" id="email" name="email" class="form-control"--}}
{{--                                               type="email" value="" size="30" aria-required='true'/></div>--}}
{{--                                    <div class="col-md-12"><input placeholder="Enter Website" id="url" name="url"--}}
{{--                                                                  class="form-control" type="url" value="" size="30"/></div>--}}
{{--                                </div>--}}
{{--                                <p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent"--}}
{{--                                                                               name="wp-comment-cookies-consent"--}}
{{--                                                                               type="checkbox" value="yes"/> <label--}}
{{--                                        for="wp-comment-cookies-consent">Lưu tên của tôi, email, và trang web trong trình--}}
{{--                                        duyệt này cho lần bình luận kế tiếp của tôi.</label></p>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12 ">--}}
{{--					<textarea--}}
{{--                        class="form-control msg-box"--}}
{{--                        placeholder="Enter Comments"--}}
{{--                        id="comment"--}}
{{--                        name="comment"--}}
{{--                        cols="45" rows="8"--}}
{{--                        aria-required="true">--}}
{{--					</textarea>--}}
{{--                                    </div>--}}
{{--                                    <div class="clearfix"></div>--}}
{{--                                </div>--}}
{{--                                <p class="form-submit"><input name="submit" type="submit" id="submit"--}}
{{--                                                              class="btn-comments btn btn-primary" value="Post Comment"/>--}}
{{--                                    <input type='hidden' name='comment_post_ID' value='8182' id='comment_post_ID'/>--}}
{{--                                    <input type='hidden' name='comment_parent' id='comment_parent' value='0'/>--}}
{{--                                </p><input type="hidden" id="ak_js" name="ak_js" value="69"/><textarea name="ak_hp_textarea"--}}
{{--                                                                                                       cols="45" rows="8"--}}
{{--                                                                                                       maxlength="100"--}}
{{--                                                                                                       style="display: none !important;"></textarea>--}}
{{--                            </form>--}}
{{--                        </div><!-- #respond -->--}}

{{--                    </div><!-- #comments -->--}}
                </div> <!-- .col-md-8 -->


                <div class="col-lg-4 col-md-12">
                    @include('partials.sidebar')
                </div><!-- Sidebar col end -->


            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!--#main-content -->

    @include('partials.footer')
@stop

@section('styles')
    <link href="/client/uploads/elementor/css/post-2958785b.css" rel="stylesheet">
    <link href="/client/uploads/elementor/css/post-26785b.css" rel="stylesheet">

    <script>
        $('body').addClass('home page-template page-template-elementor_header_footer page page-id-1420 wp-custom-logo sidebar-active elementor-default elementor-template-full-width elementor-kit-4327 elementor-page elementor-page-1420');
    </script>
@stop
