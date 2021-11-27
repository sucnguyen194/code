<main>
    <header id="js-header"
            class="u-header u-header--static u-header--show-hide u-header--change-appearance u-header--has-hidden-element"
            data-header-fix-moment="500" data-header-fix-effect="slide">
        <div class="u-header__section u-header__section--light g-bg-img-hero g-transition-0_3"
             style="background-image: url(assets/img/bgheader.jpg);">
            <div class="d-lg-flex flex-md-row align-items-center g-pos-rel">
                <button class="navbar-toggler navbar-toggler-right btn g-hidden-lg-up g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-top-3 g-right-0"
                        type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar"
                        data-toggle="collapse" data-target="#navBar">
              <span class="hamburger hamburger--slider">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
              </span>
              </span>
                </button>
                <a href="/" class="navbar-brand blogo">
                    <img src="{{setting('site.logo')}}" class="g-hidden-md-down" alt="{{setting('site.name', 1)}}"/>
                    <img src="{{setting('site.logo')}}" class="g-hidden-lg-up" alt="{{setting('site.name', 1)}}"/>
                </a>
                <div class="col g-mt-0--lg g-px-0">
                    <div class="row flex-row justify-content-between align-items-center g-mx-0 g-my-5--lg">
                        <div class="col-auto divslogan g-my-5">
                            <div class="text-uppercase g-line-height-1 g-font-weight-600 g-color-primary g-mb-0 fslogan">
                                {{setting('site.slogan', 1)}}
                            </div>
                        </div>
                        <div class="col-auto g-pos-rel g-my-5 g-hidden-lg-up">
                            <a href=""><i
                                    class="fa fa-home g-color-main-5 g-font-size-25 g-valign-middle"></i></a>
                        </div>
                        <div class="col-auto g-pos-rel g-my-5 g-hidden-md-down">
                            <a href="tel:+{{setting('contact.hotline')}}"
                               class="btn btn-xs g-bg-submit-contact u-btn-skew g-brd-2 g-rounded-50 g-mx-1">
                    <span class="u-btn-skew__inner g-color-primary fslogan g-font-weight-500 g-letter-spacing-0_5">
                    <i class="icon-call-in g-mr-5 g-font-weight-900"></i>
                      {{setting('contact.hotline')}}</span>
                            </a>
                        </div>
                        <div class="col-auto g-pos-rel g-my-5 g-hidden-lg-up">
                            <ul class="list-inline g-overflow-hidden g-pt-1 g-mx-minus-4 mb-0">
                                <li class="list-inline-item g-mx-4">
                                    <i class="icon-call-in g-font-size-18 g-valign-middle g-color-primary g-pos-rel g-top-minus-2 g-mr-5"></i>
                                    <a href="tel:+{{setting('contact.hotline')}}"
                                       class="g-color-primary g-text-underline--none--hover">{{setting('contact.hotline')}}</a>
                                </li>
                            </ul>
                        </div>
{{--                        <div class="col-auto g-pos-rel g-my-5">--}}
{{--                            <ul class="list-inline g-overflow-hidden g-pt-1 g-mx-minus-4 mb-0">--}}
{{--                                <li class="list-inline-item g-mx-4">--}}
{{--                                    <i class="icon-globe-alt g-font-size-18 g-valign-middle g-color-primary g-pos-rel g-top-minus-2 g-mr-5"></i>--}}
{{--                                    <a href=''--}}
{{--                                       class='g-color-primary g-text-underline--none--hover'>English</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                    <nav class="navbar navbar-expand-lg p-0 g-bg-l-navtop">
                        <div class="js-mega-menu collapse navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg g-bg-navtop"
                             id="navBar">
                            <ul class="navbar-nav text-uppercase g-font-weight-600 g-py-15">
                                <li class="nav-item g-mx-10--lg g-font-size-22"><a class="nav-link p-0"
                                                                                   href="/"><i
                                            class="fa fa-home g-color-main-5"></i></a></li>
                                @php
                                    $menus = \App\Models\Menu::ofPosition(\App\Enums\MenuPosition::top)->get();
                                @endphp

                                @foreach($menus->where('parent_id', 0) as $menu)
                                <li class='nav-item {{$menus->where('parent_id', $menu->id)->count() ? "hs-has-sub-menu" : ""}} g-mx-20--lg'><a id='nav-link-1060'
                                                                                    aria-haspopup='true'
                                                                                    aria-expanded='false'
                                                                                    aria-controls='nav-submenu-1060'
                                                                                    class='nav-link p-0'
                                                                                    href="{{$menu->slug}}">{{$menu->name}}</a>
                                    @if($menus->where('parent_id', $menu->id)->count())
                                    <ul class='g-brd-top-footer hs-sub-menu g-bg-primary list-unstyled g-text-transform-none g-min-width-200 g-mt-6 g-mt-10--lg--scrolling'
                                        id='nav-submenu-1060' aria-labelledby='nav-link-1060'>
                                        @foreach($menus->where('parent_id', $menu->id) as $sub)
                                        <li class='dropdown-item nav-item g-font-weight-600'><a
                                                class='nav-link g-py-10'
                                                href="{{$sub->slug}}">{{$sub->name}}</a></li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach

                            </ul>

                        </div>

                    </nav>
                </div>
            </div>
        </div>
    </header>
