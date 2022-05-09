@if($fixed)
<section
    class="elementor-section elementor-top-section elementor-element elementor-element-22eebdb main-nav elementor-section-boxed elementor-section-height-default elementor-section-height-default"
    data-id="22eebdb" data-element_type="section"
    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">

    @else

        <section
            class="elementor-section elementor-inner-section elementor-element elementor-element-22eebdb elementor-section-boxed elementor-section-height-default elementor-section-height-default"
            data-id="5116ce0" data-element_type="section"
            data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;ekit_sticky_on&quot;:[&quot;desktop&quot;],&quot;ekit_sticky&quot;:&quot;top&quot;,&quot;ekit_sticky_offset&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:0,&quot;sizes&quot;:[]},&quot;ekit_sticky_effect_offset&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:0,&quot;sizes&quot;:[]}}">

            @endif

    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <div
                class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-36142fd"
                data-id="36142fd" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div
                            class="elementor-element elementor-element-57f39d3 elementor-widget elementor-widget-ekit-nav-menu"
                            data-id="57f39d3" data-element_type="widget"
                            data-widget_type="ekit-nav-menu.default">
                            <div class="elementor-widget-container">
                                <div class="ekit-wid-con ekit_menu_responsive_tablet"
                                     data-hamburger-icon="" data-hamburger-icon-type="icon"
                                     data-responsive-breakpoint="1024">
                                    <button class="elementskit-menu-hamburger elementskit-menu-toggler">
                                        <span class="elementskit-menu-hamburger-icon"></span><span
                                            class="elementskit-menu-hamburger-icon"></span><span
                                            class="elementskit-menu-hamburger-icon"></span>
                                    </button>
                                    <div id="ekit-megamenu-main-menu"
                                         class="elementskit-menu-container elementskit-menu-offcanvas-elements elementskit-navbar-nav-default elementskit_line_arrow ekit-nav-menu-one-page-no">
                                        <ul id="main-menu"
                                            class="elementskit-navbar-nav elementskit-menu-po-left submenu-click-on-icon">
                                            @foreach($menus as $menu)
                                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-2631 nav-item elementskit-dropdown-has relative_position elementskit-dropdown-menu-default_width elementskit-mobile-builder-content"
                                                data-vertical-menu=750px><a href="{{$menu->slug}}"
                                                                            class="ekit-menu-nav-link ekit-menu-dropdown-toggle">{{$menu->name}} @if($menu->parents->count()) <i class="icon icon-down-arrow1 elementskit-submenu-indicator"></i> @endif </a>
                                                @if($menu->parents->count())
                                                <ul class="elementskit-dropdown elementskit-submenu-panel">
                                                    @foreach($menu->parents as $parent)
                                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7616 nav-item elementskit-mobile-builder-content" data-vertical-menu=750px><a
                                                            href="{{$parent->slug}}"
                                                            class=" dropdown-item">{{$parent->name}}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                        <div class="elementskit-nav-identity-panel">
                                            <div class="elementskit-site-title">
                                                <a class="elementskit-nav-logo" href="/"
                                                   target="_self" rel="">
                                                    <img
                                                        src="{{setting('site.logo')}}"
                                                        alt="">
                                                </a>
                                            </div>
                                            <button
                                                class="elementskit-menu-close elementskit-menu-toggler"
                                                type="button">X
                                            </button>
                                        </div>
                                    </div>
                                    <div
                                        class="elementskit-menu-overlay elementskit-menu-offcanvas-elements elementskit-menu-toggler ekit-nav-menu--overlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-614c4f3"
                data-id="614c4f3" data-element_type="column"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div
                            class="elementor-element elementor-element-37d927f elementor-widget elementor-widget-instive-search"
                            data-id="37d927f" data-element_type="widget"
                            data-widget_type="instive-search.default">
                            <div class="elementor-widget-container">
                                <div class="ts-search-box">

                                    <form method="get" action="{{route('search')}}"
                                          class="instive-serach xs-search-group">
                                        <div class="input-group">
                                            <input type="search" class="form-control" name="key"
                                                   placeholder="Search..." value="{{request()->key}}">
                                            <button class="input-group-btn search-button"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-84696b8"
                data-id="84696b8" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div
                            class="elementor-element elementor-element-e47a6a2 ekit-off-canvas-position-right elementor-widget elementor-widget-elementskit-header-offcanvas"
                            data-id="e47a6a2" data-element_type="widget"
                            data-widget_type="elementskit-header-offcanvas.default">
                            <div class="elementor-widget-container">
                                <div class="ekit-wid-con">
                                    <div class="ekit-offcanvas-toggle-wraper">
                                        <a href="#"
                                           class="ekit_navSidebar-button ekit_offcanvas-sidebar">
                                            <i aria-hidden="true" class="fasicon icon-menu-9"></i> </a>
                                    </div>
                                    <!-- offset cart strart -->
                                    <!-- sidebar cart item -->
                                    <div class="ekit-sidebar-group info-group">
                                        <div class="ekit-overlay ekit-bg-black"></div>
                                        <div class="ekit-sidebar-widget">
                                            <div class="ekit_sidebar-widget-container">
                                                <div class="ekit_widget-heading">
                                                    <a href="#" class="ekit_close-side-widget">

                                                        <i aria-hidden="true" class="fas fa-times"></i>
                                                    </a>
                                                </div>
                                                <div class="ekit_sidebar-textwidget">

                                                    <div
                                                        class="widgetarea_warper widgetarea_warper_editable"
                                                        data-elementskit-widgetarea-key="1708bef"
                                                        data-elementskit-widgetarea-index="99">
                                                        <div class="widgetarea_warper_edit"
                                                             data-elementskit-widgetarea-key="1708bef"
                                                             data-elementskit-widgetarea-index="99">
                                                            <i class="eicon-edit"
                                                               aria-hidden="true"></i>
                                                            <span
                                                                class="elementor-screen-only">Edit</span>
                                                        </div>

                                                        <div class="elementor-widget-container">
                                                            <div data-elementor-type="wp-post"
                                                                 data-elementor-id="968"
                                                                 class="elementor elementor-968"
                                                                 data-elementor-settings="[]">
                                                                <div class="elementor-inner">
                                                                    <div class="elementor-section-wrap">
                                                                        <section
                                                                            class="elementor-section elementor-top-section elementor-element elementor-element-8077bdd elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                                                            data-id="8077bdd"
                                                                            data-element_type="section">
                                                                            <div
                                                                                class="elementor-container elementor-column-gap-default">
                                                                                <div
                                                                                    class="elementor-row">
                                                                                    <div
                                                                                        class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-f79e31b"
                                                                                        data-id="f79e31b"
                                                                                        data-element_type="column">
                                                                                        <div
                                                                                            class="elementor-column-wrap elementor-element-populated">
                                                                                            <div
                                                                                                class="elementor-widget-wrap">
                                                                                                <div
                                                                                                    class="elementor-element elementor-element-83d6c1e elementor-widget elementor-widget-image"
                                                                                                    data-id="83d6c1e"
                                                                                                    data-element_type="widget"
                                                                                                    data-widget_type="image.default">
                                                                                                    <div
                                                                                                        class="elementor-widget-container">
                                                                                                        <div
                                                                                                            class="elementor-image">
                                                                                                            <a href="/">
                                                                                                                <img
                                                                                                                    width="431"
                                                                                                                    height="90"
                                                                                                                    src="{{setting('site.logo')}}"
                                                                                                                    class="attachment-full size-full"
                                                                                                                    alt="logo"
                                                                                                                    loading="lazy"
                                                                                                                    sizes="(max-width: 431px) 100vw, 431px"/>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="elementor-element elementor-element-1bfc3c7 elementor-widget elementor-widget-heading"
                                                                                                    data-id="1bfc3c7"
                                                                                                    data-element_type="widget"
                                                                                                    data-widget_type="heading.default">
                                                                                                    <div
                                                                                                        class="elementor-widget-container">
                                                                                                        <h2 class="elementor-heading-title elementor-size-default">{{setting('site.footer_title', true)}}</h2>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="elementor-element elementor-element-3f6da04 elementor-widget elementor-widget-text-editor"
                                                                                                    data-id="3f6da04"
                                                                                                    data-element_type="widget"
                                                                                                    data-widget_type="text-editor.default">
                                                                                                    <div
                                                                                                        class="elementor-widget-container">
                                                                                                        <div
                                                                                                            class="elementor-text-editor elementor-clearfix">{!! setting('site.footer', true) !!}
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="elementor-element elementor-element-021b604 elementor-widget elementor-widget-elementskit-button"
                                                                                                    data-id="021b604"
                                                                                                    data-element_type="widget"
                                                                                                    data-widget_type="elementskit-button.default">
                                                                                                    <div
                                                                                                        class="elementor-widget-container">
                                                                                                        <div
                                                                                                            class="ekit-wid-con">
                                                                                                            <div
                                                                                                                class="ekit-btn-wraper">
                                                                                                                <a href="#"
                                                                                                                   class="elementskit-btn  whitespace--normal">


                                                                                                                    Đăng
                                                                                                                    nhập </a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="elementor-element elementor-element-b32bb6c elementor-widget elementor-widget-heading"
                                                                                                    data-id="b32bb6c"
                                                                                                    data-element_type="widget"
                                                                                                    data-widget_type="heading.default">
                                                                                                    <div
                                                                                                        class="elementor-widget-container">
                                                                                                        <h2 class="elementor-heading-title elementor-size-default">
                                                                                                            thông
                                                                                                            tin
                                                                                                            liên
                                                                                                            hệ</h2>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="elementor-element elementor-element-6ae0212 elementor-align-left elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                                                                                                    data-id="6ae0212"
                                                                                                    data-element_type="widget"
                                                                                                    data-widget_type="icon-list.default">
                                                                                                    <div
                                                                                                        class="elementor-widget-container">
                                                                                                        <ul class="elementor-icon-list-items">
                                                                                                            <li class="elementor-icon-list-item">
											<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-telegram-plane"></i>						</span>
                                                                                                                <span
                                                                                                                    class="elementor-icon-list-text">{{setting('contact.address', true)}}</span>
                                                                                                            </li>
                                                                                                            <li class="elementor-icon-list-item">
                                                                                                                <a href="tel:{{setting('contact.phone')}}">						<span
                                                                                                                        class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-phone-alt"></i>						</span>
                                                                                                                    <span
                                                                                                                        class="elementor-icon-list-text">{{setting('contact.phone')}}</span>
                                                                                                                </a>
                                                                                                            </li>
                                                                                                            <li class="elementor-icon-list-item">
											<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="far fa-building"></i>						</span>
                                                                                                                <span
                                                                                                                    class="elementor-icon-list-text">{{setting('contact.time_open')}}</span>
                                                                                                            </li>
                                                                                                        </ul>
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- END sidebar widget item -->
                                    <!-- END offset cart strart -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
