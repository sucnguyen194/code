@foreach($menus->where('parent_id', $parent_id) as $items)
    <li class="dd-item" data-id="{{$items->id}}">
        <div class="dd-handle">{{$items->name}}</div>
        <div class="menu_action">
            @can('menu.edit')
            <a href="{{route('admin.menus.edit',$items)}}" title="{{__('_edit')}}"
               class="ajax-modal btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a>
            @endcan

            @can('menu.destroy')
            <a href="{{route('admin.menus.destroy',$items)}}" title="{{__('lang.destroy')}}"
               class="ajax-link-menu btn btn-warning waves-effect waves-light" data-confirm="{{__('_delete_record')}}"
               data-refresh="true" data-method="DELETE"><i class="fe-x"></i> </a>
            @endcan
        </div>

        <ol class="dd-list">
          @include('admin.render.sub_menu', ['menus' => $menus, 'parent_id' => $items->id])
        </ol>
    </li>
@endforeach

