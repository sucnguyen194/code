@extends('layouts.layout')
@section('title') Tags: #{{$slug}} @stop
@section('content')
    <div data-elementor-type="wp-page" data-elementor-id="8038" class="elementor elementor-8038"
         data-elementor-settings="[]">
        <div class="elementor-inner">
            <div class="elementor-section-wrap">
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-67f1066 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="67f1066" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-e8c336c"
                                 data-id="e8c336c" data-element_type="column">
                                <div class="elementor-column-wrap">
                                    <div class="elementor-widget-wrap">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-ad1a7e3 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="ad1a7e3" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-f523beb"
                                 data-id="f523beb" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-ba68429 elementor-widget elementor-widget-instive-post-slider"
                                             data-id="ba68429" data-element_type="widget"
                                             data-widget_type="instive-post-slider.default">
                                            <div class="elementor-widget-container">
                                                <div class="blog-post">
                                                    @foreach($translations as $post)
                                                        <div class="post ">
                                                            <div class="post-body">
                                                                <div class="post-media">
                                                                    <img width="750" height="465"
                                                                         src="{{$post->item->thumb}}"
                                                                         class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                                                         alt="" loading="lazy"/></div>
                                                                <div class="post-meta">

                                                         <span class="post-date">
                                 <i class="fa fa-clock-o"></i>
                                 {{optional($post->item)->created_at->diffForHumans()}}
                              </span>
                                                                </div>
                                                                <div class="post-title">
                                                                    <h3>
                                                                        <a href="{{route('slug',$post->slug)}}">
                                                                            {{$post->name}}
                                                                        </a>
                                                                    </h3>
                                                                </div>
                                                                <div class="post-content">
                                                                    <p>
                                                                        {!! str_limit($post->description, 40) !!}</p>
                                                                    <a href="{{route('slug',$post->slug)}}"
                                                                       class="btn-link readmore"> Đọc thêm </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="blog-paginate">
                                                    {!! $translations->appends(request()->except(['page']))->links() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    @include('partials.footer')
@stop

@section('scripts')
    <link href="/client/uploads/elementor/css/post-2958785b.css" rel="stylesheet">
    <script>
        $('body').addClass('page-template-default page page-id-8038 page-child parent-pageid-102 wp-custom-logo sidebar-active elementor-default elementor-template-full-width elementor-kit-4327 elementor-page elementor-page-8038');
    </script>

    <style>
        .post {
            width: 50%;
            float: left;
        }
        .post img {
            height: 300px;
            object-fit: cover;
        }
    </style>
@stop
