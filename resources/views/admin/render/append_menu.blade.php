<li class="dd-item" data-id="{{$menu->id}}">
    <div class="dd-handle">{{optional($menu->translation)->name}}</div>
    <div class="menu_action">
        @can('menu.edit')
            <a href="{{route('admin.menus.edit',$menu)}}" title="{{__('lang.edit')}}"
               class="ajax-modal btn btn-primary waves-effect waves-light"><i class="fe-edit-2"></i></a>
        @endcan
        @can('menu.destroy')
            <a href="{{route('admin.menus.destroy',$menu)}}" title="{{__('lang.destroy')}}"
               class="ajax-link-menu btn btn-warning waves-effect waves-light" data-confirm="{{__('lang.confirm_destroy')}}"
               data-refresh="true" data-method="DELETE"><i class="fe-x"></i> </a>
        @endcan
    </div>
