<section
    class="elementor-section elementor-top-section elementor-element elementor-element-49c90d4a elementor-section-full_width elementor-section-height-default elementor-section-height-default"
    data-id="49c90d4a" data-element_type="section">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-2bf4e5e0"
                 data-id="2bf4e5e0" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div class="elementor-element elementor-element-8b3e8ca elementor-widget elementor-widget-slider_revolution"
                             data-id="8b3e8ca" data-element_type="widget"
                             data-widget_type="slider_revolution.default">
                            <div class="elementor-widget-container">

                                <div class="wp-block-themepunch-revslider">
                                    <!-- START Home 3 REVOLUTION SLIDER 6.3.8 --><p class="rs-p-wp-fix"></p>
                                    <rs-module-wrap id="rev_slider_9_1_wrapper" data-source="gallery"
                                                    style="background:transparent;padding:0;margin:0px auto;margin-top:0;margin-bottom:0;">
                                        <rs-module id="rev_slider_9_1" style="" data-version="6.3.8">
                                            <rs-slides>
                                                @foreach($sliders as $slider)
                                                <rs-slide data-key="rs-{{$slider->id}}" data-title="{{$slider->name}}"
                                                          data-thumb="{{$slider->thumb}}"
                                                          data-anim="ei:d;eo:d;s:d;r:default;t:turnoff-vertical;sl:d;">
                                                    <img loading="lazy"
                                                         src="{{$slider->image}}"
                                                         title="{{$slider->name}}"
                                                         width="2560" height="1707" class="rev-slidebg"
                                                         data-no-retina>
                                                    <!--
                -->
                                                    <rs-layer
                                                        id="slider-9-slide-24-layer-1"
                                                        data-type="text"
                                                        data-rsp_ch="on"
                                                        data-xy="xo:40px,40px,47px,5px;yo:173px,173px,129px,95px;"
                                                        data-text="w:normal;s:18,18,12,16;l:28,28,18,8;ls:0.54px,0.54px,0px,0px;"
                                                        data-padding="r:15;l:15;"
                                                        data-frame_0="y:50,50,34,16;"
                                                        data-frame_1="st:590;sp:1000;sR:590;"
                                                        data-frame_999="y:bottom;sX:2;sY:2;o:0;rZ:70deg;st:w;sp:1000;sR:7410;"
                                                        style="z-index:12;font-family:Open Sans;text-transform:uppercase;"
                                                    >
                                                        <div class="sub-title primary-color">{{$slider->description}}
                                                        </div>
                                                    </rs-layer><!--

							-->
                                                    <rs-layer
                                                        id="slider-9-slide-24-layer-2"
                                                        data-type="text"
                                                        data-color="#fff"
                                                        data-rsp_ch="on"
                                                        data-xy="xo:39px,39px,47px,3px;yo:214px,214px,156px,127px;"
                                                        data-text="w:normal;s:52,52,35,26;l:58,58,39,32;fw:800;"
                                                        data-dim="w:601px,601px,415px,307px;minh:0px,0px,none,none;"
                                                        data-padding="r:15,15,11,15;l:15,15,11,15;"
                                                        data-frame_0="y:50,50,34,16;"
                                                        data-frame_1="st:1340;sp:1000;sR:1340;"
                                                        data-frame_999="o:0;st:8900;sR:6660;"
                                                        style="z-index:11;font-family:Open Sans;text-transform:uppercase;"
                                                    >{{$slider->name}}
                                                    </rs-layer><!--

							-->
                                                    <rs-layer
                                                        id="slider-9-slide-24-layer-6"
                                                        class="rev-btn"
                                                        data-type="button"
                                                        data-rsp_ch="on"
                                                        data-xy="xo:296px,296px,209px,196px;yo:362px,362px,259px,203px;"
                                                        data-text="w:normal;s:14,14,12,12;l:50,50,40,19;fw:700;"
                                                        data-dim="w:auto,auto,auto,159px;minh:0px,0px,none,none;"
                                                        data-padding="t:0,0,0,10;r:25,25,17,25;b:0,0,0,10;l:25,25,17,25;"
                                                        data-border="bos:solid;boc:#ffffff;bow:1px,1px,1px,1px;bor:5px,5px,5px,5px;"
                                                        data-frame_0="y:50,50,34,16;"
                                                        data-frame_1="st:2390;sp:1000;sR:2390;"
                                                        data-frame_999="o:0;st:w;sR:5610;"
                                                        data-frame_hover="c:#072143;bgc:#fcbc3a;boc:#fcbc3a;bor:5px,5px,5px,5px;bos:solid;bow:1px,1px,1px,1px;sp:100;e:power1.inOut;bri:120%;"
                                                        style="z-index:9;font-family:Open Sans;text-transform:uppercase;"
                                                    >
                                                        <div class="slider-btn"><i class="fa-user"></i> yêu
                                                            cầu tư vấn
                                                        </div>
                                                    </rs-layer><!--

							-->
                                                    <rs-layer
                                                        id="slider-9-slide-24-layer-7"
                                                        class="rev-btn"
                                                        data-type="button"
                                                        data-color="#072143"
                                                        data-rsp_ch="on"
                                                        data-xy="xo:55px,55px,57px,18px;yo:362px,362px,259px,203px;"
                                                        data-text="w:normal;s:14,14,12,12;l:50,50,40,19;fw:700;"
                                                        data-dim="w:auto,auto,auto,160px;minh:0px,0px,none,none;"
                                                        data-padding="t:0,0,0,10;r:25,25,17,25;b:0,0,0,10;l:25,25,17,25;"
                                                        data-border="bos:solid;bow:1px,1px,1px,1px;bor:5px,5px,5px,5px;"
                                                        data-frame_0="y:50,50,34,16;"
                                                        data-frame_1="st:2050;sp:1000;sR:2050;"
                                                        data-frame_999="o:0;st:w;sR:5950;"
                                                        data-frame_hover="c:#fff;bgc:transparent;boc:#fff;bor:5px,5px,5px,5px;bos:solid;bow:1px,1px,1px,1px;sp:100;e:power1.inOut;bri:120%;"
                                                        style="z-index:10;background-color:#fcbc3a;font-family:Open Sans;text-transform:uppercase;"
                                                    >
                                                        <div class="slider-btn"><i class="material-icons">insert_chart</i>
                                                            THÔNG TIN SẢN PHẨM
                                                        </div>
                                                    </rs-layer><!--

							-->
                                                    <rs-layer
                                                        id="slider-9-slide-24-layer-8"
                                                        data-type="shape"
                                                        data-rsp_ch="on"
                                                        data-xy="xo:3px,3px,31px,4px;yo:130px,130px,99px,53px;"
                                                        data-text="w:normal;s:20,20,13,6;l:0,0,17,8;"
                                                        data-dim="w:655px,655px,453px,366px;h:340px,340px,234px,235px;"
                                                        data-border="bor:10px,10px,10px,10px;"
                                                        data-frame_0="x:0,0,0,0px;y:50,50,34,34px;"
                                                        data-frame_1="x:0,0,0,0px;y:0,0,0,0px;sp:1000;"
                                                        data-frame_999="o:0;st:w;sR:8000;"
                                                        style="z-index:8;background-color:rgba(0,52,120,0.8);"
                                                    >
                                                    </rs-layer><!--
-->                        </rs-slide>
                                                @endforeach
                                            </rs-slides>
                                            <rs-static-layers><!--
					--></rs-static-layers>
                                        </rs-module>
                                        <script type="text/javascript">
                                            setREVStartSize({
                                                c: 'rev_slider_9_1',
                                                rl: [1240, 1240, 778, 480],
                                                el: [600, 600, 480, 360],
                                                gw: [1110, 1110, 768, 375],
                                                gh: [600, 600, 480, 360],
                                                type: 'standard',
                                                justify: '',
                                                layout: 'fullwidth',
                                                mh: "0"
                                            });
                                            var revapi9,
                                                tpj;

                                            function revinit_revslider91() {
                                                jQuery(function () {
                                                    tpj = jQuery;
                                                    revapi9 = tpj("#rev_slider_9_1");
                                                    if (revapi9 == undefined || revapi9.revolution == undefined) {
                                                        revslider_showDoubleJqueryError("rev_slider_9_1");
                                                    } else {
                                                        revapi9.revolution({
                                                            visibilityLevels: "1240,1240,778,480",
                                                            gridwidth: "1110,1110,768,375",
                                                            gridheight: "600,600,480,360",
                                                            spinner: "spinner0",
                                                            perspective: 600,
                                                            perspectiveType: "local",
                                                            editorheight: "600,373,480,360",
                                                            responsiveLevels: "1240,1240,778,480",
                                                            progressBar: {disableProgressBar: true},
                                                            navigation: {
                                                                wheelCallDelay: 1000,
                                                                onHoverStop: false,
                                                                bullets: {
                                                                    enable: true,
                                                                    tmp: "",
                                                                    style: "instive",
                                                                    hide_onmobile: true,
                                                                    hide_under: "1024px",
                                                                    h_align: "left",
                                                                    v_align: "center",
                                                                    h_offset: 40,
                                                                    v_offset: 0,
                                                                    direction: "vertical",
                                                                    space: 6
                                                                }
                                                            },
                                                            fallbacks: {
                                                                allowHTML5AutoPlayOnAndroid: true
                                                            },
                                                        });
                                                    }

                                                });
                                            } // End of RevInitScript
                                            var once_revslider91 = false;
                                            if (document.readyState === "loading") {
                                                document.addEventListener('readystatechange', function () {
                                                    if ((document.readyState === "interactive" || document.readyState === "complete") && !once_revslider91) {
                                                        once_revslider91 = true;
                                                        revinit_revslider91();
                                                    }
                                                });
                                            } else {
                                                once_revslider91 = true;
                                                revinit_revslider91();
                                            }
                                        </script>
                                        <script>
                                            var htmlDivCss = unescape("%23rev_slider_9_1_wrapper%20.instive.tp-bullets%20%7B%0A%7D%0A%0A%23rev_slider_9_1_wrapper%20.instive%20.tp-bullet%20%7B%0A%20%20%20%20overflow%3Ahidden%3B%0A%20%20%20%20border-radius%3A50%25%3B%0A%20%20%20%20width%3A6px%3B%0A%20%20%20%20height%3A6px%3B%0A%20%20%20%20background-color%3A%20rgba%280%2C%200%2C%200%2C%200%29%3B%0A%20%20%20%20box-shadow%3A%20inset%200%200%200%201px%20%23ffffff%3B%0A%20%20%20%20-webkit-transition%3A%20background%200.3s%20ease%3B%0A%20%20%20%20transition%3A%20background%200.3s%20ease%3B%0A%20%20%20%20position%3Aabsolute%3B%0A%7D%0A%0A%23rev_slider_9_1_wrapper%20.instive%20.tp-bullet%3Ahover%20%7B%0A%09%20%20background-color%3A%20rgba%28255%2C%20255%2C%20255%2C%200.2%29%3B%0A%7D%0A%23rev_slider_9_1_wrapper%20.instive%20.tp-bullet%3Aafter%20%7B%0A%20%20content%3A%20%27%20%27%3B%0A%20%20position%3A%20absolute%3B%0A%20%20bottom%3A%200%3B%0A%20%20height%3A%200%3B%0A%20%20left%3A%200%3B%0A%20%20width%3A%20100%25%3B%0A%20%20background-color%3A%20%23ffffff%3B%0A%20%20box-shadow%3A%200%200%201px%20%23ffffff%3B%0A%20%20-webkit-transition%3A%20height%200.3s%20ease%3B%0A%20%20transition%3A%20height%200.3s%20ease%3B%0A%7D%0A%23rev_slider_9_1_wrapper%20.instive%20%3Aafter%20%7B%0A%20%20height%3A100%25%3B%0A%7D%0A%0A");
                                            var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
                                            if (htmlDiv) {
                                                htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
                                            } else {
                                                var htmlDiv = document.createElement('div');
                                                htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
                                                document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
                                            }
                                        </script>
                                        <script>
                                            var htmlDivCss = unescape("%0A%0A%0A");
                                            var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
                                            if (htmlDiv) {
                                                htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
                                            } else {
                                                var htmlDiv = document.createElement('div');
                                                htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
                                                document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
                                            }
                                        </script>
                                        <script>
                                            var htmlDivCss = unescape("%2F%2A%20%0D%0AICON%20SET%20%0D%0A%2A%2F%0D%0A%40font-face%20%7B%0D%0A%20%20font-family%3A%20%27Material%20Icons%27%3B%0D%0A%20%20font-style%3A%20normal%3B%0D%0A%20%20font-weight%3A%20400%3B%20%20%0D%0A%20%20src%3A%20url%28%2F%2Ffonts.gstatic.com%2Fs%2Fmaterialicons%2Fv41%2FflUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2%29%20format%28%27woff2%27%29%3B%0D%0A%7D%0D%0A%0D%0Ars-module%20.material-icons%20%7B%0D%0A%20%20font-family%3A%20%27Material%20Icons%27%3B%0D%0A%20%20font-weight%3A%20normal%3B%0D%0A%20%20font-style%3A%20normal%3B%20%20%0D%0A%20%20display%3A%20inline-block%3B%20%20%0D%0A%20%20text-transform%3A%20none%3B%0D%0A%20%20letter-spacing%3A%20normal%3B%0D%0A%20%20word-wrap%3A%20normal%3B%0D%0A%20%20white-space%3A%20nowrap%3B%0D%0A%20%20direction%3A%20ltr%3B%0D%0A%20%20vertical-align%3A%20top%3B%0D%0A%20%20line-height%3A%20inherit%3B%0D%0A%20%20%2F%2A%20Support%20for%20IE.%20%2A%2F%0D%0A%20%20font-feature-settings%3A%20%27liga%27%3B%0D%0A%0D%0A%20%20-webkit-font-smoothing%3A%20antialiased%3B%0D%0A%20%20text-rendering%3A%20optimizeLegibility%3B%0D%0A%20%20-moz-osx-font-smoothing%3A%20grayscale%3B%0D%0A%7D");
                                            var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
                                            if (htmlDiv) {
                                                htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
                                            } else {
                                                var htmlDiv = document.createElement('div');
                                                htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
                                                document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
                                            }
                                        </script>
                                    </rs-module-wrap>
                                    <!-- END REVOLUTION SLIDER -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
