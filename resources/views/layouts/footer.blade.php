<div class="ekit-template-content-markup ekit-template-content-footer ekit-template-content-theme-support">
    <div data-elementor-type="wp-post" data-elementor-id="176" class="elementor elementor-176"
         data-elementor-settings="[]">
        <div class="elementor-inner">
            <div class="elementor-section-wrap">
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-2216195 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="2216195" data-element_type="section"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            @foreach($menus as $menu)
                            <div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-e9e7883"
                                 data-id="e9e7883" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-1027f00 elementor-widget elementor-widget-heading"
                                             data-id="1027f00" data-element_type="widget"
                                             data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h3 class="elementor-heading-title elementor-size-default">{{$menu->name}}</h3></div>
                                        </div>
                                        <div class="elementor-element elementor-element-0a7f838 elementor-align-left blo-list-icon-center elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                                             data-id="0a7f838" data-element_type="widget"
                                             data-widget_type="icon-list.default">
                                            <div class="elementor-widget-container">
                                                <ul class="elementor-icon-list-items">
                                                    @foreach($menu->parents as $parent)
                                                    <li class="elementor-icon-list-item">
                                                        <a href="{{$parent->slug}}">						<span
                                                                class="elementor-icon-list-icon">
													</span>
                                                            <span class="elementor-icon-list-text">{{$parent->name}}</span>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-ea19f28"
                                 data-id="ea19f28" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-66e1559 elementor-widget elementor-widget-heading"
                                             data-id="66e1559" data-element_type="widget"
                                             data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h3 class="elementor-heading-title elementor-size-default">thông tin
                                                    liên hệ</h3></div>
                                        </div>
                                        <div class="elementor-element elementor-element-b1cfbc7 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                                             data-id="b1cfbc7" data-element_type="widget"
                                             data-widget_type="icon-list.default">
                                            <div class="elementor-widget-container">
                                                <ul class="elementor-icon-list-items">
                                                    <li class="elementor-icon-list-item">
											<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="far fa-building"></i>						</span>
                                                        <span class="elementor-icon-list-text">{{setting('contact.address', true)}}</span>
                                                    </li>
                                                    <li class="elementor-icon-list-item">
                                                        <a href="tel:13056773952">						<span
                                                                class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-phone-alt"></i>						</span>
                                                            <span class="elementor-icon-list-text"><b>{{setting('contact.phone')}}</b></span>
                                                        </a>
                                                    </li>
                                                    <li class="elementor-icon-list-item">
											<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="far fa-clock"></i>						</span>
                                                        <span class="elementor-icon-list-text">{{setting('contact.time_open')}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-bc20519"
                                 data-id="bc20519" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-dbd7d8f elementor-widget elementor-widget-image"
                                             data-id="dbd7d8f" data-element_type="widget"
                                             data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image">
                                                    <a href="/">
                                                        <img width="431" height="90"
                                                             src="{{setting('site.logo')}}"
                                                             class="attachment-full size-full" alt="" loading="lazy"
                                                             sizes="(max-width: 431px) 100vw, 431px"/> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-88a1f97 footer-social elementor-widget elementor-widget-elementskit-social-media"
                                             data-id="88a1f97" data-element_type="widget"
                                             data-widget_type="elementskit-social-media.default">
                                            <div class="elementor-widget-container">
                                                <div class="ekit-wid-con">
                                                    <ul class="ekit_social_media">
                                                        <li class="elementor-repeater-item-a318456">
                                                            <a
                                                                href="{{setting('social.facebook')}}"
                                                                class="facebook">

                                                                <i aria-hidden="true" class="fasicon icon-facebook"></i>
                                                            </a>
                                                        </li>
                                                        <li class="elementor-repeater-item-4ee38b2">
                                                            <a
                                                                href="{{setting('social.linkedin')}}" class="linkedin">

                                                                <i aria-hidden="true" class="fasicon icon-linkedin"></i>
                                                            </a>
                                                        </li>
                                                        <li class="elementor-repeater-item-41ad09b">
                                                            <a
                                                                href="{{setting('social.youtube')}}" class="v">

                                                                <i aria-hidden="true"
                                                                   class="fasicon icon-youtube-v"></i>
                                                            </a>
                                                        </li>
                                                        <li class="elementor-repeater-item-6756370">
                                                            <a
                                                                href="mailto:{{setting('contact.email')}}" class="envelope1">

                                                                <i aria-hidden="true"
                                                                   class="fasicon icon-envelope1"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
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
                    class="elementor-section elementor-top-section elementor-element elementor-element-dc7b9bc elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="dc7b9bc" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-a83a8af"
                                 data-id="a83a8af" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-c76a22c elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
                                             data-id="c76a22c" data-element_type="widget"
                                             data-widget_type="divider.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-07a9809 elementor-widget elementor-widget-text-editor"
                                             data-id="07a9809" data-element_type="widget"
                                             data-widget_type="text-editor.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-text-editor elementor-clearfix">
                                                    <p style="text-align: center;"><span style="font-size: 10pt;">© 2021, Trung tâm KHCC Dai-ichi Life Premier</span><br><span
                                                            style="font-size: 10pt;">All Rights Reserved by DFA PRemier</span>
                                                    </p></div>
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
</div>

<div class="zalo-container right" style="bottom:120px;">
    <a id="zalo-btn" href="https://zalo.me/{{setting('social.zalo')}}" target="_blank" rel="noopener noreferrer nofollow">
        <div class="animated_zalo infinite zoomIn_zalo cmoz-alo-circle"></div>
        <div class="animated_zalo infinite pulse_zalo cmoz-alo-circle-fill"></div>
        <span><img src="/client/images/zalo-2.png" alt="Contact Me on Zalo"></span>
    </a>
</div>

<div class="zalo-container right" style="bottom:200px;">
    <a id="zalo-btn" href="tel:{{setting('contact.phone')}}" target="_blank" rel="noopener noreferrer nofollow">
        <div class="animated_zalo infinite zoomIn_zalo cmoz-alo-circle"></div>
        <div class="animated_zalo infinite pulse_zalo cmoz-alo-circle-fill"></div>
        <span><img src="/client/images/call.png" style="margin: auto; width: 30px" alt="Contact Me on Phone"></span>
    </a>
</div>



<link rel="stylesheet" property="stylesheet" id="rs-icon-set-fa-icon-css"
      href="/client/plugins/revslider/public/assets/fonts/font-awesome/css/font-awesome.css" type="text/css"
      media="all"/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400%2C800%2C700%7CRoboto:400" rel="stylesheet"
      property="stylesheet" media="all" type="text/css">

<script type="text/javascript">
    if (typeof revslider_showDoubleJqueryError === "undefined") {
        function revslider_showDoubleJqueryError(sliderID) {
            var err = "<div class='rs_error_message_box'>";
            err += "<div class='rs_error_message_oops'>Oops...</div>";
            err += "<div class='rs_error_message_content'>";
            err += "You have some jquery.js library include that comes after the Slider Revolution files js inclusion.<br>";
            err += "To fix this, you can:<br>&nbsp;&nbsp;&nbsp; 1. Set 'Module General Options' -> 'Advanced' -> 'jQuery & OutPut Filters' -> 'Put JS to Body' to on";
            err += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jQuery.js inclusion and remove it";
            err += "</div>";
            err += "</div>";
            var slider = document.getElementById(sliderID);
            slider.innerHTML = err;
            slider.style.display = "block";
        }
    }
</script>
<link rel='stylesheet' id='elementor-post-4578-css'
      href='/client/uploads/elementor/css/post-4578ee15.css?ver=1625515259' type='text/css' media='all'/>
<link rel='stylesheet' id='elementor-post-968-css'
      href='/client/uploads/elementor/css/post-968ee15.css?ver=1625515259' type='text/css' media='all'/>
<link rel='stylesheet' id='elementor-gallery-css'
      href='/client/plugins/elementor/assets/lib/e-gallery/css/e-gallery.min7359.css?ver=1.2.0' type='text/css'
      media='all'/>
<link rel='stylesheet' id='lae-icomoon-styles-css'
      href='/client/plugins/addons-for-elementor-premium/assets/css/icomoonab7d.css?ver=6.10.1' type='text/css'
      media='all'/>
<link rel='stylesheet' id='lae-slick-carousel-styles-css'
      href='/client/plugins/addons-for-elementor-premium/assets/css/lib/slickab7d.css?ver=6.10.1' type='text/css'
      media='all'/>
<link rel='stylesheet' id='lae-frontend-styles-css'
      href='/client/plugins/addons-for-elementor-premium/assets/css/lae-frontendab7d.css?ver=6.10.1' type='text/css'
      media='all'/>
<link rel='stylesheet' id='lae-slick-carousel-custom-styles-css'
      href='/client/plugins/addons-for-elementor-premium/assets/css/slick-customab7d.css?ver=6.10.1' type='text/css'
      media='all'/>
<link rel='stylesheet' id='lae-posts-sliders-styles-css'
      href='/client/plugins/addons-for-elementor-premium/assets/css/widgets/posts-slidersab7d.css?ver=6.10.1'
      type='text/css' media='all'/>
<link rel='stylesheet' id='lae-posts-sliders-premium-styles-css'
      href='/client/plugins/addons-for-elementor-premium/assets/css/premium/widgets/posts-slidersab7d.css?ver=6.10.1'
      type='text/css' media='all'/>
<link rel='stylesheet' id='elementor-icons-shared-1-css'
      href='/client/themes/instive/assets/css/icon-fontad76.css?ver=5.9.0' type='text/css' media='all'/>
<link rel='stylesheet' id='elementor-icons-icon-instive-css'
      href='/client/themes/instive/assets/css/icon-fontad76.css?ver=5.9.0' type='text/css' media='all'/>
<link rel='stylesheet' id='elementor-icons-fa-brands-css'
      href='/client/plugins/elementor/assets/lib/font-awesome/css/brands.min9e0b.css?ver=5.15.1' type='text/css'
      media='all'/>
<script type='text/javascript' id='my_loadmore-js-extra'>
    /* <![CDATA[ */
    var misha_loadmore_params = {
        "ajaxurl": "https:\/\/dai-ichi-dfapremier.vn\/wp-admin\/admin-ajax.php",
        "current_page": "1"
    };
    /* ]]> */
</script>
<script type='text/javascript' src='/client/plugins/thepack/ashelement/assets/js/kc-enginecfaa.js?ver=5.7.6'
        id='my_loadmore-js'></script>
<script type='text/javascript' id='particles-js-extra'>
    /* <![CDATA[ */
    var xld_particle = {"template_url": "https:\/\/dai-ichi-dfapremier.vn\/wp-content\/plugins\/thepack\/ashelement\/"};
    /* ]]> */
</script>
<script type='text/javascript' src='/client/plugins/thepack/ashelement/assets/js/particles.mincfaa.js?ver=5.7.6'
        id='particles-js'></script>
<script type='text/javascript' src='/client/js/dist/vendor/wp-polyfill.min89b1.js?ver=7.4.4'
        id='wp-polyfill-js'></script>
<script type='text/javascript' id='wp-polyfill-js-after'>
    ('fetch' in window) || document.write('<script src="/client/js/dist/vendor/wp-polyfill-fetch.min6e0e.js?ver=3.0.0"></scr' + 'ipt>');
    (document.contains) || document.write('<script src="/client/js/dist/vendor/wp-polyfill-node-contains.min2e00.js?ver=3.42.0"></scr' + 'ipt>');
    (window.DOMRect) || document.write('<script src="/client/js/dist/vendor/wp-polyfill-dom-rect.min2e00.js?ver=3.42.0"></scr' + 'ipt>');
    (window.URL && window.URL.prototype && window.URLSearchParams) || document.write('<script src="/client/js/dist/vendor/wp-polyfill-url.min5aed.js?ver=3.6.4"></scr' + 'ipt>');
    (window.FormData && window.FormData.prototype.keys) || document.write('<script src="/client/js/dist/vendor/wp-polyfill-formdata.mine9bd.js?ver=3.0.12"></scr' + 'ipt>');
    (Element.prototype.matches && Element.prototype.closest) || document.write('<script src="/client/js/dist/vendor/wp-polyfill-element-closest.min4c56.js?ver=2.0.2"></scr' + 'ipt>');
    ('objectFit' in document.documentElement.style) || document.write('<script src="/client/js/dist/vendor/wp-polyfill-object-fit.min531b.js?ver=2.3.4"></scr' + 'ipt>');
</script>
<script type='text/javascript' id='contact-form-7-js-extra'>
    /* <![CDATA[ */
    var wpcf7 = {"api": {"root": "https:\/\/dai-ichi-dfapremier.vn\/wp-json\/", "namespace": "contact-form-7\/v1"}};
    /* ]]> */
</script>
<script type='text/javascript' src='/client/plugins/contact-form-7/includes/js/indexc225.js?ver=5.4.1'
        id='contact-form-7-js'></script>
<script type='text/javascript' src='/client/plugins/metform/public/assets/js/htme29d.js?ver=1.4.9'
        id='htm-js'></script>
<script type='text/javascript' src='/client/js/dist/vendor/lodash.mind1d1.js?ver=4.17.21' id='lodash-js'></script>
<script type='text/javascript' id='lodash-js-after'>
    window.lodash = _.noConflict();
</script>
<script type='text/javascript' src='/client/js/dist/vendor/react.mincd00.js?ver=16.13.1' id='react-js'></script>
<script type='text/javascript' src='/client/js/dist/vendor/react-dom.mincd00.js?ver=16.13.1'
        id='react-dom-js'></script>
<script type='text/javascript' src='/client/js/dist/escape-html.mina992.js?ver=cf3ba719eafb9297c5843cfc50c8f87e'
        id='wp-escape-html-js'></script>
<script type='text/javascript' src='/client/js/dist/element.min9031.js?ver=d19384292cd0b9f8f030fa288fda7203'
        id='wp-element-js'></script>
<script type='text/javascript' id='metform-app-js-extra'>
    /* <![CDATA[ */
    var mf = {"postType": "page", "restURI": "https:\/\/dai-ichi-dfapremier.vn\/wp-json\/metform\/v1\/forms\/views\/"};
    /* ]]> */
</script>
<script type='text/javascript' src='/client/plugins/metform/public/assets/js/appe29d.js?ver=1.4.9'
        id='metform-app-js'></script>
<script type='text/javascript'
        src='/client/plugins/elementskit-lite/libs/framework/assets/js/frontend-scriptc936.js?ver=2.3.1.1'
        id='elementskit-framework-js-frontend-js'></script>
<script type='text/javascript' id='elementskit-framework-js-frontend-js-after'>
    var elementskit = {
        resturl: 'https://dai-ichi-dfapremier.vn/wp-json/elementskit/v1/',
    }


</script>
<script type='text/javascript'
        src='/client/plugins/elementskit-lite/widgets/init/assets/js/widget-scriptsc936.js?ver=2.3.1.1'
        id='ekit-widget-scripts-js'></script>
<script type='text/javascript'
        src='/client/plugins/instive-essential/modules/elements/chart/assets/js/chartcfaa.js?ver=5.7.6'
        id='chart-kit-js-js'></script>
<script type='text/javascript' src='/client/js/imagesloaded.mineda1.js?ver=4.1.4' id='imagesloaded-js'></script>
<script type='text/javascript' src='/client/js/masonry.min3a05.js?ver=4.2.2' id='masonry-js'></script>
<script type='text/javascript' src='/client/plugins/thepack/theme/includes/js/tb-themecfaa.js?ver=5.7.6'
        id='thepack-theme-js'></script>
<script type='text/javascript' src='/client/themes/instive/assets/js/Popper3ec8.js?ver=1.1.6'
        id='popper-js'></script>
<script type='text/javascript' src='/client/themes/instive/assets/js/bootstrap.min3ec8.js?ver=1.1.6'
        id='bootstrap-min-js'></script>
<script type='text/javascript' src='/client/themes/instive/assets/js/owl.carousel.min3ec8.js?ver=1.1.6'
        id='owl-carousel-min-js'></script>
<script type='text/javascript' src='/client/themes/instive/assets/js/jquery.overlayScrollbars.min3ec8.js?ver=1.1.6'
        id='jquery-overlay-scrollbars-min-js'></script>
<script type='text/javascript' src='/client/themes/instive/assets/js/slick.min3ec8.js?ver=1.1.6'
        id='slick-js-js'></script>
<script type='text/javascript' src='/client/themes/instive/assets/js/jquery.magnific-popup.min3ec8.js?ver=1.1.6'
        id='jquery-magnific-popup-min-js'></script>
<script type='text/javascript' id='instive-script-js-extra'>
    /* <![CDATA[ */
    var instive_ajax = {"ajax_url": "https:\/\/dai-ichi-dfapremier.vn\/wp-admin\/admin-ajax.php"};
    /* ]]> */
</script>
<script type='text/javascript' src='/client/themes/instive/assets/js/script3ec8.js?ver=1.1.6'
        id='instive-script-js'></script>


<script type='text/javascript' src='/client/js/wp-embed.mincfaa.js?ver=5.7.6' id='wp-embed-js'></script>
<script type='text/javascript' src='/client/plugins/elementor/assets/lib/waypoints/waypoints.min05da.js?ver=4.0.2'
        id='elementor-waypoints-js'></script>
<script type='text/javascript' src='/client/plugins/elementor/assets/lib/e-gallery/js/e-gallery.min7359.js?ver=1.2.0'
        id='elementor-gallery-js'></script>
<script type='text/javascript'
        src='/client/plugins/addons-for-elementor-premium/assets/js/slick.minab7d.js?ver=6.10.1'
        id='lae-jquery-slick-js'></script>
<script type='text/javascript' id='lae-frontend-scripts-js-extra'>
    /* <![CDATA[ */
    var lae_ajax_object = {
        "ajax_url": "https:\/\/dai-ichi-dfapremier.vn\/wp-admin\/admin-ajax.php",
        "block_nonce": "82ce5835d7"
    };
    var lae_js_vars = {"custom_css": ""};
    /* ]]> */
</script>
<script type='text/javascript'
        src='/client/plugins/addons-for-elementor-premium/assets/js/lae-frontend.minab7d.js?ver=6.10.1'
        id='lae-frontend-scripts-js'></script>
<script type='text/javascript'
        src='/client/plugins/addons-for-elementor-premium/assets/js/lae-carousel-helper.minab7d.js?ver=6.10.1'
        id='lae-carousel-helper-scripts-js'></script>
<script type='text/javascript' src='/client/plugins/elementor/assets/js/webpack.runtime.min2072.js?ver=3.2.5'
        id='elementor-webpack-runtime-js'></script>
<script type='text/javascript' src='/client/plugins/elementor/assets/js/frontend-modules.min2072.js?ver=3.2.5'
        id='elementor-frontend-modules-js'></script>
<script type='text/javascript' src='/client/js/jquery/ui/core.min35d0.js?ver=1.12.1'
        id='jquery-ui-core-js'></script>
<script type='text/javascript' src='/client/plugins/elementor/assets/lib/swiper/swiper.min48f5.js?ver=5.3.6'
        id='swiper-js'></script>
<script type='text/javascript' src='/client/plugins/elementor/assets/lib/share-link/share-link.min2072.js?ver=3.2.5'
        id='share-link-js'></script>
<script type='text/javascript' src='/client/plugins/elementor/assets/lib/dialog/dialog.mina288.js?ver=4.8.1'
        id='elementor-dialog-js'></script>
<script type='text/javascript' id='elementor-frontend-js-before'>
    var elementorFrontendConfig = {
        "environmentMode": {"edit": false, "wpPreview": false, "isScriptDebug": false},
        "i18n": {
            "shareOnFacebook": "Chia s\u1ebb tr\u00ean Facebook",
            "shareOnTwitter": "Chia s\u1ebb tr\u00ean Twitter",
            "pinIt": "Ghim n\u00f3",
            "download": "T\u1ea3i xu\u1ed1ng",
            "downloadImage": "T\u1ea3i h\u00ecnh \u1ea3nh",
            "fullscreen": "To\u00e0n m\u00e0n h\u00ecnh",
            "zoom": "Thu ph\u00f3ng",
            "share": "Chia s\u1ebb",
            "playVideo": "Ch\u01a1i Video",
            "previous": "Previous",
            "next": "Next",
            "close": "\u0110\u00f3ng"
        },
        "is_rtl": false,
        "breakpoints": {"xs": 0, "sm": 480, "md": 768, "lg": 1025, "xl": 1440, "xxl": 1600},
        "responsive": {
            "breakpoints": {
                "mobile": {
                    "label": "Thi\u1ebft b\u1ecb di \u0111\u1ed9ng",
                    "value": 767,
                    "direction": "max",
                    "is_enabled": true
                },
                "mobile_extra": {"label": "Mobile Extra", "value": 880, "direction": "max", "is_enabled": false},
                "tablet": {
                    "label": "M\u00e1y t\u00ednh b\u1ea3ng",
                    "value": 1024,
                    "direction": "max",
                    "is_enabled": true
                },
                "tablet_extra": {"label": "Tablet Extra", "value": 1365, "direction": "max", "is_enabled": false},
                "laptop": {"label": "Laptop", "value": 1620, "direction": "max", "is_enabled": false},
                "widescreen": {"label": "Widescreen", "value": 2400, "direction": "min", "is_enabled": false}
            }
        },
        "version": "3.2.5",
        "is_static": false,
        "experimentalFeatures": {"form-submissions": true, "video-playlist": true},
        "urls": {"assets": "https:\/\/dai-ichi-dfapremier.vn\/wp-content\/plugins\/elementor\/assets\/"},
        "settings": {"page": [], "editorPreferences": []},
        "kit": {
            "stretched_section_container": "body",
            "active_breakpoints": ["viewport_mobile", "viewport_tablet"],
            "global_image_lightbox": "yes",
            "lightbox_enable_counter": "yes",
            "lightbox_enable_fullscreen": "yes",
            "lightbox_enable_zoom": "yes",
            "lightbox_enable_share": "yes",
            "lightbox_title_src": "title",
            "lightbox_description_src": "description"
        },
        "post": {
            "id": 1420,
            "title": "Trung%20t%C3%A2m%20t%C3%A0i%20ch%C3%ADnh%20Dai-ichi%20Life%20DFA%20Premier",
            "excerpt": "",
            "featuredImage": false
        }
    };
</script>
<script type='text/javascript' src='/client/plugins/elementor/assets/js/frontend.min2072.js?ver=3.2.5'
        id='elementor-frontend-js'></script>
<script type='text/javascript'
        src='/client/plugins/addons-for-elementor-premium/assets/js/widgets/posts-multislider.minab7d.js?ver=6.10.1'
        id='lae-posts-multislider-scripts-js'></script>
<script type='text/javascript' src='/client/plugins/elementor-pro/assets/js/webpack-pro.runtime.min9b70.js?ver=3.3.0'
        id='elementor-pro-webpack-runtime-js'></script>
<script type='text/javascript'
        src='/client/plugins/elementor-pro/assets/lib/sticky/jquery.sticky.min9b70.js?ver=3.3.0'
        id='elementor-sticky-js'></script>
<script type='text/javascript' id='elementor-pro-frontend-js-before'>
    var ElementorProFrontendConfig = {
        "ajaxurl": "https:\/\/dai-ichi-dfapremier.vn\/wp-admin\/admin-ajax.php",
        "nonce": "57940a9707",
        "urls": {"assets": "https:\/\/dai-ichi-dfapremier.vn\/wp-content\/plugins\/elementor-pro\/assets\/"},
        "i18n": {"toc_no_headings_found": "No headings were found on this page."},
        "shareButtonsNetworks": {
            "facebook": {"title": "Facebook", "has_counter": true},
            "twitter": {"title": "Twitter"},
            "google": {"title": "Google+", "has_counter": true},
            "linkedin": {"title": "LinkedIn", "has_counter": true},
            "pinterest": {"title": "Pinterest", "has_counter": true},
            "reddit": {"title": "Reddit", "has_counter": true},
            "vk": {"title": "VK", "has_counter": true},
            "odnoklassniki": {"title": "OK", "has_counter": true},
            "tumblr": {"title": "Tumblr"},
            "digg": {"title": "Digg"},
            "skype": {"title": "Skype"},
            "stumbleupon": {"title": "StumbleUpon", "has_counter": true},
            "mix": {"title": "Mix"},
            "telegram": {"title": "Telegram"},
            "pocket": {"title": "Pocket", "has_counter": true},
            "xing": {"title": "XING", "has_counter": true},
            "whatsapp": {"title": "WhatsApp"},
            "email": {"title": "Email"},
            "print": {"title": "Print"}
        },
        "facebook_sdk": {"lang": "vi", "app_id": ""},
        "lottie": {"defaultAnimationUrl": "https:\/\/dai-ichi-dfapremier.vn\/wp-content\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json"}
    };
</script>
<script type='text/javascript' src='/client/plugins/elementor-pro/assets/js/frontend.min9b70.js?ver=3.3.0'
        id='elementor-pro-frontend-js'></script>
<script type='text/javascript'
        src='/client/plugins/elementor-pro/assets/js/preloaded-elements-handlers.min9b70.js?ver=3.3.0'
        id='pro-preloaded-elements-handlers-js'></script>
<script type='text/javascript'
        src='/client/plugins/elementskit-lite/widgets/init/assets/js/slick.minc936.js?ver=2.3.1.1'
        id='ekit-slick-js'></script>
<script type='text/javascript'
        src='/client/plugins/elementskit-lite/widgets/init/assets/js/animate-circlec936.js?ver=2.3.1.1'
        id='animate-circle-js'></script>
<script type='text/javascript'
        src='/client/plugins/elementskit-lite/widgets/init/assets/js/elementorc936.js?ver=2.3.1.1'
        id='elementskit-elementor-js'></script>
<script type='text/javascript'
        src='/client/plugins/instive-essential/modules/sticky-content/assets/js/jquery.sticky20b9.js?ver=1.0.2'
        id='elementskit-sticky-content-script-js'></script>
<script type='text/javascript'
        src='/client/plugins/instive-essential/modules/sticky-content/assets/js/main20b9.js?ver=1.0.2'
        id='elementskit-sticky-content-script-core-js'></script>
<script type='text/javascript' src='/client/themes/instive/assets/js/elementor3ec8.js?ver=1.1.6'
        id='instive-main-elementor-js'></script>
<script type='text/javascript' src='/client/plugins/elementor/assets/js/preloaded-modules.min2072.js?ver=3.2.5'
        id='preloaded-modules-js'></script>
<script type='text/javascript' src='/client/plugins/metform/controls/assets/js/form-picker-editore29d.js?ver=1.4.9'
        id='metform-js-formpicker-control-editor-js'></script>
<script type='text/javascript' src='/client/plugins/powerpack-elements/assets/js/pp-bg-effects8a54.js?ver=1.0.0'
        id='pp-bg-effects-js'></script>
<script type='text/javascript'
        src='/client/plugins/elementskit-lite/modules/controls/assets/js/widgetarea-editorc936.js?ver=2.3.1.1'
        id='elementskit-js-widgetarea-control-editor-js'></script>

