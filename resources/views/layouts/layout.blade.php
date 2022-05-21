<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="content-language" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta charset="utf-8">
    <title>@hasSection('title') @yield('title') - @endif {{setting('site.name')}}</title>
    <meta name="keywords" content="@yield('keywords',setting('site.keyword_seo'))"/>
    <meta name="description" content="@yield('description',setting('site.description_seo'))"/>
    <meta property="og:url" content="@yield('url', url('/'))"/>
    <meta property="og:title" content="@hasSection('title') @yield('title') - @endif {{setting('site.name')}}"/>
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}"/>
    <meta property="og:type" content="website"/>
    @if(setting('api.facebook_app_ip'))
        <meta property="fb:app_id" content="{{setting('api.facebook_app_ip')}}"/>
    @endif
    <meta property="og:description" content="@yield('description',setting('site.description_seo'))"/>
    <meta property="og:image" content="@yield('image', setting('site.og_image') ?? setting('site.logo'))"/>
    <meta property="og:image:type" content="image/jpeg"/>
    <meta property="og:image:width" content="400"/>
    <meta property="og:image:height" content="300"/>
    <meta property="og:image:alt" content="@hasSection('title') @yield('title') - @endif {{setting('site.name')}}"/>
    <meta property="og:site_name" content="@hasSection('title') @yield('title') - @endif {{setting('site.name')}}"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:description" content="@yield('description',setting('site.description_seo'))"/>
    <meta name="twitter:title" content="@hasSection('title') @yield('title') - @endif {{setting('site.name')}}"/>
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="@yield('url',route('home'))">
    <link rel="icon" href="{{asset(setting('site.favicon'))}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <!--*************************---->

    <!-- Latest compiled and minified CSS & JS -->
    {{--    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>--}}

    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
            integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>


    {{--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>--}}
    {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">--}}

    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css" integrity="sha512-3PN6gfRNZEX4YFyz+sIyTF6pGlQiryJu9NlGhu9LrLMQ7eDjNgudQoFDK3WSNAayeIKc6B8WXXpo4a7HqxjKwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />--}}
    {{--    <!-- Vendor js -->--}}
    {{--    <script src="/lib/assets/js/vendor.min.js"></script>--}}
<!-- Stylesheets
    ============================================= -->
    <script type="text/javascript">
        window._wpemojiSettings = {
            "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/72x72\/",
            "ext": ".png",
            "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/svg\/",
            "svgExt": ".svg",
            "source": {"concatemoji": ""}
        };
        !function (e, a, t) {
            var n, r, o, i = a.createElement("canvas"), p = i.getContext && i.getContext("2d");

            function s(e, t) {
                var a = String.fromCharCode;
                p.clearRect(0, 0, i.width, i.height), p.fillText(a.apply(this, e), 0, 0);
                e = i.toDataURL();
                return p.clearRect(0, 0, i.width, i.height), p.fillText(a.apply(this, t), 0, 0), e === i.toDataURL()
            }

            function c(e) {
                var t = a.createElement("script");
                t.src = e, t.defer = t.type = "text/javascript", a.getElementsByTagName("head")[0].appendChild(t)
            }

            for (o = Array("flag", "emoji"), t.supports = {
                everything: !0,
                everythingExceptFlag: !0
            }, r = 0; r < o.length; r++) t.supports[o[r]] = function (e) {
                if (!p || !p.fillText) return !1;
                switch (p.textBaseline = "top", p.font = "600 32px Arial", e) {
                    case"flag":
                        return s([127987, 65039, 8205, 9895, 65039], [127987, 65039, 8203, 9895, 65039]) ? !1 : !s([55356, 56826, 55356, 56819], [55356, 56826, 8203, 55356, 56819]) && !s([55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128, 56447], [55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203, 56128, 56423, 8203, 56128, 56447]);
                    case"emoji":
                        return !s([55357, 56424, 8205, 55356, 57212], [55357, 56424, 8203, 55356, 57212])
                }
                return !1
            }(o[r]), t.supports.everything = t.supports.everything && t.supports[o[r]], "flag" !== o[r] && (t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && t.supports[o[r]]);
            t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && !t.supports.flag, t.DOMReady = !1, t.readyCallback = function () {
                t.DOMReady = !0
            }, t.supports.everything || (n = function () {
                t.readyCallback()
            }, a.addEventListener ? (a.addEventListener("DOMContentLoaded", n, !1), e.addEventListener("load", n, !1)) : (e.attachEvent("onload", n), a.attachEvent("onreadystatechange", function () {
                "complete" === a.readyState && t.readyCallback()
            })), (n = t.source || {}).concatemoji ? c(n.concatemoji) : n.wpemoji && n.twemoji && (c(n.twemoji), c(n.wpemoji)))
        }(window, document, window._wpemojiSettings);
    </script>
    <style type="text/css">
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
    <link rel='stylesheet' id='elementor-frontend-legacy-css'
          href='/client/plugins/elementor/assets/css/frontend-legacy.min2072.css?ver=3.2.5' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='elementor-frontend-css'
          href='/client/plugins/elementor/assets/css/frontend.min2072.css?ver=3.2.5' type='text/css' media='all'/>
    <style id='elementor-frontend-inline-css' type='text/css'>
        @font-face {
            font-family: eicons;
            src: url('/client/plugins/elementor/assets/lib/eicons/fonts/eicons0b93.eot?5.10.0');
            src: url('/client/plugins/elementor/assets/lib/eicons/fonts/eicons.eot?5.10.0#iefix') format("embedded-opentype"), url('/client/plugins/elementor/assets/lib/eicons/fonts/eicons.woff2?5.10.0') format("woff2"), url('/client/plugins/elementor/assets/lib/eicons/fonts/eicons.woff?5.10.0') format("woff"), url('/client/plugins/elementor/assets/lib/eicons/fonts/eicons.ttf?5.10.0') format("truetype"), url('/client/plugins/elementor/assets/lib/eicons/fonts/eicons.svg?5.10.0#eicon') format("svg");
            font-weight: 400;
            font-style: normal
        }
    </style>
    <link rel='stylesheet' id='elementor-post-1424-css'
          href='/client/uploads/elementor/css/post-1424c980.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='font-awesome-5-all-css'
          href='/client/plugins/elementor/assets/lib/font-awesome/css/all.min2072.css?ver=3.2.5' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='font-awesome-4-shim-css'
          href='/client/plugins/elementor/assets/lib/font-awesome/css/v4-shims.min2072.css?ver=3.2.5' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='elementor-post-176-css'
          href='/client/uploads/elementor/css/post-176777c.css?ver=1649744796' type='text/css' media='all'/>
    <link rel='stylesheet' id='wp-block-library-css'
          href='/client/css/dist/block-library/style.mincfaa.css?ver=5.7.6' type='text/css' media='all'/>
    <link rel='stylesheet' id='contact-form-7-css'
          href='/client/plugins/contact-form-7/includes/css/stylesc225.css?ver=5.4.1' type='text/css' media='all'/>
    <link rel='stylesheet' id='rs-plugin-settings-css'
          href='/client/plugins/revslider/public/assets/css/rs6fab5.css?ver=6.3.8' type='text/css' media='all'/>
    <style id='rs-plugin-settings-inline-css' type='text/css'>
        #rs-demo-id {
        }
    </style>
    <link rel='stylesheet' id='metform-ui-css'
          href='/client/plugins/metform/public/assets/css/metform-uie29d.css?ver=1.4.9' type='text/css' media='all'/>
    <link rel='stylesheet' id='metform-style-css'
          href='/client/plugins/metform/public/assets/css/stylee29d.css?ver=1.4.9' type='text/css' media='all'/>
    <link rel='stylesheet' id='elementor-icons-ekiticons-css'
          href='/client/plugins/elementskit-lite/modules/elementskit-icon-pack/assets/css/ekiticonsc936.css?ver=2.3.1.1'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='elementor-icons-css'
          href='/client/plugins/elementor/assets/lib/eicons/css/elementor-icons.min21f9.css?ver=5.11.0'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='elementor-animations-css'
          href='/client/plugins/elementor/assets/lib/animations/animations.min2072.css?ver=3.2.5' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='elementor-post-4327-css'
          href='/client/uploads/elementor/css/post-4327ee15.css?ver=1625515259' type='text/css' media='all'/>
    <link rel='stylesheet' id='powerpack-frontend-css'
          href='/client/plugins/powerpack-elements/assets/css/min/frontend.minc0b8.css?ver=2.3.7' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='thepack-theme-plugin-css'
          href='/client/plugins/thepack/theme/includes/css/stylecfaa.css?ver=5.7.6' type='text/css' media='all'/>
    <link rel='stylesheet' id='thepack-header-css'
          href='/client/plugins/thepack/theme/includes/css/headercfaa.css?ver=5.7.6' type='text/css' media='all'/>
    <link rel='stylesheet' id='elementor-pro-css'
          href='/client/plugins/elementor-pro/assets/css/frontend.min9b70.css?ver=3.3.0' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='thepack-shortcode-css'
          href='/client/plugins/thepack/ashelement/assets/css/shortcodecfaa.css?ver=5.7.6' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='line-awesome-css'
          href='/client/plugins/thepack/ashelement/assets/css/line-awesome/styles68b3.css?ver=1' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='themify-icons-css'
          href='/client/plugins/thepack/ashelement/assets/css/themify-icons/styles68b3.css?ver=1' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='et-line-font-css'
          href='/client/plugins/thepack/ashelement/assets/css/et-line-font/styles68b3.css?ver=1' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='linea_arrows-css'
          href='/client/plugins/thepack/ashelement/assets/css/linea_arrows/styles68b3.css?ver=1' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='linea_basic-css'
          href='/client/plugins/thepack/ashelement/assets/css/linea_basic/styles68b3.css?ver=1' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='linea_ecommerce-css'
          href='/client/plugins/thepack/ashelement/assets/css/linea_ecommerce/styles68b3.css?ver=1' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='linea_basic_elaboration-css'
          href='/client/plugins/thepack/ashelement/assets/css/linea_basic_elaboration/styles68b3.css?ver=1'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='linea_music-css'
          href='/client/plugins/thepack/ashelement/assets/css/linea_music/styles68b3.css?ver=1' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='LineIcons-css'
          href='/client/plugins/thepack/ashelement/assets/css/LineIcons/styles68b3.css?ver=1' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='elegant_font-css'
          href='/client/plugins/thepack/ashelement/assets/css/elegant_font/styles68b3.css?ver=1' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='bootstrap-css'
          href='/client/plugins/thepack/ashelement/assets/css/bootstrapcfaa.css?ver=5.7.6' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='metform-css-formpicker-control-editor-css'
          href='/client/plugins/metform/controls/assets/css/form-picker-editor8a54.css?ver=1.0.0' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='elementskit-css-widgetarea-control-editor-css'
          href='/client/plugins/elementskit-lite/modules/controls/assets/css/widgetarea-editorc936.css?ver=2.3.1.1'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='elementor-global-css'
          href='/client/uploads/elementor/css/global5b76.css?ver=1625888661' type='text/css' media='all'/>
    <link rel='stylesheet' id='elementor-post-1420-css'
          href='/client/uploads/elementor/css/post-14202729.css?ver=1649749655' type='text/css' media='all'/>
    <link rel='stylesheet' id='bootstrap-min-css'
          href='/client/themes/instive/assets/css/bootstrap.min3ec8.css?ver=1.1.6' type='text/css' media='all'/>
    <link rel='stylesheet' id='font-awesome-css'
          href='/client/plugins/elementor/assets/lib/font-awesome/css/font-awesome.min1849.css?ver=4.7.0'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='icon-font-css' href='/client/themes/instive/assets/css/icon-font3ec8.css?ver=1.1.6'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='owl-carousel-min-css'
          href='/client/themes/instive/assets/css/owl.carousel.min3ec8.css?ver=1.1.6' type='text/css' media='all'/>
    <link rel='stylesheet' id='overlay-scrollbars-min-css'
          href='/client/themes/instive/assets/css/OverlayScrollbars.min3ec8.css?ver=1.1.6' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='owl-theme-default-min-css'
          href='/client/themes/instive/assets/css/owl.theme.default.min3ec8.css?ver=1.1.6' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='magnific-popup-css'
          href='/client/themes/instive/assets/css/magnific-popup3ec8.css?ver=1.1.6' type='text/css' media='all'/>
    <link rel='stylesheet' id='instive-blog-css' href='/client/themes/instive/assets/css/blog3ec8.css?ver=1.1.6'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='instive-gutenberg-custom-css'
          href='/client/themes/instive/assets/css/gutenberg-custom3ec8.css?ver=1.1.6' type='text/css' media='all'/>
    <link rel='stylesheet' id='instive-master-css' href='/client/themes/instive/assets/css/master3ec8.css?ver=1.1.6'
          type='text/css' media='all'/>
    <style id='instive-master-inline-css' type='text/css'>

        body {
            /*font-family: "Rubik";*/
            font-size: 16px;
        }

        body,
        .sidebar ul li a,
        body.blog, body.single-post, body.page, body.search.search-results {
            color: #5a5a5a;
        }

        h1 {
            font-family: "Open Sans";
            font-size: 36px;
            font-weight: 800;
        }

        h2 {
            font-family: "Open Sans";
            font-size: 30px;
            font-weight: 800;
        }

        h3 {
            font-style: normal;
            font-size: 24px;
            font-weight: 800;
        }

        h4 {
            font-family: "Arial";
            font-style: normal;
            font-size: 18px;
            font-weight: 800;
        }

        .banner-bg::after,
        .banner-area::after {
            background-color: rgba(0, 0, 0, 0.4);
        }


        a, .post-meta span i, .entry-header .entry-title a:hover, .sidebar ul li a:hover {
            color: #003478;
            transition: all ease 500ms;
        }

        .header ul.navbar-nav > li > a:hover,
        .header ul.navbar-nav > li > a.active,
        .header ul.navbar-nav > li > a:focus,
        .post .entry-header .post-meta span i,
        article.page .entry-header .post-meta span i,
        .post .entry-header .post-meta span a:hover, article.page .entry-header .post-meta span a:hover,
        .post .entry-header .entry-title a:hover,
        article.page .entry-header .entry-title a:hover,
        .sidebar .widget .widget-title a:hover,
        h1, h2, h3, h4, h5, h6,
        .sidebar .widget .entry-title a:hover,
        .sidebar .ts-social-list li a,
        .wp-block-quote:before,
        a.btn-link,
        .testimoial-wrap .testimonial-content .testimonial-meta .ts-title,
        .testimoial-wrap .testimonial-content p:before,
        .post-navigation span:hover, .post-navigation h3:hover,
        .related-post-area .ts-title a:hover,
        a.btn-link:hover {
            color: #003478;
        }

        .entry-header .entry-title a,
        .post .entry-header .entry-title a, article.page .entry-header .entry-title a,
        .sidebar .widget .widget-title a,
        h1, h2, h3, h4, h5, h6,
        .sidebar .widget .entry-title a,
        .related-post-area .ts-title a,
        .sidebar ul li a.url, .sidebar ul li a.rsswidget {
            color: #003478;

        }

        .sidebar .widget.widget_search .instive-serach .input-group-btn,
        .btn,
        .testimoial-wrap .testimonial-content h3.ts-title,
        .ts-service-slider .ts-feature-box .btn.quote-btn,
        .sidebar .ts-social-list li a:hover,
        #preloader {
            background-color: #003478;
        }

        .btn:hover {
            background-color: #00449e;
            border-color: #00449e;
        }

        .dot-style2 .owl-dots .owl-dot.active span,
        .testimoial-wrap .testimonial-content .testimonial-author-img,
        .owl-carousel .owl-dots .owl-dot.active span {
            border-color: #003478;
        }

        body {
            background-color: #fff;
        }


        .copy-right {
            background: #003478;
        }

        .copy-right .copyright-text {
            color: #fff;
        }

    </style>
    <link rel='stylesheet' id='parent-style-css' href='/client/themes/instive-child/stylecfaa.html?ver=5.7.6'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='ekit-widget-styles-css'
          href='/client/plugins/elementskit-lite/widgets/init/assets/css/widget-stylesc936.css?ver=2.3.1.1'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='ekit-responsive-css'
          href='/client/plugins/elementskit-lite/widgets/init/assets/css/responsivec936.css?ver=2.3.1.1'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='dynamic-css' href='/client/plugins/thepack/css/dynamiccfaa.css?ver=5.7.6'
          type='text/css' media='all'/>
    <style id='dynamic-inline-css' type='text/css'>
        a:hover, a:focus {
            text-decoration: none !important;
        }

        .elementor-invisible {
            visibility: visible;
        }

    </style>
    <link rel='stylesheet' id='google-fonts-1-css'
          href='https://fonts.googleapis.com/css?family=Open+Sans%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRubik%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&amp;display=auto&amp;subset=vietnamese&amp;ver=5.7.6'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='elementor-icons-shared-0-css'
          href='/client/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min9e0b.css?ver=5.15.1'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='elementor-icons-fa-solid-css'
          href='/client/plugins/elementor/assets/lib/font-awesome/css/solid.min9e0b.css?ver=5.15.1' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='elementor-icons-fa-regular-css'
          href='/client/plugins/elementor/assets/lib/font-awesome/css/regular.min9e0b.css?ver=5.15.1' type='text/css'
          media='all'/>
    <script type='text/javascript'
            src='/client/plugins/elementor/assets/lib/font-awesome/js/v4-shims.min2072.js?ver=3.2.5'
            id='font-awesome-4-shim-js'></script>
    <script type='text/javascript' id='jquery-core-js-extra'>
        /* <![CDATA[ */
        var pp = {"ajax_url": ""};
        /* ]]> */
    </script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>

    <script type='text/javascript' src='/client/js/jquery/jquery.min9d52.js?ver=3.5.1' id='jquery-core-js'></script>
    <script type='text/javascript' src='/client/js/jquery/jquery-migrate.mind617.js?ver=3.3.2'
            id='jquery-migrate-js'></script>
    <script type='text/javascript' src='/client/plugins/thepack/ashelement/assets/js/tbbootstrapcfaa.js?ver=5.7.6'
            id='tbbootstrap-js'></script>
    <script type='text/javascript' src='/client/plugins/thepack/ashelement/assets/js/lazysizes.mincfaa.js?ver=5.7.6'
            id='lazysizes-js'></script>
    <script type='text/javascript'
            src='/client/plugins/thepack/ashelement/assets/js/jquery.scrollbar.mincfaa.js?ver=5.7.6'
            id='jquery.scrollbar-js'></script>
    <script type='text/javascript' src='/client/plugins/revslider/public/assets/js/rbtools.minfab5.js?ver=6.3.8'
            id='tp-tools-js'></script>
    <script type='text/javascript' src='/client/plugins/revslider/public/assets/js/rs6.minfab5.js?ver=6.3.8'
            id='revmin-js'></script>

    <script type="text/javascript">
        (function () {
            window.lae_fs = {can_use_premium_code: true};
        })();
    </script>
    <script type="text/javascript">function setREVStartSize(e) {
            //window.requestAnimationFrame(function() {
            window.RSIW = window.RSIW === undefined ? window.innerWidth : window.RSIW;
            window.RSIH = window.RSIH === undefined ? window.innerHeight : window.RSIH;
            try {
                var pw = document.getElementById(e.c).parentNode.offsetWidth,
                    newh;
                pw = pw === 0 || isNaN(pw) ? window.RSIW : pw;
                e.tabw = e.tabw === undefined ? 0 : parseInt(e.tabw);
                e.thumbw = e.thumbw === undefined ? 0 : parseInt(e.thumbw);
                e.tabh = e.tabh === undefined ? 0 : parseInt(e.tabh);
                e.thumbh = e.thumbh === undefined ? 0 : parseInt(e.thumbh);
                e.tabhide = e.tabhide === undefined ? 0 : parseInt(e.tabhide);
                e.thumbhide = e.thumbhide === undefined ? 0 : parseInt(e.thumbhide);
                e.mh = e.mh === undefined || e.mh == "" || e.mh === "auto" ? 0 : parseInt(e.mh, 0);
                if (e.layout === "fullscreen" || e.l === "fullscreen")
                    newh = Math.max(e.mh, window.RSIH);
                else {
                    e.gw = Array.isArray(e.gw) ? e.gw : [e.gw];
                    for (var i in e.rl) if (e.gw[i] === undefined || e.gw[i] === 0) e.gw[i] = e.gw[i - 1];
                    e.gh = e.el === undefined || e.el === "" || (Array.isArray(e.el) && e.el.length == 0) ? e.gh : e.el;
                    e.gh = Array.isArray(e.gh) ? e.gh : [e.gh];
                    for (var i in e.rl) if (e.gh[i] === undefined || e.gh[i] === 0) e.gh[i] = e.gh[i - 1];

                    var nl = new Array(e.rl.length),
                        ix = 0,
                        sl;
                    e.tabw = e.tabhide >= pw ? 0 : e.tabw;
                    e.thumbw = e.thumbhide >= pw ? 0 : e.thumbw;
                    e.tabh = e.tabhide >= pw ? 0 : e.tabh;
                    e.thumbh = e.thumbhide >= pw ? 0 : e.thumbh;
                    for (var i in e.rl) nl[i] = e.rl[i] < window.RSIW ? 0 : e.rl[i];
                    sl = nl[0];
                    for (var i in nl) if (sl > nl[i] && nl[i] > 0) {
                        sl = nl[i];
                        ix = i;
                    }
                    var m = pw > (e.gw[ix] + e.tabw + e.thumbw) ? 1 : (pw - (e.tabw + e.thumbw)) / (e.gw[ix]);
                    newh = (e.gh[ix] * m) + (e.tabh + e.thumbh);
                }
                if (window.rs_init_css === undefined) window.rs_init_css = document.head.appendChild(document.createElement("style"));
                document.getElementById(e.c).height = newh + "px";
                window.rs_init_css.innerHTML += "#" + e.c + "_wrapper { height: " + newh + "px }";
            } catch (e) {
                console.log("Failure at Presize of Slider:" + e)
            }
            //});
        };</script>

    <link rel="stylesheet" href="/client/css/style.css">
    <link rel="stylesheet" href="/client/css/responsive.css">
    <!--*********************************---->
    @if(setting('site.nocopy'))
    <script src="/lib/js/nocoppy.js"></script>
    @endif
    {!! setting('site.remarketing_header') !!}
    @yield('styles')

</head>
<body>
<div id="app-vue">
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
</div>

{!! setting('site.remarketing_footer') !!}
</body>
<!--************START*************---->
@yield('scripts')
<!-- Vendor js -->
{{--<script src="{{asset('lib/assets/js/vendor.min.js')}}"></script>--}}
<!-- rating js -->
{{--<script src="https://coderthemes.com/adminox/layouts/vertical/assets/libs/ratings/jquery.raty-fa.js"></script>--}}
<!-- Tost-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet" type="text/css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@include('errors.note')
<script type="text/javascript">
    // Ajax form
    function ajaxform(ele) {

        jQuery(ele).ajaxSubmit({
            headers: {
                "X-CSRF-Token": $('meta[name=_token]').attr('content')
            },
            beforeSubmit: function (formData, jqForm, options) {
                $(ele).find('[type=submit]').attr('disabled');

            },
            success: function (responseText, statusText, xhr, $form) {


            },
            error: function (xhr, status, errMsg, $form) {

            },
            complete: function (xhr, statusText, $form) {

                $(ele).find('[type=submit]').attr('disabled', false);

                let result = xhr.responseText;

                try {
                    result = $.parseJSON(result);
                } catch {
                    console.log('invalid json response');
                    $('#ajax-modal').html(result).modal();
                    return;
                }

                flash(result);

                if (result.type == 'success' || result.type == 'info') {

                    if ($form.data('reset') == true)
                        $form.resetForm();

                    $('#ajax-modal').modal('hide');

                    try {
                        $table.bootstrapTable('refresh', {silent: true});
                    } catch {
                    }
                }

            }

        });
        return false;
    }

    $(document).on('submit', '.ajax-form', function (e) {
        e.preventDefault();

        ajaxform(this);
        return false;
    });
</script>

<script src="/lib/js/cpanel.js"></script>

<!--*************************---->
{{--<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>--}}
{{--<script type="text/javascript">--}}
{{--    let alias = $('.vue-alias').val();--}}
{{--    // let amount = $('#quantity').val();--}}
{{--    var app = new Vue({--}}
{{--        el: '#app-vue',--}}
{{--        mounted:function(){--}}
{{--            var vm = this;--}}
{{--        },--}}
{{--        data:{--}}
{{--            alias: alias,--}}
{{--            carts: @json(Cart::content()),--}}
{{--            lang: {--}}
{{--                type: 0,--}}
{{--                id: 0,--}}
{{--                lang:0,--}}
{{--            },--}}
{{--            cart: {--}}
{{--                total: "{{Cart::subtotal(0)}}",--}}
{{--                count: {{Cart::content()->count()}},--}}
{{--            },--}}
{{--            amount: 1,--}}
{{--            price:0,--}}
{{--            options:[]--}}
{{--        },--}}
{{--        methods: {--}}
{{--            plusQuantity:function(){--}}
{{--                if ( jQuery('input[name="quantity"]').val() != undefined ) {--}}
{{--                    var currentVal = parseInt(jQuery('input[name="quantity"]').val());--}}
{{--                    if (!isNaN(currentVal)) {--}}
{{--                        var amount = jQuery('input[name="quantity"]').val(currentVal + 1);--}}
{{--                    } else {--}}
{{--                        var amount = jQuery('input[name="quantity"]').val(1);--}}
{{--                    }--}}
{{--                    app.amount = amount.val();--}}
{{--                }else {--}}
{{--                    console.log('error: Not see elemnt ' + jQuery('input[name="quantity"]').val());--}}
{{--                }--}}
{{--                console.log(amount);--}}
{{--            },--}}
{{--            minusQuantity:function(){--}}
{{--                if ( jQuery('input[name="quantity"]').val() != undefined ) {--}}
{{--                    var currentVal = parseInt(jQuery('input[name="quantity"]').val());--}}
{{--                    if (!isNaN(currentVal) && currentVal > 1) {--}}
{{--                        var amount = jQuery('input[name="quantity"]').val(currentVal - 1);--}}
{{--                        app.amount = amount.val();--}}
{{--                    }--}}
{{--                }else {--}}
{{--                    console.log('error: Not see elemnt ' + jQuery('input[name="quantity"]').val());--}}
{{--                }--}}
{{--            },--}}
{{--            buyNow:function(id, price, qty =1){--}}
{{--                let route = "{{route('ajax.order.create',[":id",':price', ":qty"])}}".replace(":id",id).replace(":qty",qty).replace(":price",price);--}}
{{--                fetch(route).then(function (res) {--}}
{{--                    return res.json().then(function (data) {--}}
{{--                        let checkout = "{{route('order.checkout')}}";--}}
{{--                        window.location.assign(checkout);--}}
{{--                    })--}}
{{--                })--}}
{{--            },--}}
{{--            orderCreate:function(id, qty = 1, options = null){--}}
{{--                let route = "{{route('ajax.order.create',[":id", ":qty",':options'])}}".replace(":id",id).replace(":qty",qty).replace(":options",options);--}}
{{--                fetch(route).then(function (res) {--}}
{{--                    return res.json().then(function (data) {--}}
{{--                        app.carts = data.carts;--}}
{{--                        app.cart.total = data.total;--}}
{{--                        app.cart.count = data.count;--}}
{{--                        let obj = {--}}
{{--                            'message' : "Thêm thành công sản phẩm vào giỏ hàng!",--}}
{{--                            'type' : "success"--}}
{{--                        }--}}
{{--                        flash(obj);--}}
{{--                    })--}}
{{--                })--}}
{{--            },--}}
{{--            orderRemove:function(rowId){--}}
{{--                if(confirm('Xóa sản phẩm?')){--}}
{{--                    let route = "{{route('ajax.order.remove',":rowId")}}".replace(":rowId",rowId);--}}
{{--                    fetch(route).then(function (res) {--}}
{{--                        return res.json().then(function (data) {--}}
{{--                            app.carts = data.carts;--}}
{{--                            app.cart.total = data.total;--}}
{{--                            app.cart.count = data.count;--}}
{{--                        })--}}
{{--                    })--}}
{{--                }--}}
{{--            },--}}
{{--            orderUpdate:function(rowId, qty){--}}
{{--                let route = "{{route('ajax.order.update',[":rowId",":qty"])}}".replace(":rowId",rowId).replace(":qty",qty);--}}
{{--                fetch(route).then(function (res) {--}}
{{--                    return res.json().then(function (data) {--}}
{{--                        app.carts = data.carts;--}}
{{--                        app.cart.total = data.total;--}}
{{--                        app.cart.count = data.count;--}}
{{--                        let obj = {--}}
{{--                            'message' : "Cật nhật thành công!",--}}
{{--                            'type' : "success"--}}
{{--                        }--}}
{{--                        flash(obj);--}}
{{--                    })--}}
{{--                })--}}
{{--            }--}}
{{--        },--}}
{{--        watch: {--}}
{{--            alias:function(val){--}}
{{--                this.alias = val;--}}
{{--            },--}}
{{--            amount:function(val){--}}
{{--                this.amount = val;--}}
{{--            }--}}
{{--        },--}}
{{--        computed:{--}}

{{--        }--}}
{{--    })--}}
{{--</script>--}}

<script>

    function flash(obj) {
        if (obj.hasOwnProperty('errors')) {
            $.each(obj.errors, function (key, value) {
                toastr['error'](value);
            });
        } else if (obj.type) {

            toastr[obj.type](obj.message);
        } else if (obj.message) {
            toastr['error'](obj.message);
        } else
            toastr['warning']('Đã có lỗi xảy ra');

        if (obj.hasOwnProperty('url') && (obj.url != null && obj.url != '')) {
            window.open(obj.url, obj.target)
        }

    }


    // // Flash message
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "opacity": "1",
        "timeOut": "6000",
        "extendedTimeOut": "4000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

</script>

<!--*************************---->

<!--****STARTACTION CALL*****---->
{{--<div class="action-call">--}}
{{--  <div id="phonering-alo-phoneIcon" class="phonering-alo-phone phonering-alo-green phonering-alo-show">--}}
{{--    <div class="phonering-alo-ph-circle"></div>--}}
{{--    <div class="phonering-alo-ph-circle-fill"></div>--}}
{{--    <div class="phonering-alo-ph-img-circle">--}}
{{--      <a class="pps-btn-img " href="tel:{{setting('contact.phone')}}"> <img src="https://wonderads.vn/themes/default/images/v8TniL3.png" alt="Liên hệ" width="50" class="img-responsive"/> </a>--}}
{{--    </div>--}}
{{--  </div>--}}
{{--</div>--}}

<div id="fb-root"></div>
<script src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0"></script>
<!--*****END ACTION CALL*****---->
@if(setting('api.messenger_id'))
    <div class="fb-customerchat" page_id="{{setting('api.messenger_id')}}" greeting_dialog_delay="30"
         logged_in_greeting="{{setting('api.messenger_text')}} "
         logged_out_greeting="{{setting('api.messenger_text')}} "></div>

    <div id='fb-root'></div>
    <script type="text/javascript">
        window.fbAsyncInit = function () {
            FB.init({
                xfbml: true,
                version: 'v6.0'
            });
        };

        window.addEventListener('load', function () {
            var is_load = 0

            function loadfb() {
                if (is_load == 0) {
                    is_load = 1
                    var an = document.createElement('script')
                    an.async = true;
                    an.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1'
                    var sc = document.getElementsByTagName('script')[0]
                    sc.parentNode.insertBefore(an, sc)
                }
            }

            window.addEventListener('scroll', function () {
                loadfb()
            })
            setTimeout(function () {
                loadfb()
            }, 5000)
        });
    </script>
@endif

@if(setting('api.google_analytics_id'))
    <script type="text/javascript">
        window.addEventListener('load', function () {
            var is_load = 0

            function loadanalytics() {
                if (is_load == 0) {
                    is_load = 1
                    var an = document.createElement('script')
                    an.async = true;
                    an.src = 'https://www.googletagmanager.com/gtag/js?id={{setting('api.google_analytics_id')}}'
                    var sc = document.getElementsByTagName('script')[0]
                    sc.parentNode.insertBefore(an, sc)
                    window.dataLayer = window.dataLayer || [];

                    function gtag() {
                        dataLayer.push(arguments);
                    }

                    gtag('js', new Date());
                    gtag('config', '{{setting('api.google_analytics_id')}}');
                }
            }

            window.addEventListener('scroll', function () {
                loadanalytics()
            })
            setTimeout(function () {
                loadanalytics()
            }, 3000)
        })
    </script>
@endif
</html>
