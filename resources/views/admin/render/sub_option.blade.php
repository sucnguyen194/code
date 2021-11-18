@foreach($options->where('parent_id', $parent_id) as $option)
    <option value="{{$option->id}}" {{selected($option->id, $selected)}}>{!! $tab !!} {{optional($option->translation)->name}}</option>
    @include('admin.render.sub_option', ['options' => $options, 'parent_id' => $option->id, 'tab' => $tab."&nbsp;&nbsp;",'selected' => $selected])
@endforeach
