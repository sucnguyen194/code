<div data-elementor-type="wp-page" data-elementor-id="10146" class="elementor elementor-10146" data-elementor-settings="[]">
    <div class="elementor-inner">
        <div class="elementor-section-wrap">
            <section class="elementor-section elementor-top-section elementor-element elementor-element-2c1d01a7 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="2c1d01a7" data-element_type="section">
                <div class="elementor-container elementor-column-gap-default">
                    <div class="elementor-row">
                        <div class="elementor-column elementor-col-66 elementor-top-column elementor-element elementor-element-6bd5acdf" data-id="6bd5acdf" data-element_type="column">
                            <div class="elementor-column-wrap elementor-element-populated">
                                <div class="elementor-widget-wrap">
                                    <div class="elementor-element elementor-element-b88a0e8 service-faq elementor-widget elementor-widget-elementskit-accordion" data-id="b88a0e8" data-element_type="widget" data-widget_type="elementskit-accordion.default">
                                        <div class="elementor-widget-container">
                                            <div class="ekit-wid-con" >

                                                <div class="elementskit-accordion accoedion-primary" id="accordion-625bba730a672">

                                                    @foreach($quessions as $key => $quession)
                                                    <div class="elementskit-card">
                                                        <div class="elementskit-card-header" id="primaryHeading-{{$key}}-b88a0e8">
                                                            <a href="#Collapse-{{$quession->id}}" class="ekit-accordion--toggler elementskit-btn-link collapsed" data-ekit-toggle="collapse" data-target="#Collapse-{{$quession->id}}" aria-expanded="{{$key == 0 ? 'true' : 'false'}}" aria-controls="Collapse-{{$quession->id}}">
                                                                <span class="number"></span>
                                                                <span class="ekit-accordion-title">{{$quession->name}}</span>
                                                                <div class="ekit_accordion_icon_group">
                                                                    <div class="ekit_accordion_normal_icon">
                                                                        <!-- Normal Icon -->
                                                                        <i class="icon icon-plus icon-open icon-right" aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="ekit_accordion_active_icon">
                                                                        <!-- Active Icon -->
                                                                        <i class="icon icon-minus icon-closed icon-right" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>

                                                        <div id="Collapse-{{$quession->id}}" class="{{$key == 0 ? 'show' : ''}} collapse" aria-labelledby="primaryHeading-{{$key}}-b88a0e8" data-parent="#accordion-625bba730a672">
                                                            <div class="elementskit-card-body ekit-accordion--content">
                                                                {!! $quession->description !!}                                                                                                          </div>
                                                        </div>
                                                    </div><!-- .elementskit-card END -->
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-119ef4af" data-id="119ef4af" data-element_type="column">
                            <div class="elementor-column-wrap elementor-element-populated">
                                <div class="elementor-widget-wrap">
                                    <div class="elementor-element elementor-element-21218cb4 overlay-box ekit-equal-height-disable elementor-widget elementor-widget-elementskit-icon-box" data-id="21218cb4" data-element_type="widget" data-widget_type="elementskit-icon-box.default">
                                        <div class="elementor-widget-container">
                                            <div class="ekit-wid-con" >        <!-- link opening -->
                                                <!-- end link opening -->

                                                <div class="elementskit-infobox text-left text- icon-lef-right-aligin elementor-animation-   ">
                                                    <div class="box-body">
                                                        <h3 class="elementskit-info-box-title">
                                                            bạn cần hỗ trợ?                </h3>
                                                        <p>Hãy liên hệ với đường dây nóng của chúng tôi để được giải đáp thắc mắc.  </p>
                                                        <div class="box-footer disable_hover_button">
                                                            <div class="btn-wraper">
                                                                <a href="#" target="_self" rel="" class="elementskit-btn whitespace--normal elementor-animation-">
                                                                    Liên hệ                                    </a>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>		</div>
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

<link rel="stylesheet" href="/client/uploads/elementor/css/post-2958785b.css">
<link rel="stylesheet" href="/client/uploads/elementor/css/post-101469b1e.css">

<script>
    $('body').addClass('page-template page-template-template page-template-full-width-template page-template-templatefull-width-template-php page page-id-10146 wp-custom-logo sidebar-active elementor-default elementor-template-full-width elementor-kit-4327 elementor-page elementor-page-10146');
</script>
