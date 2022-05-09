<section
    class="elementor-section elementor-top-section elementor-element elementor-element-577dd411 elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default"
    data-id="577dd411" data-element_type="section">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-2e108de5"
                 data-id="2e108de5" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div class="elementor-element elementor-element-17facf41 elementor-widget elementor-widget-elementskit-client-logo"
                             data-id="17facf41" data-element_type="widget"
                             data-widget_type="elementskit-client-logo.default">
                            <div class="elementor-widget-container">
                                <div class="ekit-wid-con">
                                    <div class="elementskit-clients-slider simple_logo_image"
                                         data-config="{&quot;rtl&quot;:false,&quot;arrows&quot;:false,&quot;dots&quot;:false,&quot;pauseOnHover&quot;:true,&quot;prevArrow&quot;:&quot;&quot;,&quot;nextArrow&quot;:&quot;&quot;,&quot;autoplay&quot;:true,&quot;autoplaySpeed&quot;:1000,&quot;infinite&quot;:true,&quot;slidesToShow&quot;:7,&quot;slidesToScroll&quot;:5,&quot;rows&quot;:1,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1024,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:6},&quot;arrows&quot;:false}]}"
                                         data-direction="">
                                        @foreach($partners as $partner)
                                        <div class="elementskit-client-slider-item ">
                                            <div class="single-client image-switcher" title="{{$partner->name}}">

                                                <div class="content-image">
                                                  <a href="{{$partner->path}}" target="{{$partner->target}}"><img src="{{$partner->image}}"
                                                                  alt="{{$partner->name}}"
                                                                  class=""></a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div><!-- .elementskit-clients-slider END -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
