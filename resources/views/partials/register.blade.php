<section
    class="elementor-section elementor-top-section elementor-element elementor-element-2ee4e5b8 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
    data-id="2ee4e5b8" data-element_type="section"
    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-3584348"
                 data-id="3584348" data-element_type="column"
                 data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <section
                            class="elementor-section elementor-inner-section elementor-element elementor-element-6c002a7 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                            data-id="6c002a7" data-element_type="section"
                            data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                            <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-1d26f28"
                                         data-id="1d26f28" data-element_type="column"
                                         data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                        <div class="elementor-column-wrap elementor-element-populated">
                                            <div class="elementor-widget-wrap">
                                                <div class="elementor-element elementor-element-1f27cca elementor-widget elementor-widget-heading"
                                                     data-id="1f27cca" data-element_type="widget"
                                                     data-widget_type="heading.default">
                                                    <div class="elementor-widget-container">
                                                        <h2 class="elementor-heading-title elementor-size-default">
                                                            đăng ký thành viên</h2></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="elementor-element elementor-element-1f6cd5b elementor-widget elementor-widget-html"
                             data-id="1f6cd5b" data-element_type="widget" data-widget_type="html.default">
                            <div class="elementor-widget-container">
                                <div id="getfly-optin-form-iframe-1625633988947">
                                    <div id="getfly-form" class="getfly-form">
                                        <form method="post" action="{{route('send.contact')}}" data-reset="true" class="ajax-form">
                                            @csrf
                                        <div class="getfly-row">
                                                <label class="getfly-label getfly-label-c">Tên khách hàng</label>
                                                <input type="input" class="getfly-input " name="data[name]" placeholder=" ">
                                        </div>
                                        <div class="getfly-row">
                                            <label class="getfly-label getfly-label-c">Điện thoại<span class="getfly-span getfly-span-c">*</span></label><input type="text" name="data[phone]" id="account_phone" class="getfly-input phone " placeholder="VD: 0123456789"></div><div class="getfly-row">
                                            <label class="getfly-label getfly-label-c">Email<span class="getfly-span getfly-span-c">*</span></label>
                                            <input type="text" name="data[email]" id="account_email" class="getfly-input email " placeholder="vidu@mail.com"></div>
                                        <div class="getfly-mt10 getfly-btn">
                                            <button type="submit" class="getfly-button getfly-button-bg ">ĐĂNG KÝ NGAY</button>
                                        </div>
                                            </form>

                                        <p style="margin-top: 30px">Đã là thành viên? <strong><a href="#">Đăng
                                                    nhập</a></strong></p>
                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-35ceb558"
                 data-id="35ceb558" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div class="elementor-element elementor-element-e0f4898 ekit-testimonial elementor-widget elementor-widget-elementskit-testimonial"
                             data-id="e0f4898" data-element_type="widget"
                             data-widget_type="elementskit-testimonial.default">
                            <div class="elementor-widget-container">
                                <div class="ekit-wid-con">
                                    <div class="elementskit-testimonial-slider"
                                         data-config="{&quot;rtl&quot;:false,&quot;arrows&quot;:true,&quot;dots&quot;:false,&quot;pauseOnHover&quot;:true,&quot;prevArrow&quot;:&quot;icon icon-chevron-left&quot;,&quot;nextArrow&quot;:&quot;icon icon-chevron-right&quot;,&quot;autoplay&quot;:true,&quot;autoplaySpeed&quot;:3000,&quot;infinite&quot;:true,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;responsive&quot;:[]}">
                                        @foreach($customers as $customer)
                                        <div class="elementskit-testimonial-inner">
                                            <div class="elementskit-single-testimonial-slider ekit_testimonial_style_2">
                                                <div class="elementskit-commentor-content">
                                                    <div class="elementskit-client_logo">
                                                        <img src="{{resize_image($customer->image, 'l')}}"
                                                             class="elementskit-testimonial-client-logo"
                                                             alt="Client Logo">
                                                    </div>
                                                    <div class="client-commit">
                                                        {!! $customer->description !!}
                                                    </div>

                                                    <span class="elementskit-border-hr"></span>
                                                    <span class="elementskit-profile-info">
						<strong class="elementskit-author-name">{{$customer->name}}</strong>
						<span class="elementskit-author-des">{{$customer->translation->job}}</span>
					</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
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
