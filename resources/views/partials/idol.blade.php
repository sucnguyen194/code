<section
    class="elementor-section elementor-top-section elementor-element elementor-element-5f38b7e elementor-section-boxed elementor-section-height-default elementor-section-height-default"
    data-id="5f38b7e" data-element_type="section">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-84950fd"
                 data-id="84950fd" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div class="elementor-element elementor-element-3df1c71 elementor-widget elementor-widget-elementskit-heading"
                             data-id="3df1c71" data-element_type="widget"
                             data-widget_type="elementskit-heading.default">
                            <div class="elementor-widget-container">
                                <div class="ekit-wid-con">
                                    <div class="ekit-heading elementskit-section-title-wraper text_left   ekit_heading_tablet-   ekit_heading_mobile-">
                                        <h2 class="ekit-heading--title elementskit-section-title ">
                                            lựa chọn của các <span><span>NGÔI SAO</span></span>
                                        </h2>
                                        <div class="ekit_heading_separetor_wraper ekit_heading_elementskit-border-divider">
                                            <div class="elementskit-border-divider"></div>
                                        </div>
                                        <div class='ekit-heading__description'>
                                                        <pre><span
                                                                style="font-family: arial, helvetica, sans-serif;font-size: 12pt"><br/>Được lựa chọn là đối tác tài chính của các nghệ sĩ Việt. <br/>DFA Premier tự tin vào dịch vụ chăm sóc khách hàng tận tâm và sản phẩm số 1 trên thị trường</span></pre>
                                            <p> </p>
                                        </div>
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
    class="elementor-section elementor-top-section elementor-element elementor-element-028b2c8 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
    data-id="028b2c8" data-element_type="section">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-d06df8e"
                 data-id="d06df8e" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div class="elementor-element elementor-element-a6c78ba elementor-widget elementor-widget-gallery"
                             data-id="a6c78ba" data-element_type="widget"
                             data-settings="{&quot;lazyload&quot;:&quot;yes&quot;,&quot;gallery_layout&quot;:&quot;grid&quot;,&quot;columns&quot;:4,&quot;columns_tablet&quot;:2,&quot;columns_mobile&quot;:1,&quot;gap&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;gap_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;gap_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;link_to&quot;:&quot;file&quot;,&quot;aspect_ratio&quot;:&quot;3:2&quot;,&quot;overlay_background&quot;:&quot;yes&quot;,&quot;content_hover_animation&quot;:&quot;fade-in&quot;}"
                             data-widget_type="gallery.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-gallery__container">
                                    @foreach($idols as $idol)
                                    <a class="e-gallery-item elementor-gallery-item elementor-animated-content"
                                       href="{{$idol->image}}"
                                       data-elementor-open-lightbox="yes"
                                       data-elementor-lightbox-slideshow="all-a6c78ba"
                                       data-elementor-lightbox-title="{{$idol->name}}">
                                        <div class="e-gallery-image elementor-gallery-item__image"
                                             data-thumbnail="{{$idol->thumb}}"
                                             data-width="225" data-height="300" alt="{{$idol->name}}"></div>
                                        <div class="elementor-gallery-item__overlay"></div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-1b34bb5 elementor-widget elementor-widget-spacer"
                             data-id="1b34bb5" data-element_type="widget" data-widget_type="spacer.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-spacer">
                                    <div class="elementor-spacer-inner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
