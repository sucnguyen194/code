@php($tab = "&nbsp;&nbsp")

@foreach($options->where('parent_id', 0) as $option)
    <option value="{{$option->id}}" {{selected($option->id, $selected)}}> {{$option->name}}</option>
    @include('admin.render.sub_option', ['options' => $options, 'parent_id' => $option->id, 'tab' => $tab,'selected' => $selected] )
@endforeach
