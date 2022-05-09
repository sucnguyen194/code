@foreach($categories as $category)
<section
    class="elementor-section elementor-top-section elementor-element elementor-element-68bce8b elementor-section-boxed elementor-section-height-default elementor-section-height-default"
    data-id="68bce8b" data-element_type="section">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-538ddbc"
                 data-id="538ddbc" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div class="elementor-element elementor-element-d52f9bd elementor-widget elementor-widget-elementskit-heading"
                             data-id="d52f9bd" data-element_type="widget"
                             data-widget_type="elementskit-heading.default">
                            <div class="elementor-widget-container">
                                <div class="ekit-wid-con">
                                    <div class="ekit-heading elementskit-section-title-wraper text_left   ekit_heading_tablet-   ekit_heading_mobile-">

                                        <h2 class="ekit-heading--title elementskit-section-title " style="padding-top: 50px">
                                         <a href="{{$category->slug}}">{{$category->name}} </a>
                                        </h2>
                                        <div class="ekit_heading_separetor_wraper ekit_heading_elementskit-border-divider">
                                            <div class="elementskit-border-divider"></div>
                                        </div>
                                        @if($category->description)
                                        <div class='ekit-heading__description'>
                                            {!! $category->description !!}
                                        </div>
                                         @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section
    class="elementor-section elementor-top-section elementor-element elementor-element-7a36b7e elementor-section-boxed elementor-section-height-default elementor-section-height-default"
    data-id="7a36b7e" data-element_type="section">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-293ae27"
                 data-id="293ae27" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div class="elementor-element elementor-element-ee89eb5 lae-slider-arrow-placement-middle-center lae-slider-arrow-shape-circle lae-slider-arrow-color-dark lae-slider-arrow-visibility-always elementor-widget elementor-widget-lae-posts-multislider"
                             data-id="ee89eb5" data-element_type="widget"
                             data-widget_type="lae-posts-multislider.default">
                            <div class="elementor-widget-container">

                                <div class="lae-posts-multislider-wrap">
                                    <div id="lae-posts-multislider-ee89eb5"
                                         class="lae-posts-multislider lae-container lae-posts-multislider-style-1"
                                         data-settings='{"arrows":true,"dots":false,"autoplay":false,"autoplay_speed":3000,"animation_speed":300,"pause_on_hover":true,"adaptive_height":false,"display_columns":3,"scroll_columns":3,"tablet_width":800,"tablet_display_columns":2,"tablet_scroll_columns":2,"mobile_width":480,"mobile_display_columns":1,"mobile_scroll_columns":1}'>
                                        @foreach($category->posts as $post)
                                        <div class="lae-posts-multislider-item lae-align-bottom-left">

                                            <article id="post-10216"
                                                     class="lae-post-entry post-10216 post type-post status-publish format-standard has-post-thumbnail hentry category-business category-marketing tag-digital tag-marketing tag-seo">


                                                <a class="lae-post-link-overlay"
                                                   href="{{$post->slug}}"
                                                   target=""></a>


                                                <div class="lae-post-overlay lae-post-featured-img-bg"
                                                     style="background-image: url({{$post->image}}); height: 500px;">


                                                    <div class="lae-post-text-wrap">

                                                        <div class="lae-post-text">


                                                                        <span class="lae-terms">
                                                                            @if($post->category)
                                                                                <a
                                                                                    href="{{$post->category->slug}}">{{$post->category->name}}</a>,
                                                                            @endif

                                                                            @foreach($post->categories as $category)
                                                                            <a
                                                                                href="{{$category->slug}}">{{$category->name}}</a>{{!$loop->last ?? ',' }}
                                                                            @endforeach
                                                                        </span>


                                                            <h3 class="lae-post-title"><a
                                                                    href="{{$post->slug}}"
                                                                    title="{{$post->title}}"
                                                                    rel="bookmark">{{$post->title}}</a>
                                                            </h3>


                                                            <div class="lae-post-meta">



<span class="author vcard">By     <a class="url fn n"
                                     href="#"
                                     title="{{$post->admin->name}}">{{$post->admin->name}}</a>
</span>


                                                                <span class="published">
    <abbr title="{{$post->created_at->diffForHumans()}}">{{$post->created_at->diffForHumans()}}</abbr>
</span>


{{--                                                                <span class="lae-comments">{{$post->posts_count > 0 ? $post->posts_count : 'No'}} Comments</span>--}}

                                                            </div>


                                                            <div class="lae-post-content">


                                                            </div>

                                                        </div><!-- .lae-post-text -->

                                                    </div>


                                                </div>


                                            </article><!-- .hentry -->

                                        </div><!-- .lae-posts-multislider-item -->
                                        @endforeach
                                    </div><!-- .lae-posts-multislider -->

                                </div><!-- .lae-posts-multislider-wrap -->        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
