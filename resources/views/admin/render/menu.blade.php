
@foreach($menus->where('parent_id', 0) as $items)
    <li class="dd-item" data-id="{{$items->id}}">
        <div class="dd-handle">{{$items->translation->name}}</div>
        <div class="menu_action">
            @can('menu.edit')
                <a href="{{route('admin.menus.edit',$items)}}" title="Sửa"
                   class="ajax-modal btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a>
            @endcan

            @can('menu.destroy')
                <a href="{{route('admin.menus.destroy',$items)}}" title="Xóa"
                   class="ajax-link-menu btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?"
                   data-refresh="true" data-method="DELETE"><i class="fe-x"></i> </a>
            @endcan
        </div>

        <ol class="dd-list">
            @include('admin.render.sub_menu', ['menus' => $menus, 'parent_id' => $items->id])
        </ol>
    </li>
@endforeach
