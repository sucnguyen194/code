<!-- Footer -->
<footer class="g-bg-primary g-py-20 g-brd-top-footer">
    <div class="container">
        <div class="row">
            <!-- Footer Content -->
            <div class="col-lg-4 g-mb-50 g-mb-0--lg">
                <a class="d-block g-mb-20" href="/">
                    <img class="img-fluid" src="https://i.imgur.com/I0re7Tp.png" alt="1"/>
                </a>
                <h2 class="g-font-weight-700 g-font-size-16 g-color-footer g-mb-20">{{setting('site.name',1)}}</h2>

                <address class="g-color-footer g-mb-20">
                    @if(setting('contact.address',1))
                    <div class="d-flex g-mb-15">
                        <div class="g-mr-10">
              <span class="g-font-size-18 g-color-icon-footer">
                <i class="fa fa-home"></i>
              </span>
                        </div>
                        <p class="mb-0"><strong>Địa chỉ: </strong>{{setting('contact.address',1)}}</p>
                    </div>
                    @endif
                        @if(setting('contact.hotline'))
                    <div class="d-flex g-mb-15">
                        <div class="g-mr-10">
              <span class="g-font-size-18 g-color-icon-footer">
                <i class="fa fa-phone"></i>
              </span>
                        </div>
                        <p class="mb-0"><strong>Điện thoại: </strong><a
                                class="g-color-footer g-color-white--hover" href="tel:{{setting('contact.hotline')}}">{{setting('contact.hotline')}}</a>
                        </p>
                    </div>
                        @endif
                        @if(setting('contact.fax'))
                    <div class="d-flex g-mb-15">
                        <div class="g-mr-10">
              <span class="g-font-size-18 g-color-icon-footer">
                <i class="fa fa-fax"></i>
              </span>
                        </div>
                        <p class="mb-0"><strong>Fax:</strong> {{setting('contact.fax')}}</p>
                    </div>
                    @endif

                        @if(setting('contact.email'))
                    <div class="d-flex g-mb-15">
                        <div class="g-mr-10">
              <span class="g-font-size-18 g-color-icon-footer">
                <i class="icon-communication-005 u-line-icon-pro"></i>
              </span>
                        </div>
                        <p class="mb-0">
                            <strong>Email:</strong>
                            <a class="g-color-footer g-color-white--hover" href="mailto:{{setting('contact.email')}}">{{setting('contact.email')}}</a>
                        </p>
                    </div>
                        @endif
                </address>


            </div>
            <!-- End Footer Content -->

            <!-- Footer Content -->
            <div class="col-lg-4 g-mb-30 g-mb-0--lg">

                <h2 class="h6 g-color-footer g-font-weight-700 g-mb-20">
                            <span class="g-font-size-18 g-color-icon-footer"><i
                                    class="icon-communication-005 u-line-icon-pro"></i></span>
                    Liên hệ</h2>
                <div class="row">
                    <div class="col-sm-12">
                        <form method="post" action="{{route('send.contact')}}" class="ajax-form">
                            @csrf
                        <div class="form-group g-mb-10">
                            <input name="data[name]" type="text" class="form-control g-font-size-default g-placeholder-inherit g-bg-input-contact g-bg-white--focus g-brd-primary g-px-10 g-py-10" placeholder="Họ tên" required/>
                        </div>
                        <div class="form-group g-mb-10">
                            <input name="data[phone]" type="text"  class="form-control g-font-size-default g-placeholder-inherit g-bg-input-contact g-bg-white--focus g-brd-primary  g-px-10 g-py-10" placeholder="Điện thoại"/>
                        </div>
                        <div class="form-group g-mb-10">
                            <input name="data[email]" type="text" class="form-control g-font-size-default g-placeholder-inherit g-bg-input-contact g-bg-white--focus g-brd-primary g-px-10 g-py-10" placeholder="Email"/>
                        </div>
                        <div class="form-group g-mb-10">
                        <textarea name="data[note]" rows="2" cols="20" class="form-control g-font-size-default g-placeholder-inherit g-bg-input-contact g-bg-white--focus g-brd-primary g-px-10 g-py-10"
                      placeholder="Nội dung">
</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn u-btn-primary g-bg-submit-contact g-color-primary btn-sm text-uppercase g-font-weight-700 g-font-size-12 g-px-20 g-py-10 mb-0">Gửi </button>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- End Footer Content -->

            <!-- Footer Content -->
            <div class="col-lg-4">
                <h2 class="h6 g-color-footer g-font-weight-700 g-mb-20"><span
                        class="g-font-size-18 g-color-icon-footer">
                        <i class="icon-globe"></i>
                      </span>Kết nối</h2>
                <div class="row">
                    @if(setting('social.facebook'))
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=710563779422756&autoLogAppEvents=1" nonce="aVJKhm1k"></script>

                    <div class="col-sm-12 g-mb-20">
                        <div class="fb-page" data-href="{{setting('social.facebook')}}" data-tabs="timeline" data-width="" data-height="225" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="{{setting('social.facebook')}}" class="fb-xfbml-parse-ignore"><a href="{{setting('social.facebook')}}">{{setting('site.name',1)}}</a></blockquote></div>
                    </div>
                        @endif
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="list-inline g-mb-20 g-mb-0--md ">
                            <li class="list-inline-item">
                                <a class="u-icon-v2 g-width-35 g-height-35 g-font-size-default g-color-icon-footer g-color-white--hover g-bg-primary--hover g-brd-icon-footer g-brd-primary--hover g-rounded-50x g-mx-5"
                                   href="{{setting('social.twitter')}}"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a class="u-icon-v2 g-width-35 g-height-35 g-font-size-default g-color-icon-footer g-color-white--hover g-bg-primary--hover g-brd-icon-footer g-brd-primary--hover g-rounded-50x g-mx-5"
                                   href="{{setting('social.pinterest')}}"><i class="fa fa-pinterest-p"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a class="u-icon-v2 g-width-35 g-height-35 g-font-size-default g-color-icon-footer g-color-white--hover g-bg-primary--hover g-brd-icon-footer g-brd-primary--hover g-rounded-50x g-mx-5"
                                   href="{{setting('social.facebook')}}"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a class="u-icon-v2 g-width-35 g-height-35 g-font-size-default g-color-icon-footer g-color-white--hover g-bg-primary--hover g-brd-icon-footer g-brd-primary--hover g-rounded-50x g-mx-5"
                                   href="{{setting('social.linkedin')}}"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Footer Content -->
        </div>
    </div>
</footer>
<!-- End Footer -->
<a class="js-go-to u-go-to-v1" href="#!"
   data-type="fixed"
   data-position='{
           "bottom": 135,
           "right": 20
         }'
   data-offset-top="400"
   data-compensation="#js-header"
   data-show-effect="zoomIn">
    <i class="hs-icon hs-icon-arrow-top"></i>
</a>
</main>
<!-- JS Global Compulsory -->
<script src="assetsfw/vendor/jquery/jquery.min.js"></script>
<script src="assetsfw/vendor/jquery-migrate/jquery-migrate.min.js"></script>
<script src="assetsfw/vendor/popper.min.js"></script>
<script src="assetsfw/vendor/bootstrap/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->


<script src="assetsfw/vendor/hs-megamenu/src/hs.megamenu.js"></script>
<script src="assetsfw/vendor/slick-carousel/slick/slick.js"></script>
<script src="assetsfw/vendor/fancybox/jquery.fancybox.min.js"></script>
<!-- JS Unify -->
<script src="assetsfw/js/hs.core.js"></script>
<script src="assetsfw/js/components/hs.header.js"></script>
<script src="assetsfw/js/helpers/hs.hamburgers.js"></script>


<script src="assetsfw/js/components/hs.tabs.js"></script>

<script src="assetsfw/js/components/hs.carousel.js"></script>
<script src="assetsfw/js/components/hs.go-to.js"></script>
<script src="assets/masterslidejs/masterslider.min.js"></script>
<!-- JS Customization
<script src="assetsfw/js/custom.js"></script> -->
<!-- JS Plugins Init. -->
<script type="text/javascript">
    // initialization of master slider
    var promoSlider = new MasterSlider();
    promoSlider.setup('masterslider', {
        width: 1400,
        //height: 380,
        autoHeight: true,
        speed: 5,

        layout: 'fullwidth',
        fullscreenMargin: 200,
        loop: true,
        preload: 0,
        autoplay: true,

    });

    promoSlider.control('thumblist', {
        autohide: false,
        dir: 'h',
        align: 'bottom',
        width: 200,
        height: 120,
        margin: 0,
        space: 0,
        hideUnder: 767
    });
    $(document).on('ready', function () {
        // initialization of carousel
        $.HSCore.components.HSCarousel.init('.js-carousel');
        // initialization of header
        $.HSCore.components.HSHeader.init($('#js-header'));
        $.HSCore.helpers.HSHamburgers.init('.hamburger');

        // initialization of tabs
        $.HSCore.components.HSTabs.init('[role="tablist"]');

        // initialization of go to section
        $.HSCore.components.HSGoTo.init('.js-go-to');
        // initialization of HSMegaMenu component
        $('.js-mega-menu').HSMegaMenu({
            event: 'hover',
            pageContainer: $('.container'),
            breakpoint: 991
        });
        $(window).on('resize', function () {
            setTimeout(function () {
                $.HSCore.components.HSTabs.init('[role="tablist"]');
            }, 200);
        });
    });
</script>
