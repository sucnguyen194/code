<textarea id="nestable-output" class="d-none" name="menuval"></textarea>
<div class="form-group">
    <label><strong class="text-uppercase">{{__('_position')}}</strong></label>
    <select class="form-control position" data-toggle="select2">
        @foreach(\App\Enums\MenuPosition::getInstances() as $menu)
            <option value="{{$menu->value}}"
                    {{selected(session('menu_position'),$menu->value)}} class="form-control">{{__('_menu')}} {{$menu->description}}</option>
        @endforeach

    </select>
</div>

<div class="custom-dd dd" id="nestable">
    <ol class="dd-list" id="result_data">
        @foreach($menus->where('parent_id', 0) as $items)
            <li class="dd-item" data-id="{{$items->id}}">
                <div class="dd-handle">{{$items->name}}</div>
                <div class="menu_action">
                    @can('menu.edit')
                        <a href="{{route('admin.menus.edit',$items)}}" title="{{__('_edit')}}"
                           class="ajax-modal btn btn-primary waves-effect waves-light ajax-modal"><i
                                class="fe-edit-2"></i></a>
                    @endcan

                    @can('menu.destroy')
                        <a href="{{route('admin.menus.destroy',$items)}}" title="{{__('_delete')}}"
                           class="ajax-link-menu btn btn-warning waves-effect waves-light"
                           data-confirm="{{__('_delete_record')}}"
                           data-refresh="true" data-method="DELETE"><i class="fe-x"></i> </a>
                    @endcan
                </div>

                <ol class="dd-list">
                    @include('admin.render.sub_menu', ['menus' => $menus, 'parent_id' => $items->id])
                </ol>
            </li>
        @endforeach
    </ol>
</div>



