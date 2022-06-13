<ul class="metismenu" id="side-menu">
    <li>
        <a href="{{route('admin.dashboard')}}">
            <i class="fe-home"></i>
            <span>{{__('_dashboard')}}</span>
        </a>
    </li>
    @can('admin.view')
        <li>
            <a href="javascript:void(0)">
                <i class="fe-user"></i>
                <span>{{__('_admin')}}</span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{route('admin.admins.index')}}">{{__('_account')}}</a>
                </li>
                @can('role.view')
                    <li>
                        <a href="{{route('admin.roles.index')}}">{{__('_role')}}</a>
                    </li>
                @endcan
                @can('permission.view')
                    <li>
                        <a href="{{route('admin.permissions.index')}}">{{__('_permission')}}</a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan
    @can('menu.view')
        <li>
            <a href="{{route('admin.menus.index')}}">
                <i class="fe-align-left"></i>
                <span>@lang('_menu')</span>
            </a>
        </li>
    @endcan
    @can('photo.view')
        <li>
            <a href="{{route('admin.photos.index')}}">
                <i class="fe-image"></i>
                <span>{{__('_image')}}</span>
            </a>
        </li>
    @endcan
    @can('contact.view')
        <li>
            <a href="{{route('admin.contacts.index')}}" class="{{nav_active('admin/contacts*')}}">
                <i class="fe-mail"></i>
                <span>{{__('_messenger')}}</span>
            </a>
        </li>
    @endcan
    @canany('support.view')
        <li>
            <a href="javascript:void(0)">
                <i class="fe-mic"></i>
                <span>{{__('_support')}}</span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                @can('support.view')
                    <li>
                        <a href="{{route('admin.supports.customers.index')}}">{{__('_customer_reviews')}}</a>
                    </li>

                    <li>
                        <a href="{{route('admin.supports.index')}}">{{__('_support_team')}}</a>
                    </li>

                    <li>
                        <a href="{{route('admin.supports.questions.index')}}">{{__('_frequently_asked_questions')}}</a>
                    </li>
                @endcan

            </ul>
        </li>
    @endcan
    @can('comment.view')
        <li class="{{nav_active('admin/comments*','mm-active')}}">
            <a href="javascript:void(0)">
                <i class="fe-message-square"></i>
                <span>{{__('_comment')}}</span>
                <span class="menu-arrow"></span>
                @if($comments->count()) <span
                    class="badge badge-danger badge-pill">{{$comments->count()}}</span>@endif
                <ul class="nav-second-level" aria-expanded="false">
                    @can('blog.view')
                        <li>
                            <a href="{{route('admin.comments.list','posts')}}">{{__('_post')}} <span
                                    class="badge badge-danger badge-pill">{{$comments->where('comment_type',\App\Enums\CommentMap::posts)->count()}}</span></a>
                        </li>
                    @endcan
                    @can('product.view')
                        <li>
                            <a href="{{route('admin.comments.list','products')}}">{{__('_product')}}
                                <span
                                    class="badge badge-danger badge-pill">{{$comments->where('comment_type',\App\Enums\CommentMap::products)->count()}}</span></a>
                        </li>
                    @endcan
                </ul>
            </a>
        </li>
    @endcan
    @can('tag.view')
        <li>
            <a href="{{route('admin.tags.index')}}">
                <i class="fe-tag"></i>
                <span>{{__('_tag')}}</span>
            </a>
        </li>
    @endcan

    @canany(['blog.view', 'video.view','gallery.view'])
        <li class="menu-title">{{__('_content')}}</li>
    @endcan

    @can('blog.view')
        <li class="{{nav_active('admin/posts*','mm-active')}}">
            <a href="javascript:void(0)">
                <i class="fe-book"></i>
                <span>{{__('_post')}}</span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                @can('blog.create')
                    <li>
                        <a href="{{route('admin.posts.create')}}">{{__('_add_new')}} </a>
                    </li>
                @endcan
                <li>
                    <a href="{{route('admin.posts.index')}}">{{__('_list_post')}}</a>
                </li>
                <li>
                    <a href="{{route('admin.posts.categories.index')}}">{{__('_category_post')}}</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{route('admin.posts.pages.index')}}" class="{{nav_active('admin/pages*')}}">
                <i class="fe-file-text"></i>
                <span>{{__('_page')}}</span>
            </a>
        </li>

    @endcan

    @can('gallery.view')
        <li>
            <a href="{{route('admin.posts.galleries.index')}}"
               class="{{nav_active('admin/galleries*')}}">
                <i class="fe-upload-cloud"></i>
                <span>{{__('_gallery')}}</span>
            </a>
        </li>
    @endcan
    @can('video.view')
        <li>
            <a href="{{route('admin.posts.videos.index')}}" class="{{nav_active('admin/videos*')}}">
                <i class="fe-film"></i>
                <span>{{__('_video')}}</span>
            </a>
        </li>
    @endcan

    @can('recruitment.view')

        <li class="{{nav_active('admin/recruitments*','mm-active')}}">
            <a href="javascript:void(0)">
                <i class="fe-user-plus"></i>
                <span>{{__('lang.recruitment')}}</span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                @can('recruitment.create')
                    <li>
                        <a href="{{route('admin.recruitments.create')}}">{{__('_add_new')}}</a>
                    </li>
                @endcan
                <li>
                    <a href="{{route('admin.recruitments.index')}}">{{__('_list_post')}}</a>
                </li>
                <li>
                    <a href="{{route('admin.recruitments.categories.index')}}">{{__('_category_post')}}</a>
                </li>
            </ul>
        </li>
    @endcan

    @canany(['product.view', 'discount.view','order.view','user.view'])
        <li class="menu-title">{{__('_transaction')}}</li>
    @endcan
    @can('product.view')
        <li class="{{nav_active('admin/products*','mm-active')}}">
            <a href="javascript:void(0)">
                <i class="fe-box"></i>
                <span>{{__('_product')}}</span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                @can('product.create')
                    <li>
                        <a href="{{route('admin.products.create')}}">{{__('_add_new')}}</a>
                    </li>
                @endcan
                <li>
                    <a href="{{route('admin.products.index')}}">{{__('_list_product')}}</a>
                </li>
                <li>
                    <a href="{{route('admin.products.categories.index')}}">{{__('_category_product')}}</a>
                </li>
                <li>
                    <a href="{{route('admin.filters.index')}}">{{__('_filter')}}</a>
                </li>

            </ul>
        </li>
    @endcan

    @can('discount.view')
        <li>
            <a href="{{route('admin.discounts.index')}}" class="{{nav_active('admin/discounts*')}}">
                <i class="fe-gift"></i>
                <span> {{__('_discount')}}</span>
            </a>
        </li>
    @endcan

    @can('order.view')
        <li>
            <a href="{{route('admin.orders.index')}}" class="{{nav_active('admin/orders*')}}">
                <i class="fe-shopping-cart"></i>
                <span>{{__('_order')}}</span>
            </a>
        </li>
    @endcan

    @can('user.view')
        <li>
            <a href="{{route('admin.users.index')}}">
                <i class="fe-users"></i>
                <span>{{__('_customer')}}</span>
            </a>
        </li>
    @endcan

    @can('setting.update')
        <li class="menu-title">{{__('_setting')}}</li>
        <li class="{{nav_active('admin/languages*','mm-active')}}">
            <a href="javascript:void(0)" class="{{nav_active('admin/languages*')}}">
                <i class="fe-settings"></i>
                <span>Website</span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{route('admin.settings')}}">{{__('_system_configuration')}}</a>
                </li>

                @can('setting.source')
                    <li>
                        <a href="{{route('admin.sources.index')}}">{{__('_edit_website')}}</a>
                    </li>
                @endcan
                @can('setting.language')
                    <li class="{{nav_active('admin/languages*','mm-active')}}">
                        <a href="{{route('admin.languages.index')}}" class="{{nav_active('admin/languages*')}}">{{__('_language')}}</a>
                    </li>
                @endcan

            </ul>
        </li>
        <li>
            <a href="{{route('admin.logs')}}">
                <i class="fe-activity"></i>
                <span>System Logs</span>
            </a>
        </li>
    @endcan
</ul>
